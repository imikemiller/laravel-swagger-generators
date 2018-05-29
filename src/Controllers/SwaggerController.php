<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 29/05/18
 * Time: 10:30
 */

namespace Imm\Controllers;


use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller;

class SwaggerController extends Controller
{
    public function index()
    {
        $filePath = swagger_path(config('swagger.save_path'),config('swagger.file_name'));
        if (! file_exists($filePath)) {
            abort(404, 'Cannot find '.$filePath);
        }
        $content = file_get_contents($filePath);
        return new Response($content, 200, ['Content-Type' => 'application/json']);
    }
}