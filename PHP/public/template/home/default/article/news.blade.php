@extends(THEME . '.index.index');
@section('banner')

@endsection
@section('service')

@endsection
@section('product')
    <div class="met-banner-ny vertical-align text-center" style=''>
        <h1 class="vertical-align-middle">博客</h1>
    </div>

    <section class="met-news animsition ">
        <div class="container">
            <div class="row">
                <div class="col-md-9 met-news-body">
                    <div class="row">
                        <div class="met-news-list">

                            <ul class="met-page-ajax" data-scale='0.75'>
                                @foreach($news as $v)
                                    <li class="">
                                        <div class="media media-lg">
                                            <div class="media-left">
                                                <a href="{{url('news/details',[$v->id])}}" title="Oculus在伦敦组建VR团队"
                                                   target='_self'>
                                                    <img class="media-object"
                                                         src="{{asset($v->cover)}}"
                                                         style='height:150px;'>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="{{url('news/details',[$v->id])}}"
                                                       title="Oculus在伦敦组建VR团队" target='_self'>
                                                        {{$v->title}}
                                                    </a>
                                                </h4>
                                                <p class="des">
                                                    {!! pure_text($v->content,90) !!}
                                                </p>
                                                <p class="info">
                                                    <span>{{$v->created_at}}</span>
                                                    <span>admin</span>
                                                    <span><i class="icon wb-eye margin-right-5" aria-hidden="true"></i>2311  </span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="hidden-xs">
                                <div class='met_pager'>
                                    {{$news->links()}}
                                </div>
                            </div>
                            <div class="met-page-ajax-body visible-xs-block invisible" data-plugin="appear"
                                 data-animate="slide-bottom" data-repeat="false">
                                <button type="button" class="btn btn-default btn-block btn-squared ladda-button"
                                        id="met-page-btn" data-style="slide-left"
                                        data-url="http://show.metinfo.cn/muban/res013/323/blog/news.php?lang=cn&class1=108&class2=0&class3=0&mbpagelist=1"
                                        data-page="1"><i class="icon wb-chevron-down margin-right-5"
                                                         aria-hidden="true"></i>更多文章
                                </button>
                            </div>

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

                                    <li class="list-group-item"><a href="shownews3a55.html?lang=cn&amp;id=53"
                                                                   title="Oculus在伦敦组建VR团队" target='_self'>Oculus在伦敦组建VR团队</a>
                                    </li>

                                    <li class="list-group-item"><a href="shownews05fc.html?lang=cn&amp;id=55"
                                                                   title="Chrome OS支持所有安卓应用" target='_self'>Chrome
                                            OS支持所有安卓应用</a></li>

                                    <li class="list-group-item"><a href="shownews7b74.html?lang=cn&amp;id=54"
                                                                   title="人工智能风口来袭 情感机器人众望所归" target='_self'>人工智能风口来袭
                                            情感机器人众望所归</a></li>

                                    <li class="list-group-item"><a href="shownews587b.html?lang=cn&amp;id=52"
                                                                   title="人工智能风口来袭 情感机器人众望所归" target='_self'>人工智能风口来袭
                                            情感机器人众望所归</a></li>

                                </ul>
                            </div>

                            <ul class="column">
                                <li><a href="index.html" title="所有文章" target='_self'>所有文章</a></li>

                                <li><a href="newsef35.html?lang=cn&amp;class2=122" title="产品资讯">产品资讯</a></li>

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