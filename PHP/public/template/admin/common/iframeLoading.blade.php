{{--主题和插件下载loading--}}
        <!doctype html>
<html lang="en-US">
@include('admin/common/head')

<style type="text/css">
    .demo {
        padding: 2em 0;
        /*background: linear-gradient(to right, #2c3b4e, #4a688a, #2c3b4e);*/
    }

    .progress {
        height: 25px;
        background: #262626;
        padding: 5px;
        overflow: visible;
        border-radius: 20px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #7992a8;
        margin-top: 50px;
    }

    .progress .progress-bar {
        border-radius: 20px;
        position: relative;
        animation: animate-positive 2s;
    }

    .progress .progress-value {
        display: block;
        padding: 3px 7px;
        font-size: 13px;
        color: #fff;
        border-radius: 4px;
        background: #191919;
        border: 1px solid #000;
        position: absolute;
        top: -40px;
        right: -10px;
    }

    .progress .progress-value:after {
        content: "";
        border-top: 10px solid #191919;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        position: absolute;
        bottom: -6px;
        left: 26%;
    }

    .progress .progress-value2 {
        display: block;
        display: none;

        padding: 3px 7px;
        font-size: 13px;
        color: #fff;
        border-radius: 4px;
        background: red;
        border: 1px solid red;
        position: absolute;
        top: -40px;
        right: -10px;
    }

    .progress .progress-value2:after {
        content: "";
        border-top: 10px solid red;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        position: absolute;
        bottom: -6px;
        left: 26%;
    }

    .progress .progress-value3 {
        display: block;
        display: none;

        padding: 3px 7px;
        font-size: 13px;
        color: #fff;
        border-radius: 4px;
        background: forestgreen;
        border: 1px solid forestgreen;
        position: absolute;
        top: -40px;
        right: -10px;
    }

    .progress .progress-value3:after {
        content: "";
        border-top: 10px solid forestgreen;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        position: absolute;
        bottom: -6px;
        left: 26%;
    }

    .progress-bar.active {
        animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 0s;
    }

    @-webkit-keyframes animate-positive {
        0% {
            width: 0;
        }
    }

    @keyframes animate-positive {
        0% {
            width: 0;
        }
    }
</style>

<body>

<div class="container">
    <div class="demo">
        <div class="container">
            <div class="row">
                <h3 style="text-align: center;">
                    {{admin_language('Download')}} ：
                    {{json_decode(urldecode($serverDownload['info']))->name}}
                </h3>
            </div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="progress">
                        <div id="loading-jdt" class="progress-bar progress-bar-info progress-bar-striped active"
                             style="width: 7%;">
                            <div class="progress-value">{{admin_language('Download')}}</div>
                            <div class="progress-value2">{{admin_language('DownloadFailedPleaseTryAgain')}}</div>
                            <div class="progress-value3">{{admin_language('DownloadCompletedIsJumping')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin/common/js')
<script>

    var i = 5;
    setInterval(function () {
        if (i < 100 && i > 0) {
            i++;
        }
        $("#loading-jdt").css({
            width: i * 1 + "%"
        });

    }, 50);
    /*  setTimeout(function () {
          i=100
      },2000);*/
</script>
<script>
    //
    $.ajax({
        type: 'POST',
        data: {
            _token: "{{csrf_token()}}",
        },
        success: function (data) {
            if (data.status == 1) {
                $(".progress .progress-value").hide();
                $(".progress .progress-value2").hide();
                $(".progress .progress-value3").show();
                i = 100;
                $(".progress-bar.active").css({
                    animation: 'no'
                });
                $(".progress-bar-info").css({
                    backgroundColor: 'forestgreen'
                });
                setTimeout(function () {
                    parent.reloadIframe(data.url)
                },2000);
            }
        },
        error: function () {
            $(".progress .progress-value").hide();
            $(".progress .progress-value2").show();
            i = 100
            $(".progress-bar.active").css({
                animation: 'no'
            });
            $(".progress-bar-info").css({
                backgroundColor: " #6f6f6f"
            });
        }
    });
</script>


</body>
</html>