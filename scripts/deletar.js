function deletar(id){
    document.getElementById("rowHide"+id).style.display = 'none';
    $.ajax({
      type:'post',
      url: 'upload.php',
      data:{id_deletar:id},
      success:function(data){
      }
    });
  }