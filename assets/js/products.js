$(document).ready(function() {
  // $('.search').click(function(){
  //   $('input').toggleClass('form-control');
  // });

  $('.dropdown').hover(
    function(){
      $(this).css({'margin-bottom': '65%'}).slide('slow');
    },
    function(){
      $(this).css('margin-bottom', '5px');
    }
  );
});