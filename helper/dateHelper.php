<?php

if (! function_exists('changeFormatDate')) {
    function changeFormatDate($date, $currentFormat = DTF_DB, $format = DTF_NORMAL_24)
    {
        $timestamp = dateToTimesamp($date, $currentFormat);
        return date($format, $timestamp);
    }
}

if (! function_exists('dateToTimesamp')) {
    function dateToTimesamp($date, $format = DTF_DB)
    {
        $date = date_parse_from_format($format, $date);
        $timestamp = mktime(
            (int) $date['hour'],
            (int) $date['minute'],
            (int) $date['second'],
            (int) $date['month'],
            (int) $date['day'],
            (int) $date['year']
        );

        return $timestamp;
    }
}


if (! function_exists('get_total_dates')) {
    function get_total_dates($first, $last, $output_format = 'd/m/Y', $step = '+1 day')
    {
        $dates        = [];
        $current    = strtotime($first);
        $last        = strtotime($last);

        while ($current <= $last) {
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
}

if (! function_exists('get_dates')) {
    function get_dates($type)
    {
        switch ($type) {
            case 'this-month':
                $dates = get_total_dates(date('Y-m-01'), date('Y-m-t'), DF_DB);
                break;
        }

        return $dates;
    }
}

if (!function_exists('text_time_difference')) {
    function text_time_difference($date, $format = DTF_DB)
    {
        $time = time() - dateToTimesamp($date, $format);

        $tokens = [
            31536000 => 'năm',
            2592000 => 'tháng',
            604800 => 'tuần',
            86400 => 'ngày',
            3600 => 'giờ',
            60 => 'phút',
            1 => 'giây'
        ];

        if ($time != 0) {
            if ($time < 1) {
                $time = abs($time);
                $subfix = ' nữa';
            } else {
                $subfix = ' trước';
            }

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) {
                    continue;
                }
                $number_of_units = floor($time / $unit);
                return $number_of_units.' '.$text . $subfix;
            }
        } else {
            return 'Vừa xong';
        }
    }
}
