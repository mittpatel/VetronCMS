@foreach($galleryList as $galleryListVal)

    <div class="col-md-2">
        <div style="position: relative" class="pricing-table see_gallery">
            <div>
                <img style="width: 100%;"
                     src="{{asset($galleryListVal->cover)}}">
            </div>
            <div class="edit-edit" style="display: none">
                <div class="hide_action plan-title"
                     style="width:100%;position: absolute;bottom: 0;display: flex;justify-content: space-around;">
                                                <span class=""><i style="cursor: pointer;"
                                                                  class="fa fa-trash"
                                                                  onclick="deleteGallery({{$categoryListVal->id}})"></i></span>
                </div>
            </div>
        </div>
        <div class="plan-title none_back">
            {{$galleryListVal->name}}
        </div>
    </div>
@endforeach