<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class WebController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        $this->flash->addMessage('info', 'Sample flash message');

        $this->view->render($response, 'index.html');
        return $response;
    }

    public function viewPost(Request $request, Response $response, $args)
    {
        $this->logger->info("View post using Doctrine with Slim 3");

        $messages = $this->flash->getMessage('info');

        try {
            $post = $this->em->find('App\Model\Post', intval($args['id']));
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }

        $this->view->render($response, 'post.html', ['post' => $post, 'flash' => $messages]);
        return $response;
    }

//sign_in
	public function sign_in(Request $request, Response $response, $args)
    {
        $this->logger->info("Sign_in page action dispatched");

        $this->flash->addMessage('info', 'sign_in page load');

        $this->view->render($response, 'sign_in.html');
        return $response;
    }

//sign_up
	public function sign_up(Request $request, Response $response, $args)
    {
        $this->logger->info("Sign_up page action dispatched");

        $this->flash->addMessage('info', 'sign_up page load');

        $this->view->render($response, 'sign_up.html');
        return $response;
    }

//forgotten_password
	public function forgotten_password(Request $request, Response $response, $args)
    {
        $this->logger->info("forgotten_password page action dispatched");

        $this->flash->addMessage('info', 'forgotten_password page load');

        $this->view->render($response, 'ForgottPw.html');
        return $response;
    }

//show_Map
	public function map(Request $request, Response $response, $args)
    {
        $this->logger->info("map page action dispatched");

        $this->flash->addMessage('info', 'map page load');

        $this->view->render($response, 'Map.html');
        return $response;
    }

//mypage
	public function mypage(Request $request, Response $response, $args)
    {
        $this->logger->info("my page action dispatched");

        $this->flash->addMessage('info', 'my page load');

        $this->view->render($response, 'My_page.html');
        return $response;
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
