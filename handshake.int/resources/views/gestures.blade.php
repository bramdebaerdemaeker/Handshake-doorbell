@extends('layout')

@section('content')
    <link type="text/css" rel="stylesheet" href="/js/leaptrainer/trainer-ui/css/leaptrainer-ui.css" />
    <div id="body" class="section">
        <div id="main">
            <div id="gesture-creation-area">
                <form id="new-gesture-form">
                    <input type="text" id="new-gesture-name" value="Create a Gesture" maxlength="15" autocomplete="off"/>
                    <input type="submit" id="create-new-gesture" value="Create" class="button"/>
                </form>
                <img src="./trainer-ui/images/create-arrow.png" />
            </div>
            <div id="render-area">
            </div>
        </div>
        <div id="output-text"></div>
        <div id="overlay-shade"></div>

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

    <script src="/js/leaptrainer/leaptrainer-ui.js"></script>
    <script src="/js/leaptrainer/gestureController.js"></script>

@endsection
