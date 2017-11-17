{{--<span style="font-size: 18px;">{{admin_language('common_attribute')}}</span>--}}
<div class="row ">
    <div class="form-group">

        @foreach($categoryAttribute as $categoryAttributeVal)
            @if($categoryAttributeVal->input_type==1)
                @foreach($edit as $e)
                    @if($e->attribute_id==$categoryAttributeVal->id)
                        {{--输入框--}}
                        <div class="col-md-12 col-sm-12" style="margin-top: 2px;">
                            <label>{{home_language($categoryAttributeVal->language_key)}}</label>
                            <input name="attribute[{{$categoryAttributeVal->id}}]" class="form-control" type="text"
                                   value="{{$e->attribute_value}}">
                        </div>
                    @endif
                @endforeach
            @elseif($categoryAttributeVal->input_type==2)
                {{--单选框--}}
                @foreach($edit as $e)
                    @if($e->attribute_id==$categoryAttributeVal->id)
                        <div class="col-md-12 col-sm-12" style="margin-top: 2px;">
                            <label>{{home_language($categoryAttributeVal->language_key)}}</label>
                            <div class="sky-form">
                                @foreach(explode(',',trim($categoryAttributeVal->default_val,',')) as $categoryAttributeValRadio)
                                    <label style="display: inline-block;" class="radio">
                                        <input type="radio" name="attribute[{{$categoryAttributeVal->id}}]"
                                               @if($e->attribute_value==$categoryAttributeValRadio)
                                                       checked
                                                @endif
                                                value="{{$categoryAttributeValRadio}}"><i></i>
                                        <span class="text-warning"
                                              style="color: #676a6c !important;">{{$categoryAttributeValRadio}}</span></label>


                                @endforeach
                                    <label style="display: inline-block;" class="radio">
                                        <input type="radio" name="attribute[{{$categoryAttributeVal->id}}]"
                                               value=""><i></i>
                                        <span class="text-warning"
                                              style="color: #676a6c !important;">{{admin_language('common_disabled')}}</span></label>
                            </div>
                        </div>
                    @endif
                @endforeach
            @elseif($categoryAttributeVal->input_type==3)
                {{--复选框--}}
                @foreach($edit as $e)
                    @if($e->attribute_id==$categoryAttributeVal->id)
                        <div class="col-md-12 col-sm-12" style="margin-top: 2px;">
                            <label>{{home_language($categoryAttributeVal->language_key)}}</label>
                            <div class="sky-form">
                                @foreach(explode(',',trim($categoryAttributeVal->default_val,',')) as $categoryAttributeValCheckbox)
                                    <label style="display: inline-block;" class="checkbox">
                                        <input type="checkbox" value="{{$categoryAttributeValCheckbox}}"
                                               @if(in_array($categoryAttributeValCheckbox,explode(',',$e->attribute_value)))
                                               checked
                                               @endif
                                               name="attribute[{{$categoryAttributeVal->id}}][]" id="">
                                        <i style="border-color:#676a6c;color: #676a6c"></i>
                                        {{$categoryAttributeValCheckbox}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif



        @endforeach

    </div>
</div>