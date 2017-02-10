<?php

if (! function_exists('admin_url')) {
    function admin_url($path = null, $parameters = [], $string_query = true, $secure = null)
    {
        if ($string_query) {
            if (count($parameters)) {
                if (str_contains($path, '?')) {
                    $path .= '&';
                } else {
                    $path .= '?';
                }

                $i = 0;
                foreach ($parameters as $key => $value) {
                    if ($i != 0) {
                        $path .= '&';
                    }
                    $path .= $key .'=' . $value;
                    $i++;
                }

                $parameters = [];
            }
        }

        return url('admin/' . $path, $parameters, $secure);
    }
}
