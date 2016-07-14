<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('auth.title_login')</title>

    <!-- Bootstrap -->
    <link href="bower_resources/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="bower_resources/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
              <h1>@lang('auth.please_login')</h1>
              <div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required="" />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="" />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
              <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i> @lang('auth.btn_login')
                </button>
                <a class="reset_pass" href="{{ url('/password/reset') }}">@lang('auth.forget_password')</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-tags"></i> @lang('auth.footer_title')</h1>
                  <p>@lang('auth.copy_right')</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
