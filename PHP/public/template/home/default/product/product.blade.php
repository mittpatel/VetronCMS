@extends(THEME . '.index.index');
@section('banner')

@endsection
@section('service')

@endsection
@section('product')
    <div class="met-banner-ny vertical-align text-center" style=''>
        <h1 class="vertical-align-middle">产品</h1>
    </div>

    <div class="met-column-nav bordernone" style="height: 50px !important;">
        <div class="container">
            <div class="row">

                <div class="sidebar-tile">
                    <ul class="met-column-nav-ul invisible-xs">

                        <li><a href="index.html" class="link"  title="全部">全部</a></li>


                        <li>

                            <a href="product5688.html?lang=cn&amp;class2=112" title="智能手表" class="link ">智能手表</a>

                        </li>

                        <li>

                            <a href="productd61c.html?lang=cn&amp;class2=113" title="智能眼镜" class="link ">智能眼镜</a>

                        </li>

                        <li>

                            <a href="product326e.html?lang=cn&amp;class2=114" title="机器人" class="link ">机器人</a>

                        </li>

                        <li>

                            <a href="producted31.html?lang=cn&amp;class2=118" title="体感车" class="link ">体感车</a>

                        </li>

                        <li>

                            <a href="product6301.html?lang=cn&amp;class2=119" title="无人机" class="link ">无人机</a>

                        </li>

                    </ul>
                </div>


            </div>
        </div>
    </div>

    <div class="met-product animsition type-1">
        <div class="container">
            <ul class="blocks-2 blocks-sm-2 blocks-md-4 blocks-xlg-4  met-page-ajax met-grid" id="met-grid" data-scale='1'>

                <li class=" shown">
                    <div class="widget widget-shadow">
                        <figure class="widget-header cover">
                            <a href="showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport" target='_self'>
                                <img class="cover-image" src="{{THEME_ASSET}}/asset/img/thumb.jpg" alt="Apple Watch Sport" style='height:200px;'>
                            </a>
                        </figure>
                        <h4 class="widget-title">
                            <a href="showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport" target='_self'>Apple Watch Sport</a>
                            <p class='margin-bottom-0 margin-top-5 red-600'>2288.00元</p>
                        </h4>
                    </div>
                </li>


            </ul>



            <div class="hidden-xs">
                <div class='met_pager'>
                    <span class='PreSpan'>上一页</span><a href=index.html class='Ahover'>1</a><a href=productc7fd.html?lang=cn&amp;class1=110&amp;page=2 >2</a><a href=productc7fd.html?lang=cn&amp;class1=110&amp;page=2 class='NextA'>下一页</a>
                    <span class='PageText'>转至第</span>
                    <input type='text' id='metPageT' data-pageurl='product.php?lang=cn&class1=110&page=||2' value='1' />
                    <input type='button' id='metPageB' value='页' />
                </div>
            </div>
            <div class="met-page-ajax-body visible-xs-block invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                <button type="button" class="btn btn-default btn-block btn-squared ladda-button" id="met-page-btn" data-style="slide-left" data-url="http://show.metinfo.cn/muban/res013/323/product/product.php?lang=cn&class1=110&class2=0&class3=0&mbpagelist=1" data-page="1"><i class="icon wb-chevron-down margin-right-5" aria-hidden="true"></i>更多产品</button>
            </div>

        </div>
    </div>
@endsection
@section('news')
@show
@section('about')
@show