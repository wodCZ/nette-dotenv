<?php


namespace wodCZ\NetteDotenv;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class EnvAccessor
{
    private $directory;
    private $fileName;
    private $overload;
    private $loaded;
    /** @var bool */
    private $localOnly;

    public function __construct($directory, $fileName = '.env', $overload = false, $localOnly = false)
    {
        $this->directory = $directory;
        $this->fileName = $fileName;
        $this->overload = $overload;
        $this->localOnly = $localOnly;
    }

    public function get($key, $default = null)
    {
        $this->load();

        if (PHP_MAJOR_VERSION === 5) {
            if ($this->localOnly) {
                trigger_error('localOnly option is only available in PHP 7');
            }
            return getenv($key) ?: $default;
        }
        return getenv($key, $this->localOnly) ?: $default;
    }

    private function load()
    {
        if ($this->loaded) {
            return;
        }
        try {
            // Load variables from .env file
            $loader = new Dotenv($this->directory, $this->fileName);

            if ($this->overload) {
                $loader->overload();
            } else {
                $loader->load();
            }
        } catch (InvalidPathException $e) {
            // If .env file doesn't exist, silently continue
        }
        $this->loaded = true;
    }
}
