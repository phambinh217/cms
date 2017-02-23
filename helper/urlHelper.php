<?php 

if (! function_exists('std_uri')) {
    /**
     * Chuẩn hóa uri
     * @param  string $path
     * @return string
     */
    function std_uri($path)
    {
        if (starts_with($path, url('/'))) {
            $path = str_replace(url('/'), null, $path);
        }

        return trim($path, '/');
    }
}

if (! function_exists('url_in_local')) {
    /**
 * Kiểm tra đường dẫn có phải là nội bộ
 * @param  string $url
 * @return boolean
 */
    function url_in_local($url)
    {
        $base_url = url('/');
        $base_url = str_replace(['http://', 'https://'], null, $base_url);
        $base_url = str_replace('/', '\/', $base_url);
        $p = "/(http:\/\/|https:\/\/)" . ($base_url) ."\/(.+)/";

        return preg_match($p, $url) == 1;
    }
}

if (!function_exists('asset_url')) {
    function asset_url($module, $path = null)
    {
        if ($path) {
            $append = trim($module, '/') .'/'.$path;
        } else {
            $append = $module;
        }

        return url('assets/'.$append);
    }
}