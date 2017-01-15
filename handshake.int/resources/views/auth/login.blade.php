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
</div>



</div>


<script src="/js/photocapture.js"></script>


@endsection
