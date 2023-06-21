$(document).ready(function () {
  $("#task_data").submit(function (event) {
    var formData = {
      name: $("#title").val(),
      email: $("#content").val(),
    };

    $.ajax({
      type: "POST",
      url: "controller.php?action=newtask",
      data: $('#task_data').serialize(),
      //cache: true
    }).done(function (data) {
      //console.log(data);
      //alert('success');
      $('#msg').html(data);
    });

    event.preventDefault();
  });


  $("#del").on("click",(function (event) {
    var id =  $("#tid").val();
    var link = "controller.php?action=delete&taskid="+id;
    if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
      type: "POST",
      url: link,
      data: id,
      //cache: true
    }).done(function (data) {
      console.log(link);
      //alert('success');
      console.log(data);
      $('#msg').html(data);
      window.setTimeout(function(){
     
     $('.col').load('div#complete');
    }, 1000);
    });
}
    event.preventDefault();
  }));
});