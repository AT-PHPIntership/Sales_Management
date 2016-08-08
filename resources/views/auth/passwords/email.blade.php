<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('auth.label_reset_pass')</title>

    <!-- Bootstrap -->
    <link href="/bower_resources/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/bower_resources/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
              {{ csrf_field() }}
              <h1>@lang('auth.label_reset_pass')</h1>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required="" />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-envelope-o"></i> @lang('auth.btn_send_reset')
                </button>
              </div>
              <div class="clearfix"></div>

              @if (session('status'))
                  <br>
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
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
    @if (session('status'))
    <!-- Auto redirect after submit email -->
    <script>
        var TIME_OUT_REDIRECT = 5000;
        window.setTimeout(function(){
            window.location.href = "{{ url('/login') }}";
        }, TIME_OUT_REDIRECT);
    </script>
    @endif
  </body>
</html>
