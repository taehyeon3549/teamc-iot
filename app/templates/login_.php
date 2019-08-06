<!DOCTYPE html>
<html>

<head>
  <title>C team_summer_IoT_Login</title>
  <meta charset="utf-8">
  
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link href="https://cloud.typography.com/737368/747986/css/fonts.css" rel="stylesheet" type="text/css">
  <link href="assets/css/keen-static.css" rel="stylesheet" type='text/css' />
  <link href="assets/css/keen-dashboards.css" rel="stylesheet" type='text/css' />
  <!-- Admin LTE -->
  <meta http-equiv="X-UA-Compatible">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">

  <div class="masthead hero" style = "min-height: 100px; height: 100px;">
	<div class="container" style="text-align:right; font-size:15px; font-color:#FFFFFF">
		<a href="login.php"><span class="btn-user-info" style="font-weight:bold">Login</span></a>
		/
		<a href="signin.php"><span class="btn-user-signin" style="font-weight:bold">Create Account</span></a>
	</div>
    <div class="container">
      <header class="navbar">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-target=".keen-navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="https://keen.io?s=db_land" class="navbar-brand" target="_blank">
            <svg class="keen-logo" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px"
              viewBox="0 0 594 128" enable-background="new 0 0 594 128" xml:space="preserve">
              <g class="icon">
                <polygon class="red" fill="#FFFFFF"
                  points="59.811,73.135 66.859,85.34 49.275,115.863 140.807,115.863 147.814,128 28.045,128"></polygon>
                <polygon class="green" fill="#FFFFFF"
                  points="59.873,24.297 91.504,79.242 77.413,79.242 59.826,48.781 13.958,128 0,128"></polygon>
                <polygon class="blue" fill="#FFFFFF"
                  points="133.769,103.674 70.364,103.674 77.418,91.432 112.586,91.432 66.915,12.1 73.9,0"></polygon>
              </g>
              <path class="text" fill="#FFFFFF"
                d="M246.12 94.163L216.29 57.373l27.704-27.484c1.199-1.195 1.782-2.475 1.782-3.91 0-2.906-2.496-5.453-5.341-5.453 -1.869 0-3.128 0.887-4.262 1.896l-43.89 44.996V26.094c0-3.07-2.498-5.568-5.568-5.568 -2.96 0-5.461 2.549-5.461 5.568v72.01c0 3.02 2.501 5.57 5.461 5.57 3.07 0 5.568-2.498 5.568-5.57V81.145l16.181-16.178 29.093 36.231c1.15 1.643 2.655 2.477 4.474 2.477 3.021 0 5.573-2.551 5.573-5.57C247.604 96.301 246.896 95.151 246.12 94.163zM309.211 71.702c0-15.379-9.767-30.948-28.434-30.948 -16.456 0-29.348 13.941-29.348 31.743v0.23c0 18.1 13.108 31.748 30.49 31.748 9.265 0 16.353-2.836 22.95-9.162 1.104-0.967 1.713-2.248 1.713-3.609 0-2.631-2.192-4.771-4.887-4.771 -1.466 0-2.503 0.719-3.195 1.293 -4.886 4.5-10.083 6.596-16.354 6.596 -10.378 0-18.167-7.188-19.675-18.006h41.627C306.917 76.815 309.211 74.52 309.211 71.702zM280.55 50.182c11.501 0 16.667 9.162 17.751 18.117h-35.831C263.956 57.574 271.266 50.182 280.55 50.182zM374.018 71.702c0-15.379-9.767-30.948-28.434-30.948 -16.454 0-29.344 13.941-29.344 31.743v0.23c0 18.1 13.107 31.748 30.486 31.748 9.263 0 16.351-2.836 22.95-9.164 1.103-0.965 1.71-2.246 1.71-3.607 0-2.631-2.193-4.771-4.889-4.771 -1.464 0-2.501 0.719-3.193 1.293 -4.886 4.5-10.082 6.596-16.352 6.596 -10.374 0-18.163-7.189-19.677-18.006h41.626C371.723 76.815 374.018 74.52 374.018 71.702zM345.357 50.182c11.497 0 16.662 9.162 17.749 18.117h-35.83C328.762 57.574 336.072 50.182 345.357 50.182zM414.734 40.754c-8.037 0-14.492 3.127-19.233 9.309V46.9c0-3.062-2.396-5.461-5.455-5.461 -2.945 0-5.342 2.449-5.342 5.461v51.319c0 3.059 2.396 5.455 5.455 5.455 3.045 0 5.342-2.346 5.342-5.455V68.271c0-10.312 6.874-17.514 16.717-17.514 9.606 0 15.342 6.291 15.342 16.826v30.635c0 3.059 2.398 5.455 5.461 5.455 2.999 0 5.348-2.396 5.348-5.455V65.414C438.369 50.434 429.092 40.754 414.734 40.754zM491.424 20.525c-2.958 0-5.457 2.549-5.457 5.568v72.01c0 3.02 2.499 5.57 5.457 5.57 3.072 0 5.572-2.498 5.572-5.57v-72.01C496.996 23.023 494.496 20.525 491.424 20.525zM552.307 19.725c-23.504 0-41.916 18.613-41.916 42.373v0.229c0 24.03 17.923 42.149 41.689 42.149 23.507 0 41.92-18.613 41.92-42.377v-0.227C594 37.844 576.076 19.725 552.307 19.725zM582.627 62.098v0.229c0 18.133-13.035 31.807-30.32 31.807 -17.411 0-30.541-13.773-30.541-32.036v-0.227c0-18.131 13.032-31.803 30.314-31.803C569.209 30.068 582.627 44.137 582.627 62.098z">
              </path>
            </svg>
          </a>
        </div>
        <nav class="navbar-collapse collapse keen-navbar-collapse" role="navigation">
          <ul class="navbar-nav nav main-nav">
            <li><a href="https://github.com/keen/dashboards" target="_blank">Docs</a></li>
            <li><a href="https://keen.io/docs/visualize/common-chart-examples/" target="_blank">Charts</a></li>
            <li><a href="https://keen.io/team" target="_blank">Team</a></li>
            <li><a href="https://blog.keen.io/" target="_blank">Blog</a></li>
            <li><a href="http://slack.keen.io/" target="_blank">Community</a></li>
          </ul>
          <ul class="navbar-nav nav main-nav align-right">
            <!-- 
			<li><a href="https://keen.io/signup?s=gh-dashboards" class="btn navbar-btn" target="_blank">Create a Free
                Project</a></li> -->
          </ul>
        </nav>
      </header>    

    </div>
  </div>

  <div class="content">
    <div class="container grid grid-simple-col-2" style="min-height: 450px">
      <div>
        <!-- 내용 -->
		<div class="login-box">
		  <div class="login-logo">
		    <a href="../../index2.html"><b>Admin</b>LTE</a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
		    <p class="login-box-msg">Sign in to start your session</p>

		    <form action="../../index2.html" method="post">
		      <div class="form-group has-feedback">
		        <input type="email" class="form-control" placeholder="Email">
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="Password">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <input type="checkbox"> Remember Me
				    </label>
		          </div>
				</div>
				<!-- /.col -->
			    <div class="col-xs-4">
				  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			    </div>
				<!-- /.col -->
		      </div>
			</form>
			<div class="social-auth-links text-center">
			  <p>- OR -</p>
			  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
				Facebook</a>
			  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
				Google+</a>
			</div>
			<!-- /.social-auth-links -->
		    <a href="#">I forgot my password</a><br>
		    <a href="register.html" class="text-center">Register a new membership</a>
		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <div class="love">
        <p><a href="http://qi.ucsd.edu/">QI institute UCSD</a></p>
      </div>
    </div>
  </div>

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
  <script type="text/javascript" src="assets/js/keen-analytics.js"></script>
  <script>
    function toggleMenu() {
      const toggleBtn = document.querySelector('.navbar-toggle');

      toggleBtn.addEventListener('click', (e) => {
        let menu;
        if (e.currentTarget.dataset.target) {
          menu = document.querySelector(e.currentTarget.dataset.target);
        }
        if (menu) menu.classList.toggle('collapsed');
      });
    }

    window.addEventListener('DOMContentLoaded', toggleMenu);

	$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  </script>
</body>

</html>