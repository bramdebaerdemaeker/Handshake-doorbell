@extends('layout')

@section('content')
  <div class="section section-contact">
    <div class="contact-image">
      <h1 class="uppercase">contact us</h1>
    </div>
    <div class="contact-content">
      <div class="form">
        <form method="post" autocomplete="on">

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email">
          </div>

          <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" rows="8" cols="80"></textarea>
          </div>

          <div class="form-group">
            <button type="button" name="button" class="uppercase">send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
