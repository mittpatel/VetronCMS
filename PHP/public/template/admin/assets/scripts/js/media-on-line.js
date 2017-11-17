/**
 * Created by LONG JIN WEN on 2017/6/17.
 */
/*
 * 插入在线资源
 * */
/*
 * */


var nowPathNow = '';
var newNowPath = '/uploads';

function addOnLineNext(path) {
    var addOnLine = layer.load();
    $.ajax({
        type: 'GET',
        url: site_root + "/admin/onLineFiles",
        data: {
            now: path,
            isMedia: 1
        },
        success: function (data) {
            newNowPath = path
            layer.close(addOnLine);
            var parentsDiv = $(".on-line-body").parent('div');
            $(".on-line-body").remove();
            parentsDiv.html(data)
        }
    });
}

function uploadFile(e) {
    var addOnLine = layer.load();
    ajaxUpload({
        e: e,
        url: site_root + "/admin/ajaxOnLineFiles" + "?path=" + $(e).attr('path'),//处理图片脚本
        token: token
    }, function (data) {

        if (data.status == 1) {
            layer.msg(data.msg);
            nowPathNow = data.nowPath;
            addOnLineNext(data.nowPath);
            // cutPictures(data.path);

        } else {
            layer.close(addOnLine);
            layer.msg(data.msg)
        }
    });
}

function cutPictures(data) {

    var fileExtension = data.split('.').pop().toLowerCase();
    if (fileExtension == 'jpg' || fileExtension == 'jpeg' || fileExtension == 'png') {

        $("body").css('position', 'relative');
        $("body").append('<img class="tmp_img" src="' + site_public + data + '" style="width: 800px;height: auto;opacity: 0;" />');
        setTimeout(function () {
            AcutPictures = layer.open({
                type: 1,
                anim: 0,
                skin: 'layui-layer-lan',
                area: ['802px', $(".tmp_img").height() + 120 + "px"], //宽高
                title: 'Upload',
                content: '<img src="" style="width: 800px;height: auto;margin: 0 auto;" id="" class="target_ss" alt="[Jcrop Example]"/><input style="float: right;margin: 20px;" type="button" class="btn btn-primary btn-sm" onclick="submitCutPictures()" value="SUBMIT"><div class="inline-labels"><div style="display: none;"><label>X1<input type="text" size="4" class="x1" name="x1"/></label><label>Y1<input type="text" size="4" class="y1" name="y1"/></label><label>X2<input type="text" size="4" class="x2" name="x2"/></label><label>Y2<input type="text" size="4" class="y2" name="y2"/></label><label>W<input type="text" size="4" class="w" name="w"/></label><label>H<input type="text" size="4" class="h" name="h"/><input type="hidden" class="show_width" name="show_width"><input type="hidden" class="show_height" name="show_height"></label></div></div>',
            });
            $(".target_ss").attr('src', site_public + data);
            $(".target_ss").attr('src_path', './' + data);
            (function () {
                jQuery(function ($) {
                    var jcrop_api;
                    $('.target_ss').Jcrop({
                        onChange: showCoords,
                        onSelect: showCoords,
                        onRelease: clearCoords
                    }, function () {
                        jcrop_api = this;
                    });
                    $('.coords').on('change', 'input', function (e) {
                        var x1 = $('.x1').val(),
                            x2 = $('.x2').val(),
                            y1 = $('.y1').val(),
                            y2 = $('.y2').val();
                        jcrop_api.setSelect([x1, y1, x2, y2]);
                    });

                });
                function showCoords(c) {
                    $('.x1').val(c.x);
                    $('.y1').val(c.y);
                    $('.x2').val(c.x2);
                    $('.y2').val(c.y2);
                    $('.w').val(c.w);
                    $('.h').val(c.h);
                }

                function clearCoords() {
                    $('.coords input').val('');
                }
            })();
        }, 1000);
        setTimeout(function () {
            $(".show_width").val($(".target_ss").width());
            $(".show_height").val($(".target_ss").height());
            $(".tmp_img").remove();
        }, 2000);

    }
}

function submitCutPictures() {
    var xx1 = $(".x1").val();
    var xx2 = $(".x2").val();
    var yy1 = $(".y1").val();
    var yy2 = $(".y2").val();
    var www = $(".w").val();
    var hhh = $(".h").val();
    var width = $(".show_width").val();
    var height = $(".show_height").val();
    var edit_img_path = $(".target_ss").attr('src_path');

    $.ajax({
        type: 'GET',
        url: site_root + "/admin/cutPictures",
        data: 'xx1=' + xx1 + "&xx2=" + xx2 + "&yy1=" + yy1 + "&yy2=" + yy2 + "&www=" + www + "&hhh=" + hhh + "&edit_img_path=" + edit_img_path + "&width=" + width + "&height=" + height,
        success: function (data) {
            layer.close(AcutPictures)
            //返回成功后刷新当前目录
            addOnLineNext(nowPathNow);
        },

    });
}


function appendEditor(e) {
}
function createFolder() {

    //弹出输入框
    var indexprompt = layer.prompt({
        title: '输入文件夹名称',
        formType: 3,
        btn: ['确认', '取消']
    }, function (text) {
        var createFolders = layer.load();
        $.ajax({
            type: 'GET',
            url: site_root + "/admin/ajaxCreateFolder",
            data:{
                text:text,
                nowPath:newNowPath
            },
            success: function (data) {
                data=$.parseJSON(data);
                layer.close(indexprompt);
                layer.close(createFolders);

                if (data.status == 1) {
                    addOnLineNext(newNowPath)
                    layer.msg(data.msg);

                } else {
                    layer.msg(data.msg)
                }

            },

        });


    });


}
