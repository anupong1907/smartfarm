<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Londinium - premium responsive admin template by Eugene Kopyov</title>

<link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('css/londinium-theme.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('css/styles.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('css/icons.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext')}}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{url('http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js')}}"></script>

<script type="text/javascript" src="{{url('js/plugins/charts/sparkline.min.js')}}"></script>

<script type="text/javascript" src="{{url('js/plugins/charts/sparkline.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.orderbars.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.pie.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.time.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.animator.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/excanvas.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins/charts/flot.resize.min.js')}}"></script>

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

<script type="text/javascript" src="{{url('js/charts/full/vertical_bars.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/horizontal_bars.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/simple_graph.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/auto_filled.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/auto_empty.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/multiple_axes.js')}}"></script>

<script type="text/javascript" src="{{url('js/charts/full/animated_1.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/animated_2.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/animated_3.js')}}"></script>

<script type="text/javascript" src="{{url('js/charts/full/donut.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/pie.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/full/pie_full.js')}}"></script>

<script type="text/javascript" src="{{url('js/charts/widgets/filled_green.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/widgets/filled_red.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/widgets/filled_blue.js')}}"></script>

<script type="text/javascript" src="{{url('js/charts/widgets/updating_1.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/widgets/updating_2.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/widgets/updating_3.js')}}"></script>
<link href="https://fonts.googleapis.com/css?family=Prompt|Poppins" rel="stylesheet">
@yield('css')

</head>

<body class="navbar-fixed">
	@include('layouts.navbar')
	<div class="page-container">
		@include('layouts.sidebar')
		<div class="page-content">
			
			@yield('content')

			@include('layouts.footer')			
		</div>
	</div>
	@yield('script')
</body>
</html>