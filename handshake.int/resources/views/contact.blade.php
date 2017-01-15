@extends('layout')

@section('content')
  <div class="section--contact">
    <div class="section--contact__content">
      <div class="section--contact__content__title">
        <h2 class="uppercase">contact</h2>
      </div>
      <div class="section--contact__content__body">
        Your questions and special </br> requests are always welcome.
      </div>
      <div class="form">
        <div class="mail"></div>
        <form action="">
          <h2 class="uppercase">contact us</h2>
          <input type="text" placeholder="Your name"/>

          <input type="text" placeholder="E-mail"/>

          <textarea name="" id="" cols="30" rows="10" placeholder="Message"></textarea>

          <div class="submit">Send</div>

        </form>
    </div>

    </div>


  <div class="ok_message">
  <span>We'll answer you soon!</span></div>
  </div>


@stop
