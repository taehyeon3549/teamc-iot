<?php

// Routes

/****************************************/
/*              web page                */
/****************************************/

// Login page
$app->get('/', 'App\Controller\WebController:dispatch')
    ->setName('sign_in');

// main page
$app->get('/main', 'App\Controller\WebController:main')
    ->setName('main');

// register_email
$app->get('/register_email', 'App\Controller\WebController:register_email')
    ->setName('register_email');

//forgotten_password page
$app->get('/forgot-password', 'App\Controller\WebController:forgotten_password')
    ->setName('forgot-password');

// Sign_up
$app->get('/sign_up/{code}', 'App\Controller\WebController:sign_up')
    ->setName('sign_up');  

// register_email_message
$app->get('/register_email_message', 'App\Controller\WebController:register_email_message')
    ->setName('register_email_message'); 

// myaccount
$app->get('/myaccount', 'App\Controller\WebController:myaccount')
    ->setName('myaccount');

// change_password
$app->get('/change_password', 'App\Controller\WebController:change_password')
    ->setName('change_password');

// change_idcancellation
$app->get('/change_idcancellation', 'App\Controller\WebController:change_idcancellation')
    ->setName('change_idcancellation');

// charts
$app->get('/charts', 'App\Controller\WebController:charts')
    ->setName('charts');

// maps
$app->get('/maps', 'App\Controller\WebController:maps')
    ->setName('maps');

/****************************************/
/*          User Management             */
/****************************************/

//sign_up
$app->post('/signup_proc', 'App\Controller\UserManagementController:signup_proc')
->setName('signup_proc');

//eamil check
$app->post('/check_user', 'App\Controller\UserManagementController:check_user')
->setName('check_user');

//click_verify
$app->post('/click_verify', 'App\Controller\UserManagementController:click_verify')
->setName('click_verify');

//certification check
$app->post('/check_certification', 'App\Controller\UserManagementController:check_certification')
->setName('check_certification');

//change the certi_state
$app->get('/verify/{code}', 'App\Controller\UserManagementController:change_certification')
->setName('change_certification');

//sign_in
$app->post('/signin_proc', 'App\Controller\UserManagementController:signin_proc')
->setName('signin_proc');

//sign_out
$app->post('/signout_proc', 'App\Controller\UserManagementController:signout_proc')
->setName('signout_proc');

//forgot_password check- user are exsit
$app->post('/forgot_password_check', 'App\Controller\UserManagementController:forgot_password_check')
->setName('forgot_password_check');

//forgot_password
$app->post('/forgot_password', 'App\Controller\UserManagementController:forgot_password')
->setName('forgot_password');

//change_password
$app->post('/change_password', 'App\Controller\UserManagementController:change_password')
->setName('change_password');

//user cancellation check page
$app->post('/delete_account_check', 'App\Controller\UserManagementController:delete_account_check')
->setName('delete_account_check');

//user cancellation
$app->post('/delete_account', 'App\Controller\UserManagementController:delete_account')
->setName('delete_account');

//logo_img
$app->get('/mailicon', 'App\Controller\UserManagementController:mailicon')
->setName('mailicon');

/****************************************/
/*         Sensor Management            */
/****************************************/

//register_Sensor 
$app->post('/registrationSensor', 'App\Controller\SensorManagementController:registrationSensor')
->setName('registrationSensor');

//Deregister_Sensor 
$app->post('/deregistrationSensor', 'App\Controller\SensorManagementController:deregistrationSensor')
->setName('deregistrationSensor');

//Sensor List
$app->post('/sensorList', 'App\Controller\SensorManagementController:sensorList')
->setName('sensorList');

//insert_Sensor value
$app->post('/insertSensor', 'App\Controller\SensorManagementController:insertSensor')
->setName('insertSensor');


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
