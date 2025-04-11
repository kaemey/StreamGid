<?php
function timing($form)
{
    $timingData = explode(';', $form->timing);
    $timing = [];
    foreach ($timingData as $dayData) {
        $day = explode(':', $dayData);
        switch ($day[0]) {
            case 1:
                $timing['ПН'][0] = true;
                if ($day[1] == '0') {
                    $timing['ПН'][0] = false;
                }
                $timing['ПН'][1] = $day[2];
                $timing['ПН'][2] = $day[3];
            case 2:
                $timing['ВТ'][0] = true;
                if ($day[1] == '0') {
                    $timing['ВТ'][0] = false;
                }
                $timing['ВТ'][1] = $day[2];
                $timing['ВТ'][2] = $day[3];
            case 3:
                $timing['СР'][0] = true;
                if ($day[1] == '0') {
                    $timing['СР'][0] = false;
                }
                $timing['СР'][1] = $day[2];
                $timing['СР'][2] = $day[3];
            case 4:
                $timing['ЧТ'][0] = true;
                if ($day[1] == '0') {
                    $timing['ЧТ'][0] = false;
                }
                $timing['ЧТ'][1] = $day[2];
                $timing['ЧТ'][2] = $day[3];
            case 5:
                $timing['ПТ'][0] = true;
                if ($day[1] == '0') {
                    $timing['ПТ'][0] = false;
                }
                $timing['ПТ'][1] = $day[2];
                $timing['ПТ'][2] = $day[3];
            case 6:
                $timing['СБ'][0] = true;
                if ($day[1] == '0') {
                    $timing['СБ'][0] = false;
                }
                $timing['СБ'][1] = $day[2];
                $timing['СБ'][2] = $day[3];
            case 7:
                $timing['ВС'][0] = true;
                if ($day[1] == '0') {
                    $timing['ВС'][0] = false;
                }
                $timing['ВС'][1] = $day[2];
                $timing['ВС'][2] = $day[3];
        }
    }
    return $timing;
}