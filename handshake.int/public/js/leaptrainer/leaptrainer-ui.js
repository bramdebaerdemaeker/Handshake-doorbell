/*!
 * The MIT License (MIT)
 *
 * Copyright (c) 2013 Robert O'Leary
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * ------------------------------ NOTE ----------------------------------
 *
 * The positionPalm and positionFinger functions, as well as the structure of the leap
 * controller listener below, are based on code from jestPlay (also under the MIT license), by Theo Armour:
 *
 * 	http://jaanga.github.io/gestification/cookbook/jest-play/r1/jest-play.html
 *
 * Thanks Theo!
 *
 * ----------------------------------------------------------------------
 *
 *
 * Table of contents
 * ---------------------------
 *
 * 	1. Basic Initialization
 *	2. Setting up the options panel
 *	3. Setting up the overlay
 * 	4. Handling window resize events
 *	5. Setting up the gesture creation form
 *	6. Utility interface modification functions
 *	7. Training event listeners
 *	8. Leap controller event listeners
 *	9. WebGL rendering functions
 *	10. And finally...
 *
 * ---------------------------
 */
jQuery(document).ready(function ($) {

    /*
     * ------------------------------------------------------------------------------------------
     *  1. Basic Initialization
     * ------------------------------------------------------------------------------------------
     */

    /*
     * First we create the leap controller - since the training UI will respond to event coming directly from the device.
     */
    var controller = new Leap.Controller();

    /*
     * Now we create the trainer controller, passing the leap controller as a parameter
     */
    var trainer = new LeapTrainer.Controller({controller: controller});

    /*
     * We get the DOM crawling done now during setup, so it's not consuming cycles at runtime.
     */
    var win					= $(window),
        body				= $("body"),
        gestureCreationArea	= $('#gesture-creation-area'),
        creationForm		= $('#new-gesture-form'),
        existingGestureList = $("#existing-gestures"),
        renderArea 			= $('#render-area'),
        main				= $('#main'),
        overlayArea			= $('#overlay'),
        overlayShade		= $('#overlay-shade'),
        retrainButton 		= $('#retrain-gesture'),
        outputText			= $('#output-text'),
        wegGlWarning		= $('#webgl-warning'),
        versionTag			= $('#version-tag'),
        count 				= 0,
        gesture1            = $('#gesture1'),
        gesture2            = $('#gesture2'),
        gesture3            = $('#gesture3'),
        gesturesubmit       = $('#gesturesubmit'),
        gestureCounter      = 0,
        loginSubmit         = $('#loginSubmit'),

        /*
         * We set up the WebGL renderer - switching to a canvas renderer if needed
         */
        webGl				= Detector.webgl,
        renderer 			= webGl ? new THREE.WebGLRenderer({antialias:true}) : new THREE.CanvasRenderer(),

        /*
         * Some constant colors are declared for interface modifications
         */
        red					= '#EE5A40',
        green				= '#AFF372',
        yellow				= '#EFF57E',
        blue				= '#AFDFF1',
        white				= '#FFFFFF',

        /*
         * The WebGL variables, materials, and geometry
         */
        material 			= new THREE.MeshBasicMaterial({color: white }),		// The normal material used to display hands and fingers
        recordingMaterial 	= new THREE.MeshBasicMaterial({color: yellow }),	// The material used on hands and fingers during recording
        palmGeometry 		= new THREE.CubeGeometry(60, 10, 60),				// The geometry of a palm
        fingerGeometry 		= webGl ? new THREE.SphereGeometry(5, 20, 10) : new THREE.TorusGeometry(1, 5, 5, 5), // The geometry of a finger (simplified if using a canvas renderer)

        camera 				= new THREE.PerspectiveCamera(45, 2/1, 1, 3000),
        cameraInitialPos	= new THREE.Vector3(0, 0, 450),
        scene 				= new THREE.Scene(),
        controls 			= new THREE.OrbitControls(camera, renderer.domElement),

        /*
         * When a gesture is being rendered, not all recorded frames will necessarily be needed.  This variable controls the interval between
         * frames chosen for rendering.  If 21 frames are recorded and the gestureRenderInterval is 3, then just 7 frames will be rendered.
         */
        gestureRenderInterval = webGl ? 3 : 6,

        /*
         * And finally we declare some working variables for use below
         */
        windowHeight, 				// A holding variable for the current window height - used for calculations when the window is resized
        windowWidth, 				// The current window width
        gestureEntries 		= {},	// The list items ('LI') in the known gestures list - already jQuery-wrapped
        progressBars 		= {},	// The colored progress bar backgrounds in the list items - also jQuery-wrapped, needed for setting widths during recognition
        gestureLabels 		= {},	// The area for text at the right of gesture list entries - displays 'LEARNED' when training completes
        gestureArrows 		= {},	// The right-pointing arrow heads associated with each gesture in the gesture list
        optionsOpen 		= false,// A toggle indicating if the options panel is currently open
        overlayOpen 		= false,// A toggle indicating if the overlay is currently open
        training 			= false,// A toggle indicating if the trainer is currently training a gesture - used to disable opening of the overlay during training
        data;

    /*
     * If WebGL is supported the WebGL warning can be removed entirely - otherwise it should be made visible.
     */
    if (webGl) { wegGlWarning.remove(); } else { wegGlWarning.css({display: 'block'}); }

    /*
     * Panning is disabled as it distrupts resetting of the camera position.
     *
     * TODO: Fix the resetting, rather than just disabling panning.
     */
    controls.noPan = true;


    /*
     * ------------------------------------------------------------------------------------------
     *  2. Setting up the options panel
     * ------------------------------------------------------------------------------------------
     */

    /*
     * Opening and closing of the options area is just a jQuery animate on the left style of the main area - pushing it out of view to
     * the right and revealing the options.
     */

    /*
     *
     */

    /*
     * The options panel open/close functions are bound to the options button
     */




    /*
     * This function merges a function from one controller class into another
     */
    function modifyController(replacementController) {

        replacementController = LeapTrainer[replacementController];

        var fields = replacementController.overidden;

        var func;

        for (var field in fields) {

            func = replacementController.prototype[field];

            if (func) {

                if (func.bind) { func.bind(trainer); }

                trainer[field] 	= func;
            }
        }

        optionsUpdated();
    }


    /*
     * Now we set up the interface configuration drop-downs, which can be used to bind gestures to interface operations
     */
    var openConfigGesture = null, closeConfigGesture = null;

    function registerUIGesture (oldGesture, newGesture, func) { trainer.off(oldGesture, func); trainer.on(newGesture, func); optionsUpdated(); return newGesture; }

    /*
     * When the retrain button is clicked the overlay closes and the leaptrainer retrain() function is called for the selected gesture
     */
    retrainButton.click(function() { trainer.retrain(exportingName.html()); });


    /*
     * ------------------------------------------------------------------------------------------
     *  4. Handling window resize events
     * ------------------------------------------------------------------------------------------
     */

    /*
     * When the window resizes we update:
     *
     * 	- The dimensions of the three.js render area
     *  - The font size, left offset, and width of the output text at the top of the screen (to try to ensure it's visible even when the window gets very small)
     * 	- The height of the main area, options panel, and overlay shade (to ensure they're all always 100% of the screen height)
     *  - The size and position of the export/retrain overlay and its contents.
     */
    function updateDimensions() {

        windowHeight 		= main.innerHeight();
        windowWidth 		= main.innerWidth();

        main.css			({height: windowHeight});

        /*
         * The three.js area and renderer are resized to fit the page
         */
        var renderHeight 	= windowHeight - 5;

        renderArea.css({width: windowWidth, height: renderHeight});

        renderer.setSize(windowWidth, renderHeight);

        /*
         * When window drops below a given width , the output text is no longer centered on the screen - because if it is, it's likely
         * to end up behind the gesture creation input or button.  Instead, it's pushed over to the left somewhat in order to clear the gesture
         * creation form as much as possible.
         */
        var outputTextLeft = (windowWidth < 1000) ? 100 : 22;

        /*
         * The font of the output text is also scaled with the window width
         */
        //outputText.css({left: outputTextLeft, width: windowWidth - outputTextLeft - 22, fontSize: Math.max(22, windowWidth/55)});

    }

    /*
     * We fire the dimensions update once to set up the correct initial dimensions.
     */
    updateDimensions();

    /*
     * And then bind the update function to window resize events.
     */
    win.resize(updateDimensions);



    /*
     * The gesture creation form should fire a script when submit, rather than actually submit to a URL - so we bind a
     * function to the submit event which returns false in order to prevent the event propagating.
     *
     * Regardless of whether a gesture is created or not, the form shouldn't submit - so this function always returns FALSE.
     */
    creationForm.submit(function() {

        var name;

        if(count == 0){
            name = "gesture1";
            count += 1;
        }
        else if(count == 1){
            name = "gesture2";
            count += 1;
        }
        else if(count == 2){
            name = "gesture3";
            count += 1;

        }
        else if(count == 3){
            gesture1.val(trainer.toJSON('gesture1'));
            gesture2.val(trainer.toJSON('gesture2'));
            gesture3.val(trainer.toJSON('gesture3'));
            gesturesubmit.click();
        }
        /*
         * If the input name is empty, the default on the box, or already exists in the list of existing gestures, we just do nothing and return.
         *
         * TODO: Some sort of feedback on what happened here would be nice.
         */

        /*
         * And then we create the new gesture in the trainer and return false to prevent the form submission event propagating.
         *
         * The gesture name is upper-cased for uniformity (TODO: This shouldn't really be a requirement).
         */
        trainer.create(name, false);
        return false;
    });


    /*
     * ------------------------------------------------------------------------------------------
     *  6. Utility interface modification functions
     * ------------------------------------------------------------------------------------------
     */

    /**
     * Sets the output text at the top of the screen.  If no parameter is passed, the text is set to an empty string.
     */
    function setOutputText(text) { outputText.html(text ? text : ''); };


    /**
     * Updates the whole interface to a disabled state.  This function is used when the connection to the Leap Motion is lost.
     */
    function disableUI(color, message) {

        main.css({background: color});

        gestureCreationArea.css({display: 'none'});
        versionTag		   .css({display: 'none'});
        forkMe			   .css({display: 'none'});

        //outputText.css({background: 'transparent'});

        setOutputText(message);
    }

    /**
     * Re-enables the UI after it has been disabled.
     */
    function enableUI(message) {

        main.css({background: ''});

        gestureCreationArea.css({display: ''});
        versionTag		   .css({display: ''});
        forkMe			   .css({display: ''});

        //outputText.css({background: ''});

        setOutputText(message);
    }

    function gestureCount() {
        gestureCounter += 1;
    }
    /*
     * ------------------------------------------------------------------------------------------
     *  7. Training event listeners
     * ------------------------------------------------------------------------------------------
     */

    /*
     * When a new gesture is created by the trainer, an entry is added to the gestures list.
     */
    trainer.on('gesture-created', function(gestureName, trainingSkipped) {
        setOutputText('Gesture created!');
    });

    /*
     * During a training countdown we update the output text.
     */
    trainer.on('training-countdown', function(countdown) {

        training = true;

        setOutputText('Starting training in ' + countdown + ' second' + (countdown > 1 ? 's' : ''));
    });

    /*
     * When training starts we reset the gesture progress bar, show the arrow on the gesture list entry, and change the progress bar to yellow.
     * The output text is updated to display how many training gestures need to be performed.
     */
    trainer.on('training-started', function(gestureName) {

        $('#progress').css({widht: 33+'%'});

        var trainingGestureCount = trainer.trainingGestures;
        console.log("training start");
        setOutputText('Perform the ' + gestureName + ' gesture or pose ' + (trainingGestureCount > 1 ? trainingGestureCount + ' times' : ''));
    });

    /*
     * When a training gesture is successfully saved, we render the gesture, update the progress bar on the gesture list entry, and
     * update the output text to display how many more gestures need to be performed.
     */
    trainer.on('training-gesture-saved', function(gestureName, trainingSet) {
        var trainingGestures = trainer.trainingGestures;

        renderGesture();
        $('#progress').css({widht: 66+'%'});
        var remaining = (trainingGestures - trainingSet.length);
        setOutputText('Perform the ' + gestureName + ' gesture ' + (remaining == 1 ? ' once more' : remaining + ' more times'));
    });

    /*
     * When training completes we render the final training gesture, update the output text and gesture label, and set the gesture scale to
     * 100% and green.
     */
    trainer.on('training-complete', function(gestureName, trainingSet, isPose) {
        console.log("training complete");
        training = false;

        renderGesture();

        setOutputText(gestureName + (isPose ? ' pose' : ' gesture') + ' learned!');
    });

    /*
     * When a known gesture is recognised we select it in the gesture list, render it, update the gesture list entry progress bar to
     * match the hit value, and set the output text.
     */

    trainer.on('gesture-recognized', function(hit, gestureName, allHits) {

        renderGesture();
        if(trainer.hasData() == true){
            if(gestureCounter == 0){
                console.log('1');
                trainer.on('gesture1', gestureCount);
            }
            else if(gestureCounter == 1){
                console.log('2');
                trainer.on('gesture2', gestureCount);
            }
            else if(gestureCounter == 2) {
                console.log('3');
                trainer.on('gesture3', gestureCount);
                loginSubmit.click();
            }
        }
        var hitPercentage = Math.min(parseInt(100 * hit), 100);

        setOutputText('<span style="font-weight: bold">' + gestureName + '</span> : ' + hitPercentage + '% MATCH');

    });

    /*
     * When an unknown gesture is recorded we unselect all gestures in the list, update all gesture progress bars with the list of hit
     * values that did come back (all of which will be below trainer.hitThreshold) and empty the output text.  We also clear any currently
     * rendered gesture.
     */
    trainer.on('gesture-unknown', function(allHits) {

        setOutputText();


        clearGesture();
    });

    /*
     * ------------------------------------------------------------------------------------------
     *  8. Leap controller event listeners
     * ------------------------------------------------------------------------------------------
     */

    /*
     * When the controller connects to the Leap web service we update the output text
     */
    controller.on('connect', function() { setOutputText('Create a gesture to get started'); });

    /*
     * BLUR and FOCUS event listeners can be added in order to display that the trainer is no longer listening for
     * input when the browser window blurs.
     *
     * Currently these listeners are not enabled by default, since it seems intrusive.
     */
    //controller.on('blur',	 function() { disableUI('#DDD'); setOutputText('Focus lost'); });
    //controller.on('focus', function() { enableUI(); 		 setOutputText('Focus regained');});

    /*
     * When the connection to the Leap is lost we set the output text and disable the UI, making the background an alarming RED.
     */
    controller.on('deviceDisconnected', function() { disableUI(red, 'DISCONNECTED!  Check the connection to your Leap Motion'); });

    /*
     * When the connection to the Leap is restored, we re-enable the UI.
     */
    controller.on('deviceConnected', function() { enableUI('Connection restored!'); });


    /*
     * ------------------------------------------------------------------------------------------
     *  9. WebGL rendering functions
     * ------------------------------------------------------------------------------------------
     */

    /*
     * The camera is set to its initial position
     */
    camera.position.set(cameraInitialPos.x, cameraInitialPos.y, cameraInitialPos.z);

    /*
     * The renderer is added to the rendering area in the DOM.  The size of the renderer will be modified when the window is resized.
     */
    renderArea.append(renderer.domElement);

    /*
     * Creates a palm mesh
     */
    function createPalm() { return new THREE.Mesh(palmGeometry, material); }

    /*
     * Creates a finger mesh
     */
    function createFinger() { return new THREE.Mesh(fingerGeometry, material); }

    /*
     * An inital pair of palm meshs and ten fingers are added to the scene. The second palm and second five fingers
     * are initially invisible.  The first palm and fingers are set in a default pose below.
     */
    var palms = [createPalm(), createPalm()];

    palms[1].visible = false;

    scene.add(palms[0]);
    scene.add(palms[1]);

    var finger, fingers = [];

    for (var j = 0; j < 10; j++) {

        finger = new THREE.Mesh(fingerGeometry, material);

        finger.visible = j < 5;

        scene.add(finger);

        fingers.push(finger); // Finger meshes are stored for animation below
    }

    /*
     * We set default a default pose for the one visible (right) hand
     */
    var defaultHandPosition = true; // This is a flag used to indicate if the scene is currently just showing the default pose

    palms[0].position.set(-5.62994, -37.67400000000001, 96.368);
    palms[0].rotation.set(-2.0921488149553125, 0.051271951412566935, -2.6597446090413466);

    fingers[0].position.set(34.179, 24.22, 28.7022);
    fingers[0].rotation.set(-2.777879785829599, 0.02183472660404244, 3.133282166633954);
    fingers[0].scale.z = 8;

    fingers[1].position.set(53.8033, -15.913000000000011, 32.6661);
    fingers[1].rotation.set(-2.7753644328170965, 0.22532594370921782, 3.056111568660471);
    fingers[1].scale.z = 5;

    fingers[2].position.set(4.69965, 49.19499999999999, 31.643);
    fingers[2].rotation.set(-2.600622653205929, 0.033504548426940645, 3.121471314695975);
    fingers[2].scale.z = 9;

    fingers[3].position.set(-23.7075, 50.976, 50.363);
    fingers[3].rotation.set(-2.543443897235925, 0.04106473211751575, 3.113625377842598);
    fingers[3].scale.z = 8;

    fingers[4].position.set(-80.6532, -33.772999999999996, 84.7031);
    fingers[4].rotation.set(-2.589002343898949, -0.4631619960981157, -2.872745378807403);
    fingers[4].scale.z = 6;

    /*
     * Updates the material of the palm and fingers created above.  This function is called when recording starts and ends, in order to
     * modify how visible hands look during recording.
     */
    function setHandMaterial(m) {

        palms[0].material = m;
        palms[1].material = m;

        for (var i = 0, l = fingers.length; i < l; i++) { fingers[i].material = m; }
    }

    /*
     * We set the recording material during recording.
     */
    trainer.on('started-recording', function () { setHandMaterial(recordingMaterial); })
        .on('stopped-recording', function () { setHandMaterial(material); });

    /*
     * We use Paul Irish's requestAnimFrame function (which is described
     * here: http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/) for
     * updating the scene.
     *
     */
    window.requestAnimFrame = (function(){
        return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function(callback){ window.setTimeout(callback, 1000 / 60); };
    })();

    /*
     * And bind a simple update function into the requestAnimFrame function
     */
    function updateRender() { controls.update(); TWEEN.update(); renderer.render(scene, camera); requestAnimFrame(updateRender); }

    requestAnimFrame(updateRender);

    /*
     * In order to avoid as much variable creation as possible during animation, variables are created here once.
     */
    var hand, palm, position, direction, normal, handFingers, handFingerCount, finger, handCount, palmCount = palms.length;

    /*
     * TODO: WHY is it necessary to offset mesh positions on the y-axis by 170? I don't know at the moment - but this bit of nonsense should be fixed.
     */
    var yOffset = -170;

    /*
     * This section animates the fingers and palm.
     *
     * The positionPalm and positionFinger functions, as well as the structure of the leap controller listener below, are based on code
     * from jestPlay (also under the MIT license), by Theo Armour:
     *
     * 	http://jaanga.github.io/gestification/cookbook/jest-play/r1/jest-play.html
     *
     * Thanks Theo!
     */

    /**
     *
     */
    function positionPalm(hand, palm) {

        position = hand.stabilizedPalmPosition || hand.position;

        palm.position.set(position[0], position[1] + yOffset, position[2]);

        direction = hand.direction;

        palm.lookAt(new THREE.Vector3(direction[0], direction[1], direction[2]).add(palm.position));

        normal = hand.palmNormal || hand.normal;

        palm.rotation.z = Math.atan2(normal[0], normal[1]);
    }

    /**
     *
     */
    function positionFinger(handFinger, finger) {

        position = handFinger.stabilizedTipPosition || handFinger.position;

        finger.position.set(position[0], position[1] + yOffset, position[2]);

        direction = handFinger.direction;

        finger.lookAt(new THREE.Vector3(direction[0], direction[1], direction[2]).add(finger.position));

        finger.scale.z = 0.1 * handFinger.length;
    }

    /*
     * Now we set up a Leap controller frame listener in order to animate the scene
     */
    var clock = new THREE.Clock();

    clock.previousTime = 1000000;

    controller.on('frame', function(frame) {

        if (clock.previousTime === 1000000) {

            handCount = frame.hands.length;

            for (var i = 0; i < palmCount; i++) { // We attempt to position all (normally, both) rendered hands

                palm = palms[i];

                if (i >= handCount) {

                    if (!defaultHandPosition) { // If the default pose is showing we don't update anything

                        palm.visible = false;

                        for (var j = 0, k = 5, p; j < k; j++) { p = (i * 5) + j; fingers[p].visible = false; };
                    }

                } else {

                    defaultHandPosition = false;

                    hand = frame.hands[i];

                    positionPalm(hand, palm);

                    palm.visible = true;

                    handFingers 	= hand.fingers;
                    handFingerCount = handFingers.length;

                    /*
                     *
                     */
                    for (var j = 0, k = 5; j < k; j++) {

                        finger = fingers[(i * 5) + j];

                        if (j >= handFingerCount) {

                            finger.visible = false;

                        } else {

                            positionFinger(handFingers[j], finger);

                            finger.visible = true;
                        }
                    };
                }
            }
        }
    });

    /*
     * Finally we set up the rendering of gestures.  Gestures are rendered by placing hand renders periodically along a recorded set of
     * hand positions.
     *
     * We save each render in the renderedHands array so that the previous gesture can be deleted before a new one is rendered.
     */
    var renderedHands = [];

    /*
     * Removes the currently rendered gesture, if any.
     */
    function clearGesture() {

        new TWEEN.Tween(camera.position).to({x: cameraInitialPos.x, y: cameraInitialPos.y, z: cameraInitialPos.z}).easing(TWEEN.Easing.Exponential.Out).start();
        new TWEEN.Tween(camera.rotation).to({x: 0, y: 0, z: 0}).easing(TWEEN.Easing.Exponential.Out).start();

        for (var i = 0, l = renderedHands.length; i < l; i++) { scene.remove(renderedHands[i]); }

        renderedHands = [];
    }

    /**
     * This function is called when a training gesture is saved and when a gesture is recognized.  It depends on the LeapTrainer
     * Controller providing a renderableGesture array.
     */
    function renderGesture() {

        if (!webGl) { return; } // Gesture renders are entirely disabled for canvas renderers (it's just too slow at the moment!)

        /*
         * Only one gesture is rendered at a time, so first the current gesture - if any - is removed.
         */
        clearGesture();

        /*
         * The LeapTrainer controller should provide a renderableGesture array, which should always contain positioning data for the
         * LAST gesture recorded.
         */
        var gestureFrames = trainer.renderableGesture;

        if (!gestureFrames || gestureFrames.length == 0) { return; } // If the controller doesn't supply this variable, or the array is empty, we return.

        /*
         * Some variables are set up in order to avoid creation in the loops
         */
        var frame, hand, handObject, palm, fingers, finger, fingerMesh, material;

        for (var i = 0, l = gestureFrames.length; i < l; i += gestureRenderInterval) { // Not all frames are necessarily rendered

            frame = gestureFrames[i];

            /*
             * TODO: It sucks that new materials are being created in a loop here - but the frame count is variable, and the opacity increases
             * as the frame gets closer to the end.. So for the moment, this is how it is.
             */
            material = new THREE.MeshBasicMaterial({wireframe: true, color: white, transparent: true, opacity: Math.min(0.02 * i, 0.5) });

            for (var j = 0, k = frame.length; j < k; j++) {

                hand = frame[j];

                handObject = new THREE.Object3D();

                /*
                 * Palm
                 */
                palm = createPalm();

                palm.material = material;

                positionPalm(hand, palm);

                handObject.add(palm);

                /*
                 * Fingers
                 */
                fingers = hand.fingers;

                for (var p = 0, q = fingers.length; p < q; p++) {

                    finger = fingers[p];

                    fingerMesh = createFinger();

                    fingerMesh.material = material;

                    positionFinger(finger, fingerMesh);

                    handObject.add(fingerMesh);
                }

                renderedHands.push(handObject);

                scene.add(handObject);
            }
        }
    }


    /*
     * ------------------------------------------------------------------------------------------
     *  10. And finally...
     * ------------------------------------------------------------------------------------------
     */

    /*
     * And finally we connect to the device
     */
    controller.connect();
});
