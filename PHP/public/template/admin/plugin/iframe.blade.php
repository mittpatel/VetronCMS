<!doctype html>
<html lang="en-US">
@include('admin/common/head')
<style>

    .plugin_avater {
        position: relative;
        width: 72px;
        top: -11px
    }

    .plugin_athor {
        height: 30px;
        line-height: 30px;
    }

    .plugin-text-right {
        float: right;
    }

    .plugin-settting {
        height: 21px;
        line-height: 21px;
    }

</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            <div id="content" class="dashboard padding-20">
                <iframe id="pluginList" style="width: 100%;height: 100%;" src="{{$iframeUrl}}"></iframe>
            </div>
            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
<script>

    function actionPlugin(url) {
        layer.confirm('{{admin_language('theme_areYouSureYouWantToPerformThisOperation')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = url;
        });

    }
    $(function () {
       $("#pluginList").height($(window).height()-162);
       $(window).resize(function () {
           $("#pluginList").height($(window).height()-162);
       })
    });


    //下载完成后，跳出iframe
    function reloadIframe(url) {
        window.location=url;
    }


</script>

</body>
</html>