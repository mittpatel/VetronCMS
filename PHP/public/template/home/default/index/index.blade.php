<!DOCTYPE HTML>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <title>科技</title>
    <meta name="renderer" content="webkit">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content=""/>
    <meta name="generator" content="" data-variable=""/>
    <meta name="keywords" content=""/>
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link rel='stylesheet' href='{{THEME_ASSET}}/asset/metinfo031c.css'>
</head>
<body>
@section('nav')
    <nav class="navbar navbar-default met-nav " role="navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle hamburger hamburger-close collapsed"
                            data-target="#navbar-default-collapse" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="hamburger-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand navbar-logo vertical-align" title="科技公司">
                        <h1 class='hide'>科技公司</h1>
                        <div class="vertical-align-middle"><img src="{{THEME_ASSET}}/asset/img/1464062976.png"
                                                                alt="科技公司"
                                                                title="科技公司"/>
                        </div>
                    </a>
                    <h2 class='hide'></h2>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-toolbar nav-shop" id="navbar-default-collapse">


                    <div class="navbar-right vertical-align text-center animation-slide-top met-nav-login">
                        <div class="vertical-align-middle margin-right-10"><a
                                    href="member/register_includedb38.html?lang=cn"
                                    class="btn btn-squared btn-success">注册</a></div>
                        <div class="vertical-align-middle"><a href="member/logindb38.html?lang=cn"
                                                              class="btn btn-squared btn-primary btn-outline">登录</a>
                        </div>
                    </div>


                    <ul class="nav navbar-nav navbar-right navlist">
                        @foreach($GLOBALS['homeMenu'] as $p)
                            @if($p->p_id==0)
                                <li class="dropdown margin-left-40">
                                    <a class="dropdown-toggle link @if($other['active']==$p->active) active @endif"
                                       data-toggle="dropdown"
                                       data-hover="dropdown"
                                       href="{{url($p->route)}}"
                                       @if($p->target==2)
                                       target="_blank"
                                       @endif
                                       aria-expanded="false"
                                       title="{{home_language($p->language_key)}}"
                                    >{{home_language($p->language_key)}}
                                        @foreach($GLOBALS['homeMenu'] as $span)
                                            @if($span->p_id==$p->id)
                                                <span class="caret"></span>
                                                @break
                                            @endif
                                        @endforeach
                                    </a>
                                    @foreach($GLOBALS['homeMenu'] as $span)
                                        @if($span->p_id==$p->id)
                                            <ul class="dropdown-menu dropdown-menu-right animate">
                                                @break
                                                @endif
                                                @endforeach
                                                @foreach($GLOBALS['homeMenu'] as $s)
                                                    @if($s->p_id==$p->id)
                                                        <li>

                                                            <a href="{{url($s->route)}}"
                                                               class=""

                                                               title="{{home_language($s->language_key)}}">{{home_language($s->language_key)}}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @foreach($GLOBALS['homeMenu'] as $span)
                                                    @if($span->p_id==$p->id)
                                            </ul>
                                            @break
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </nav>
@show
@section('banner')
    <div class="met-banner" data-height='' style=''>

        <div class="slick-slide">
            <img class="cover-image" src="{{THEME_ASSET}}/asset/img/1464083856.png"
                 srcset='include/thumb.php?dir=upload/201605/1464083856.png&x=767 767w,{{THEME_ASSET}}/asset/img/1464083856.png'
                 sizes="(max-width: 767px) 767px" alt="Know You More">
            <div class="banner-text p-1">
                <div class='container'>
                    <div class='banner-text-con'>
                        <div>
                            <h4 class="animation-slide-top">Know You More</h4>

                            <p class="animation-slide-bottom animation-delay-300">懂你，总会多一点</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="slick-slide">
            <img class="cover-image" src="{{THEME_ASSET}}/asset/img/1464084575.png"
                 srcset='include/thumb.php?dir=upload/201605/1464084575.png&x=767 767w,{{THEME_ASSET}}/asset/img/1464084575.png'
                 sizes="(max-width: 767px) 767px" alt="">
        </div>

    </div>
@show
@section('service')
    <div class="met-index-service met-index-body">
        <div class="container">
            <h2 class="invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">科技改变生活</h2>
            <p class="desc invisible" data-plugin="appear" data-animate="fade" data-repeat="false">
                科技正用你无法想象的速度在改变世界，改变人们的生活</p>
            <ul class="blocks-2 blocks-sm-2 blocks-md-4 blocks-xlg-4 " data-plugin="matchHeight">

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom50" data-repeat="false">

                    <i class="icon fa-automobile" aria-hidden="true"></i>

                    <h3>无人驾驶</h3>
                    <p>无人驾驶车将改变人们的出行方式。据估计，无人驾驶车可将每年因交通事故死亡的人数（120万）削减一半。</p>

                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom50" data-repeat="false">

                    <i class="icon fa-eye" aria-hidden="true"></i>

                    <h3>虚拟现实</h3>
                    <p>简称VR，创建和体验虚拟世界，有一天你也会有专属自己的虚拟人生。</p>

                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom50" data-repeat="false">

                    <i class="icon fa-android" aria-hidden="true"></i>

                    <h3>机器人</h3>
                    <p>未来将会有更多给人们生活带来改变的机器人，甚至机器人会有自己的情感。</p>

                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom50" data-repeat="false">

                    <i class="icon fa-fighter-jet" aria-hidden="true"></i>

                    <h3>无人机</h3>
                    <p>人们已经在利用无人机寻找等待救援的远足者和滑雪者，拍摄房屋航空图像，以及调查考古遗址。</p>

                </li>

            </ul>
        </div>
    </div>
@show
@section('product')
    <div class="met-index-product met-index-body">
        <div class="container">
            <h2 class="invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">科技产品</h2>
            <p class="desc invisible" data-plugin="appear" data-animate="fade" data-repeat="false">我们致力于让科技改善人们的生活</p>

            <div class='invisible' data-plugin="appear" data-animate="fade" data-repeat="false">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#indexprolist" title="全部" data-toggle="tab" data-num='8' data-filter="*">
                            <h3>全部</h3>
                        </a>
                    </li>

                    <li>
                        <a href="#indexprolist" title="智能手表" data-toggle="tab" data-filter="list_112">
                            <h3>智能手表</h3>
                        </a>
                    </li>

                    <li>
                        <a href="#indexprolist" title="智能眼镜" data-toggle="tab" data-filter="list_113">
                            <h3>智能眼镜</h3>
                        </a>
                    </li>

                    <li>
                        <a href="#indexprolist" title="机器人" data-toggle="tab" data-filter="list_114">
                            <h3>机器人</h3>
                        </a>
                    </li>


                </ul>
            </div>
            <ul class="blocks-2 blocks-sm-2 blocks-md-4 blocks-xlg-4 no-space" id='indexprolist' data-scale='1'>


                <li data-type="list_112">
                    <div class="widget widget-shadow invisible" data-plugin="appear" data-animate="slide-bottom50"
                         data-repeat="false">
                        <figure class="widget-header cover">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>
                                <img class="cover-image"
                                     src="{{THEME_ASSET}}/asset/img/thumb.jpg"
                                     style='height:300px;' alt="Apple Watch Sport">
                            </a>
                        </figure>
                        <h4 class="widget-title">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>天猫音响</a>
                            <p class='margin-bottom-0 margin-top-5 red-600'>2288.00元</p>
                        </h4>
                    </div>
                </li>
                <li data-type="list_113">
                    <div class="widget widget-shadow invisible" data-plugin="appear" data-animate="slide-bottom50"
                         data-repeat="false">
                        <figure class="widget-header cover">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>
                                <img class="cover-image"
                                     src="{{THEME_ASSET}}/asset/img/thumb.jpg"
                                     style='height:300px;' alt="Apple Watch Sport">
                            </a>
                        </figure>
                        <h4 class="widget-title">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>天猫音响</a>
                            <p class='margin-bottom-0 margin-top-5 red-600'>2288.00元</p>
                        </h4>
                    </div>
                </li>

                <li data-type="list_114">
                    <div class="widget widget-shadow invisible" data-plugin="appear" data-animate="slide-bottom50"
                         data-repeat="false">
                        <figure class="widget-header cover">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>
                                <img class="cover-image"
                                     src="{{THEME_ASSET}}/asset/img/thumb.jpg"
                                     style='height:300px;' alt="Apple Watch Sport">
                            </a>
                        </figure>
                        <h4 class="widget-title">
                            <a href="product/showproductb1b6.html?lang=cn&amp;id=48" title="Apple Watch Sport"
                               target='_self'>天猫音响</a>
                            <p class='margin-bottom-0 margin-top-5 red-600'>2288.00元</p>
                        </h4>
                    </div>
                </li>

            </ul>

        </div>
    </div>
@show
@section('news')
    <div class="met-index-news met-index-body">
        <div class="container">
            <h2 class="invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">博客资讯</h2>
            <p class="desc invisible" data-plugin="appear" data-animate="fade" data-repeat="false">分享最新科技资讯，关注智能硬件</p>
            <ul class="blocks-2" data-scale='0.75'>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownewsb469.html?lang=cn&amp;id=51" title="Oculus在伦敦组建VR团队" target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1464075489148330.jpg&x=200&y=150"
                                     style='height:80px;' alt="Oculus在伦敦组建VR团队">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownewsb469.html?lang=cn&amp;id=51" title="Oculus在伦敦组建VR团队"
                                   target='_self'>
                                    Oculus在伦敦组建VR团队
                                </a>
                            </h4>
                            <p class="des">
                                自从2014年斥资20亿美元收购Oculus以来，Facebook作为社交平台巨头一直在VR发展的前沿。而随着市场发展，VR在美国和中国等地刮起狂潮。由此，Facebook准备扩大疆域，向英国瞄准。根...</p>
                            <p class="info">
                                <span>2017-01-14</span>
                                <span class="margin-left-10">admin</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>2311</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews3a55.html?lang=cn&amp;id=53" title="Oculus在伦敦组建VR团队" target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1464075489148330.jpg&x=200&y=150"
                                     style='height:80px;' alt="Oculus在伦敦组建VR团队">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews3a55.html?lang=cn&amp;id=53" title="Oculus在伦敦组建VR团队"
                                   target='_self'>
                                    Oculus在伦敦组建VR团队
                                </a>
                            </h4>
                            <p class="des">
                                自从2014年斥资20亿美元收购Oculus以来，Facebook作为社交平台巨头一直在VR发展的前沿。而随着市场发展，VR在美国和中国等地刮起狂潮。由此，Facebook准备扩大疆域，向英国瞄准。根...</p>
                            <p class="info">
                                <span>2016-11-29</span>
                                <span class="margin-left-10">admin</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>636</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews05fc.html?lang=cn&amp;id=55" title="Chrome OS支持所有安卓应用" target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1464073341.jpg&x=200&y=150"
                                     style='height:80px;' alt="Chrome OS支持所有安卓应用">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews05fc.html?lang=cn&amp;id=55" title="Chrome OS支持所有安卓应用"
                                   target='_self'>
                                    Chrome OS支持所有安卓应用
                                </a>
                            </h4>
                            <p class="des">“Google Play商店马上就要登陆Chrome
                                OS了”谷歌公司在今天的开发者大会上宣布。然后大家就可以在自己的Chromebook跟Chromebox上安装几乎所有安卓应用了。谷歌让Play商...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>422</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews7b74.html?lang=cn&amp;id=54" title="人工智能风口来袭 情感机器人众望所归"
                               target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1463992953.jpg&x=200&y=150"
                                     style='height:80px;' alt="人工智能风口来袭 情感机器人众望所归">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews7b74.html?lang=cn&amp;id=54" title="人工智能风口来袭 情感机器人众望所归"
                                   target='_self'>
                                    人工智能风口来袭 情感机器人众望所归
                                </a>
                            </h4>
                            <p class="des">
                                近日，习近平在中科大“检阅”了多款人工智能机器人，Gowild智能科技公司开发的全球首款情感社交机器人“公子小白”激萌可爱，分外抢眼。据悉，受“检阅”的人工智能机器人的开发者包括科大讯飞、Gowild...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>397</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews587b.html?lang=cn&amp;id=52" title="人工智能风口来袭 情感机器人众望所归"
                               target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1463992953.jpg&x=200&y=150"
                                     style='height:80px;' alt="人工智能风口来袭 情感机器人众望所归">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews587b.html?lang=cn&amp;id=52" title="人工智能风口来袭 情感机器人众望所归"
                                   target='_self'>
                                    人工智能风口来袭 情感机器人众望所归
                                </a>
                            </h4>
                            <p class="des">
                                近日，习近平在中科大“检阅”了多款人工智能机器人，Gowild智能科技公司开发的全球首款情感社交机器人“公子小白”激萌可爱，分外抢眼。据悉，受“检阅”的人工智能机器人的开发者包括科大讯飞、Gowild...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>233</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews07db.html?lang=cn&amp;id=50" title="Chrome OS支持所有安卓应用" target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1464073341.jpg&x=200&y=150"
                                     style='height:80px;' alt="Chrome OS支持所有安卓应用">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews07db.html?lang=cn&amp;id=50" title="Chrome OS支持所有安卓应用"
                                   target='_self'>
                                    Chrome OS支持所有安卓应用
                                </a>
                            </h4>
                            <p class="des">“Google Play商店马上就要登陆Chrome
                                OS了”谷歌公司在今天的开发者大会上宣布。然后大家就可以在自己的Chromebook跟Chromebox上安装几乎所有安卓应用了。谷歌让Play商...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>148</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownews97e0.html?lang=cn&amp;id=49" title="Chrome OS支持所有安卓应用" target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1464073341.jpg&x=200&y=150"
                                     style='height:80px;' alt="Chrome OS支持所有安卓应用">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownews97e0.html?lang=cn&amp;id=49" title="Chrome OS支持所有安卓应用"
                                   target='_self'>
                                    Chrome OS支持所有安卓应用
                                </a>
                            </h4>
                            <p class="des">“Google Play商店马上就要登陆Chrome
                                OS了”谷歌公司在今天的开发者大会上宣布。然后大家就可以在自己的Chromebook跟Chromebox上安装几乎所有安卓应用了。谷歌让Play商...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>172</span>
                            </p>
                        </div>
                    </div>
                </li>

                <li class="invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
                    <div class="media media-lg">
                        <div class="media-left">
                            <a href="blog/shownewsb1b6.html?lang=cn&amp;id=48" title="人工智能风口来袭 情感机器人众望所归"
                               target='_self'>
                                <img class="media-object"
                                     data-original="include/thumb.php?dir=upload/201605/1463992953.jpg&x=200&y=150"
                                     style='height:80px;' alt="人工智能风口来袭 情感机器人众望所归">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="blog/shownewsb1b6.html?lang=cn&amp;id=48" title="人工智能风口来袭 情感机器人众望所归"
                                   target='_self'>
                                    人工智能风口来袭 情感机器人众望所归
                                </a>
                            </h4>
                            <p class="des">
                                近日，习近平在中科大“检阅”了多款人工智能机器人，Gowild智能科技公司开发的全球首款情感社交机器人“公子小白”激萌可爱，分外抢眼。据悉，受“检阅”的人工智能机器人的开发者包括科大讯飞、Gowild...</p>
                            <p class="info">
                                <span>2016-05-24</span>
                                <span class="margin-left-10">科技公司</span>
                                <span class="margin-left-10"><i class="icon wb-eye margin-right-5"
                                                                aria-hidden="true"></i>206</span>
                            </p>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
@show
@section('about')
    <div class="met-index-about met-index-body">
        <div class="container">
            <h2 class="invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">关于我们</h2>
            <p class="desc invisible" data-plugin="appear" data-animate="fade" data-repeat="false">我们致力于让科技改善人们的生活</p>
            <div class="met-editor no-gallery lazyload clearfix invisible" data-plugin="appear"
                 data-animate="slide-bottom10" data-repeat="false">
                <p><img class="imgloading" height="200"
                        data-original="http://show.metinfo.cn/muban/res013/323/upload/201605/1464245734139534.jpg"
                        title="1464245734139534.jpg" alt="56f8e7bf65a3f.jpg"/></p>
                <hr/>
                <p>某科技公司是一个诞生于2013年机器人浪潮来袭前际，总部位于“硬件之都”中国深圳。</p>
                <p>我们是一群热衷于智能机器人的极客、设计师和发烧友，对未来充满无限创想、野心和激情。“在最好的时光里，撒野去”是我们所倡导的品牌文化，号召属于这个时代的年轻人，不羁束缚、随心逐梦！</p>
                <p>
                    比普通创客幸运一些的是，我们成立之初，就在语义技术、图数据管理和供应链方面拥有比较丰富的经验和积累，并且、汇聚整合了完善的生产链条和多元的渠道资源，我们愿意拥抱大胆有趣的产品理念，为用户创造更多的惊喜！</p>
            </div>
        </div>
    </div>
@show
@section('footnav')
    <div class="met-footnav text-center">
        <div class="container">
            <div class="row mob-masonry">

                <div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
                    <h4><a href="product/index.html" title="产品">产品</a></h4>
                    <ul>

                        <li><a href="product/product5688.html?lang=cn&amp;class2=112" title="智能手表">智能手表</a></li>

                        <li><a href="product/productd61c.html?lang=cn&amp;class2=113" title="智能眼镜">智能眼镜</a></li>

                        <li><a href="product/product326e.html?lang=cn&amp;class2=114" title="机器人">机器人</a></li>

                        <li><a href="product/producted31.html?lang=cn&amp;class2=118" title="体感车">体感车</a></li>

                        <li><a href="product/product6301.html?lang=cn&amp;class2=119" title="无人机">无人机</a></li>

                    </ul>
                </div>

                <div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
                    <h4><a href="service/show4fca.html?lang=cn&amp;id=129" title="支持">支持</a></h4>
                    <ul>

                        <li><a href="service/show4fca.html?lang=cn&amp;id=129" title="售后政策">售后政策</a></li>

                        <li><a href="download/index.html" title="相关下载">相关下载</a></li>

                    </ul>
                </div>

                <div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
                    <h4><a href="blog/index.html" title="博客">博客</a></h4>
                    <ul>

                        <li><a href="blog/newsef35.html?lang=cn&amp;class2=122" title="产品资讯">产品资讯</a></li>

                        <li><a href="blog/newsa627.html?lang=cn&amp;class2=123" title="行业动态">行业动态</a></li>

                        <li><a href="blog/news9e04.html?lang=cn&amp;class2=124" title="国际资讯">国际资讯</a></li>

                    </ul>
                </div>

                <div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
                    <h4><a href="about/show8335.html?lang=cn&amp;id=125" title="关于">关于</a></h4>
                    <ul>

                        <li><a href="about/show8335.html?lang=cn&amp;id=125" title="关于我们">关于我们</a></li>

                        <li><a href="about/show7bf3.html?lang=cn&amp;id=126" title="联系我们">联系我们</a></li>

                        <li><a href="job/index.html" title="加入我们">加入我们</a></li>

                        <li><a href="feedback/index.html" title="意见反馈">意见反馈</a></li>

                    </ul>
                </div>

                <div class="col-md-3 col-ms-12 col-xs-12 info masonry-item">
                    <em><a href="tel:400-000-000" title="400-000-000">400-000-000</a></em>
                    <p>周一至周五 08:30~17:30</p>


                    <a id="met-weixin"><i class="fa fa-weixin light-green-700" data-plugin="webuiPopover"
                                          data-trigger="hover" data-animation="pop" data-placement='top'
                                          data-width='160'
                                          data-padding='0'
                                          data-content="<img src='upload/201605/1464081530.jpg' alt='科技公司网站模板|科技公司企业网站模板-科技公司' style='width: 150px;display:block;margin:auto;'>"></i></a>

                    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" rel="nofollow"
                       target="_blank">
                        <i class="fa fa-qq"></i>
                    </a>

                    <a href="#" rel="nofollow" target="_blank"><i class="fa fa-weibo red-600"></i></a>


                </div>
            </div>
        </div>
    </div>
@show

<footer>
    <div class="container text-center">
        <p>科技公司 版权所有 © 2008-2016 湘ICP备8888888 </p>
        <p>本页面内容为网站演示数据，前台页面内容都可以在后台修改。</p>

        <div class="powered_by_metinfo">Powered&nbsp;by&nbsp;<a href="http://www.metinfo.cn/#copyright" target="_blank"
                                                                title="企业网站管理系统">MetInfo</a>&nbsp;5.3.16
        </div>
    </div>
</footer>
<button type="button" class="btn btn-icon btn-primary btn-squared met-scroll-top hide">
    <i class="icon wb-chevron-up" aria-hidden="true"></i>
</button>
<script src="{{THEME_ASSET}}/asset/metinfo3a5b.js?2017011801"></script>
</body>

</html>