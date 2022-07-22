<?php

namespace JoeDixon\Translation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use JoeDixon\Translation\Drivers\Database\Database;
use JoeDixon\Translation\Drivers\File\File;
use JoeDixon\Translation\Drivers\Translation;

class TranslationManager
{
    public function __construct(
        private Application $app,
        private array $config,
        private Scanner $scanner
    ) {
    }

    public function resolve(): Translation
    {
        $driver = $this->config['driver'];
        $driverResolver = Str::studly($driver);
        $method = "resolve{$driverResolver}Driver";

        if (! method_exists($this, $method)) {
            throw new \InvalidArgumentException("Invalid driver [$driver]");
        }

        return $this->{$method}();
    }

    protected function resolveFileDriver(): File
    {
        return new File(new Filesystem, $this->app['path.lang'], $this->app->config['app']['locale'], $this->scanner);
    }

    protected function resolveDatabaseDriver(): Database
    {
        return new Database($this->app->config['app']['locale'], $this->scanner);
    }
}
