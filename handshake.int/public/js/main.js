(function(){
  var $animation_elements = $('.animation-element');
  var $window = $(window);
  var $count_elements = $('.count');

  $window.on('scroll resize', check_if_in_view);
  $window.trigger('scroll');

  function check_if_in_view() {
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);

  $.each($animation_elements, function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);

    //check to see if this current container is within viewport


    if ((element_bottom_position >= window_top_position + 200) &&
        (element_top_position <= window_bottom_position + 200)) {
      count();
      if ((element_bottom_position >= window_top_position - 250) &&
          (element_top_position <= window_bottom_position - 250)) {
        $element.addClass('in-view');
      } else {
        $element.removeClass('in-view');
      }
    }
  });
}

function count(){
  $.each($count_elements, function(){
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });
}
})();
