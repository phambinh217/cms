<?php 
if (! function_exists('prefix_number')) {
    function prefix_number($value, $prefix = null)
    {
        if ($prefix == null) {
            if ($value >= 0) {
                return '+' . $value;
            }
            return '-' . $value;
        }
        
        return $prefix . $value;
    }
}
