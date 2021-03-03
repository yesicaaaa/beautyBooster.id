$(document).ready(function(){
  //navbar
  $()

  // carousel
  $('.navbar-toggler').click(function(){
    if($(this).attr('aria-expanded', 'true')){
      $('.carousel').css('margin-top', '-100px');
    }else{
      $('.carousel').css('margin-top', '-56px');
    }
  });
});