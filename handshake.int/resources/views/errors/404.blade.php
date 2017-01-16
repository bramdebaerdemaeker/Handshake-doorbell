@extends('layout')

@section('content')
    <link type="text/css" rel="stylesheet" href="/js/leaptrainer/trainer-ui/css/leaptrainer-ui.css" />
    <div id="main" class="main">
        <div id="render-area">
        </div>
        <div id="message">What you are looking for? Well you won't find it here :D</div>
    </div>
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
    <script src="/js/leaptrainer/leaptrainer-ui.js"></script>
@endsection
