@extends('layout')

@section('content')
    <link type="text/css" rel="stylesheet" href="/js/leaptrainer/trainer-ui/css/leaptrainer-ui.css" />
          <div id="main" class="main">
              <div id="gesture-creation-area">
                  <form id="new-gesture-form" class="gesture-form">
                      <input type="submit" id="create-new-gesture" value="Create gesture" class="button"/>

                  </form>
              </div>
              <div id="render-area">
              </div>
              <div id="output-text"></div>
              <div class="progress-bar" >
                <div id="#progress">
                  progress
                </div>
              </div>
          </div>
    <form action="/saveGestures" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="gesture1" name="gesture1">
        <input type="hidden" id="gesture2" name="gesture2">
        <input type="hidden" id="gesture3" name="gesture3">
        <input type="submit" id="gesturesubmit">
    </form>
    <script src="/js/leaptrainer/trainer-ui/js/jquery.min.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/jquery.touchwipe.min.js"></script>

    <script src="/js/leaptrainer/trainer-ui/js/three.min.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/detector.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/tween.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/orbit-controls.js"></script>

    <script src="https://js.leapmotion.com/leap-0.6.4.min.js"></script>
    <script src="/js/leaptrainer/leaptrainer.js"></script>

    <script src="/js/leaptrainer/sub-classes/high-resolution-recording.js"></script>
    <script src="/js/leaptrainer/sub-classes/lib/brain.js"></script>
    <script src="/js/leaptrainer/sub-classes/neural-networks.js"></script>
    <script src="/js/leaptrainer/sub-classes/cross-correlation.js"></script>
    <script type="text/javascript">
        window.onload = function () {
            var controller = new Leap.Controller();
            var trainer = new LeapTrainer.Controller({controller: controller});
            trainer.fromJSON('{!! $data[0] !!}');
            trainer.fromJSON('{!! $data[1] !!}');
            trainer.fromJSON('{!! $data[2] !!}');
        };
    </script>
    <script src="/js/leaptrainer/leaptrainer-ui.js"></script>

@endsection
