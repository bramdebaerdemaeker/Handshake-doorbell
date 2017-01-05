@extends('layout')

@section('content')

<!-- <div class="section">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="photo" name="photo">
      @if ($errors->has('email'))
          <span class="help-block">
          <strong>Zet je camera aan!</strong>
        </span>
      @endif
      <input type="email" name="email" placeholder="email">
      @if ($errors->has('email'))
          <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
      <input type="text" name="name">
      @if ($errors->has('name'))
          <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
      <input id="submit" type="submit" ></input>
  </form>

    <div class="camera">
    </div>
    <canvas id="canvas">
    </canvas>
    <button id="startbutton">Button</button>

</div> -->


<div class="section">

    <div class="section-register">
      <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="information">
            <h2>Become a member </h2>

            <input type="hidden" id="photo" name="photo">
            @if ($errors->has('email'))
                <strong>Zet je camera aan!</strong>
              </span>
            @endif

            <input type="text" name="email" placeholder="Email">
            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif

            <input type="text" name="name" placeholder="Name">
            @if ($errors->has('name'))
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif

            <input id="submit" type="submit" class="submit-hidden"></input>

            <button type="button" name="button" class="hide-information">next</button>
          </div>
          <div class="picture">
            <h2>Face recognition</h2>
            <div class="camera">
                <video id="video">Video stream not available.</video>
            </div>
            <canvas id="canvas"></canvas>
            <button type="submit" name="button" class="hide-picture" id="startbutton">take picture</button>
          </div>
        </form>
    </div>

</div>


<script src="/js/photocapture.js"></script>

@endsection
