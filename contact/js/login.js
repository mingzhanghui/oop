/**
 * Created by mzh on 11/9/16.
 */
// 选定输入框下面提示信息消失
var nameInput = document.getElementsByTagName('input')[0];
var nameHelp = document.getElementsByClassName('help-block')[0];

nameInput.onfocus = function() {
    nameHelp.innerHTML = '';
}

var pwdInput = document.getElementsByTagName('input')[1];
var pwdHelp = document.getElementsByClassName('help-block')[1];

pwdInput.onfocus = function() {
    pwdHelp.innerHTML = '';
}

// 转化URL xxx/users/login.php -> xxx/
var url = location.href;
url = url.substring(0, url.lastIndexOf('/'));
url = url.substring(0, url.lastIndexOf('/'));
var indexURL = url;

$('form.ajax-login').on('submit', function () {
    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};
    // username, password
    that.find('input[name]').each(function() {
       var that = $(this),
           name = that.attr('name'),
           value = that.val();
        data[name] = value;
    });
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
            var json = JSON.parse(response);
            switch (json.status) {
                case 0:  // 成功
                    window.location.href = indexURL;
                    alert(json.msg);
                    break;
                case 1:  // 用户名不存在
                case 3:　// 用户名没有输入
                    $('#username_feedback').html(json.msg).show();
                    break;
                case 2:   // 密码错误
                case 4:   // 密码没输入
                    $('#pwd_feedback').html(json.msg).show();
                    break;
                default:  // Exception
                    alert("Exception: " + json.msg);
            }
        }
    });
    return false;
});