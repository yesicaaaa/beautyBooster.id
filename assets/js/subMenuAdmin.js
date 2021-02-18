function getData(id){
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: BASE_URL + 'master_sub_menu/getSubMenuRow',
    data: {
      id: id
    },
    success: function(data){
      $('#idEdit').val(data.id),
      $('#menuEdit').val(data.menu_id),
      $('#titleEdit').val(data.title),
      $('#iconEdit').val(data.icon),
      $('#urlEdit').val(data.url),
      $('#newEditSubMenuModal').modal()
    }
  });
}