<html>
<head>
  <meta charset="UTF-8">
  <title>通信录-新用户注册</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css" />
  <script src="../js/lib/jquery-3.1.0.min.js" type="text/javascript"></script>
</head>
<body class="login">
<div class="register_wrap">
  <h1>通信录-新用户注册</h1>
  <div class="login_border">
    <div class="login_input">
      <form action="do_register.php" method="post" name="register">
        <input type="hidden" name="check_submit" value="1" />
        <ul class="login_items">
          <li>
            <label for="username">用户名:</label>
            <input type="text" id="username_input" tabindex="1" name="username" value="" id="username" size="40"
                   class="login_input_style" required placeholder="5-16位英文字母或下划线">
            <div class="help-block" id="username_feedback"></div>
          </li>
          <li>
            <label for="pwd">密码: </label>
            <input type="password" tabindex="2" name="pwd" value="" id="pwd" size="40"
                   class="login_input_style" required placeholder="密码长度至少5位">
            <div class="help-block" id="pwd_feedback"></div>
          </li>
          <li>
            <label for="pwd">确认密码: </label>
            <input type="password" tabindex="3" name="repwd" value="" id="repwd" size="40"
                   class="login_input_style" placeholder="确认密码">
            <div class="help-block" id="repwd_feedback"></div>
          </li>
          <li>
            <input type="submit" tabindex="4" value="注册" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
  </div>
  <p class="copyright">
    已有账号?<a href="login.php">登录</a>
    © 2014 Powered by
    <a href="http://jscss.me" target="_blank">有主机上线</a>
  </p>
</div>
</body>
<script type="text/javascript" src="../js/register.js"></script>
</html>