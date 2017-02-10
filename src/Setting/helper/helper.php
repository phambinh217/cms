<?php
/**
 * ModuleAlias: setting
 * ModuleName: setting
 * Description: Helper functions of module setting
 * @author: noname
 * @version: 1.0
 * @package: PhambinhCMS
 */

if (!function_exists('setting_path')) {
    function setting_path($path = null)
    {
        return config('setting.cache.path') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app(\Phambinh\Cms\Setting\Services\Setting::class);
        }

        return app(\Phambinh\Cms\Setting\Services\Setting::class)->get($key, $default);
    }
}
