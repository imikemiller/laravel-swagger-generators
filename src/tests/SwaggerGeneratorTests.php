<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 29/05/18
 * Time: 09:26
 */

namespace Imm\tests;


use Imm\Commands\SwaggerGeneratorCommand;
use Imm\Providers\SwaggerGeneratorServiceProvider;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\TestCase;
use Mockery;

class SwaggerGeneratorTests extends TestCase
{
    public function test_filepath_generator()
    {
        $gen = new SwaggerGeneratorCommand();

        $gen->save_path = '/a/save/path/';
        $gen->file_name = 'filename.json';
        $gen->filePath();
        $this->assertEquals('/a/save/path/filename.json',$gen->file_path);

        $gen->save_path = '/a/save/path';
        $gen->file_name = 'filename';
        $gen->filePath();
        $this->assertEquals('/a/save/path/filename.json',$gen->file_path);

        $gen->save_path = '/a/save/path//';
        $gen->file_name = 'filename';
        $gen->filePath();
        $this->assertEquals('/a/save/path/filename.json',$gen->file_path);
    }

    public function test_handle_command()
    {
        $gen = Mockery::mock('Imm\Commands\SwaggerGeneratorCommand[info,warn]');
        $gen->shouldReceive('info','warn');
        $gen->handle();

        $this->assertTrue(file_exists($gen->file_path));

    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = new Application(
            realpath(__DIR__)
        );

        $app->register(SwaggerGeneratorServiceProvider::class);

        $config=[
            'save_path'=>__DIR__.'/test_save_dir/',
            'scan_path'=>__DIR__.'/test_scan_dir/',
            'file_name'=>'docs'
        ];

        $app['config']->set('swagger', $config);
    }

    public function tearDown()
    {
        parent::tearDown();
        if(file_exists(swagger_path(config('swagger.save_path'),config('swagger.file_name')))) {
            unlink(swagger_path(config('swagger.save_path'), config('swagger.file_name')));
            rmdir(config('swagger.save_path'));
        }
    }
}