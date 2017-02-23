<?php 

if (! function_exists('mkdirs')) {
    function mkdirs($path)
    {
        $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
        $segments = explode(DIRECTORY_SEPARATOR, $path);
        $p = null;
        foreach ($segments as $segment) {
            if (empty($segment)) {
                continue;
            }

            $p .= $segment . DIRECTORY_SEPARATOR;
            if (! is_dir($p)) {
                mkdir($p);
            }
        }
    }
}
