@extends('layouts.front')

@section('content')


    <div id="wrapper">

    <div class="vertical-align-wrap">

      <div class="vertical-align-middle">

        <div class="auth-box ">

          <div class="left">

            <div class="content">

              <div class="header">

                <div class="logo text-center"><img src="{{asset('assets/login/img/logo.png')}}" alt="Logo UBP" width="40%" height="auto"></div>

                <p class="lead">Login E-Office</p>

                  @if (count($errors) > 0)
<font color="red">
    <strong>Whoops!</strong> {{__('Username atau Password Salah.')}}<br><br>
</font>

  @endif

              </div>

              <form data-no-ajax action="{{ route('login') }}" method="post">

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">

                  <label for="signin-email" class="control-label sr-only">Email</label>

                  <input type="email" class="form-control" id="signin-email" name="email" placeholder="Email">

                </div>

                <div class="form-group">

                  <label for="signin-password" class="control-label sr-only">Password</label>

                  <input type="password" class="form-control" id="signin-password" name="password" placeholder="Password">

                </div>

                

                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Login to..">


               </form>
            </div>

          </div>

          <div class="right">

            <div class="overlay"></div>

            <div class="content text">

              <h1 class="heading">e-Office</h1>

              <p>UNIVERSITAS UNIVERSAL</p>

            </div>

          </div>

          <div class="clearfix"></div>

        </div>

      </div>

    </div>

  </div>

  
@endsection
