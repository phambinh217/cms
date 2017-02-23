<?php 

if (! function_exists('preg_array_key_exists')) {
    /**
     * [preg_array_key_exists description]
     * @param  [type] $pattern [description]
     * @param  [type] $array   [description]
     * @return [type]          [description]
     */
    function preg_array_key_exists($pattern, $array)
    {
        foreach ($array as $key => $value) {
            if (preg_match($pattern, $key, $m)) {
                return $m;
            }
        }

        return false;
    }
}
    

if (! function_exists('array_undot')) {
    /**
     * Reversing array_dot
     * @param  string $str
     * @return array
     */
    function array_undot($path, $value, &$arr, $separator='.')
    {
        $keys = explode($separator, $path);
        foreach ($keys as $key) {
            $arr = &$arr[$key];
        }

        $arr = $value;
        return $arr;
    }
}

if (! function_exists('array_forget_value')) {
    function array_forget_value($array, $value)
    {
        foreach ($array as $key => $val) {
            if ($value == $val) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}

if (!function_exists('array_max')) {
    function array_max($array)
    {
        $max = $array[0];
        foreach ($array as $value) {
            if ($max < $value) {
                $max = $value;
            }
        }
        return $max;
    }
}


if (!function_exists('array_total')) {
    function array_total($array)
    {
        $sum = 0;
        foreach ($array as $value) {
            $sum = $sum + $value;
        }
        return $sum;
    }
}
