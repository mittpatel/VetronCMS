<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body>

<div class="container">
    <div id="wrapper" class="clearfix">
        {{--左侧导航--}}
        @section('nav')
            @include('admin/common/nav')
        @show
        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            {{--内容区--}}
            @section('content')
                <div id="content" class="dashboard padding-20">

                    <!--
                        PANEL CLASSES:
                            panel-default
                            panel-danger
                            panel-warning
                            panel-info
                            panel-success

                        INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                                All pannels should have an unique ID or the panel collapse status will not be stored!
                    -->
                    <div id="panel-1" class="panel panel-default">
                        <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('index_AmountOfAccess')}}</strong> <!-- panel title -->
								<small class="size-12 weight-300 text-mutted hidden-xs">{{admin_language('index_LastMonth')}}</small>
							</span>

                            <!-- right options -->
                            <ul class="options pull-right list-inline">
                                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                                       data-placement="bottom"></a></li>
                                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip"
                                       title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                            </ul>
                            <!-- /right options -->

                        </div>

                        <!-- panel content -->
                        <div class="panel-body">

                            <div id="flot-sales" class="fullwidth height-250"></div>

                        </div>
                        <!-- /panel content -->

                        <!-- panel footer -->
                        <div class="panel-footer">

                            <!--
                                .md-4 is used for a responsive purpose only on col-md-4 column.
                                remove .md-4 if you use on a larger column
                            -->
                            <ul class="easypiecharts list-unstyled">
                                <li class="clearfix">
                                    <span class="stat-number">18.125</span>
                                    <span class="stat-title">New Customers</span>

                                    <span class="easyPieChart" data-percent="86" data-easing="easeOutBounce"
                                          data-barColor="#F8CB00" data-trackColor="#dddddd" data-scaleColor="#dddddd"
                                          data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                                </li>
                                <li class="clearfix">
                                    <span class="stat-number">60%</span>
                                    <span class="stat-title">Returning Customers</span>

                                    <span class="easyPieChart" data-percent="59.83" data-easing="easeOutBounce"
                                          data-barColor="#F86C6B" data-trackColor="#dddddd" data-scaleColor="#dddddd"
                                          data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                                </li>
                                <li class="clearfix">
                                    <span class="stat-number">12%</span>
                                    <span class="stat-title">Canceled Orders</span>

                                    <span class="easyPieChart" data-percent="12" data-easing="easeOutBounce"
                                          data-barColor="#98AD4E" data-trackColor="#dddddd" data-scaleColor="#dddddd"
                                          data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                                </li>
                                <li class="clearfix">
                                    <span class="stat-number">97%</span>
                                    <span class="stat-title">Positive Feedbacks</span>

                                    <span class="easyPieChart" data-percent="97" data-easing="easeOutBounce"
                                          data-barColor="#0058AA" data-trackColor="#dddddd" data-scaleColor="#dddddd"
                                          data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                                </li>
                            </ul>

                        </div>
                        <!-- /panel footer -->

                    </div>
                    <!-- /PANEL -->


                    <!-- BOXES -->
                    <div class="row">

                        <!-- Feedback Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box danger"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4><a href="#">{{$articleCount}} <span style="font-size: 80%;">
                                                {{admin_language('index_ArticleQuantity')}}
                                            </span></a></h4>
                                    <small class="block">{{$weekArticleCount}} {{admin_language('index_LastWeek')}}</small>
                                    <i class="fa fa-pencil-square"></i>
                                </div>

                                <div class="box-body text-center">
									<span class="sparkline"
                                          data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456,
										331,265,456
									</span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Profit Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box warning"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4>{{$productCount}} <span style="font-size: 80%;color: #ffffff;">{{admin_language('index_ProductQuantity')}}</span></h4>
                                    <small class="block">{{$weekProductCount}} {{admin_language('index_LastWeek')}}</small>
                                    <i class="fa fa-shopping-cart"></i>
                                </div>

                                <div class="box-body text-center">
									<span class="sparkline"
                                          data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                                            100,100,100,
                                            100,100,100,
                                            100,100,100,
                                            100,100,100,
                                            100,100,100,
                                            100,100,100
                                    </span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Orders Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box default"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4>{{$EnablePluginCount}} <span style="font-size: 80%;color: #ffffff;">{{admin_language('index_PluginEnabled')}}</span></h4>
                                    <small class="block">{{$AllPluginCount}} {{admin_language('index_AllPlugins')}}</small>
                                    <i class="fa fa-cutlery"></i>
                                </div>

                                <div class="box-body text-center">
									<span class="sparkline"
                                          data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Online Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box success"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4>{{$historyCount}} <span style="color: #ffffff;font-size: 80%;">{{admin_language('index_TotalVisits')}}</span></h4>
                                    <small class="block">{{$weekHistoryCount}} {{admin_language('index_LastWeek')}}</small>
                                    <i class="fa fa-globe"></i>
                                </div>

                                <div class="box-body text-center">
									<span class="sparkline"
                                          data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                    </div>
                    <!-- /BOXES -->


                    <div class="row">

                        <div class="col-md-6">

                            <!--
                                PANEL CLASSES:
                                    panel-default
                                    panel-danger
                                    panel-warning
                                    panel-info
                                    panel-success

                                INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                                        All pannels should have an unique ID or the panel collapse status will not be stored!
                            -->
                            <div id="panel-2" class="panel panel-default">
                                <div class="panel-heading">
									<span class="title elipsis">
										<strong>{{admin_language('index_RecentTrends')}}</strong> <!-- panel title -->
									</span>

                                    <!-- tabs nav -->
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="active"><!-- TAB 1 -->
                                            <a href="#ttab1_nobg" data-toggle="tab">{{admin_language('index_LatestArticles')}}</a>
                                        </li>
                                        <li class=""><!-- TAB 2 -->
                                            <a href="#ttab2_nobg" data-toggle="tab">{{admin_language('index_LatestProduct')}}</a>
                                        </li>
                                    </ul>
                                    <!-- /tabs nav -->


                                </div>

                                <!-- panel content -->
                                <div class="panel-body">

                                    <!-- tabs content -->
                                    <div class="tab-content transparent">

                                        <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{admin_language('common_title')}}</th>
                                                        <th>{{admin_language('article_category')}}</th>
                                                        <th>{{admin_language('index_AmountOfAccess')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sevenArticle as $a)
                                                        <tr>
                                                            <td><a href="#">{{pure_text($a->title,32)}}</a></td>
                                                            <td>{{getArticleCategoryName($a->category)}}</td>
                                                            <td>3499</td>
                                                            <td><a href="{{url('admin/article/edit/'.$a->id)}}"
                                                                   class="btn btn-default btn-xs btn-block">{{admin_language('index_See')}}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <a class="size-12" href="{{url('admin/article')}}">
                                                    <i class="fa fa-arrow-right text-muted"></i>
                                                   {{admin_language('index_ViewMore')}}
                                                </a>


                                            </div>

                                        </div><!-- /TAB 1 CONTENT -->

                                        <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{admin_language('common_title')}}</th>
                                                        <th>{{admin_language('common_price')}}</th>
                                                        <th>{{admin_language('article_category')}}</th>
                                                        <th>{{admin_language('index_AmountOfAccess')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sevenProduct as $p)
                                                        <tr>
                                                            <td><a href="#">Motorola Droid 4 XT894 - 16GB - Black </a>
                                                            </td>
                                                            <td>{{number_format($p->price,2)}}</td>
                                                            <td>{{getProductCategoryName($p->category)}}</td>
                                                            <td>784</td>
                                                            <td><a href="{{url("admin/product/edit/".$p->id)}}"
                                                                   class="btn btn-default btn-xs btn-block">{{admin_language('index_See')}}</a>
                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <a class="size-12" href="{{url('admin/product')}}">
                                                    <i class="fa fa-arrow-right text-muted"></i>
                                                    {{admin_language('index_ViewMore')}}
                                                </a>

                                            </div>

                                        </div><!-- /TAB 1 CONTENT -->

                                    </div>
                                    <!-- /tabs content -->

                                </div>
                                <!-- /panel content -->

                            </div>
                            <!-- /PANEL -->

                        </div>

                        <div class="col-md-6">

                            <!--
                                PANEL CLASSES:
                                    panel-default
                                    panel-danger
                                    panel-warning
                                    panel-info
                                    panel-success

                                INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                                        All pannels should have an unique ID or the panel collapse status will not be stored!
                            -->
                            <div id="panel-3" class="panel panel-default">
                                <div class="panel-heading">
									<span class="title elipsis">
										<strong>RECENT ACTIVITIES</strong> <!-- panel title -->
									</span>
                                </div>

                                <!-- panel content -->
                                <div class="panel-body">

                                    <ul class="list-unstyled list-hover slimscroll height-300"
                                        data-slimscroll-visible="true">

                                        <li>
                                            <span class="label label-danger"><i class="fa fa-bell-o size-15"></i></span>
                                            Urgent task: add new TEMPLATE to fastAdmin
                                        </li>

                                        <li>
                                            <span class="label label-success"><i class="fa fa-user size-15"></i></span>
                                            <a href="#">5 pending memership</a>
                                        </li>

                                        <li>
                                            <span class="label label-warning"><i
                                                        class="fa fa-comment size-15"></i></span>
                                            <a href="#">24 New comments that needs your approval</a>
                                        </li>

                                        <li>
                                            <span class="label label-default"><i
                                                        class="fa fa-briefcase size-15"></i></span>
                                            No work for tomorrow &ndash; everyone is free!
                                        </li>

                                        <li>
                                            <span class="label label-info"><i
                                                        class="fa fa-shopping-cart size-15"></i></span>
                                            You have new 3 orders unprocessed
                                        </li>

                                        <li>
                                            <span class="label label-success"><i class="fa fa-bar-chart-o size-15"></i></span>
                                            Generate the finance report for the previous year
                                        </li>

                                        <li>
                                            <span class="label label-success bg-black"><i
                                                        class="fa fa-cogs size-15"></i></span>
                                            CentOS server need a kernel update
                                        </li>

                                        <li>
                                            <span class="label label-warning"><i class="fa fa-file-excel-o size-15"></i></span>
                                            <a href="#">XCel finance report for 2017 released</a>
                                        </li>

                                        <li>
                                            <span class="label label-danger"><i class="fa fa-bell-o size-15"></i></span>
                                            Power grid is off. Moving to solar backup.
                                        </li>

                                        <li>
                                            <span class="label label-warning"><i
                                                        class="fa fa-comment size-15"></i></span>
                                            <a href="#">24 New comments that need your approval</a>
                                        </li>

                                        <li>
                                            <span class="label label-default"><i
                                                        class="fa fa-briefcase size-15"></i></span>
                                            No work for tomorrow &ndash; everyone is free!
                                        </li>

                                        <li>
                                            <span class="label label-info"><i
                                                        class="fa fa-shopping-cart size-15"></i></span>
                                            You have new 3 orders unprocessed
                                        </li>

                                        <li>
                                            <span class="label label-success"><i class="fa fa-bar-chart-o size-15"></i></span>
                                            Generate the finance report for the previous year
                                        </li>

                                        <li>
                                            <span class="label label-success bg-black"><i
                                                        class="fa fa-cogs size-15"></i></span>
                                            CentOS server need a kernel update
                                        </li>

                                        <li>
                                            <span class="label label-warning"><i class="fa fa-file-excel-o size-15"></i></span>
                                            <a href="#">XCel finance report for 2017 released</a>
                                        </li>

                                        <li>
                                            <span class="label label-danger"><i class="fa fa-bell-o size-15"></i></span>
                                            Power grid is off. Moving to solar backup.
                                        </li>
                                    </ul>

                                </div>
                                <!-- /panel content -->

                                <!-- panel footer -->
                                <div class="panel-footer">

                                    <a href="#"><i class="fa fa-arrow-right text-muted"></i> View Activities Archive</a>

                                </div>
                                <!-- /panel footer -->

                            </div>
                            <!-- /PANEL -->

                        </div>

                    </div>

                </div>
            @show

        </section>

    </div>
</div>
<script>
    var common_SundaysAndHolid = "{{admin_language('common_SundaysAndHolid')}}";
    var common_Saturday = "{{admin_language('common_Saturday')}}";
    var common_Friday = "{{admin_language('common_Friday')}}";
    var common_Thursday = "{{admin_language('common_Thursday')}}";
    var common_Wednesday = "{{admin_language('common_Wednesday')}}";
    var common_Tuesday = "{{admin_language('common_Tuesday')}}";
    var common_Monday = "{{admin_language('common_Monday')}}";


    var common_December = "{{admin_language('common_December')}}";
    var common_November = "{{admin_language('common_November')}}";
    var common_October = "{{admin_language('common_October')}}";
    var common_September = "{{admin_language('common_September')}}";
    var common_August = "{{admin_language('common_August')}}";
    var common_July = "{{admin_language('common_July')}}";
    var common_June = "{{admin_language('common_June')}}";
    var common_May = "{{admin_language('common_May')}}";
    var common_April = "{{admin_language('common_April')}}";
    var common_March = "{{admin_language('common_March')}}";
    var common_February = "{{admin_language('common_February')}}";
    var common_January = "{{admin_language('common_January')}}";


</script>
@include('admin/common/js')
{{--javascript--}}
@section('javascript')
@show
{{----}}
<script type="text/javascript" src="{{app_public()}}template/admin/assets/plugins/chart.chartjs/Chart.js"></script>
<script type="text/javascript">

    //    _toastr("Welcome, you have 2 new orders", "top-right", "success", false);


    /** SALES CHART
     ******************************************* **/
    loadScript(plugin_path + "chart.flot/jquery.flot.min.js", function () {
        loadScript(plugin_path + "chart.flot/jquery.flot.resize.min.js", function () {
            loadScript(plugin_path + "chart.flot/jquery.flot.time.min.js", function () {
                loadScript(plugin_path + "chart.flot/jquery.flot.fillbetween.min.js", function () {
                    loadScript(plugin_path + "chart.flot/jquery.flot.orderBars.min.js", function () {
                        loadScript(plugin_path + "chart.flot/jquery.flot.pie.min.js", function () {
                            loadScript(plugin_path + "chart.flot/jquery.flot.tooltip.min.js", function () {

                                if (jQuery("#flot-sales").length > 0) {

                                    /* DEFAULTS FLOT COLORS */
                                    var $color_border_color = "#eaeaea", /* light gray 	*/
                                        $color_second = "#6595b4";
                                    /* blue      	*/


                                    var d = [
                                        {{$history}}
                                    ];

                                    /*  for (var i = 0; i < d.length; ++i) {
                                          d[i][0] += 60 * 60 * 1000;
                                      }
  */
                                    var options = {

                                        xaxis: {
                                            mode: "time",
                                            tickLength: 5
                                        },

                                        series: {
                                            lines: {
                                                show: true,
                                                lineWidth: 1,
                                                fill: true,
                                                fillColor: {
                                                    colors: [{
                                                        opacity: 0.1
                                                    }, {
                                                        opacity: 0.15
                                                    }]
                                                }
                                            },
                                            //points: { show: true },
                                            shadowSize: 0
                                        },

                                        selection: {
                                            mode: "x"
                                        },

                                        grid: {
                                            hoverable: true,
                                            clickable: true,
                                            tickColor: $color_border_color,
                                            borderWidth: 0,
                                            borderColor: $color_border_color,
                                        },

                                        tooltip: true,

                                        tooltipOpts: {
                                            content: " %x <span class='block'> %y</span>",
                                            dateFormat: "%y-%0m-%0d",
                                            defaultTEMPLATE: false
                                        },

                                        colors: [$color_second],

                                    };

                                    var plot = jQuery.plot(jQuery("#flot-sales"), [d], options);
                                }

                            });
                        });
                    });
                });
            });
        });
    });
</script>
</body>
</html>