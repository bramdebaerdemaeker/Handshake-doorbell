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
        <div id="options">

            <table>
                <tbody>
                <tr><td class="label">Recording Trigger</td><td><select id="recording-triggers"></select></td></tr>
                <tr><td class="label">Gesture encoding</td><td><select id="recording-strategies"></select></td></tr>
                <tr><td class="label">Recognition Strategy</td><td><select id="recognition-strategies"></select></td></tr>

                <tr><td class="label">&nbsp;</td><td>&nbsp;</td></tr>

                <tr><td class="label">Min. gesture velocity</td><td><input type="text" id="minRecordingVelocity"/></td></tr>
                <tr><td class="label">Max. pose velocity</td><td><input type="text" id="maxRecordingVelocity"/></td></tr>

                <tr><td class="label">Min. gesture frames</td><td><input type="text" id="minGestureFrames"/></td></tr>
                <tr><td class="label">Min. pose frames</td><td><input type="text" id="minPoseFrames"/></td></tr>

                <tr><td class="label">Hit threshold</td><td><input type="text" id="hitThreshold"/></td></tr>
                <tr><td class="label">Training gestures</td><td><input type="text" id="trainingGestures"/></td></tr>
                <tr><td class="label">Convolution factor</td><td><input type="text" id="convolutionFactor"/></td></tr>
                <tr><td class="label">Down-time</td><td><input type="text" id="downtime"/></td></tr>

                <tr><td class="label">&nbsp;</td><td>&nbsp;</td></tr>

                <tr><td class="label">Open options</td><td><select id="open-configuration"><option></option></select></td></tr>
                <tr><td class="label">Close options</td><td><select id="close-configuration"><option></option></select></td></tr>
                </tbody>
            </table>

            <div id="options-update-confirmation">Configuration Updated!</div>
        </div>

        <div id="overlay-shade"></div>

        <div id="overlay">
            <div>
                <p>To use the <b id="exporting-gesture-name"></b> gesture, copy the text in the text area below and import it into a <b>LeapTrainer.Controller</b> using the <b>fromJSON</b> function:</p>

                <p id="sample-import-code">
                    var trainer = new LeapTrainer.Controller();
                    <br/>
                    trainer.fromJSON('<i id="exporting-gesture-sample-text"></i>');
                </p>
            </div>
            <div>
                <textarea id="export-text"></textarea>

                <input type="button" id="retrain-gesture" value="Retrain" class="button"/>
                <input type="button" id="close-overlay" value="Close" class="button"/>
            </div>
        </div>

        <div id="webgl-warning"><b>WARNING:</b> Your browser does not support WebGL. Rendering quality is limited and gesture trails are disabled.</div>
    </div>

    <script src="/js/leaptrainer/trainer-ui/js/jquery.min.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/jquery.touchwipe.min.js"></script>

    <script src="/js/leaptrainer/trainer-ui/js/three.min.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/detector.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/tween.js"></script>
    <script src="/js/leaptrainer/trainer-ui/js/orbit-controls.js"></script>

    <script src="https://js.leapmotion.com/leap-0.6.4.min.js"></script>
    <script src="/js/leaptrainer/leaptrainer.min.js"></script>

    <script src="/js/leaptrainer/sub-classes/high-resolution-recording.js"></script>
    <script src="/js/leaptrainer/sub-classes/lib/brain.js"></script>
    <script src="/js/leaptrainer/sub-classes/neural-networks.js"></script>
    <script src="/js/leaptrainer/sub-classes/cross-correlation.js"></script>

    <script src="/js/leaptrainer/leaptrainer-ui.min.js"></script>
    <script src="/js/leaptrainer/gestureController.js"></script>

@endsection
