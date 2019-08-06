<!DOCTYPE html>
<html>

<head>
  <title>C team_summer_IoT</title>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link href="https://cloud.typography.com/737368/747986/css/fonts.css" rel="stylesheet" type="text/css">
  <link href="assets/css/keen-static.css" rel="stylesheet" type='text/css' />
  <link href="assets/css/keen-dashboards.css" rel="stylesheet" type='text/css' />
</head>

<body>

  <div class="masthead hero">
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
		  <!-- 로고 동작 -->
          <a href="http://xogus007.dothome.co.kr/iot/index.html" style="filter:alpha(style=2, opacity=100,finishopacity=0)">
           <img src="test_logo.png" alt="" style="width: 150px;">
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

      <h1>QI_summer_IoT_C_Team</h1>
      <p class="lead">Responsive dashboard templates for Bootstrap</p>
      <a class="btn hero-btn" href="https://github.com/keen/dashboards" target="_blank">Start</a>     

    </div>
  </div>

  <div class="content">
    <div class="container grid grid-simple-col-2">
      <div>
        <h2><a href="./examples/">Examples</a></h2>
        <a href="./examples/"><img class="img-responsive img-thumbnail" src="./examples/starter-kit/preview.png"></a>
      </div>
      <div>
        <h2><a href="./layouts/">Layouts</a></h2>
        <a href="./layouts/"><img class="img-responsive img-thumbnail" src="./layouts/quarter-grid/preview.png"></a>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <div class="love">
        <p><a href="https://keen.io?s=db_land">Keen IO</a></p>
      </div>
    </div>
  </div>

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
  </script>
</body>

</html>