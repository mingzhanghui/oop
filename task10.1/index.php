<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <title>创建对象</title>
  <link rel='stylesheet' type='text/css' href='style.css'/>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
</head>
<body>
<a name="#top"></a>
<?php
include_once 'page.class.php';
include 'girlfriend.class.php';

$gfarr = array();
for ($i = 0; $i < 1000; $i++) {
  $gf = new girlfriend($i+1);
  array_push($gfarr, $gf);
}

$curpage = isset($_GET['page']) ? $_GET['page'] : 1;
// 每页中条目数
$size = 20;
// 分页对象
$pageObj = new page(1000, $size, $curpage, 'index.php?page=1');
$page = $pageObj->get_page();
// 准备输入的数组
$gfarr = array_slice($gfarr, ($page-1)*$size, $size);
$table = new table($gfarr);
$table->table_write(0, count($gfarr));

echo $pageObj->myde_write();
?>
<a id="toTop" href="#top" onclick="javascript:scrollToAnchor('#top')">
  <span id="toTopHover"></span>
  <img width="40" height="40" alt="To Top" src="to-top.png">
</a>
</body>
<script type='text/javascript' src='bgcolor.js'></script>
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
