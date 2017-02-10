<?php 

if (! function_exists('api_url')) {
    /**
     * [api_url description]
     * @param  [type] $path       [description]
     * @param  array  $parameters [description]
     * @param  [type] $secure     [description]
     * @return [type]             [description]
     */
    function api_url($path = null, $parameters = [], $secure = null)
    {
        return url('api/' . $path, $parameters, $secure);
    }
}
