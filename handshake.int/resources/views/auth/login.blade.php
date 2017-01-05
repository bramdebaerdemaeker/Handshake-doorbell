@extends('layout')

@section('content')
<!--
<div class="section">
  <div class="section-login">

    <div class="instructions">
      <h2>Face recognition</h2>
      <hr>
      <ul>
        <li>data</li>
        <li>data</li>
        <li>data</li>
        <li>data</li>
      </ul>
    </div>
    <div class="picture">
      <img src="http://placehold.it/200x200">
      <button type="button" name="button">take picture</button>
    </div>

  </div>
</div> -->

<div class="section">
  <div class="section-register">
    <div class="information">
      <h2>Become a member </h2>
      <input type="text" placeholder="Email">
      <input type="text" placeholder="Name">
      <button type="button" name="button" id="hide-information">next</button>
    </div>
    <div class="picture">
      <h2>Face recognition</h2>
      <img src="http://placehold.it/200x200">
      <button type="button" name="button" id="hide-picture">take picture</button>
    </div>
  </div>
</div>


<div class="section">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email" class="col-md-4 control-label">E-Mail Address</label>

      <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
      <label for="password" class="col-md-4 control-label">Password</label>

      <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Remember Me
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
          Login
        </button>

        <a class="btn btn-link" href="{{ url('/password/reset') }}">
          Forgot Your Password?
        </a>
      </div>
    </div>
  </form>
</div>





@endsection
