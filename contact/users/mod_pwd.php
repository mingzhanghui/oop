<?php
require_once "../public/acl.php";
// echo $_SERVER['REQUEST_URI'];
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>通信录-修改用户名</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css" />
  <script src="../js/lib/jquery-3.1.0.min.js" type="text/javascript"></script>
</head>
<body class="login">
<div class="register_wrap">
  <h1>通信录-修改密码</h1>
  <div class="login_border">
    <div class="login_input">
      <!--modpwd.js -> do_mod_pwd.php-->
      <form method="post" name="modpwdform" action="do_mod_pwd.php">
        <ul class="login_items">
          <li>
            <label for="oldpwd">原密码: </label>
            <input type="password" tabindex="1" name="oldpwd" size="40" class="login_input_style" placeholder="输入原密码">
            <div class="help-block" id="oldpwd_fb"></div>
          </li>
          <li>
            <label for="pwd">新密码: </label>
            <input type="password" tabindex="2" name="pwd" size="40" class="login_input_style" placeholder="密码长度至少5位">
            <div class="help-block" id="newpwd_fb"></div>
          </li>
          <li>
            <label for="pwd">确认密码: </label>
            <input type="password" tabindex="3" name="repwd" size="40" class="login_input_style" placeholder="确认密码">
            <div class="help-block" id="repwd_fb"></div>
          </li>
          <li>
            <input type="submit" tabindex="4" value="确认" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
  </div>
  <p class="copyright">
    放弃修改?<a href="javascript:history.back()">返回</a>
    © 2014 Powered by
    <a href="http://jscss.me" target="_blank">有主机上线</a>
  </p>
</div>
</body>
<script type="text/javascript" src="../js/modpwd.js"></script>
</html>