/**
 * Created by mzh on 11/10/16.
 */
$(document).ready(function() {
    // 选中输入框 边框变蓝色
    var input = $("input");
    input.focus(function() {
        $(this).css( "border", "1px solid #549ed8");
    });
    input.blur(function() {
        $(this).css( "border", "1px solid #a9a9a9");
    });

    var remark = $("textarea[rel=remark]");
    remark.focus(function() {
        $(this).css( "border", "1px solid #549ed8");
    });
    remark.blur(function() {
        $(this).css( "border", "1px solid #a9a9a9");
    });

    // 添加联系人
    $("#js-add").click(function() {
        var name = $("input[name=name]");
        var tel = $("input[name=tel]");
        if ($.trim(name.val()) == '' || $.trim(tel.val()) == '') {
            name.css("border", "1px solid red");
            tel.css("border", "1px solid red");
            name.focus();
            alert("姓名或电话没有填写");
            return false;
        }

        var url = "add_do.php";
        var type = "post";
        var data =  {
            "uid" : $("input[name=uid]").val(),
            "name": name.val(),
            "remark": $("textarea[name=remark]").val(),
            "tel":tel.val(),
            "email":$("input[name=email]").val(),
            "gender": $("input[name=gender]:checked").val(),
            "birth":$("input[name=birth]").val(),
            "address":$("input[name=address]").val()
        };
        // trim data attributes value
        $.each(data, function(key, value) {
            value = encodeURI($.trim(value));
        });
        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: "json",
            success: function(respObj, dataType) {
                if (respObj == null) alert('返回数据0条');
                switch (respObj.code) {
                    case 0:
                        location.href = 'index.php';
                        break;
                    case 1:
                        alert(respObj.msg);
                        break;
                    default:
                        alert(respObj.msg);
                        console.log(respObj);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('添加联系人失败: ' + errorThrown);
            }
        });
    });

    // 保存修改联系人
    $("#js-save").click(function() {
        var url = "edit_do.php";
        var type = "post";
        var data =  {
            "id" : $("input[name=id]").val(),
            "name": $("input[name=name]").val(),
            "remark": $("textarea[name=remark]").val(),
            "tel":$("input[name=tel]").val(),
            "email":$("input[name=email]").val(),
            "gender": $("input[name=gender]:checked").val(),
            "birth":$("input[name=birth]").val(),
            "address":$("input[name=address]").val(),
            "gid":$("select[name=groups] option:selected").val()
        };
        // trim data attributes value
        $.each(data, function(key, value) {
            value = encodeURI($.trim(value));
        });
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response) {
                var json = JSON.parse(response);
                switch (json.code) {
                    case 0:
                        alert('修改成功');
                        history.back();
                        break;
                    case 1:
                        alert('修改联系人失败:' + json.msg);
                    default:
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('修改联系人失败: ' + errorThrown);
                console.log(textStatus);
            }
        });
    });

    // 添加组, 只有index.php有这个node
    $('#js-add-group').click(function() {
        var groupname = prompt("输入添加分组名:");
        name = encodeURI($.trim(groupname));
        if (name == '') {   // 分组名为空
            return false;
        }
        var uid = $("#js-uid").val();
        uid = encodeURI($.trim(uid));

        var data = {};
        data['name'] = name;
        data['uid'] = uid;

        $.ajax({
            url: "group_add.php",
            type: "post",
            data: data,
            success: function (response) {
                var json = JSON.parse(response);
                if (json.code == 0) {
                    var id = json.id;

                    var dom = "<div class='item' title='" + decodeURI(name) + "'>" +
                    "<a href='?group_id='" + id + "' class='name'>" + decodeURI(name) + "</a>" +
                    "<a href='javascript:;' class='btn-icon edit' rel='edit'>" +
                    "<i class='ct-icon ctico-edit'></i><span>编辑</span></a>" +
                    "<a href='' class='btn-icon del' rel='del'>" +
                    "<i class='ct-icon ctico-clean'></i><span>删除</span></a></div>";
                    // jQuery 添加节点
                    $('#js-group-list').prepend(dom);
                } else {
                    alert('添加分组失败: ' + json.msg);
                }
            }
        });
    });

    // 编辑分组
    editgroup = function (obj) {
        var groupid = obj.parentNode.getAttribute("data-group-id");
        var groupname = prompt("输入新的分组名");
        groupname = $.trim(groupname);
        if (groupname == '') {
            return false;
        }

        var data = {};
        data['id'] = groupid;
        data['name'] = encodeURI(groupname);
        $.ajax({
            url: "group_rename.php",
            type: "post",
            data: data,
            success: function (response) {
                var json = null;
                try {
                    json = JSON.parse(response);
                } catch (e) {
                    alert("解析group_rename.php返回json错误");
                    return false;
                }
                if (json.code == 0) {
                    $(obj).prev().text(groupname);
                } else {
                    alert('修改分组名失败(' + json.code + '): ' + json.msg);
                    return false;
                }
            }
        });
    }

    // 删除分组
    deletegroup = function (obj) {
        var groupid = obj.parentNode.getAttribute("data-group-id");

        var data = {};
        data['id'] = groupid;

        $.ajax({
            url: "group_remove.php",
            type: "post",
            data: data,
            success: function (response) {
                var json = null;
                try {
                    json = JSON.parse(response);
                } catch (e) {
                    alert("解析group_remove.php返回json错误, ");
                    return false;
                }
                if (json.code == 0) {
                    // 删除这个节点的父节点
                    $(obj).parent().remove();
                } else {
                    alert('修改分组名失败(' + json.code + '): ' + json.msg);
                    return false;
                }
            }
        });
    }
});

