@extends('layout')

@section('content')

    <div class="home" id="home">
      <h1 class="uppercase">the best</br>new way to login</h1>
    </div>

    <div class="container">

      <!-- section 1 -->
      <div class="section--feature-1" id="feature">
        <div class="section--feature-1__intro">
          <h1>Introducing Handshake</h1>
        </div>
        <div class="section__bg-image">
          <div class="section__content animation-element animation-element--slide-left">
            <div class="section__content__title">
              <h2><span>A faster, safer</span> </br> way to sign in.</h2>
            </div>
            <div class="section__content__body">
              <p>
                Meet the latest new way to sign in on all of your favorite platforms.
                Forget about card readers, batches and fingerprint sensors, Shakure brings back the fun in a daily routine as "sign in".
              </p>
              <p>
                Shakure is made to get rid of all of your time waisting login - type moments
                and replace it with a way of authenticating that you'll never forget.

            </p>
              <p>
                It's all the security of two - factor authentication, but all the convenience of Shakure.
              </p>
            </div>
          </div>
          <div class="section__img">
            <!-- <img src="http://placehold.it/400x450"> -->
          </div>
        </div>
      </div>

      <!-- section 2 -->
      <div class="section--feature-2">

        <div class="section__img animation-element animation-element--slide-up">
          <img src="http://placehold.it/400x450">
        </div>

        <div class="section__content animation-element animation-element--slide-right">
          <div class="section__content__title">
            <h2><span>No keys </br> No touch</span> </br> Just signing in.</h2>
          </div>
          <div class="section__content__body">
            <p>
              Shakure is made for the purpose of getting things done more efficiently and uses the latest safety technologies,
              making signing in faster and more secure than ever before.
            </p>
            <p>
              You'll never have to open or touch anything. Just look in the camera, do your familiar handshake and you're in!
          </p>
            <p>
              Not only is it fast and safe, it creates a smile on your face knowing signing in can be this easy.
            </p>
          </div>
        </div>
      </div>

      <!-- section 3 -->
      <div class="section--feature-3">
        <div class="section__content">
          <div class="section__content__title">
            <h2>Watch </br><span>and be convinced.</span></h2>
          </div>
        </div>
        <div class="section__img">
          <iframe src="http://player.vimeo.com/video/63534746" width="800" height="450"></iframe>
        </div>
      </div>

      <!-- section 4-->
      <div class="section--count animation-element animation-element--count" id="count">
          <div class="section--count__number">
            <span class="count">87</span><span>%</span>
            <h3 class="uppercase">faster</h3>
          </div>
          <div class="section--count__number">
            <span class="count">100</span><span>%</span>
            <h3 class="uppercase">secure</h3>
          </div>
          <div class="section--count__number">
            <span class="count">76</span><span>%</span>
            <h3 class="uppercase">easier</h3>
          </div>
      </div>

      <!-- section 5 -->
      <div class="section--service">
        <div class="">
          <h1>Shakure services</h1>
          <p>Now. Are you interested in a safe and fast, enjoyable </br> sign in process again? Just give it a try. </br> It's free</p>
            <a href="register"><button type="button" name="button" class="uppercase btn--section-service">try it now</button></a>
        </div>

      </div>

    </div>

@stop
