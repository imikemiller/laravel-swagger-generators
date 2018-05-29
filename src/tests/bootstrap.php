<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 24/05/18
 * Time: 08:57
 */

if(!function_exists('config')){

    /*
     * Mocking the Laravel/Lumen config helper function
     */
    function config($arg = null, $default = null)
    {
        switch($arg){
            case 'swagger.scan_path':
                return __DIR__.'/test_scan_dir/';
            case 'swagger.save_path':
                return __DIR__.'/test_save_dir/';
            case 'swagger.file_name':
                return 'api_docs';
            default:
                return $default;
        }
    }
}

require_once __DIR__.'/../../vendor/autoload.php';
