<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body style="position: relative;">

<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">

            @include('admin/common/crumbs')
            <div id="content" class="dashboard padding-20">
                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('common_lists')}}</strong> <!-- panel title -->
							</span>
                    </div>

                    <div class="panel-body on-line">


                    </div>
                    <!-- /panel content -->


                </div>

            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

<div style="display: none;" class="ale_img">
    <img style="max-width: 80%;"
         src="http://127.0.0.1/SZVETRON-027-VETRONCMS_V2/public/uploads/default.jpg"
         alt="">
</div>
@include('admin/common/js')
{{--<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/js/media-on-line.js"></script>--}}


<script>
    onLineUpload.init('.on-line','/');


</script>

<script>

    $("body").on('click', '.mediaImg', function () {
        $(".ale_img").find('img').prop('src', $(this).attr('asset'));
        $(".ale_img").find('img').css({
            'maxHeight':$(window).height()*0.8
        });
        $(".ale_img").fadeIn();
    });
    $("body").on("click", ".ale_img", function () {
        $(this).hide();
    })
</script>
<script>

</script>
</body>

</html>