<?php
// Marcel Kapfer (mmk2410)
// License: MIT License
// api for fetching various lists

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../../vendor/autoload.php';
require '../../../res/php/Config.php';

include '../auth/auth.php';

use \mmk2410\rbe\config\Config as Config;

$config = new Config("../../../config.yaml", '../../../vendor/autoload.php');
$settings = $config->getConfig();

if ($settings["rcc"]["api"] == "on" && $settings["rcc"]["rcc"] == "on") {
    $app = new \Slim\App();

    /**
    * api for get the list of blogs and if $_GET["blog"] is set the list of
    * blogs posts in that blog
    *
    * @param string $_GET["blog"] optional name of the blog
    *
    * @return JSON json string containing the blogs / blog posts
    */
    $app->get('/', function (Request $request, Response $response) {
        $blog = $_GET["blog"];


        if (!isset($blog)) {
            $files =  scandir('../../../blogs/', SCANDIR_SORT_DESCENDING);

            unset($files[sizeof($files) - 1]);
            unset($files[sizeof($files) - 1]);

            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($files, 201);
            return $response;
        }

        $path = "../../../articles/" . $blog . "/";

        $files =  scandir($path, SCANDIR_SORT_DESCENDING);

        unset($files[sizeof($files) - 1]);
        unset($files[sizeof($files) - 1]);

        $response = $response->withHeader('Content-type', 'application/json');
        $response = $response->withJson($files, 201);

        return $response;
    });

    $app->run();
}
