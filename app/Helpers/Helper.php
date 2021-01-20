<?php

namespace App\Helpers;

use Config;
use Carbon\Carbon;

class Helper
{
    public static function stt($key, $page)
    {
        return ($page - 1) * Config::get('constants.per_page') + $key + 1;
    }
    public static function desTooltip($value)
    {
        return '<p data-toggle="tooltip-light" data-placement="bottom" title="" data-original-title="' . $value . '">
                    ' . mb_strimwidth($value, 0, 100, '...') . '
                </p>';
    }
    public static function formatEventTime($value)
    {
        return Carbon::parse($value)->format('g:i A');
    }

    public static function selectDateTime($name, $value)
    {
        return <<<HTML
            <input type='text' class="form-control $name" name="$name" value="$value" />
            <script type="text/javascript">
            $(function () {
                $(".$name").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            });
        </script>
HTML;
    }
    public static function selectOnlyDate($name, $value)
    {
        return <<<HTML
            <input type='text' id="$name" class="form-control $name" name="$name" value="$value" required />
            <script type="text/javascript">
            $(function () {
                $(".$name").flatpickr({
                });
            });
        </script>
HTML;
    }
    public static function selectOnlyTime($name, $value)
    {
        return <<<HTML
            <input type='text' class="form-control $name" name="$name" value="$value" required />
            <script type="text/javascript">
            $(function () {
                $(".$name").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
            });
        </script>
HTML;
    }
    public static function uploadSingleImage($oldImage, $name)
    {
        $image = $oldImage ? asset($oldImage) : asset('mainPage/image/photo.png');
        return <<<HTML
        <div class="preview-upload-image">
            <img id="img-sigle-preview" src="$image"/>
        </div>
        <button  type="button" class="btn-photo-image mb-2 mr-2 btn-icon btn-icon-only btn btn-light"><i class="pe-7s-camera btn-icon-wrapper"> </i></button>
        <input type="file" class="form-control upload-single-image" id="upload-single-image" name="$name" style="width: 0" required/>
HTML;
    }

    public static function activeMenu($name, $actionName = null)
    {

        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
        $controller = str_replace('controller', '', strtolower($controller));
        if (($name == $controller && $actionName == '') || ($name == $controller && strtolower($actionName) == strtolower($action)) || (is_array($name) && in_array($controller, $name))) {
            return 'mm-active';
        }
        return '';
    }

    public static function formatDate($date)
    {
        $dt = is_null($date) ? Carbon::now() : new Carbon($date);
        return  $dt->format('d/m/Y');
    }
    public static function formatDate1($date)
    {
        $dt = is_null($date) ? Carbon::now() : new Carbon($date);
        return  $dt->format('d-m-Y');
    }
    public static function formatDateTime($date)
    {
        $dt = is_null($date) ? Carbon::now() : new Carbon($date);
        return  $dt->format('d-m-Y H:i:s');
    }
    
    public static function formatTime($date)
    {
        $dt = is_null($date) ? Carbon::now() : new Carbon($date);
        return  $dt->format('H:i:s');
    }
    public static function setSelected($val, $origin)
    {
        $active = $val == $origin ? 'selected' : '';
        return $active;
    }
    public static function formatSqlDate($date)
    {
        if (is_null($date)) {
            return null;
        }
        $dt = new Carbon($date);
        return $dt->format('Y-m-d');
    }
    public static function formatDayOfWeek($date)
    {
        if (is_null($date)) {
            return null;
        }
        $dt = new Carbon($date);
        return $dt->format('l');
    }
}
