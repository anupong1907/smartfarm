<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <title>Londinium - premium responsive admin template by Eugene Kopyov</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/londinium-theme.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/icons.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/plugins/charts/sparkline.min.js"></script>

    <script type="text/javascript" src="js/plugins/forms/uniform.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/select2.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/inputmask.js"></script>
    <script type="text/javascript" src="js/plugins/forms/autosize.js"></script>
    <script type="text/javascript" src="js/plugins/forms/inputlimit.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/listbox.js"></script>
    <script type="text/javascript" src="js/plugins/forms/multiselect.js"></script>
    <script type="text/javascript" src="js/plugins/forms/validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/tags.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/switch.min.js"></script>

    <script type="text/javascript" src="js/plugins/forms/uploader/plupload.full.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/uploader/plupload.queue.min.js"></script>

    <script type="text/javascript" src="js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/wysihtml5/toolbar.js"></script>

    <script type="text/javascript" src="js/plugins/interface/daterangepicker.js"></script>
    <script type="text/javascript" src="js/plugins/interface/fancybox.min.js"></script>
    <script type="text/javascript" src="js/plugins/interface/moment.js"></script>
    <script type="text/javascript" src="js/plugins/interface/jgrowl.min.js"></script>
    <script type="text/javascript" src="js/plugins/interface/datatables.min.js"></script>
    <script type="text/javascript" src="js/plugins/interface/colorpicker.js"></script>
    <script type="text/javascript" src="js/plugins/interface/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/plugins/interface/timepicker.min.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/application.js"></script>

</head>

<body class="full-width page-condensed">




    <!-- Login wrapper -->
    <div class="login-wrapper">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="popup-header">
                <span class="text-semibold">User Login</span>
            </div>
            <div class="well">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-group has-feedback">
                        <label>E-mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        <i class="icon-users form-control-feedback"></i>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="form-group has-feedback">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        <i class="icon-lock form-control-feedback"></i>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row form-actions">
                    <div class="col-xs-6">
                        <div class="checkbox checkbox-success">
                            <label>
                                <input type="checkbox" name="remember" class="styled" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
    <!-- /login wrapper -->

</body>
</html>