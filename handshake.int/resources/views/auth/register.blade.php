@extends('layout')

@section('content')

<div class="section--authorization">

    <div class="section--authorization__brand">
      <div class="section--authorization__brand__img">
      </div>
      <div class="section--authorization__brand__title">
          <a href="/"><h1>Handshake</h1></a>
      </div>
    </div>

    <div class="section-auth--register">
      <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- overal information -->
          <div class="section-auth__information">

            <input type="hidden" id="photo" name="photo">

            <input type="text" name="email" placeholder="Email@address.com" class="section-auth__information_input">
            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif

            <input type="text" name="name" placeholder="Name" class="section-auth__information_input">
            @if ($errors->has('name'))
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif

            <input id="submit" type="submit" class="submit-hidden"></input>

            <button type="button" name="button" class="hide-information section-auth__button uppercase">next</button>
          </div>


        <!-- face recognition -->
          <div class="section-auth__picture">
            <h2>Face recognition</h2>
            <div class="camera">
                <video id="video" width="300" height="300">Video stream not available.</video>
            </div>
            <canvas id="canvas"></canvas>
            <button type="submit" name="button" class="hide-picture" id="startbutton">take picture</button>
          </div>

        </form>
    </div>

</div>


<script src="/js/photocapture.js"></script>

@endsection
