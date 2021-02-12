$(document).ready(function() {
  // $('.search').click(function(){
  //   $('input').toggleClass('form-control');
  // });

  $('.dropdown').hover(
    function(){
      $(this).css({'margin-bottom': '80%'});
    },
    function(){
      $(this).css('margin-bottom', '5px');
    }
  );
});