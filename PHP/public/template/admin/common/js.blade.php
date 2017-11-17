<script type="text/javascript">var plugin_path = '{{app_public()}}template/admin/assets/plugins/';</script>
<script type="text/javascript">var site_root = '{{url('/')}}';</script>
<script type="text/javascript">var site_public = '{{asset('/')}}';</script>
<script type="text/javascript">var token = '{{csrf_token()}}';</script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/js/app.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/layer/layer.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/js/cms.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/js/bootstrap-treeview.js"></script>

<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/Jcrop.js"></script>
{{--百度富文本编辑器--}}
<script type="text/javascript" charset="utf-8"
        src="{{app_public()}}template/admin/assets/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8"
        src="{{app_public()}}template/admin/assets/ueditor/ueditor.all.min.js"></script>
    @if(ADMIN_LOCALE=='zh')
        <script type="text/javascript" charset="utf-8"
                src="{{app_public()}}template/admin/assets/ueditor/lang/zh-cn/zh-cn.js"></script>
    @else
        <script type="text/javascript" charset="utf-8"
                src="{{app_public()}}template/admin/assets/ueditor/lang/en/en.js"></script>
    @endif
<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/scripts/upload-get-new.js"></script>

<script>
    @if(session()->has('tips'))
    layer.msg("{{session()->pull('tips')}}");
    @endif
    if ($("#editor").attr("id")) {

        var ue = UE.getEditor('editor', {
            autoFloatEnabled: false
        });
    }
</script>