<html>
<head>
    <meta charset="utf-8">
    <title>进度条测试</title>
    <script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<div>
    <span id="percent">0%</span>
    <input type="file" id="file_upload"/>
    <img src="" alt="" id="file_upload_y">
</div>

<input type="button" value="上传" onclick="upload()" id="upload"/>

</body>
<script>
    var file = null;

    $("#file_upload").change(function () {
        previewImg('file_upload','file_upload_y')
        file = this.files[0];
    });

    //上传文件
    function upload() {
        var formData = new FormData();
        formData.append("fileName", file);
        formData.append('_token', "{{csrf_token()}}")
        $.ajax({
            url: "http://127.0.0.1/SZVETRON-027-VETRONCMS_V2/public/test/upload",
            type: 'POST',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (result) {

            },
            error: function (result) {

            },
            xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                //uploadProgress回调函数
                if (uploadProgress && xhr.upload) {
                    xhr.upload.addEventListener("progress", uploadProgress, false);
                    return xhr;
                }
            }
        });
    }


    function uploadProgress(evt) {
        if (evt.lengthComputable) {
            //evt.loaded：文件上传的大小   evt.total：文件总的大小
            var percentComplete = Math.round((evt.loaded) * 100 / evt.total);
            //加载进度条，同时显示信息

            $("#percent").html(percentComplete + '%')
        }
    }

</script>
<script>
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
            //
            alert('文件类型错误');
            return;
        }
        this.url = window.URL.createObjectURL(document.getElementById(_file).files.item(0));
        this.imgPre = document.getElementById(previewImgId);
        this.imgPre.src = this.url;
    }
</script>
</html>