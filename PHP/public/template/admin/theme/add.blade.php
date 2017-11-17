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
                                <strong>主题添加</strong>
                            </div>

                            <div class="panel-body">

                                <form method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>主题名称 *</label>
                                                    <input type="text" name="language_key" value="{{session_form_old('language_key')}}" class="form-control required">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label>存放目录 *</label>
                                                    <input type="text" name="folder" value="{{session_form_old('folder')}}" class="form-control required">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>
                                                        模版文件
                                                        <small class="text-muted">Curriculum Vitae - optional</small>
                                                    </label>

                                                    <div class="fancy-file-upload fancy-file-primary">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="template[]" onchange="jQuery(this).next('input').val(this.value);" />
                                                        <input type="text" class="form-control" placeholder="" readonly="" />
                                                        <span class="button">选择文件</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        预览图
                                                        <small class="text-muted">Curriculum Vitae - optional</small>
                                                    </label>

                                                    <div class="fancy-file-upload fancy-file-primary">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="view[]" onchange="jQuery(this).next('input').val(this.value);" />
                                                        <input type="text" class="form-control" placeholder="" readonly="" />
                                                        <span class="button">选择文件</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>备注</label>
                                                    <textarea name="note" class="form-control">{{session_form_old('note')}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">提交</button>
                                            </div>
                                        </div>
                                    </fieldset>



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