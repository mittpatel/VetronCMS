{{--根目录不显示--}}
@if(!$isRoot)
    <div onclick="onLineUpload.getUpdateData('.upload-path','{{$upPath}}')" class="box-on-line"
         style="">
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
    </div>
@endforeach
<script>
    onLineUpload.nowPath = "{{$nowPath}}";
    onLineUpload.upPath = "{{$upPath}}";

</script>