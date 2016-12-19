<?php
include "./public/acl.php";

if (!isset($_SESSION['user'])) {
    echo "<script>alert(\"登录已失效, 请重新登录!\")</script>";
    echo "<script>location.href='users/login.php'</script>";
}

if (!isset($_GET['id'])) {
  die('contact entry ID is not set');
}
require './public/pdo.php';

// 要修改的联系人信息
$contact = array();
try {
  $sql = "SELECT * FROM contact WHERE id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();
  $contact = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}

if ($contact['uid'] != $_SESSION['user']['id']) {
  die('不能修改其他用户的联系人');
}
$uid = $_SESSION['user']['id'];
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>通信录个人主页</title>
  <link rel="stylesheet" type="text/css" href="./css/contact.css" />
  <script type="text/javascript" src="js/lib/jquery-3.1.0.min.js"></script>
</head>
<body>
<div class="container">
  <!--  左边分组栏-->
  <div class="col-sub">
    <div class="sub-head">
      <div class="panel-title">通信录</div>
      <div class="panel-link">
        <a id="js-add-group" href="javascript:;">
          <i class="ct-icon ctico-add"></i><span>新分组</span>
        </a>
      </div>
      <div class="contact-group">
        <dl>
          <dt>
            <a href="index.php">
              <i class="ct-icon cticon-person"></i>
              <span>全部好友</span>
              <?php
              try {
                $sql = "SELECT count(id) AS n FROM contact WHERE uid=:uid";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array('uid'=>$_SESSION['user']['id']));
                $stmt->bindColumn(1, $n);
                $stmt->fetch(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo $e->getMessage();
              }
              ?>
              <em class="num">(<?php echo $n ?>)</em>
            </a>
          </dt>
          <dd id="js-group-list">
            <?php
            // 二维数组 存放 group
            $groups = array();
            try {
              $sql = "SELECT `id`, `name` FROM `grp` WHERE uid=? ORDER BY `id` DESC";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam(1, $uid);
              $stmt->execute();
              while ($group = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $group['name'] = htmlspecialchars(stripslashes(urldecode($group['name'])));
                ?>
                <div class="item" title="<?php echo $group['name'] ?>">
                  <a href="?group_id=<?php echo $group['id'] ?>" class="name"><?php echo $group['name'] ?></a>
                  <a href="javascript:;" class="btn-icon edit" rel="edit">
                    <i class="ct-icon ctico-edit"></i><span>编辑</span>
                  </a>
                  <a href="javascript:;" class="btn-icon del" rel="del">
                    <i class="ct-icon ctico-clean"></i><span>删除</span>
                  </a>
                </div>
                <?php
                array_push($groups, $group);
              }
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
            ?>
            <div class="item">
              <a href="index.php?group_id=0" class="name">未分组</a>
              <!-- <em class="num">(223)</em> -->
            </div>
          </dd>
        </dl>
      </div>
    </div>
  </div>

  <!--  右边联系人信息列表-->
  <div class="col-main">
    <!--    面板上功能部分-->
    <div class="main-headline" id="js-panel_menu">
      <div class="operate-btn">
        <a href="javascript:location.href='index.php'" class="btn-link"><i class="icon ico-back"></i><span>返回</span></a>
        <a class="button gray-button" id="js-save"><span>保存</span></a>
        <div class="move-group-title">
          <span>移动分组: </span>
          <select name="groups">
            <option value="0">未分组</option>
            <?php
            $groupcount = count($groups);
            $gid = $contact['gid'];
            for ($i = 0; $i < $groupcount; $i++) {
              if ($gid == $groups[$i]['id']) {
                echo "<option value='{$groups[$i]['id']}' selected>{$groups[$i]['name']}</option>";
              } else {
                echo "<option value='{$groups[$i]['id']}'>{$groups[$i]['name']}</option>";
              }
            }
            unset($groups);
            ?>
          </select>
        </div>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list">
          <li><a href="#"><?php echo $_SESSION['user']['username']; ?></a></li>
          <li><a href="users/mod_pwd.php">修改密码</a></li>
          <li><a href="users/logout.php">退出</a></li>
        </ul>
      </div>
    </div>
    <div class="main-container">
      <div class="contact-add">
        <!-- 联系人信息记录条目ID  -->
        <input type="hidden" name="id" class="text" value="<?php echo $_GET['id'] ?>" />
        <div class="user-profile">
          <div class="user-name">
            <i class="require-red">*</i><label>姓名: </label>
            <input type="text" name="name" class="text" value="<?php echo $contact['name'] ?>" required tabindex="1" autofocus />
          </div>
          <div class="user-remark">
            <label>备注: </label>
            <textarea rel="remark" name="remark" class="text" tabindex="2"><?php echo $contact['remark'] ?></textarea>
          </div>
        </div>
        <p class="title">常用联系</p>
        <div class="contact-form">
          <div class="user-phone">
            <i class="require-red">*</i><label>电话:</label><input type="tel" name="tel" class="text" value="<?php echo $contact['tel']  ?>" autocomplete="on" required maxlength="16" tabindex="3"/>
          </div>
          <div class="user-email">
            <label>邮箱:</label><input type="email" name="email" class="text" value="<?php echo $contact['email'] ?>" tabindex="4"/>
          </div>
        </div>
        <p class="title">更多详情</p>
        <div class="contact-form">
          <div class="user-gender">
            <label>性别:</label><input type="radio" name="gender" value="男" <?php echo $contact['gender'] === '男' ? "checked":"" ?>  tabindex="5"/>男
            <input type="radio" name="gender" value="女" <?php echo $contact['gender'] === '女' ? "checked":"" ?> />女
          </div>
          <div class="user-birth">
            <label>生日:</label><input type="date" name="birth" class="text" value="<?php echo $contact['birth'] ?>" tabindex="6" />
          </div>
          <div class="user-address">
            <label>地址:</label><input type="text" name="address" class="text" value="<?php echo $contact['address'] ?>" tabindex="7" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript">
$("body").keydown(function(event) {
// press Ctrl + Enter to save
  if (event.ctrlKey === true && event.which === 13) {
    $("#js-save").click();
  }
// press Esc => history.go(-1)
  if (event.which === 27) {
    location.href='index.php';
  }
})
</script>
</html>

