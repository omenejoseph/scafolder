<?php


namespace OmeneJoseph\Scafolder\Commands;


use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use OmeneJoseph\Scafolder\Traits\CommandsTrait;

class CreateTraitCommand extends Command
{
    use CommandsTrait;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:trait {name}';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Trait';

    /**
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * @var \Illuminate\Filesystem\Filesystem  $files
     */
    protected $files;
    /**
     * @var string
     */
    private $title;


    /**
     * Create a new soa Repository      .
     * @param Filesystem $files
     * @param Composer $composer
     * @return void
     */
    public function __construct(Composer $composer, Filesystem $files)
    {
        parent::__construct();
        $this->composer = $composer;

        $this->files = $files;
    }


    /**
     * Execute the console command.
     * @throws FileNotFoundException
     * @return void
     */
    public function handle()
    {
        $this->title = $this->argument('name');
        $this->createFile();

        $this->info('Dumping Autoload, Please wait...!');

        $this->composer->dumpAutoloads();
    }
    /**
     * @param string $directory_name
     * @throws FileNotFoundException
     */
    private function createFile()
    {
        $directory = app_path('Traits');
        $data = $this->getStub('trait', __DIR__);
        $this->createDirectory($directory);

        $path = $this->getMyFilePath($directory);

        $this->files->put($path, $data);

        $file_name = $this->getFileName();

        $this->info($file_name .  " class created");

        $this->info('Process Completed...!');
    }



    /**
     * Creates a dynamic path based on the argument of title passed
     * to the command
     * @param $directory
     * @param $file_name
     * @return string
     */
    private function getMyFilePath(string $directory) : string
    {
        $file_name = $this->getFileName();
        return $directory . '/' . $file_name . '.php';
    }

    private function getFileName() : string
    {
        return Str::studly($this->title . '_' . 'trait');
    }
}