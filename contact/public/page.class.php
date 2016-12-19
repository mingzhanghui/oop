<?php
class page {
  private $myde_total;        // 总记录数
  private $myde_size;         // 一页显示的记录数
  private $myde_page;         // 当前页
  private $myde_page_count;   // 总页数
  private $myde_i;            // 开始页数
  private $myde_en;           // 结尾页数
  private $myde_url;          // 获取当前的URL

  /*
   * $show_pages
   * 页面显示的格式，显示链接的页数为2*$show_pages+1。
   * 如$show_pages=2那么页面上显示就是[首页] [上页] 1 2 3 4 5 [下页] [尾页]
   */
  private $show_pages;

  // 检测是否为数字
  private function numeric($num) {
    if (strlen($num)) {
      if (!preg_match("/^[0-9]+$/", $num)) {
        $num = 1;
      } else {
        $num = substr($num, 0, 11);
      }
    } else {
      $num = 1;
    }
    return $num;
  }

  public function __construct($myde_total = 1, $myde_size = 1,
                              $myde_page = 1, $myde_url, $show_pages = 2) {
    $this->myde_total = $this->numeric($myde_total);
    $this->myde_size = $this->numeric($myde_size);
    $this->myde_page  = $this->numeric($myde_page);
    $this->myde_page_count  = $this->numeric(ceil($myde_total/$myde_size));
    $this->myde_url = $myde_url;
    if ($this->myde_total < 0) {
      $this->myde_total = 0;
    }
    if ($this->myde_page < 1) {
      $this->myde_page = 1;
    }
    if ($this->myde_page_count < 1) {
      $this->myde_page_count = 1;
    }
    if ($this->myde_page > $this->myde_page_count) {
      $this->myde_page = $this->myde_page_count;
    }
    $this->limit = ($this->myde_page - 1) * $this->myde_size;
    $this->myde_i = $this->myde_page - $show_pages;
    $this->myde_en = $this->myde_page + $show_pages;
    if ($this->myde_i < 1) {
      $this->myde_en += (1 - $this->myde_i);
      $this->myde_i = 1;
    }
    if ($this->myde_en > $this->myde_page_count) {
      $this->myde_i -= ($this->myde_en - $this->myde_page_count);
      $this->myde_en = $this->myde_page_count;
    }
    if ($this->myde_i < 1) {
      $this->myde_i = 1;
    }
  }

  // 地址替换
  private function page_replace($page) {
    return preg_replace("/page=([0-9]+)/", "page=".$page, $this->myde_url);
  }

  // 首页
  private function myde_home() {
    if ($this->myde_page != 1) {
      return sprintf("<a href='%s' title='首页'>首页</a>", $this->page_replace(1));
    }
  }

  // 上一页
  private function myde_prev() {
    if ($this->myde_page != 1) {
      return sprintf("<a href='%s' title='上一页'>上一页</a>",
        $this->page_replace($this->myde_page -1));
    } else {
      return "<p>上一页</p>";
    }
  }

  // 下一页
  private function myde_next() {
    if ($this->myde_page != $this->myde_page_count) {
      return sprintf("<a href='%s' title='下一页'>下一页</a>",
        $this->page_replace($this->myde_page + 1));
    } else {
      return "<p>下一页</p>";
    }
  }

  // 尾页
  private function myde_last() {
    if ($this->myde_page != $this->myde_page_count) {
      return sprintf("<a href='%s' title='尾页'>尾页</a>",
        $this->page_replace($this->myde_page_count));
    } else {
      return "<p>尾页</p>";
    }
  }
  // GOTO page xxx
  private function myde_goto() {
    return "<span>到<input type='number' id='js-goto-page-input'/>页
            <button id='js-goto-page-btn'>GOTO</button></span>";
  }

  // 输出
  public function myde_write($id = 'page') {
    $str = "<div id=" . $id . ">";
    $str .= $this->myde_home();
    $str .= $this->myde_prev();
    if ($this->myde_i > 1) {
      $str .= "<p class='page-ellipsis'>...</p>";
    }
    for ($i = $this->myde_i; $i <= $this->myde_en; $i++) {
      if ($i == $this->myde_page) {
        $str .= sprintf("<a href='%s' title='第%d页' class='cur'>%d</a>",
          $this->page_replace($i), $i, $i);
      } else {
        $str .= sprintf("<a href='%s' title='第%d页'>%d</a>",
          $this->page_replace($i), $i, $i);
      }
    }
    if ($this->myde_en < $this->myde_page_count) {
      $str .= "<p class=page-ellipsis>...</p>";
    }
    $str .= $this->myde_next();
    $str .= $this->myde_last();
    $str .= $this->myde_goto();
    $str .= sprintf("<p class='page-remark'>共<b>%d</b>页<b>%d</b>条数据</p>",
      $this->myde_page_count, $this->myde_total);
    $str .= "</div>";
    return $str;
  }

  // 当前页应取的数据条数
  public function get_size() {
    // 最后一页取得条数不是完整的一页
    if ($this->myde_page * $this->myde_size > $this->myde_total) {
      return $this->myde_total - ($this->myde_page - 1) * $this->myde_size;
    }
    return $this->myde_size;
  }
  public function get_page() {
    return $this->myde_page;
  }
}
?>