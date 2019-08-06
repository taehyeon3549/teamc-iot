<?php

// Routes

/****************************************/
/*              web page                */
/****************************************/

// home page
$app->get('/', 'App\Controller\WebController:dispatch')
    ->setName('homepage');

//sign_in page
$app->get('/sign_in', 'App\Controller\WebController:sign_in')
    ->setName('sign_in');

//sign_up page
$app->get('/sign_up', 'App\Controller\WebController:sign_up')
    ->setName('sign_up');

//forgotten_password page
$app->get('/forgotten_password', 'App\Controller\WebController:forgotten_password')
    ->setName('ForgottPw');

//Map page
$app->get('/map', 'App\Controller\WebController:map')
    ->setName('Map');

//My page
$app->get('/mypage', 'App\Controller\WebController:mypage')
    ->setName('Mypage');


/****************************************/
/*          User controller             */
/****************************************/
//test
$app->post('/test', 'App\Controller\BackendController:test')
    ->setName('test');





/****************************************/
/*              Back-end                */
/****************************************/
/*
//sign_up
$app->post('/signup_proc', 'App\Controller\BackendController:signup_proc')
    ->setName('signup_proc');

//eamil check
$app->post('/check_user', 'App\Controller\BackendController:check_user')
    ->setName('check_user');

//check_certificatioin
$app->post('/check_certification', 'App\Controller\BackendController:check_certification')
    ->setName('check_certification');

//sign_in
$app->post('/signin_proc', 'App\Controller\BackendController:signin_proc')
    ->setName('signin_proc');
*/





/****************************************/
/*          certification page          */
/****************************************/
/*
//certification_success page
$app->get('/certification/success', 'App\Controller\CertificateController:certification_success')
    ->setName('success');






$app->get('/post/{id}', 'App\Controller\HomeController:viewPost')
    ->setName('view_post');

// sign_up
$app->get('/ucsd/sign_up', 'App\Controller\UserController:sign_up')
    ->setName('sign_up');

// sign_in
$app->get('/ucsd/sign_in', 'App\Controller\UserController:sign_in')
    ->setName('sign_in');

//test
//$app->get('/test', 'App\Controller\TestController:dispatch')->setName('Test');
*/