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

                <div class="row">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('theme_InputData')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        {{csrf_field()}}

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <textarea name="contentText" class="form-control"
                                                              rows="20">{{$content}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">{{admin_language('common_submit')}}</button>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <input type="hidden" name="path" value="{{$path}}">
                                </form>

                            </div>

                        </div>
                        <!-- /----- -->

                    </div>


                </div>


            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
</body>
</html>