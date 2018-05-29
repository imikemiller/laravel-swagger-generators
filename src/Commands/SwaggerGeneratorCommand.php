<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 25/05/18
 * Time: 12:14
 */

namespace Imm\Commands;

use Illuminate\Console\Command;

/**
 * Class SwaggerGeneratorCommand
 * @package Imm\Commands
 */
class SwaggerGeneratorCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a Swagger JSON document and saves it at the configured path.';

    /**
     * @var string
     */
    public $scan_path;

    /**
     * @var string
     */
    public $save_path;

    /**
     * @var string
     */
    public $file_name;

    /**
     * @var string
     */
    public $file_path;

    /**
     * @var string
     */
    public $json;

    /**
     * SwaggerGeneratorCommand constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $this->setPaths();

        $this->info('Scanning at path: '.$this->scan_path.'...');
        $this->scan();

        $this->info('Saving at path: '.$this->file_path.'...');

        if(!file_exists($this->save_path)){
            mkdir($this->save_path);
        }

        if($this->save($this->json,$this->file_path)){
            $this->info('Docs generated.');
        }else{
            $this->warn('Generating failed.');
        }
    }

    /**
     *
     */
    public function setPaths()
    {
        $this->scan_path = config('swagger.scan_path');
        $this->save_path = config('swagger.save_path');
        $this->file_name = config('swagger.file_name');
        $this->filePath();
    }

    /**
     * @return string
     */
    public function filePath()
    {
        $this->file_path = swagger_path($this->save_path,$this->file_name);
    }

    /**
     * @return bool|int
     */
    public function save()
    {
        return file_put_contents($this->file_path,$this->json);
    }

    /**
     * @return void
     */
    public function scan()
    {
        $this->json = \Swagger\scan($this->scan_path);
    }
}