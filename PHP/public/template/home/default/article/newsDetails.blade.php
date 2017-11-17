@extends(THEME . '.index.index');
@section('banner')

@endsection
@section('service')

@endsection
@section('product')
    <section class="met-shownews animsition">
        <div class="container">
            <div class="row">
                <div class="col-md-9 met-shownews-body">
                    <div class="row">
                        <div class="met-shownews-header">
                            <h1>{{$new->title}}</h1>
                            <div class="info">
                                <span>{{$new->created_at}}</span>
                                <span>admin</span>
                                <span><i class="icon wb-eye margin-right-5" aria-hidden="true"></i>2311</span>
                            </div>
                        </div>
                        <div class="met-editor lazyload clearfix">
                            <div>
                                {!! $new->content !!}
                            </div>
                        </div>
                        <div class="met-shownews-footer">

                            <ul class="pager pager-round">
                                <li class="previous ">
                                    @if($prev)
                                        <a href="{{url('news/details',[$prev->id])}}" title="Oculus在伦敦组建VR团队">
                                            上一篇
                                            <span aria-hidden="true" class='hidden-xs'>{{$prev->title}}</span>
                                        </a>
                                    @else
                                        <a href="javascript:;" title="没有了">
                                            上一篇
                                            <span aria-hidden="true" class='hidden-xs'>：没有了</span>
                                        </a>
                                    @endif
                                </li>
                                <li class="next">

                                    @if($next)
                                        <a href="{{url('news/details',[$next->id])}}" title="Oculus在伦敦组建VR团队">
                                            下一篇
                                            <span aria-hidden="true" class='hidden-xs'>{{$next->title}}</span>
                                        </a>
                                    @else
                                        <a href="javascript:;" title="没有了">
                                            下一篇
                                            <span aria-hidden="true" class='hidden-xs'>：没有了</span>
                                        </a>
                                    @endif

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="met-news-bar">
                            <form method='get' action="http://show.metinfo.cn/muban/res013/323/search/search.php">
                                <input type='hidden' name='lang' value='cn'/>
                                <input type='hidden' name='class1' value='108'/>
                                <div class="form-group">
                                    <div class="input-search">
                                        <button type="submit" class="input-search-btn"><i class="icon wb-search"
                                                                                          aria-hidden="true"></i>
                                        </button>
                                        <input type="text" class="form-control" name="searchword" placeholder="Search">
                                    </div>
                                </div>
                            </form>
                            <div class="recommend news-list-md">
                                <h3>为您推荐</h3>
                                <ul class="list-group list-group-bordered">

                                    <li class="list-group-item"><a href="shownewsb469.html?lang=cn&amp;id=51"
                                                                   title="Oculus在伦敦组建VR团队" target='_self'>Oculus在伦敦组建VR团队</a>
                                    </li>



                                </ul>
                            </div>

                            <ul class="column">
                                <li><a href="index.html" title="所有文章" target='_self'>所有文章</a></li>

                                <li><a href="newsef35.html?lang=cn&amp;class2=122" class="active" title="产品资讯">产品资讯</a>
                                </li>

                                <li><a href="newsa627.html?lang=cn&amp;class2=123" title="行业动态">行业动态</a></li>

                                <li><a href="news9e04.html?lang=cn&amp;class2=124" title="国际资讯">国际资讯</a></li>

                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('news')
@show
@section('about')
@show