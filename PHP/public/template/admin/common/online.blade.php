<style>
    .on-line-body {
        /*width: 920px;*/
        height: 100%;
        /*background-color: #;*/
        padding: 10px;
    }

    .on-line-body .box-on-line {
        width: 170px;
        height: 125px;
        margin: 5px;
        display: flex;
        -webkit-flex-direction: column;
        flex-direction: column;
    }

    .on-line-body .box-on-line .box-on-line-box {
        height: 105px;
        width: 170px;
        background-color: #E3E0E0;
        cursor: pointer;
    }
</style>

<div class="on-line-body">

    <div style="width: 100%; height: 60px;">
        <div class=""
             style="height: 42px;margin-bottom: 10px;margin-left: 5px;position: relative;float: left;">
            <a href="javascript:;" class="btn btn-primary"><i class="fa fa-upload"></i>
                {{admin_language('setting_selectFile')}}
            </a><input
                    onchange="uploadFile(this)" path="{{$upPath}}" name="FileData[]" type="file"
                    id="fileToUpload-l"
                    style="position: absolute;top: 0px;opacity: 0;height: 40px;width: 136px;">
        </div>
        {{----}}
        @if($isMedia)
            <div onclick="createFolder()" class=""
                 style="height: 42px;margin-bottom: 10px;margin-left: 5px;position: relative;float: left;">
                <a href="javascript:;" class="btn btn-primary"><i class="fa fa-folder"></i>
                    {{admin_language('media_createFolder')}}
                </a>
            </div>
        @endif

    </div>
    <div style="display: flex; -webkit-flex-wrap: wrap;
    flex-wrap: wrap;">

        {{--根目录不显示--}}
        @if(!$isRoot)
            <div onclick="addOnLineNext('/{{getUpPath($upPath)}}'@if($isGallery) ,'isGallery' @endif)" class="box-on-line" style="">
                <div class="box-on-line-box"
                     style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                    <i style="font-size: 28px;" class="fa fa-reply"></i>
                </div>

                <div style="text-align: center;">
                    ...
                </div>
            </div>
        @endif
        @foreach($data as $val)
            <div class="box-on-line" style="">
                {{--图片--}}
                @if(isAllowSuffix(getFormArrLastStr($val,'/uploads'),['jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF']))
                    <div onclick="@if($isGallery) setProductGallery(this) @else appendEditor(this) @endif " type="img"
                         src="{{asset('uploads/'.getFormArrLastStr($val,'uploads/'))}}" class="box-on-line-box ale_imgs"
                         uploads="{{'uploads/'.getFormArrLastStr($val,'uploads/')}}"
                         style="background: url({{asset('uploads/'.getFormArrLastStr($val,'uploads/'))}}) no-repeat;background-size: cover;">
                    </div>
                @elseif(is_dir($val))
                    {{--文件夹--}}
                    <div onclick="addOnLineNext('{{removePublic($val)}}'@if($isGallery) ,'isGallery' @endif)" class="box-on-line-box"
                         style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                        <i style="font-size: 36px;" class="fa fa-folder"></i>
                    </div>
                @else
                    {{--其他文件--}}
                    <div onclick="appendEditor(this)" type="other"
                         src="{{asset('uploads/'.getFormArrLastStr($val,'uploads/'))}}" class="box-on-line-box"
                         style="justify-content: center;align-items: center;text-align: center;line-height: 115px;">
                        <i style="font-size: 36px;" class="fa fa-file-text"></i>
                    </div>
                @endif
                {{--isAllowSuffix--}}
                <div style="text-align: center;">
                    @if(!is_dir($val))
                        ..
                    @endif
                    {{substr(getFormArrLastStr($val,'/'),-15)}}
                </div>
            </div>
        @endforeach

    </div>
</div>