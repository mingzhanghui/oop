/**
 * Created by mzh on 11/16/16.
 */
// (function() {
//     var form = document.querySelector("form[name=modpwd]");
// }).call(this);

function forEachElement(selector, fn) {
    var elements = document.querySelectorAll(selector);
    for (var i = 0; i < elements.length; i++) {
        fn(elements[i], i, elements.length, elements[i-1]);
    }
}
function checklen(el, i) {
    //　取得下一个nodeType.ELEMENT_NODE的节点
    var nextElementNode = el.nextSibling;
    while (nextElementNode && nextElementNode.nodeType != 1) {
        nextElementNode = nextElementNode.nextSibling;
    }
    // 提示信息
    if (el.value.length == 0) {
        nextElementNode.innerHTML = "<font color='red'>密码不能为空</font>";
    } else if (el.value.length < 5) {
        nextElementNode.innerHTML = "<font color='red'>密码长度至少５位</font>";
    } else {
        nextElementNode.innerHTML = "";
    }
}
function checkequal(el, prev) {
    var nextElementNode = el.nextSibling;
    while (nextElementNode && nextElementNode.nodeType != 1) {
        nextElementNode = nextElementNode.nextSibling;
    }
    if (el.value !== prev.value) {
        nextElementNode.innerHTML = "<font color='red'>两次密码输入不一致</font>";
    } else {
        nextElementNode.innerHTML = "";
    }
}
// 检查３个密码输入框密码长度
// @el: 当前元素,
// @i: 当前循环下标
// @n: 总循环次数
// @prev: 上一个元素
forEachElement("input[type=password]", function(el, i, n, prev) {
    el.onblur = function (el, i, n, prev) {
        if (i < n - 1) {
            return function() {checklen(el, i);}
        } else {
            return function() {checkequal(el, prev);}
        }
    }(el, i, n, prev);
});
