$('.section-auth__picture').hide();

$('.hide-picture').on('click', function(){
  console.log('pic gaat hiden');
  $('.section-auth__picture').hide();
  $('.section-auth__information').show();
});

$('.hide-information').on('click', function(){
  console.log('info gaat hiden');
  $('.section-auth__information').hide();
  $('.section-auth__picture').show();
});
