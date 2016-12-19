/**
 * Created by mzh on 11/8/16.
 */
// 验证注册表单
// 根据cookie name取得value
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                // 最后一个cookie值后面没有分号;
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

$(document).ready(function() {
    var registerForm = document.forms['register'];

    // 检查注册表单用户名合法
    var url = 'check_register.php';
    if (domain = getCookie('domain')) {
        url = domain + "/users/check_register.php";
    }
    $('#username_feedback').load(url).show();

    // 检验用户名
    $('#username_input').keyup(function() {
        var result = '';
        $.post('check_register.php',
            {username: registerForm.username.value.trim() },
            function(result) {
                $('#username_feedback').html(result).show();
                console.log(result);
            });
    });

    //　检验密码
    $('#pwd').keyup(function() {
        var pwd = $('#pwd').val();
        var result = '';
        var feedback = $('#pwd_feedback');
        if (pwd.length < 5) {
            result = "<font color='red'>密码长度至少5位</font>";
            feedback.html(result).show();
        } else {
            result = "";
            feedback.html(result).show();
        }
    });

    //　检验确认密码
    $('#repwd').keyup(function () {
        var pwd = $('#pwd').val();
        var repwd = $(this).val();
        var result = '';

        if (repwd !== '') {
            if (pwd !== repwd) {
                result = "<font color='red'>2次密码输入不一致</font>";
            } else {
                result = "";
            }
        } else {
            result = "<font color='red'>必须输入确认密码</font>";
        }
        $('#repwd_feedback').html(result).show();
    });
});