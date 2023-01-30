<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Driver | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  @if(!is_null($favicon = Admin::favicon()))
  <link rel="shortcut icon" href="{{$favicon}}">
  @endif

  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css' ) }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/font-awesome/css/font-awesome.min.css' ) }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css' ) }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/iCheck/square/blue.css' ) }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page"
  @if(config('driver.login_background_image'))style="background: url({{config('driver.login_background_image')}}) no-repeat;background-size: cover;"
  @endif>




  <div class="login-box" style="width: 700px">
    <div class="login-logo">
      <b>Register as Driver in the system</b>
    </div>
    @if(Session::has('state'))
    <div class="{!! Session::has('state') == 'success' ?'alert alert-success' : 'alert alert-danger' !!}"
      style="width: 700px">
      {!! Session::has('state') == 'success' ?' Register Successful, Please for the approval by the admin. An email will
      send to notify your application.' : ' System errror, Please try again later' !!}
    </div>
    @endif
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Register</p>

      <form enctype="multipart/form-data" action="{{ url('/driver/registerDriver') }}" method="post">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group has-feedback {!! !$errors->has('username') ?: 'has-error' !!}">

              @if($errors->has('username'))
              @foreach($errors->get('username') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="text" class="form-control" placeholder="{{ trans('admin.username') }}" name="username"
                value="{{ old('username') }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group has-feedback {!! !$errors->has('name') ?: 'has-error' !!}">

              @if($errors->has('name'))
              @foreach($errors->get('name') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('username') }}">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('ic_number') ?: 'has-error' !!}">

              @if($errors->has('ic_number'))
              @foreach($errors->get('ic_number') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="text" class="form-control" placeholder="Identification Number" name="ic_number"
                value="{{ old('ic_number') }}">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('birthday') ?: 'has-error' !!}">

              @if($errors->has('birthday'))
              @foreach($errors->get('birthday') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="date" class="form-control" placeholder="Birthday" name="birthday"
                value="{{ old('birthday') }}">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('password') ?: 'has-error' !!}">

              @if($errors->has('password'))
              @foreach($errors->get('password') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="password" class="form-control" placeholder="{{ trans('admin.password') }}" name="password">
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('password_confirmation') ?: 'has-error' !!}">

              @if($errors->has('password_confirmation'))
              @foreach($errors->get('password_confirmation') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('phone_number') ?: 'has-error' !!}">

              @if($errors->has('phone_number'))
              @foreach($errors->get('phone_number') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="phone_number" class="form-control" placeholder="Phone Number" name="phone_number">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group has-feedback {!! !$errors->has('email_address') ?: 'has-error' !!}">

              @if($errors->has('email_address'))
              @foreach($errors->get('email_address') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif

              <input type="email" class="form-control" placeholder="Email Address" name="email_address"
                value="{{ old('email_address') }}">
            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group has-feedback {!! !$errors->has('driver_liscense') ?: 'has-error' !!}">
              @if($errors->has('driver_liscense'))
              @foreach($errors->get('driver_liscense') as $message)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
              @endforeach
              @endif
              <label>Please update your driver liscense</label>
              <input type="file" class="form-control" name="driver_liscense" accept="image/png, image/gif, image/jpeg"
                value="{{ old('driver_liscense') }}">
            </div>
          </div>

          <div class="col-xs-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.1.4 -->
  <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js' )}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js' )}}"></script>
  <!-- iCheck -->
  <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js' )}}"></script>
  <script>
    $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  </script>
</body>

</html>