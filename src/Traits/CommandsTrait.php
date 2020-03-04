<?php


namespace OmeneJoseph\Scafolder\Traits;
use Illuminate\Support\Str;


trait CommandsTrait
{

    /**
     * replaces the dynamic data in the stub with data passed as argument to the create file
     * @param string $type
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getStub(string  $type, $dir)
    {
        $stub_name = ucfirst($type);
        $stub = $this->files->get($dir . "/stubs/$stub_name.stub");
        return str_replace("{{NAME}}", Str::studly($this->title), $stub);
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
}