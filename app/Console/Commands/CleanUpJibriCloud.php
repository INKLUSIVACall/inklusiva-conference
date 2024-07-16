<?php

namespace App\Console\Commands;

use App\Modules\Lag\Models\JibriInstance;
use Illuminate\Console\Command;

/**
 * Deletion service which removes cloud services from the Hetzner Cloud if they are not registered in the database. In this case, they are considered orphaned servers and are deleted to avoid costs.
 * 
 * @package App\Console\Commands
 */
class CleanUpJibriCloud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inklusiva:clean-up-jibri-cloud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Löscht Server aus der Hetzner Cloud, wenn sie nicht in unserer Datenbank sind. In diesem Fall gelten sie als verwaiste Server und werden gelöscht, um Kosten zu vermeiden.';

    /**
     * Deletes all Jibri instances from the cloud which are not registered in the database.
     * @return void 
     * @throws InvalidArgumentException 
     * @throws Exception 
     * @throws LogicException 
     */
    private function cleanCloudInstances() : void {        
        // Query all known Jibri instances from the database
        $cloudInstanceIds = JibriInstance::all()->pluck('cloud_id')->toArray();

        $servers = array();

        // Query all running servers from the cloud
        $page = 1;
        $lastPage = false;
        while (!$lastPage) {
            $cloudInstances = VerifyJibriAvailability::sendQueryToAPI('/servers?per_page=50&page=' . $page, 'GET');
            $lastPage = is_null($cloudInstances['meta']['pagination']['next_page']);

            if (is_null($cloudInstances)) {
                throw new \Exception('Failed to fetch the list of cloud instances.');
            }

            foreach ($cloudInstances['servers'] as $server) {
                if (!in_array($server['id'], $cloudInstanceIds)) {
                    $status = $server['status'];
                    if (in_array($status, ['initializing', 'deleting', 'rebuilding', 'migrating', 'unknown'])) {
                        continue;
                    }

                    $servers[] = [
                        'id' => $server['id'],
                        'name' => $server['name']
                    ];
                }
            }            
        }

        $prefix = env('JIBRI_CLOUD_SERVER_NAME_PREFIX', 'LAG-JIBRI-');
        $pregPrefix = preg_quote($prefix, '/');

        // Check if they match the name pattern and delete them if they are not in the database.
        foreach ($servers as $server) {
            try {
                if (preg_match('/^' . $pregPrefix . '([A-F0-9]{8})$/', $server['name']) !== false && !in_array($server['id'], $cloudInstanceIds)) {
                    VerifyJibriAvailability::sendQueryToAPI('/servers/' . $server['id'], 'DELETE');
                }                
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }            
        }
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->cleanCloudInstances();
    }
}
