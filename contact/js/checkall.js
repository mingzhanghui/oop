/**
 * Created by mzh on 11/14/16.
 */
// 隔行换色
// $(function() {
//    $("table tr:even").addClass("even");
//    $("table tr:odd").addClass("odd");
// });

// 全选/全不选
function checkAll() {
    var checkall = document.getElementById('js-checkall');
    var items = document.getElementsByClassName('ids');

    checkall.onclick = function() {
        var len = items.length;
        for (var i = 0; i < len; i++) {
            items[i].checked = checkall.checked;
        }
    }
    // 选中变色
    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        item.onclick = function () {
            var tr = this.parentNode.parentNode;
            if (this.checked) {
                if (!tr.classList.contains("selected")) {
                    tr.classList.add("selected");
                }
            } else {
                if (tr.classList.contains("selected")) {
                    tr.classList.remove("selected");
                }
            }
        }
    }
}
window.onload = checkAll();

// 批量删除
function bulkDelete() {
    var recordsToDelete = [];
    $(".ids").each(function () {
        if (this.checked) {
            recordsToDelete.push(this.value);
        }
    });
    if (recordsToDelete.length < 1) {
        alert("至少选择一条联系人记录");
        return false;
    }
    var json = JSON.stringify(recordsToDelete);
    console.log("contact id to delete: " + json);

    if (!confirm("确定要删除这" + recordsToDelete.length + "条联系人记录?")) {
        return false;
    }
    $.ajax({
        url: "bulk_delete.php",
        type: "POST",
        data: {"ids": json},
        success: function (json) {
            try {
                if (json.code == 0) {
                    // 删除成功，刷新页面
                    location.href="index.php";
                } else {
                    alert(json.msg);
                }
            } catch (e) {
                alert(e);
            }
        },
        complete: function(xhr, status) {
        }
    });
}

$(document).ready(function () {
// 勾选联系人, 批量分组DIV出现； 取消勾选联系人， 批量分组DIV消失
    var ids = $(".ids");
    var bulkgroupdiv = $('#js-bulk-group');
    var checkall = $('#js-checkall');

    checkall.change(function () {
        if ($(this).is(":checked")) {
            bulkgroupdiv.show();
        }
    });
    checkall.change(function () {
        if (!$(this).is(":checked")) {
            bulkgroupdiv.hide();
        }
    });

    ids.each(function () {
        $(this).change(function() {
            if ($(this).is(":checked")) {
                bulkgroupdiv.show();
            }
        });
    });
    ids.each(function() {
        $(this).change(function() {
            var checkedcount = $(".ids:checked").length;
            if (checkedcount == 0) {
                bulkgroupdiv.hide();
            }
        });
    });
});

// 批量分组
function bulkGroup(obj) {
    var recordsToGroup = [];
    $(".ids").each(function () {
        if (this.checked) {
            recordsToGroup.push(this.value);
        }
    });

    var groupid = $(obj).val();
    var selections = $(obj).children();

    var data = {'uids':recordsToGroup, 'gid':groupid};
    var json = JSON.stringify(data);
    console.log("group json: " + json);

    // if (!confirm("确定要移动" + recordsToGroup.length + "个联系人?")) {
    //     return false;
    // }
    $.ajax({
        url: "group_move.php",
        type: "POST",
        data: data,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                if (json.code == 0) {
                    location.href="index.php";
                } else {
                    alert(json.msg);
                }
            } catch (e) {
                alert(e);
            }
        },
        complete: function(xhr, status) {
        }
    });
}