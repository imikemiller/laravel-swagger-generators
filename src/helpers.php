<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 25/05/18
 * Time: 12:13
 */

if ( ! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('swagger_path')) {
    /**
     * Make a tidy file path for the swagger docs
     *
     * @param  string $file_path
     * @param  string $file_name
     * @return string
     */
    function swagger_path($file_path,$file_name)
    {
        return rtrim($file_path,'/').'/'.rtrim($file_name,'.json').'.json';
    }
}