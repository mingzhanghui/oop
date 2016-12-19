<?php
include "./public/acl.php";
include "./public/pdo.php";
include "./public/page.class.php";
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>通信录个人主页</title>
  <link rel="stylesheet" type="text/css" href="./css/contact.css" />
  <script type="text/javascript" src="./js/lib/jquery-3.1.0.min.js"></script>
</head>
<body class="home-page">
<?php
$uid = $_SESSION['user']['id'];
echo "<input id='js-uid' type='hidden' value='{$uid}'/>";

// 所有的联系人信息存到 $contacts数组
$contacts = array();
$stmt = null;
// 分组限制
$and = "";
if (isset($_GET['group_id'])) {
  $gid = $_GET['group_id'];
  if ($gid == 0) {
    $and = sprintf("AND gid IS NULL", $gid);
  } else {
    $and = sprintf("AND gid='%d'", intval($gid));
  }
}
try {
  $sql = "SELECT contact.id AS id, contact.name AS `name`, gender, tel, email, 
           birth, address, grp.name AS groupname, grp.id AS gid, contact.uid as uid
           FROM `contact` LEFT JOIN `grp` ON `contact`.`gid` = `grp`.`id`
           WHERE `contact`.`uid`=:uid {$and} ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array('uid'=>$_SESSION['user']['id']));
  $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}
$rowCount = $stmt->rowCount();
$stmt->closeCursor();
// 当前的页数
if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
// URL上get参数列表?page=xx&group_id=xx, 传给分页对象
$getstr = "?page=1";
if (isset($_GET['group_id'])) {
  $getstr = "?page=1&group_id=" . $_GET['group_id'];
}
// @$pageObj: 分页对象
$pageObj = new page($rowCount, 10, $_GET['page'], $getstr, 2);
$page = $pageObj->get_page();
$size = $pageObj->get_size();
$contacts = array_slice($contacts, ($page-1)*$size, $size);
?>
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
    <div class="main-headline">
      <div class="operate-btn">
        <a href="javascript:bulkDelete()" class="hd-btn"><i class="ct-icon cticon-del">&nbsp;</i>批量删除</a>
        <a href="add.php" class="hd-btn" tabindex="1"><i class="ct-icon cticon-add">&nbsp;</i>新建联系人</a>
      </div>
      <div class="move-group-title" id="js-bulk-group" style="display:none">
        <span>批量分组: </span>

          <select name="groups" onchange="bulkGroup(this)">
          <option value="0">未分组</option>
          <?php
          $groupcount = count($groups);
          for ($i = 0; $i < $groupcount; $i++) {
            echo "<option value='{$groups[$i]['id']}'>{$groups[$i]['name']}</option>";
          }
          unset($groups);
          ?>
          </select>
          <a href="javascript:bulkGroup(this);" id="js-confirm-group"></a>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list">
          <li><a href="#"><?php echo $_SESSION['user']['username']; ?></a></li>
          <li><a href="users/mod_pwd.php">修改密码</a></li>
          <li><a href="users/logout.php">退出</a></li>
        </ul>
      </div>
    </div>
    <!-- 通信录列表 begin   -->
    <div class="list-container">
      <div class="contact-list">
        <table class="result-tab" width="100%">
          <thead>
          <tr>
            <th class="tc" width="5%"><input id="js-checkall" type="checkbox"></th>
            <th>ID</th><th>姓名</th><th>性别</th><th>电话</th><th>邮箱</th><th>生日</th><th>地址</th><th>分组</th><th>操作</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $n = count($contacts);
          for ($i = 0; $i < $n; $i++) {
            // 防止js字符串
            $row = array();
            foreach ($contacts[$i] as $key=>$value) {
              if (gettype($value) == 'string') {
                $value = htmlspecialchars(stripslashes(urldecode($value)));
              }
              $row[$key] = $value;
            }
            unset($contacts[$i]);
            ?>
            <tr>
              <td class="tc"><input class="ids" name="id[]" value="<?php echo $row['id'] ?>" type="checkbox"></td>
              <td title="id"><?php echo $row['id'] ?></td>
              <td title="name"><a href="edit.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
              <td title="gender"><?php echo $row['gender'] ?></td>
              <td title="tel"><?php echo $row['tel'] ?></td>
              <td title="email"><?php echo $row['email'] ?></td>
              <td title="birth"><?php echo $row['birth'] ?></td>
              <td title="<?php echo $row['address'] ?>"><?php echo $row['address'] ?></td>
              <td title="group"><?php echo ($row['groupname'] == '') ? "未分组" : $row['groupname'] ?></td>
              <td title="修改|删除">
                <a href="edit.php?id=<?php echo $row['id'] ?>" alt="edit"><i class="ct-icon cticon-edit"></i></a>
                <a href="delete.php?id=<?php echo $row['id'] ?>" alt="delete"><i class="ct-icon cticon-del"></i></a>
              </td>
            </tr>
            <?php
            unset($row);
          }
          ?>
          </tbody>
        </table>
      </div>
      <!-- 分页 -->
      <div class="pagination">
        <?php
        echo $pageObj->myde_write();
        ?>
      </div>
    </div>
    <!-- 通信录列表 end   -->
  </div>
</div>
</body>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/checkall.js"></script>
<script type="text/javascript">
  var page = document.getElementById('js-goto-page-input');
  var btn = document.getElementById('js-goto-page-btn');
  btn.onclick = function () {
    if (page.value) {
      location.href = '?page=' + page.value;
    }
  }
  // 如果输入了页数，　按Enter跳转到这页
  document.onkeydown = function (e) {
    if (page.value) {
      if (e.keyCode == 13) {
        location.href = '?page=' + page.value;
      }
    }
  };
</script>
</html>

