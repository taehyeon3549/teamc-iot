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
/*              Back-end                */
/****************************************/

//sign_up
$app->post('/signup_proc', 'App\Controller\BackendController:signup_proc')
    ->setName('signup_proc');

//eamil check
$app->post('/check_user', 'App\Controller\BackendController:check_user')
    ->setName('check_user');

//click_verify
$app->post('/click_verify', 'App\Controller\BackendController:click_verify')
    ->setName('click_verify');

//certification check
$app->post('/check_certification', 'App\Controller\BackendController:check_certification')
    ->setName('check_certification');

//change the certi_state
$app->post('/change_certification', 'App\Controller\BackendController:change_certification')
    ->setName('change_certification');

//sign_in
$app->post('/signin_proc', 'App\Controller\BackendController:signin_proc')
    ->setName('signin_proc');

//sign_out
$app->post('/signout_proc', 'App\Controller\BackendController:signout_proc')
    ->setName('signout_proc');

//forgot_password check- user are exsit
$app->post('/forgot_password_check', 'App\Controller\BackendController:forgot_password_check')
    ->setName('forgot_password_check');

//forgot_password
$app->post('/forgot_password', 'App\Controller\BackendController:forgot_password')
    ->setName('forgot_password');

//change_password
$app->post('/change_password', 'App\Controller\BackendController:change_password')
    ->setName('change_password');

//user cancellation
$app->post('/delete_account', 'App\Controller\BackendController:delete_account')
    ->setName('delete_account');

//insert_data
$app->post('/insertSensor', 'App\Controller\BackendController:insertSensor')
    ->setName('insertSensor');

//Get_data - not make
$app->post('/getSensor', 'App\Controller\BackendController:getSensor')
    ->setName('getSensor'); 


/****************************************/
/*          certification page          */
/****************************************/

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
