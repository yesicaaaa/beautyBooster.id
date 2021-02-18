function getData(id){
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: BASE_URL + 'master_menu/getMenuRow',
    data: {
      id: id
    },
    success: function(data){
      $('#idEdit').val(data.id);
      $('#menuEdit').val(data.menu);
      $('#newEditMenuModal').modal();
    }
  });
}