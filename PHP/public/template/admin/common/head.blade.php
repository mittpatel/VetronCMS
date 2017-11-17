<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>
    	@if($GLOBALS['language_key'])
    	{{admin_language($GLOBALS['language_key'])}}--
    	@endif
    	{{config('aSetting.admin_Name')}}
    </title>
    <meta name="description" content=""/>
    <meta name="Author" content=""/>
    <meta http-equiv=“X-UA-Compatible” content=“chrome=1″ />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>

    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
           rel="stylesheet" type="text/css"/>--}}

    <link rel="shortcut icon" href="{{app_public()}}template/admin/assets/favicon.ico">
    <link href="{{app_public()}}template/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/essentials.css" rel="stylesheet" type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/color_scheme/custom.css" rel="stylesheet" type="text/css"
          id="color_scheme"/>
    <link href="{{app_public()}}template/admin/assets/scripts/css/app.css" rel="stylesheet" type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/layout-datatables.css" rel="stylesheet" type="text/css"
          id="color_scheme"/>
    <link href="{{app_public()}}template/admin/assets/scripts/Jcrop.css" rel="stylesheet" type="text/css"
          id="color_scheme"/>
    <link rel="stylesheet" href="{{app_public()}}template/admin/assets/scripts/imgareaselect-default.css">
    <style>

        .listEnableColor {
            color: {{config('config.listEnableColor')}};
        }

        .listDisableColor {
            color: {{config('config.listDisableColor')}};
        }

    </style>
    <!--[if lt IE8]>
    <script>
        (function () {
            if (!
                            /*@cc_on!@*/
                            0) return;
            var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
            var i = e.length;
            while (i--) {
                document.createElement(e[i])
            }
        })()
    </script>
    <![endif]-->
    <!--[if !IE]> -->
    <script type="text/javascript"
            src="{{app_public()}}template/admin/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <!-- <![endif]-->


    <!--[if lte IE 8]>
    <script type="text/javascript"
            src="{{app_public()}}template/admin/assets/plugins/jquery/jquery1.11.min.js"></script>

    <![endif]-->

    <!--[if gt IE 8]>
    <script type="text/javascript"
            src="{{app_public()}}template/admin/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <![endif]-->

</head>