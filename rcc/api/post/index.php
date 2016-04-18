<?php
// Marcel Kapfer (mmk2410)
// License: MIT License
// api for accessing blog posts

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
    * api for fetching a blog post
    *
    * @param string $_GET["blog"]  name of the blog
    * @param string $_GET["post"]  filename of the blog post
    *
    * @return JSON json string containing the blog post
    */
    $app->get('/', function (Request $request, Response $response) {
        $blog = $_GET["blog"];
        $post = $_GET["post"];

        if (!isset($blog) || !isset($post)) {
            $data = array('code' => 400, 'status' => 'Bad Request', 'error' => 'Not enough arguments');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 400);
            return $response;
        }

        $path = "../../../articles/" . $blog . "/";
        $data =
        ArticleGenerator::getArray($path, $post);

        $response = $response->withHeader('Content-type', 'application/json');
        $response = $response->withJson($data, 201);

        return $response;
    });

    /**
    * api for changing/creating a blog post
    *
    * @param string $_POST["data"]  all data
    */
    $app->post('/', function (Request $request, Response $response) {
        $blog = $_POST["blog"];
        $post = $_POST["post"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $date = $_POST["date"];
        $tags = $_POST["tags"];
        $text = $_POST["text"];

        if (!isset($blog) || !isset($post) || (!isset($title) && !isset($text))) {
            $data = array('code' => 400, 'status' => 'Bad Request', 'error' => 'Not enough arguments');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 400);
            return $response;
        }

        $text = str_replace('\n', '<br>', $text);

        $md = <<<EOD
%TITLE: $title
%DATE: $date
%AUTHOR: $author
%TAGS: $tags

$text
EOD;

        $path = "../../../articles/$blog/$post";
        if (file_put_contents($path, $md)) {
            $data = array('code' => 201, 'status' => 'Post created successfully');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 201);
        } else {
            $data = array('code' => 500, 'status' => 'Internal server error');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 500);
        }

        return $response;
    });

    /**
    * api for deleting a blog post
    *
    * @param string $_GET["blog"]  name of the blog
    * @param string $_GET["post"]  filename of the blog post
    *
    * @return JSON json string containing the blog post
    */
    $app->delete('/', function (Request $request, Response $response) {
        $blog = $_GET["blog"];
        $post = $_GET["post"];

        if (!isset($blog) || !isset($post)) {
            $data = array('code' => 400, 'status' => 'Bad Request', 'error' => 'Not enough arguments');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 400);
            return $response;
        }

        $path = "../../../articles/$blog/$post";

        if (!file_exists($path)) {
            $data = array('code' => 400, 'status' => 'Bad Request', 'error' => 'No such file');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 400);
            return $response;
        }

        if (!unlink($path)) {
            $data = array('code' => 500, 'status' => 'Bad Request', 'error' => 'Internal server error');
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withJson($data, 500);
            return $response;
        }

        $data = array('code' => 201, 'status' => 'File successfully deleted');
        $response = $response->withHeader('Content-type', 'application/json');
        $response = $response->withJson($data, 201);

        return $response;
    });

    $app->run();
}
