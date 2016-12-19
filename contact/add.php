<?php
include "./public/acl.php";
include_once './public/pdo.php';
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>通信录个人主页</title>
  <link rel="stylesheet" type="text/css" href="./css/contact.css" />
  <script type="text/javascript" src="js/lib/jquery-3.1.0.min.js"></script>
</head>
<body class="home-page">
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
              $uid = $_SESSION['user']['id'];
              try {
                $sql = "SELECT count(id) AS n FROM contact WHERE uid=:uid";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array('uid'=>$uid));
                $stmt->bindColumn(1, $n);
                $stmt->fetch(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo $e->getMessage();
              }
              ?>
              <em class="num">(<?php echo $n ?>)</em>
            </a>
          </dt>
          <!-- 分组列表开始  -->
          <dd id="js-group-list">
            <?php
            $groups = array();
            try {
              $sql = "SELECT `id`, `name` FROM `grp` WHERE uid=? ORDER BY `id` DESC";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam(1, $uid);
              $stmt->execute();
              while ($group = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $group['name'] = htmlspecialchars(stripslashes(urldecode($group['name'])));
                ?>
                <div class="item <?php if(isset($_GET['group_id']) && $group['id']==$_GET['group_id']) {echo "focus";} ?>"
                     title="<?php echo $group['name'] ?>" data-group-id="<?php echo $group['id'] ?>">
                  <a href="?group_id=<?php echo $group['id'] ?>" class="name"><?php echo $group['name'] ?></a>
                  <a href="javascript:;" class="btn-icon edit" rel="edit" onclick="editgroup(this)">
                    <i class="ct-icon ctico-edit"></i><span>编辑</span>
                    <a href="javascript:;" class="btn-icon del" rel="del" onclick="deletegroup(this)">
                      <i class="ct-icon ctico-clean"></i><span>删除</span>
                    </a>
                </div>
                <?php
                array_push($groups, $group);
              }
              $stmt->closeCursor();
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
            ?>
            <div class="item <?php if(isset($_GET['group_id']) && 0==$_GET['group_id']) {echo "focus";}?>">
              <a href="index.php?group_id=0" class="name">未分组</a>
              <!-- <em class="num">(223)</em> -->
            </div>
          </dd>
          <!-- 分组列表结束 -->
        </dl>
      </div>
    </div>
  </div>
  <!--  右边联系人信息列表-->
  <div class="col-main">
    <!--    面板上功能部分-->
    <div class="main-headline" id="js-panel_menu">
      <div class="operate-btn">
        <a href="javascript:history.go(-1)" class="btn-link"><i class="icon ico-back"></i><span>返回</span></a>
        <!-- 通过js/general.js提交到add_do.php -->
        <a class="button gray-button" id="js-add"><span>提交</span></a>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list">
          <li><a href="#"><?php echo $_SESSION['user']['username']; ?></a></li>
          <li><a href="users/mod_pwd.php">修改密码</a></li>
          <li><a href="users/logout.php">退出</a></li>
        </ul>
      </div>
    </div>
<?php
if (!isset($_SESSION['user'])) {
  echo "<script>alert(\"登录已失效, 请重新登录!\")</script>";
  echo "<script>location.href='users/login.php'</script>";
}
?>
    <div class="main-container">
      <div class="contact-add">
        <input type="hidden" name="uid" class="text" value="<?php echo $_SESSION['user']['id'] ?>" required/>
        <div class="user-profile">
          <div class="user-name">
            <i class="require-red">*</i><label>姓名: </label>
            <input type="text" name="name" class="text" required />
          </div>
          <div class="user-remark">
            <label>备注: </label>
            <textarea rel="remark" name="remark" class="text"></textarea>
          </div>
        </div>
        <p class="title">常用联系</p>
        <div class="contact-form">
          <div class="user-phone">
            <i class="require-red">*</i><label>电话:</label><input type="tel" name="tel" class="text" autocomplete="on" />
          </div>
          <div class="user-email">
            <label>邮箱:</label><input type="email" name="email" class="text" />
           </div>
        </div>
        <p class="title">更多详情</p>
        <div class="contact-form">
          <div class="user-gender">
            <label>性别:</label><input type="radio" name="gender" value="男" />男
            <input type="radio" name="gender" value="女" />女
          </div>
          <div class="user-birth">
            <label>生日:</label><input type="date" name="birth" class="text"/>
          </div>
          <div class="user-address">
            <label>地址:</label><input type="text" name="address" class="text"  />
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
      $("#js-add").click();
    }
// press Esc => history.go(-1)
    if (event.which === 27) {
      location.href='index.php';
    }
  })
</script>

</html>

