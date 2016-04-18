<?php
// Marcel Kapfer (mmk2410)
// License: MIT License
// api for uploading files

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../../vendor/autoload.php';
require '../../../res/php/Config.php';
require '../../../res/php/ArticleGenerator.php';

include '../auth/auth.php';

use \mmk2410\rbe\config\Config as Config;

$config = new Config("../../../config.yaml", '../../../vendor/autoload.php');
$settings = $config->getConfig();

if ($settings["rcc"]["api"] == "on" && $settings["rcc"]["rcc"] == "on") {
    $app = new \Slim\App();

    /**
    * api for uploading files
    *
    * @return JSON json string with status
    */
    $app->post('/', function (Request $request, Response $response) {
        $storage = new \Upload\Storage\FileSystem('../../../media/');
        $file = new \Upload\File('file', $storage);

        try {
            $file->upload();
            $data = array("code" => 201);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 201);
        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $data = array("code" => 500, "error" => $Errors);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 500);
        }

        return $response;
    });

    $app->run();
}
