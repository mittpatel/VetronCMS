<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">

            @include('admin/common/crumbs')

            <div id="content" class="dashboard padding-20">
                <div id="panel-2" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('common_auth')}}</strong> <!-- panel title -->
							</span>

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">
                        <form method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="g_id" value="{{$id}}">
                            <div class="">
                                <div style="margin:15px 0px 0px 15px;">
                                    @foreach($menuDataAuth as $menuDataP)
                                        @if($menuDataP->p_id==0)
                                            <dl style="margin-bottom: 0px;" class="permission-list">

                                                <dd>
                                                    <dl class="cl permission-list2">
                                                        <dt>
                                                            <label class="checkbox checkbox_selecd">
                                                                <input type="checkbox" value="{{$menuDataP->id}}"
                                                                       name="menu[]"
                                                                       @if(in_array($menuDataP->id,explode(',',$groupOne->auth_list))) checked
                                                                       @endif
                                                                       class="ace">
                                                                <i></i><span class="lbl"><b
                                                                            style="font-size: 16px;">{{admin_language($menuDataP->note)}}</b></span>
                                                            </label>
                                                        </dt>

                                                        <dd style="margin-left: 20px;">
                                                            @foreach($menuDataAuth as $menuDataS)
                                                                @if($menuDataS->p_id==$menuDataP->id)
                                                                    <label style="width: 120px;"
                                                                           class="checkbox checkbox_selecd">
                                                                        <input type="checkbox"
                                                                               value="{{$menuDataS->id}}" class="ace"
                                                                               @if(in_array($menuDataS->id,explode(',',$groupOne->auth_list))) checked
                                                                               @endif
                                                                               name="menu[]">
                                                                        <i></i><span style="font-size: 14px;"
                                                                                     class="lbl">{{admin_language($menuDataS->note)}}</span>
                                                                    </label>
                                                                @endif
                                                            @endforeach
                                                        </dd>
                                                    </dl>
                                                    <hr>
                                                </dd>
                                            </dl>
                                        @endif
                                    @endforeach
                                    <div class="Button_operation">
                                        <button class="btn btn-primary" type="submit">{{admin_language('common_submit')}}</button>
                                        <button style="margin-left: 10px;" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                            {{admin_language('common_Return')}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /panel content -->


                </div>

            </div>


        </section>

    </div>
</div>

@include('admin/common/js')
<script>
    $(function () {
        $(".permission-list dt input:checkbox").click(function () {
            $(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function () {
            var l = $(this).parent().parent().find("input:checked").length;
            var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if ($(this).prop("checked")) {
                $(this).closest("dl").find("dt input:checkbox").prop("checked", true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
            }
            else {
                if (l == 0) {
                    $(this).closest("dl").find("dt input:checkbox").prop("checked", false);
                }
                if (l2 == 0) {
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
                }
            }

        });
    });
</script>
</body>
</html>