<?php include '../public/config.php' ?>
<html>
<head>
  <meta charset="UTF-8">
  <title>通信录登录</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css" />
  <script type="text/javascript" src="../js/lib/jquery-3.1.0.min.js"></script>
</head>
<body class="login">
<div class="login_wrap">
  <h1>通信录-登录</h1>
  <div class="login_border">
    <div class="login_input">
      <form action="do_login.php" method="post" class="ajax-login">
        <ul class="login_items">
          <li>
            <label for="username">用户名:</label>
            <input type="text" tabindex="1" name="username" value="" id="username" size="40" class="login_input_style">
            <div class="help-block" id="username_feedback"></div>
          </li>
          <li>
            <label for="pwd">密码: </label>
            <input type="password" tabindex="2" name="pwd" value="" id="pwd" size="40" class="login_input_style">
            <div class="help-block" id="pwd_feedback"></div>
          </li>
          <li>
            <input type="submit" tabindex="3" value="登录" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
  </div>
  <p class="copyright">
    没有账号?<a href="register.php">去注册</a>© 2014 Powered by<a href="http://jscss.me" target="_blank">有主机上线</a>
  </p>
</div>
</body>
<script type="text/javascript" src="../js/login.js"></script>
</html>
