<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ระบบประชาสัมพันธ์ข่าวสารสมาคมศิษย์เก่าคณะครุศาสตร์อุตสาหกรรม</title>

    <!-- Styles -->
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/londinium-themee.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/styless.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext')}}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{url('http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/plugins/charts/sparkline.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/plugins/forms/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/inputmask.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/autosize.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/inputlimit.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/listbox.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/multiselect.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/tags.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/switch.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/plugins/forms/uploader/plupload.full.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/uploader/plupload.queue.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/plugins/forms/wysihtml5/wysihtml5.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/forms/wysihtml5/toolbar.js')}}"></script>

    <script type="text/javascript" src="{{url('js/plugins/interface/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/moment.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/colorpicker.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/fullcalendar.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/interface/timepicker.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/application.js')}}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body class="full-width page-condensed">
        <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
