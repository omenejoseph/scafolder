<?php


namespace OmeneJoseph\Scafolder\Commands;


use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;

class CreateRepositoryCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repo {model}';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Repository, Contract and Service provider class';

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

    const CONTRACT = 'contract';
    const REPOSITORY = 'repository';
    const PROVIDER = 'provider';

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
        $this->title = $this->argument('model');
        $this->createContract()
            ->createRepository()
            ->createProvider();


        $this->info('Dumping Autoload, Please wait...!');
//        $this->composer->dumpAutoloads();
    }

    /**
     * [Creates Contract Stub]
     * @throws FileNotFoundException
     * @return self;
     */
    private function createContract() : self
    {
        $this->createFile(self::CONTRACT);
        return $this;
    }

    /**
     * [Creates Repository Stub]
     * @throws FileNotFoundException
     * @return self;
     */
    private function createRepository() : self
    {
        $this->createFile(self::REPOSITORY);
        return $this;
    }

    /**
     * [Creates Provider Stub]
     * @throws FileNotFoundException
     * @return self;
     */
    private function createProvider() : self
    {
        $this->createFile(self::PROVIDER);
        return $this;
    }


    /**
     * @param string $directory_name
     * @throws FileNotFoundException
     */
    private function createFile(string $directory_name)
    {
        $directory = ucfirst($this->getDirectory($directory_name));
        $data = $this->getStub($directory_name);
        $this->createDirectory($directory);

        $path = $this->getMyFilePath($directory, $directory_name);

        $this->files->put($path, $data);

        $file_name = $this->getFileName($directory_name);

        $this->info($file_name .  " class created");

        $this->info('Process Completed...!');
    }

    private function getDirectory($directory_name)
    {
        return $directory_name == self::REPOSITORY ?
                    app_path(ucfirst(str_replace('y', 'ies', $directory_name))):
                    app_path(ucfirst($directory_name).'s');
    }

    /**
     * replaces the dynamic data in the stub with data passed as argument to the create file
     * @param string $type
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getStub(string  $type)
    {
        $stub_name = ucfirst($type);
        $stub = $this->files->get(__DIR__ . "/stubs/$stub_name.stub");
        return str_replace("{{MODEL}}", $this->title, $stub);
    }

    /**
     * Checks for existence of specified directory in the project's root folder and creates
     * it if it does not exist
     * @param string $directory
     * @return void
     */
    private function createDirectory($directory) : void
    {
         (! $this->files->exists($directory)) ?
            $this->files->makeDirectory(
                $directory)
         : null;
    }

    /**
     * Creates a dynamic path based on the argument of title passed
     * to the command
     * @param $directory
     * @param $file_name
     * @return string
     */
    private function getMyFilePath(string $directory, $file_name) : string
    {
        $file_name = $this->getFileName($file_name);
        return $directory . '/' . $file_name . '.php';
    }

    private function getFileName($file_name) : string
    {
        $suffix = $file_name !== self::PROVIDER
            ? $file_name
            : "service" . $file_name;
        return Str::studly($this->title . '_' . $suffix);
    }
}