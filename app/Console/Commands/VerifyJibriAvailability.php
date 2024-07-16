<?php

namespace App\Console\Commands;

use App\Modules\Lag\Helpers\JibriInstance as JibriInstanceHelper;
use Illuminate\Console\Command;
use App\Modules\Lag\Helpers\Meeting as MeetingHelper;
use App\Modules\Lag\Models\JibriInstance;
use App\Modules\Lag\Models\Meeting;

/**
 * Verifies if enough Jibri instances are available for the currently running conferences.
 * 
 * @package App\Console\Commands
 */
class VerifyJibriAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inklusiva:verify-jibri-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prüft, ob für die aktuell laufenden Konferenzen genug Jibri-Instanzen verfügbar sind.';

    /**
     * Sends a query to the Hetzner Cloud API.
     * @param string $url 
     * @param string $method 
     * @param array|null $payload 
     * @return array|null JSON-Response or null if successful, false if failed.
     * @throws Exception 
     */
    public static function sendQueryToAPI($url, $method, ?array $payload = null) : ?array {
        $bodyMethod = false;
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $bodyMethod = true;
        }

        $headers = [
            'Authorization: Bearer '.env('JIBRI_CLOUD_BEARER_TOKEN')
        ];
        if ($bodyMethod) {
            $headers[] = 'Content-Type: application/json';
        }

        $apiUrl = env('JIBRI_CLOUD_API_URL');

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $apiUrl . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => $method
        ]);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_PUT, 'PUT');
        }

        if ($bodyMethod) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        if ($payload !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorNumber = curl_errno($ch);
        curl_close($ch);

        if ($errorNumber != \CURLE_OK || $httpCode >= 400) {
            throw new \Exception('Failed to send query to Jibri Cloud API. HTTP code: '.$httpCode . PHP_EOL . 'Response: ' . $response);
        }

        if (mb_strlen(trim($response)) === 0) {
            return null;
        }

        $jsonResponse = null;
        try {
            $jsonResponse = @json_decode($response, true);
            if (!is_array($jsonResponse)) {
                $jsonResponse = null;
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse JSON response from Jibri Cloud API. Response: ' . $response);
        }
        
        return $jsonResponse;
    }

    /**
     * Fetches the list of active rooms in Prosody and compares it with the number of Jibri instances.
     *
     * @return string[]
     */
    private function fetchActiveRoomsInProsody() : array
    {
        // uses the command muc:list() via telnet to receive all Prosody rooms
        $timeout = 30; // Connection timeout in seconds
        $host = env('PROSODY_HOST', 'localhost'); // Prosody host
        $port = env('PROSODY_PORT', 5582); // Prosody telnet port
        $muc = env('PROSODY_MUC', 'conference.inklusiva-meet.4morgen.de'); // MUC domain

        if ($muc === null) {
            throw new \Exception('The MUC domain is not set in the .env file.');
        }

        // Open a socket connection to the Prosody telnet console
        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$fp) {
            echo "Error: $errstr ($errno)\n";
        } else {
            // Wait until the console is ready (no input for 100 ms)
            usleep(100 * 1000); // 100 milliseconds in microseconds

            // Send the 'muc:list()' command followed by a newline to execute it
            fwrite($fp, 'muc:list("' . $muc . '")' . PHP_EOL);

            // Wait for and read the response
            $read = array($fp);
            $write = null;
            $except = null;
            $response = "";

            // Using stream_select to handle waiting for input
            while (stream_select($read, $write, $except, 0, 100000)) { // Timeout set to 100 ms
                foreach ($read as $read_fp) {
                    $response .= fgets($read_fp, 1024);
                    if (mb_strpos($response, 'OK') !== false) {
                        break 2;
                    }
                }
            }

            // Send 'quit' and close the connection
            fwrite($fp, "quit\n");
            fclose($fp);
        }

        // Escaping $muc for use in a regex pattern
        $escapedMuc = preg_quote($muc, '/');

        // Split $response by line breaks
        $lines = preg_split('/\r\n|\r|\n/', $response);

        // Initialize an array to hold the room names
        $roomNames = [];

        // Iterate through each line
        foreach ($lines as $line) {
            // Check if the line matches the pattern
            if (preg_match("/\| (.*)@$escapedMuc/", $line, $matches)) {
                // If a match is found, add the room name to the array
                $roomNames[] = $matches[1];
            }
        }

        // Return the array of room names
        return $roomNames;
    }    

    /**
     * Spins up a new Jibri instance.
     * @return void 
     */
    private function spinUpJibriInstance() : void {
        // Call Hetzner API to spin up a new instance

        //create a random server key
        $serverCode = str_pad(strtoupper(dechex(crc32(time() . mt_rand(1, 1000000)))), 8, '0', STR_PAD_RIGHT);

        $prefix = env('JIBRI_CLOUD_SERVER_NAME_PREFIX', 'LAG-JIBRI-');

        $ssh_keys = json_decode(env('JIBRI_CLOUD_SSH_KEYS'), true);
        $payload = [
            'automount' => false,
            'firewalls' => [[
                'firewall' => env('JIBRI_CLOUD_FIREWALL_ID')
            ]],
            'image' => env('JIBRI_CLOUD_SNAPSHOT_ID'),
            'location' => 'nbg1',
            'public_net' => [
                'enable_ipv4' => true,
                'enable_ipv6' => false
            ],
            'server_type' => 'ccx13',
            'ssh_keys' => $ssh_keys,
            'start_after_create' => true,
            'name' => $prefix.$serverCode
        ];

        // Send the request to the API
        try {
            $response = self::sendQueryToAPI('/servers', 'POST', $payload);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if (is_null($response)) {
            throw new \Exception('Failed to create a new Jibri instance. No response from the API.');
        }

        $serverId = $response['server']['id'];
        $ipv4 = $response['server']['public_net']['ipv4']['ip'];
        
        $jibriInstance = new JibriInstance([
            'cloud_id' => $serverId,
            'ipv4' => $ipv4,
            'status' => JibriInstance::STATUS_BOOTING
        ]);
        $jibriInstance->save();

        $internalId = $jibriInstance->id;

        // Call the boot script of the Jibri instance - this will prepare all config files on the Jibri instance and inform us once the instance is ready
        $bootScript = env('JIBRI_BOOT_SCRIPT');
        shell_exec('nohup ' . $bootScript . ' ' . $serverId . ' ' . $ipv4 . ' ' . $internalId . ' ' . $serverCode . ' >/dev/null 2>&1 &');
    }    

    /**
     * Kills a Jibri instance.
     * @param JibriInstance $instance 
     * @return bool 
     */
    private function killInstance(JibriInstance $instance) : bool {
        if ($instance->status !== JibriInstance::STATUS_IDLE) {
            return false;
        }

        try {
            self::sendQueryToAPI('/servers/' . $instance->cloud_id, 'DELETE');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }            

        // Call the shutdown script of the Jibri instance
        $shutdownScript = env('JIBRI_SHUTDOWN_SCRIPT'); //Closes firewall for the IP
        shell_exec('nohup ' . $shutdownScript . ' ' . $instance->ipv4 . ' >/dev/null 2>&1 &');

        // Delete the instance from the database
        $instance->delete();
        return true;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all Jibri instances, update their status and fetch Prosody rooms
        $currentInstances = JibriInstanceHelper::fetchJibriInstanceStatus();
        $prosodyRooms = $this->fetchActiveRoomsInProsody();

        // Get the meetings        
        $runningMeetings = Meeting::byJitsiRoomNames($prosodyRooms)->where('should_record', true)->get();

        //Verify if we have enough Jibri instances running
        $availableInstances = JibriInstance::all()->count();

        $requiredInstances = count($runningMeetings) - $availableInstances;

        // Spin up new Jibri instances if required
        for ($i = 0; $i < $requiredInstances; $i++) {            
            $this->spinUpJibriInstance();
            // Start a new Jibri instance
        }

        // Opposite: Kill Jibri instances if we have too many
        if ($availableInstances > count($runningMeetings)) {
            $allowShutdownUpTo = $availableInstances - count($runningMeetings);

            foreach ($currentInstances as $instance) {
                // Make sure we don't kill a busy instance
                if ($instance->status === JibriInstance::STATUS_IDLE) {
                    if ($this->killInstance($instance)) {
                        $allowShutdownUpTo--;
                    }                    
                }

                if ($allowShutdownUpTo === 0) {
                    break;
                }
            }
        }
    }
}
