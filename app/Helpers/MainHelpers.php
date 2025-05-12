<?php

use App\Models\Form;
use Illuminate\Support\Facades\Auth;
/**
 * Возвращает массив с расписанием для отображения в фронте. Параметр App\Models\Form.
 * @param  Illuminate\Database\Eloquent\Collection
 * @return array
 */
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

function checkAuth()
{
    if (!(Auth::check())) {
        header('Location: ' . route('auth'));
        die();
    }
}

function getStringDay($day)
{
    switch ($day) {
        case 1:
            return "Понедельник";
        case 2:
            return "Вторник";

        case 3:
            return "Среда";

        case 4:
            return "Четверг";

        case 5:
            return "Пятница";

        case 6:
            return "Суббота";

        case 7:
            return "Воскресенье";
    }
}

function getShortStringDay($day)
{
    switch ($day) {
        case 1:
            return "ПН";
        case 2:
            return "ВТ";
        case 3:
            return "СР";
        case 4:
            return "ЧТ";
        case 5:
            return "ПТ";
        case 6:
            return "СБ";
        case 7:
            return "ВС";
    }
}

function getStringOrderStatusForUser($status)
{
    switch ($status) {
        case 0:
            return "Ожидает подтверждения";
        case 1:
            return "Подтверждён, оплатите заказ";
        case 2:
            return "Отменён стримером";
        case 3:
            return "Отменён вами";
    }
}

function getStringOrderStatusForStreamer($status)
{
    switch ($status) {
        case 0:
            return "Ожидает подтверждения";
        case 1:
            return "Подтверждён";
        case 2:
            return "Отменён вами";
        case 3:
            return "Отменён пользователем";
    }
}

function getStringPaymentStatus($status)
{
    switch ($status) {
        case 0:
            return "Не оплачен";
        case 1:
            return "Оплачен";
    }
}