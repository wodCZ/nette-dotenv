<?php


namespace wodCZ\NetteDotenv;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class ParametersLoader
{
    private $directory;
    /** @var string */
    private $fileName;
    /** @var string */
    private $namespace;
    /** @var bool */
    private $overload;

    /**
     * @param string $directory Where your .env file is stored
     * @param string $fileName You may choose file name other than `.env`
     * @param string $namespace Key, under which will be ENV variables saved to Nette parameters
     * @param bool $overload Controls whether .env file variables should override existing ENV variables
     */
    public function __construct($directory, $fileName = '.env', $namespace = 'ENV', $overload = false)
    {

        $this->directory = $directory;
        $this->fileName = $fileName;
        $this->namespace = $namespace;
        $this->overload = $overload;
    }

    public function getParameters()
    {
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

        $params = array();
        foreach ($_SERVER as $key => $value) {
            // Escape % character, Nette will translate them back to single-%
            // This avoids translating env variables as Nette parameters
            $params[$key] = str_replace('%', '%%', $value);
        }

        return array($this->namespace => $params);
    }
}
