$('.picture').hide();

$('.hide-picture').on('click', function(){
  console.log('pic gaat hiden');
  $('.picture').hide();
  $('.information').show();
});

$('.hide-information').on('click', function(){
  console.log('info gaat hiden');
  $('.information').hide();
  $('.picture').show();
});
