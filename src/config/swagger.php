<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 25/05/18
 * Time: 12:11
 */

return [
    'scan_path'=>env('SWAGGER_SCAN_PATH','routes'),
    'save_path'=>env('SWAGGER_SAVE_PATH','storage/documentation'),
    'file_name'=>env('SWAGGER_FILE_NAME','docs.json'),
    'route'    =>env('SWAGGER_ROUTE','api/docs.json'),
    'middleware'=>[]
];