<?php
/**
 * PHP Version 7
 *
 * Configuration parser for yaml configuration files
 *
 * @category Configuration
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
namespace mmk2410\rbe\config;

/**
 * PHP Version 7
 *
 * Configuration parser for yaml configuration files
 *
 * @category Configuration
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
class Config
{

    /**
     * Path to yaml file
     * @var string
     */
    private $file;

    /**
     * Constructor for the Config class
     *
     * @param $config   path to the yaml file
     * @param $composer path to the composer autoload
     */
    public function __construct($config, $composer)
    {
        $this->file = $config;
        require $composer;
    }

    /**
     * Return yaml config as PHP array
     *
     * @return config array
     */
    public function getConfig()
    {
        $yaml = new \Symfony\Component\Yaml\Parser();
        return $yaml->parse(file_get_contents($this->file));
    }
}
