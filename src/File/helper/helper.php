<?php 

if (! function_exists('thumbnail_url')) {
    /**
 *
 * Trả về file thumbnail
 * Nếu file thumbnail chưa tồn tại thì tạo file thumbnail và trả về
 * File ảnh gốc phải nằm trên website
 *
 * @author phambinh.net
 * @return void
 */
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
    /**
 *
 * Đường dẫn tuyệt đối của file ảnh gốc
 *
 * @author phambinh.net
 * @return void
 */
    function image_path($image = null)
    {
        return public_path('uploads/' . $image);
    }
}

if (! function_exists('image_thumb_path')) {
    /**
 *
 * Đường dẫn tuyệt đối của file ảnh thumb
 *
 * @author phambinh.net
 * @return void
 */
    function image_thumb_path($image = null)
    {
        return config('file.thumb_path').($image ? DIRECTORY_SEPARATOR . $image : $image);
    }
}

if (! function_exists('image_thumb_url')) {
    /**
 * Url tuyệt đối của file ảnh thumb
 *
 *
 * @author phambinh.net
 * @return void
 */
    function image_thumb_url($image = null)
    {
        return url('uploads/thumbs/' . $image);
    }
}

if (! function_exists('file_in_local')) {
    /**
 *
 * Kiểm tra đường dẫn của file có thuộc website hay không
 *
 * @author phambinh.net
 * @return void
 */
    function file_in_local($file_url)
    {
        $base_url = url('/');
        $base_url = str_replace(['http://', 'https://'], null, $base_url);
        $base_url = str_replace('/', '\/', $base_url);
        
        return preg_match("/(http:\/\/|https:\/\/)". $base_url ."\/uploads\/(.+)/", $file_url) == 1;
    }
}

if (! function_exists('image_url')) {
    /**
 *
 *
 *
 * @author phambinh.net
 * @return void
 */
    function image_url($image = null)
    {
        return url('uploads/' . $image);
    }
}
