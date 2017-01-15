@extends('layout')

@section('content')

<!-- <div class="section">
  <form method="POST" action="{{ url('/login') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
  <div class="picture">
    <h2>Face recognition</h2>
    <div class="camera">
      <video id="video">Video stream not available.</video>
    </div>
    <canvas id="canvas"></canvas>
    <button type="submit" name="button" class="hide-picture" id="startbutton">take picture</button>
  </div>
      <input type="hidden" id="photo" name="photo">
  </form>
</div> -->



<div class="section--authorization">

    <div class="section--authorization__brand">
      <div class="section--authorization__brand__img">
      </div>
      <div class="section--authorization__brand__title">
          <a href="/"><h1>Handshake</h1></a>
      </div>
    </div>

    <div class="section-auth--register">
      <form method="POST" action="{{ url('/login') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- face recognition -->
          <div class="section-auth__picture">
            <h2>Show us your beautiful smile</h2>
            <div class="camera">
                <video id="video" width="300" height="300">Video stream not available.</video>
            </div>
            <canvas id="canvas"></canvas>
            <button type="submit" name="button" class="hide-picture" id="startbutton"><i class="fa fa-camera fa-2x" aria-hidden="true"></i></button>
          </div>

        </form>

        <div class="section-auth__login">
          <a href="/login">Not a member yet? <span>Sign up!</span></a>
        </div>
    </div>

</div>


<script src="/js/photocapture.js"></script>


@endsection
