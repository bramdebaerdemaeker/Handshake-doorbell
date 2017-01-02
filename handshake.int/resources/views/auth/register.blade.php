@extends('layout')

@section('content')

<div class="section">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}
          <input type="image" id="photo" alt="The screen capture will appear in this box.">
      <input id="submit" type="submit" ></input>
  </form>

    <div class="camera">
        <video id="video">Video stream not available.</video>
    </div>
    <canvas id="canvas">
    </canvas>
    <div class="output">
        <img id="photo" alt="The screen capture will appear in this box.">
    </div>
    <button id="startbutton">Button</button>
    <script src="/js/photocapture.js"></script>
</div>



@endsection
