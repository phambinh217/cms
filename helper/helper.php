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

if (! function_exists('api_url')) {
    function api_url($path = null, $parameters = [], $secure = null)
    {
        return url('api/' . $path, $parameters, $secure);
    }
}


if (! function_exists('thumbnail_url')) {
    function thumbnail_url($image_url, $size = [])
    {
        // Nếu file không thuộc nội bộ website trả về file gốc
        // không xử lí
        if (! file_in_local($image_url)) {
            return $image_url;
        }

        // Xử lí file ảnh thumnail từ file ảnh gốc
        if (is_string($size)) {
            $size_string = $size;
        } else {
            $size = array_merge(['height' => '100', 'width' => '100'], $size);
            $size_string = implode('x', $size);
        }

        $image_relative_path = urldecode(str_replace(url('uploads') .'/', '', $image_url));
        $image_name = basename($image_relative_path);
        $thumbnail_name = $size_string . $image_name;
        $thumbnail_path = str_replace($image_name, null, $image_relative_path);
        
        if (! file_exists(image_path($image_relative_path))) {
            return $image_url;
        }

        mkdirs(image_thumb_path($thumbnail_path));

        // Nếu file ảnh này đã được tạo thì trả về file trước đó
        if (file_exists(image_thumb_path($thumbnail_path . $thumbnail_name))) {
            return image_thumb_url($thumbnail_path . $thumbnail_name);
        }

        // Tạo file ảnh mới
        \Image::make(image_path($image_relative_path), [
            'width'    => $size['width'],
            'height'    => $size['height'],
            'crop'        => true,
        ])->save(image_thumb_path($thumbnail_path . $thumbnail_name));

        return image_thumb_url($thumbnail_path . $thumbnail_name);
    }
}

if (! function_exists('image_path')) {
    function image_path($image = null)
    {
        return public_path('uploads/' . $image);
    }
}

if (! function_exists('image_thumb_path')) {
    function image_thumb_path($image = null)
    {
        return config('cms.thumb_path').($image ? DIRECTORY_SEPARATOR . $image : $image);
    }
}

if (! function_exists('image_thumb_url')) {
    function image_thumb_url($image = null)
    {
        return url('uploads/thumbs/' . $image);
    }
}

if (! function_exists('file_in_local')) {
    function file_in_local($file_url)
    {
        $base_url = url('/');
        $base_url = str_replace(['http://', 'https://'], null, $base_url);
        $base_url = str_replace('/', '\/', $base_url);
        
        return preg_match("/(http:\/\/|https:\/\/)". $base_url ."\/uploads\/(.+)/", $file_url) == 1;
    }
}

if (! function_exists('image_url')) {
    function image_url($image = null)
    {
        return url('uploads/' . $image);
    }
}


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
            return app(\Phambinh\Cms\Services\Setting::class);
        }

        return app(\Phambinh\Cms\Services\Setting::class)->get($key, $default);
    }
}
