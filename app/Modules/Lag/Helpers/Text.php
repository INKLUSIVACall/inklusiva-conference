<?php

namespace App\Modules\Lag\Helpers;

class Text
{
    public const CONTEXT_HEARING = 'hearing';
    public const KEY_HEARING_DEAF = 'deaf';
    public const KEY_HEARING_HARD_OF_HEARING = 'hearing_impaired';
    public const KEY_HEARING_NORMAL = 'normal';

    public const CONTEXT_EYESIGHT = 'eyesight';
    public const KEY_EYESIGHT_BLIND = 'blind';
    public const KEY_EYESIGHT_VISUALLY_IMPAIRED = 'visually_impaired';
    public const KEY_EYESIGHT_NORMAL = 'normal';

    public const CONTEXT_ASSISTANTS = 'assistants';
    public const KEY_ASSISTANTS_SIGNLANG_DISPLAY_TILE = 'tile';
    public const KEY_ASSISTANTS_SIGNLANG_DISPLAY_WINDOW = 'window';

    public const CONTEXT_SUPPORT_NEED = 'supportNeed';
    public const CONTEXT_ISON = 'UIHasFeature';
    public const CONTEXT_HASPERCENT = 'HasPercent';
    public const CONTEXT_ISACTIVE = 'isActive';

    public static function getStringByContext($context, $key)
    {
        if ($context === self::CONTEXT_HEARING)
            switch ($key) {
                case self::KEY_HEARING_DEAF:
                    return 'Mein Meeting soll auf die Bedarfe gehörloser Menschen angepasst sein';
                    break;
                case self::KEY_HEARING_HARD_OF_HEARING:
                    return 'Mein Meeting soll auf die Bedarfe von Menschen mit Höreinschränkungen angepasst sein';
                    break;
                case self::KEY_HEARING_NORMAL:
                    return 'Ich brauche keine Anpassungen im Bereich „Hören“';
                    break;
                default:
                    return 'Unbekannt';
                    break;
            }

        if ($context === self::CONTEXT_EYESIGHT)
            switch ($key) {
                case self::KEY_EYESIGHT_BLIND:
                    return 'Mein Meeting soll auf die Bedarfe blinder Menschen angepasst sein';
                    break;
                case self::KEY_EYESIGHT_VISUALLY_IMPAIRED:
                    return 'Mein Meeting soll auf die Bedarfe von Menschen mit Seheinschränkung angepasst sein';
                    break;
                case self::KEY_EYESIGHT_NORMAL:
                    return 'Ich brauche keine Anpassungen im Bereich „Sehen“';
                    break;
                default:
                    return 'Unbekannt';
                    break;
            }

        if ($context === self::CONTEXT_ASSISTANTS)
            switch ($key) {
                case self::KEY_ASSISTANTS_SIGNLANG_DISPLAY_TILE:
                    return 'als Kachel anzeigen';
                    break;
                case self::KEY_ASSISTANTS_SIGNLANG_DISPLAY_WINDOW:
                    return 'als eigenes Fenster anzeigen';
                    break;

                default:
                    # code...
                    break;
            }
        if ($context === self::CONTEXT_SUPPORT_NEED)
            if ($key) {
                return 'eingeschaltet';
            } else {
                return 'kein Unterstützungsbedarf';
            }

        if ($context === self::CONTEXT_ISON)
            if ($key) {
                return 'ein';
            } else {
                return 'aus';
            }

        if ($context === self::CONTEXT_HASPERCENT) {
            return $key . ' %';
        }

        if ($context === self::CONTEXT_ISACTIVE) {
            if ($key) {
                return 'aktiv';
            } else {
                return 'inaktiv';
            }
        }
    }
}
