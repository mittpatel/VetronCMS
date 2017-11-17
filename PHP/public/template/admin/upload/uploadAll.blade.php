<div class="on-line-body">
    <div style="width: 100%; height: 60px;min-width: 300px;">
        <div class=""
             style="height: 42px;margin-bottom: 10px;margin-left: 5px;position: relative;float: left;">
            <a href="javascript:;" class="btn btn-primary"><i class="fa fa-upload"></i>
                {{admin_language('setting_selectFile')}}
            </a>
            <form id="file-file">

                {{csrf_field()}}
                <input id="imgOne"
                       onchange="onLineUpload.showBrowserimg(this.id,'sourceId');" name="FileData[]" type="file"
                       id="fileToUpload-l"
                       style="position: absolute;top: 0px;opacity: 0;height: 40px;width: 136px;">
            </form>
        </div>


        <div class="batchUpload"
             style="height: 42px;margin-bottom: 10px;margin-left: 5px;position: relative;float: left;display: none;">
            <a href="javascript:;" class="btn btn-primary" onclick="$('.uploadBox').show();$('#zhzz').show()"><i
                        class="fa fa-upload"></i>
                {{admin_language('BatchUpload')}}
            </a>
        </div>


        <div onclick="onLineUpload.createFolder()" class=""
             style="height: 42px;margin-bottom: 10px;margin-left: 5px;position: relative;float: left;">
            <a href="javascript:;" class="btn btn-primary"><i class="fa fa-folder"></i>
                {{admin_language('media_createFolder')}}
            </a>
        </div>
    </div>
    <div class="upload-path" style="display: flex; -webkit-flex-wrap: wrap;
    flex-wrap: wrap;">
        {{--根目录不显示--}}
        @if(!$isRoot)
            <div  class="box-on-line"
                 style="">
                <div onclick="onLineUpload.getUpdateData('.upload-path','{{$upPath}}')" class="box-on-line-box"
                     style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                    <i style="font-size: 28px;" class="fa fa-reply"></i>
                </div>
                <div style="text-align: center;">
                    ...ssssss
                </div>
            </div>
        @endif
        @foreach($data as $val)
            <div class="box-on-line dirAfile" style="position: relative;"
                 onmouseleave="$(this).find('.delete-mouseleave').hide();"
                 onmouseenter="$(this).find('.delete-mouseleave').show();"
            >
                {{--判断是否是文件--}}
                @if($val['type']=='file')
                    {{--判断是否是图片--}}
                    @if(in_array($val['suffix'],['jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF']))
                        <div onclick="" type="img"
                             asset="{{$val['assetUrl']}}"
                             {{--mediaImg是图片  fileAll是所有的文件--}}
                             class="box-on-line-box mediaImg fileAll"
                             relative="{{$val['relative']}}"
                             style="background: url({{$val['assetUrl']}}) no-repeat;background-size: cover;">
                        </div>


                    @else
                        {{--其他文件--}}
                        <div onclick="" type="other"
                             asset="{{$val['assetUrl']}}"
                             class="box-on-line-box fileAll"
                             relative="{{$val['relative']}}"
                             style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                            <i style="font-size: 36px;" class="fa fa-file-text"></i>
                        </div>
                    @endif
                @else
                    {{--文件夹--}}
                    <div onclick="onLineUpload.getUpdateData('.upload-path','{{$val["relative"]}}')"
                         class="box-on-line-box"
                         relative="{{$val['relative']}}"
                         style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                        <i style="font-size: 36px;" class="fa fa-folder"></i>
                    </div>
                @endif

                {{--文件名称--}}
                <div style="text-align: center;">
                    @if($val['type']=='file')
                        ..{{substr($val['fileName'],-15)}}
                    @else
                        {{$val['dirName']}}
                    @endif
                </div>


                {{--鼠标划入显示--}}
                <div onclick="" class="delete-mouseleave" style="
                            position: absolute;
                            width: 100%;
                            text-align: center;
                            bottom: 20px;
                            background-color: #B9B9B9;
                            display: flex;
                            justify-content: space-around;
                            display: none;
                        ">
                        <span onclick="onLineUpload.deleteDirFile(this)">
                            <i class="fa fa-trash" aria-hidden="true" style="cursor: pointer;"></i>
                        </span>

                </div>


            </div>
        @endforeach
    </div>
</div>
{{--上传弹出框--}}
<style>
    #zhzz {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 9998;
        position: fixed;
        left: 0;
        top: 0;
        display: none;

    }

    .uploadBox {
        width: 1018px;
        height: 550px;
        position: fixed;
        left: 0;
        top: 0;
        background-color: #FFFFFF;
        z-index: 9999;
        padding: 10px;
        display: flex;
        display: none;
        overflow: auto;

    }

    .uploadBox-on {
        width: 180px;
        height: 160px;
        border: 1px solid #acacac;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.16);
        display: none;
        position: relative;
    }

    .uploadBox-on-img {
        width: 178px;
        height: 140px;
        border-bottom: 1px solid #acacac;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .uploadBox-on-on {
        height: 160px;
        float: left;
        margin: 8px;
    }
</style>

<div class="uploadBox" onclick="">
    <div>
        <button type="button" onclick="uploadAll();" class="btn btn-primary btn-sm" style="margin-left: 8px;">上传
        </button>
    </div>
    <div class="uploadBox-t">
        <div style="display: flex;" class="uploadBox-on-on">
            <div class="uploadBox-on" style="display: flex;justify-content: center;align-items: center;border: 0;">
                <div style="position: relative;width: 34px;height: 34px;overflow: hidden;"><i
                            style="font-size: 40px;cursor: pointer;" class="fa fa-plus"></i>
                    <input class="uploadBoxInput" type="file"
                           id="id999998"
                           name="imgData[]"
                           onchange="addInput('id999998','id999998S');"
                           style="top: 0;left: 0;position: absolute;height: 34px;opacity: 0">
                </div>
            </div>
            <div class="uploadBox-on">
                <div class="uploadBox-on-img" id="id999998S">
                    <div class="uploadBox-on-img-jdt"
                         style="position: absolute;left: 0;bottom: 18px;background-color: #65b371;width: 0%;height: 5px;">
                    </div>
                </div>
                <div style="text-align: center;">
                    <i onclick="deleteInpu(this);" class="fa fa-remove" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="zhzz" onclick="hideAlert()"></div>
<script>

    //判断当前是否在媒体
    if ($(".on-line").size() > 0) {

        $(".batchUpload").show();
    }


    onLineUpload.nowPath = "{{$nowPath}}";
    onLineUpload.upPath = "{{$upPath}}";
    $(function () {
        $(".uploadBox").css({
            left: ($(window).width() - $(".uploadBox").width()) / 2,
            top: ($(window).height() - $(".uploadBox").height()) / 2,
        })
    });


    function addInput(_file, _previewImgId) {
        previewImg($.trim(_file), _previewImgId);

        $("#" + _previewImgId).parent().show();
        $("#" + _file).parent().parent().hide();
        var id = (new Date()).valueOf();

        $(".uploadBox-t").append(
            '<div style="display: flex;" class="uploadBox-on-on">\n' +
            '        <div class="uploadBox-on" style="display: flex;justify-content: center;align-items: center;border: 0;">\n' +
            '            <div style="position: relative;width: 34px;height: 34px;overflow: hidden;"><i\n' +
            '                        style="font-size: 40px;cursor: pointer;" class="fa fa-plus"></i>\n' +
            '                <input class="uploadBoxInput" type="file"\n' +
            '                       id="id' + id + '"\n' +
            '                       name="imgData[]"\n' +
            '                       onchange="addInput(\'id' + id + '\',\'id' + id + 's\');"' +
            '                       style="top: 0;left: 0;position: absolute;height: 34px;opacity: 0">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="uploadBox-on">\n' +
            '            <div class="uploadBox-on-img" id="id' + id + 's">\n' +
            '     <div class="uploadBox-on-img-jdt" style="position: absolute;left: 0;bottom: 18px;background-color: rgb(101, 179, 113);width: 0%;height: 5px;">\n' +
            '                    </div>' +
            '            </div>\n' +
            '            <div style="text-align: center;">\n' +
            '                <i onclick="deleteInpu(this);" class="fa fa-remove" style="cursor: pointer;"></i>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>'
        )
    }

    function previewImg(_file, previewImgId) {
        this.blooT = false;
        this.fileNameArr = $("#" + _file).val().split('.');
        this.allowType = ["png", "jpg", "jpeg", 'PNG', 'JPG', 'JPEG'];
        for (var iii = 0; iii < this.allowType.length; iii++) {
            if (this.allowType[iii] == this.fileNameArr[this.fileNameArr.length - 1]) {
                this.blooT = true;
                break;
            }
        }
        if (!this.blooT) {
            return;
        }
        this.url = window.URL.createObjectURL(document.getElementById(_file).files.item(0));
        this.imgPre = document.getElementById(previewImgId);
        $("#" + previewImgId).css({
            backgroundImage: "url(" + this.url + ")"
        })
    }

    function deleteInpu(_this) {
        $(_this).parents('.uploadBox-on-on').remove()
    }


    var ii = 0;
    var jj = 0;

    function uploadAll() {

        var uploadBoxSize = $(".uploadBox-on-on").size() - 1;
        if ($(".uploadBox-on-on").eq(ii).find('.uploadBoxInput').val() == '') {
            return;
        }
        var formData = new FormData();
        formData.append("FileData[]", $(".uploadBox-on-on").eq(ii).find('.uploadBoxInput').get(0).files[0]);
        formData.append('_token', "{{csrf_token()}}");

        $.ajax({
//            url: "http://127.0.0.1/SZVETRON-027-VETRONCMS_V2/public/test/upload",
            url: site_root + "/admin/ajaxOnLineFiles" + "?path=" + onLineUpload.nowPath,
            type: 'POST',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                console.log(result);
                $(".uploadBox-on-img-jdt").eq(ii - 1).css({});
                jj++;
                if (ii == jj) {
                    onLineUpload.openLoading();

                    onLineUpload.init('.on-line', onLineUpload.nowPath);
                }
            },
            error: function () {

            },
            xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener("progress", function (evt) {
                    //回调函数 //percentComplete进度
                    var percentComplete = Math.round((evt.loaded) * 100 / evt.total);

                    $(".uploadBox-on-img-jdt").eq(ii).css({
                        width: percentComplete + "%"
                    });

                    if (percentComplete == 100) {
                        ++ii;

                        uploadAll(ii);

                    }

                }, false);
                return xhr;
            }
        });
        delete formData;
    }

    function hideAlert() {
        $('.uploadBox').hide();
        $('#zhzz').hide();

        var uploadBoxSize = $(".uploadBox-on-on").size() - 1;

    }
</script>