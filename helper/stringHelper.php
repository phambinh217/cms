<?php 

if (! function_exists('str_standard')) {
    /**
 *
 * Chuẩn hóa chuỗi
 *
 * @author phambinh.net
 * @return void
 */
    function str_standard($str)
    {
        $str = mb_strtolower($str, 'utf-8');

        $array_str = explode(chr(32), $str);
        $str_std = null;
        
        foreach ($array_str as $i => $word) {
            if (trim($word) == null) {
                unset($array_str[ $i ]);
            }
        }

        $str = implode(chr(32), $array_str);

        return $str;
    }
}

if (! function_exists('str_keyword')) {
    /**
 *
 *
 *
 * @author phambinh.net
 * @return void
 */
    function str_keyword($str)
    {
        $str = str_standard($str);
        $str = str_replace(chr(32), '%', $str);
        $str = '%'.$str .'%';

        return str_unicode($str);
    }
}

if (!function_exists('json_encode_pretify')) {
    /**
     * @param array $files
     */
    function json_encode_pretify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (! function_exists('str_unicode')) {
    function str_unicode($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        

        return $str;
    }
}
