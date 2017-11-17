<?php if ($_GET['status'] != 1) header("location: " . $_SERVER['HTTP_REFERER']); ?>

<?php
include 'common/header.php';

?>


<div class="main-content">
    <div class="content-text">
        <h1>
            数据库设置
        </h1>
        <hr class="cu">
    </div>
    <div>
        <div class="res" style="">
            <form action="" id="mysql">
                <span class="res-text" style="">输入数据库信息</span>
                <div class="res-list">
                    <div style="margin-top: 10px;"><span>主机地址：</span><span>
                            <input value="10.68.100.102" name="host" type="text"></span>
                        <span class="sub-err"></span>
                    </div>
                    <div style="margin-top: 10px;"><span>端口：</span><span><input name="port" value="3306" type="text"></span>
                        <span class="sub-err"></span>
                    </div>
                    <div style="margin-top: 10px;"><span>用户名：</span><span><input name="name" value="root" type="text"></span>
                        <span class="sub-err"></span>
                    </div>
                    <div style="margin-top: 10px;"><span>密码：</span><span><input name="password" value="root" type="text"></span>
                        <span class="sub-err"></span>
                    </div>

                    <div style="margin-top: 10px;"><span>数据库名(自动创建)：</span><span>
                            <input name="dbname" value="qqqqqqqqqqqqqqqq" type="text"></span>
                        <span class="sub-err"></span>
                    </div>
                    <div>
                        <a onclick="checkMysql()" href="javascript:;"
                           style="width: 60px;font-size: 12px;height: 20px;padding: 0;line-height: 20px;"
                           class="button button-s">
                            检测连接
                        </a>
                        <span class="checkMysqlRes"></span>
                    </div>
                </div>
                <input type="hidden" name="action" value="checkMysql">
            </form>
        </div>
        <div class="res" style="">
            <span class="res-text" style="">输入管理员信息</span>
            <div class="res-list">
                <div style="margin-top: 10px;"><span>用户名：*</span><span><input name="admin_name" value="admin" type="text"></span>
                    <span class="sub-err"></span></div>
                <div style="margin-top: 10px;"><span>密码：*</span><span><input type="text" value="admin" name="admin_password"></span>
                    <span class="sub-err"></span>
                </div>
                <div style="margin-top: 10px;"><span>确认密码：*</span><span>
                        <input type="text" value="admin" name="admin_q_password"></span>
                    <span class="sub-err"></span>
                </div>
                <div style="margin-top: 10px;"><span>电子邮箱：*</span><span><input value="admin@qq.com" type="text" name="admin_email"></span>
                    <span class="sub-err"></span>
                </div>
                <div style="margin-top: 10px;"><span>手机号码：</span><span><input type="text" name="admin_phone"></span>
                    <span class="sub-err"></span>
                </div>

            </div>
        </div>
    </div>
</div>
<div style="text-align: center">
    <button href="" onclick="install(this)"
            class="button button-s next-a">
        安装
    </button>
    <span style="color: red;" class="install-tips"></span>
</div>
<!--loading-->

<div class="spinner" style="display: none;">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<div id="loading-y">

</div>
<!--loading-->
<script>
    function checkMysql() {
        $(".checkMysqlRes").html('正在检测...');
        $.ajax({
            type: 'POST',
            url: "../action.php",
            data: $('#mysql').serialize(),
            datatype: 'html',
            success: function (data) {
                $(".checkMysqlRes").html(data);
            },
            error: function () {
            }
        });
    }
    function install(e) {
        var status = true;
        var host = $("input[name=host]").val();
        if (!host) {
            $("input[name=host]").parent('span').next().html('主机地址不能为空');
            status = false;
        } else {
            $("input[name=host]").parent('span').next().html('');
        }

        var port=$("input[name=port]").val();
        if (!port) {
            $("input[name=port]").parent('span').next().html('端口不能为空');
            status = false;
        } else {
            $("input[name=port]").parent('span').next().html('');
        }


        var db_user = $("input[name=name]").val();
        if (!db_user) {
            $("input[name=name]").parent('span').next().html('用户名不能为空');
            status = false;
        } else {
            $("input[name=name]").parent('span').next().html('');
        }

        var db_password = $("input[name=password]").val();

        if (!db_password) {
            $("input[name=password]").parent('span').next().html('密码不能为空');
            status = false;
        } else {
            $("input[name=password]").parent('span').next().html('');
        }

        var db_name = $("input[name=dbname]").val();
        if (!db_name) {
            $("input[name=dbname]").parent('span').next().html('数据库不能为空');
            status = false;
        } else {
            $("input[name=dbname]").parent('span').next().html('');
        }


        var admin_name = $("input[name=admin_name]").val();
        if (!admin_name) {
            $("input[name=admin_name]").parent('span').next().html('管理员账号不能为空');
            status = false;
        } else {
            $("input[name=admin_name]").parent('span').next().html('');
        }


        var admin_password = $("input[name=admin_password]").val();
        if (!admin_password) {
            $("input[name=admin_password]").parent('span').next().html('管理员密码不能为空');
            status = false;
        } else {
            $("input[name=admin_password]").parent('span').next().html('');
        }


        var admin_q_password = $("input[name=admin_q_password]").val();
        if (admin_q_password != admin_password) {
            $("input[name=admin_q_password]").parent('span').next().html('两次密码不一致');
            status = false;
        } else {
            $("input[name=admin_q_password]").parent('span').next().html('');
        }
        var admin_phone = $("input[name=admin_phone]").val();
        var admin_email = $("input[name=admin_email]").val();

        if (!admin_email) {
            $("input[name=admin_email]").parent('span').next().html('管理员邮箱不能为空');
            status = false;

        } else {
            var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
            if (!re.test(admin_email)) {
                $("input[name=admin_email]").parent('span').next().html('管理员邮箱格式不正确');
                status = false;
            } else {
                $("input[name=admin_email]").parent('span').next().html('');
            }
        }

        if (status) {
            //锁定按钮
            $(e).prop('disabled', true);
            $(".install-tips").html('正在安装，请勿关闭浏览器...');
            $("#loading-y").show();
            $(".spinner").show();
            $.ajax({
                type: 'POST',
                url: "../action.php",
                async: true,
                data: {
                    action: "install",
                    host: host,
                    db_user: db_user,
                    db_password: db_password,
                    db_name: db_name,
                    admin_name: admin_name,
                    admin_password: admin_password,
                    admin_phone: admin_phone,
                    admin_email: admin_email,
                    port: port,
                },
                success: function (data) {

                    if (data) {
                        data = $.parseJSON(data);
                    }
                    $(e).prop('disabled', false);
                    if (data.status == 50) {
                        $(".install-tips").html(data.msg);
                        $(e).prop('disabled', false);
                        $("#loading-y").hide();
                        $(".spinner").hide();
                    } else if (data.status == 1) {
                        $(".install-tips").html(data.msg);
                        window.location="../action/four.php?active=four&status=1"
                    }
                }
            });
        }

    }


</script>
<?php
include 'common/footer.php'
?>


