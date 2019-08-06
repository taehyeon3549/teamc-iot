<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class BackendController extends BaseController
{
    protected $logger;
    protected $BackendModel;
    protected $view;

    public function __construct($logger, $BackendModel, $view)
    {
        $this->logger = $logger;
        $this->BackendModel = $BackendModel;
        $this->view = $view;
    }

    //test
    public function test(Request $request, Response $response, $args){
        echo ("test");


        $result = [];
        $result['message'] = "test";

        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($result, JSON_NUMERIC_CHECK));
    }
}
