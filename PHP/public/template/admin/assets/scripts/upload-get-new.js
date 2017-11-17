var onLineUpload = new Object();
onLineUpload.nowPath = '';
onLineUpload.upPath = '';

/*
* 1.初始化放入页面的元素
*
* */

onLineUpload.init = function (_html, _path) {
    $.ajax({
        type: 'GET',
        url: site_root + '/admin/upload/all',
        data: {
            nowPath: _path
        },
        success: function (data) {
            $(_html).html(data);
            onLineUpload.ocloseLoading();
        }
    });
}
onLineUpload.getUpdateData = function (_html, _path) {
    onLineUpload.openLoading();
    $.ajax({
        type: 'GET',
        url: site_root + '/admin/upload/path',
        data: {
            nowPath: _path
        },
        success: function (data) {
            onLineUpload.ocloseLoading();
            $(_html).html(data);
        }
    });
}
/*
* 创建文件夹
* */
onLineUpload.createFolder = function () {
    var nowPath = this.nowPath;
    //弹出输入框
    var indexprompt = layer.prompt({
        title: '输入文件夹名称',
        formType: 3,
        btn: ['确认', '取消']
    }, function (text) {
        onLineUpload.openLoading();
        $.ajax({
            type: 'GET',
            url: site_root + '/admin/upload/create/folder',
            data: {
                text: text,
                nowPath: nowPath
            },
            success: function (data) {

                layer.close(indexprompt);

                data = $.parseJSON(data);
                layer.msg(data.msg);
                if (data.status == 1) {
                    onLineUpload.reloadUpload();
                }
            },

        });
    });
}

/*
* 刷新目录
* */
onLineUpload.reloadUpload = function () {
    onLineUpload.openLoading();
    $.ajax({
        type: 'GET',
        url: site_root + '/admin/upload/path',
        data: {
            nowPath: this.nowPath
        },
        success: function (data) {
            /**/
            $('.upload-path').html(data);
            onLineUpload.ocloseLoading();
        }
    });
}
/*
* 删除文件和文件夹
* */
onLineUpload.deleteDirFile = function (e) {


    var indexprompt = layer.confirm('确认要删除吗？', {
        title: ['提示'],     //提示
        btn: ['确认', '取消'], //按钮
    }, function () {
        onLineUpload.openLoading();
        $.ajax({
            type: 'GET',
            url: site_root + '/admin/upload/delete/filedir',
            data: {
                nowPath: $(e).parent().prev().prev().attr('relative')
            },
            success: function (data) {
                onLineUpload.ocloseLoading();
                layer.close('indexprompt');
                data = $.parseJSON(data);
                if (data.status == 1) {
                    layer.msg(data.msg);
                    onLineUpload.reloadUpload();
                } else {
                    layer.msg(data.msg);
                }
            }
        });

    });

}

/*
* 上传文件框change事件
* */
onLineUpload.uploadFileY = function (sourceId) {

    this.layerOpen = layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        shadeClose: true,
        // area: ['700px', '450px'],
        skin: 'yourclass',
        content: '<img style="display: block;max-height: ' + $(window).height() * 0.8 + 'px;' + '" src="" id="sourceId">' +
        '<img style="display: none;" src="" class="sourceIdS">' +
        '<form style="display: none;" id="jiequ"><input name="x1" type="hidden" id="x1">' +
        '<input name="x2" type="hidden" id="x2">' +
        '<input name="y1" type="hidden" id="y1">' +
        '<input name="y2" type="hidden" id="y2">' +
        '<input name="ww" type="hidden" id="ww">' +
        '<input name="hh" type="hidden" id="hh">' +
        '<input name="yw" type="hidden" id="yw">' +
        '<input name="_token" type="hidden" id="" value='+token+'>' +
        '<input name="yh" type="hidden" id="yh"></form>' +
        '<button onclick="onLineUpload.ajaxUpload()" class="btn btn-primary">SUBMIT</button>',
        //关闭页面层回调
        end: function () {
            $(".layui-layer-move").next().remove();
            $(".imgareaselect-outer").remove();
        }
    });

    /* var url;
     if (navigator.userAgent.indexOf("MSIE") >= 1) { // IE
         url = document.getElementById(sourceId).value;
     } else if (navigator.userAgent.indexOf("Firefox") > 0) { // Firefox
         url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
     } else if (navigator.userAgent.indexOf("Chrome") > 0) { // Chrome
         url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
     }*/
    /*IE10以上和其他浏览器均支持*/
    var url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
    return url;
}

/*
* 显示到浏览器上
* */
onLineUpload.showBrowserimg = function (sourceId, targetId) {

    var arr = $("#" + sourceId).val().split('.');
    var blooT = false;
    $allType = ["png", "jpg", "jpeg", 'PNG', 'JPG', 'JPEG'];
    for (var iii = 0; iii < $allType.length; iii++) {
        if ($allType[iii] == arr[arr.length - 1]) {
            blooT = true;
            break;
        }
    }
    if (!blooT) {
        $("#" + sourceId).val('')
        layer.msg('文件类型不允许');
        return;
    }


    var url = this.uploadFileY(sourceId);
    var imgPre = document.getElementById(targetId);
    imgPre.src = url;

    $(".sourceIdS").attr('src', url);
    /*var imgCrop = document.getElementById('cropTestImg');
    imgCrop.src= url;*/
    // alert($(".layui-layer-page").size())
    this.positionWidthHieght('#sourceId');
}
/*
* 重新将固定定位的元素居中
* */
onLineUpload.positionWidthHieght = function (_html) {
    $(_html).hide();
    var ii = 1;
    var clearIntervals = setInterval(function () {
        ii++;
        if (ii == 10) clearInterval(clearIntervals);
        $(_html).show();
        $('.layui-layer-content').css({
            overflow: 'hidden'
        });

        var _height = $(window).height();
        var _width = $(window).width();
        var _this_width = $(_html).width();
        var _this_height = $(_html).height();
        $(_html).parents(".layui-layer-page").css({
            left: _width / 2 - _this_width / 2,
            top: _height / 2 - _this_height / 2,
        })

    }, 100)

    $('#sourceId').imgAreaSelect({
        handles: true,
        onSelectChange: onLineUpload.jian
    });
}
/*
* 截图回调
* */

onLineUpload.jian = function (img, selection) {
    if (!selection.width || !selection.height)
        return;
    //预览图尺寸等比例缩放，以100为临界，当在原图中选定的区域大于100px时，预览图中图像缩小；当在原图中选定的区域小于100px时，预览图中图像放大；selection为选区
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * 400), //原图宽400
        height: Math.round(scaleY * 300), //原图高300
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });


    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#ww').val(selection.width);
    $('#hh').val(selection.height);
    $('#yw').val($(".sourceIdS").width());
    $('#yh').val($(".sourceIdS").height());

    // console.log($('#x1').val() + '--' + $('#y1').val() + '--' + $('#x2').val() + '--' + $('#y2').val() + '--' + $('#ww').val() + '--' + $('#hh').val() + '--' + $('#yw').val() + '--' + $('#yh').val())


}

/*
* 提交上传
* */
onLineUpload.ajaxUpload = function () {
    onLineUpload.openLoading();
    console.log($('#x1').val() + '--' + $('#y1').val() + '--' + $('#x2').val() + '--' + $('#y2').val() + '--' + $('#ww').val() + '--' + $('#hh').val() + '--' + $('#yw').val() + '--' + $('#yh').val())

    $("#jiequ").append($("#imgOne").clone());
    $.ajax({
        url: site_root + "/admin/ajaxOnLineFiles" + "?path=" + onLineUpload.nowPath + "&" +
        "x1=" + $('#x1').val() + "&" +
        "y1=" + $('#y1').val() + "&" +
        "x2=" + $('#x2').val() + "&" +
        "y2=" + $('#y2').val() + "&" +
        "ww=" + $('#ww').val() + "&" +
        "hh=" + $('#hh').val() + "&" +
        "yw=" + $('#yw').val() + "&" +
        "yh=" + $('#yh').val() + "&" +
        "aw=" + $("#sourceId").width() + "&" +
        "ah=" + $("#sourceId").height(),
        type: "post",
        //
        data: new FormData($("#file-file").get(0)),
        processData: false,  // 告诉jQuery不要去处理发送的数据
        contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
        dataType:'json',
        success: function (response, status, xhr) {
            onLineUpload.ocloseLoading();
            onLineUpload.reloadUpload();
            $("#imgOne").val('');
            // data=$.parseJSON(response);
            if (response.status == 1) {
                layer.msg(response.msg);
                layer.close(onLineUpload.layerOpen);
            } else {
                // layer.close(onLineUpload.layerOpen);
                layer.msg(response.msg)
            }
        }
    });


  /*  ajaxUpload({
        e: $("#imgOne"),
        url: site_root + "/admin/ajaxOnLineFiles" + "?path=" + onLineUpload.nowPath + "&" +
        "x1=" + $('#x1').val() + "&" +
        "y1=" + $('#y1').val() + "&" +
        "x2=" + $('#x2').val() + "&" +
        "y2=" + $('#y2').val() + "&" +
        "ww=" + $('#ww').val() + "&" +
        "hh=" + $('#hh').val() + "&" +
        "yw=" + $('#yw').val() + "&" +
        "yh=" + $('#yh').val() + "&" +
        "aw=" + $("#sourceId").width() + "&" +
        "ah=" + $("#sourceId").height(),//处理图片脚本
        token: token
    }, function (data) {
        onLineUpload.ocloseLoading();
        onLineUpload.reloadUpload();
        $("#imgOne").val('');
        if (data.status == 1) {
            layer.msg(data.msg);
            layer.close(onLineUpload.layerOpen);
        } else {
            // layer.close(onLineUpload.layerOpen);
            layer.msg(data.msg)
        }
    });*/
}

onLineUpload.openLoading = function () {
    this.loading = layer.load();
}
onLineUpload.ocloseLoading = function () {
    layer.close(this.loading);
}