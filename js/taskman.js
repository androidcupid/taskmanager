$(document).ready(function () {

  //switching views in dashboard.php
    var showact = $("a#showactive");
    var showcomp = $("a#showcomplete");
    $(showact).click(function(e){
      //e.preventDefault();
      $("div#alltasks").hide();
      $("div#complete").hide();
      $("div#active").show();

    });
    $(showcomp).click(function(e){
      //e.preventDefault();
      $("div#alltasks").hide();
      $("div#active").hide();
      $("div#complete").show();
    });

//login
    $("#loginform").submit(function (event) {
    var formdata =  {
      username: $("#username").val(),
      password: $("#password").val()
   }
    
    $.ajax({
      type: "POST",
      url: "controller.php",
      data:  formdata.serialize(),
      //cache: true
    }).done(function (data) {
      console.log(data);
      
      window.setTimeout(function(){
     $('#msg').html(data);
    }, 1000);
    });

    event.preventDefault();
  });

//new task
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
      //$("#task_data").reset();
    });

    event.preventDefault();
  });

//edit task
  $("#editform").submit(function (event) {
    var id = $('#tid').val();
    var link = "controller.php?action=edit&tid="+id;
    console.log(link);
    var editform = {
      content: $('#content').val(),
      status: $('#status').val()
    }
    $.ajax({
      type: "POST",
      url: link,
      data: editform,
      //cache: true
    }).done(function (data) {
      console.log(link);
      console.log(data);
      $('#msg').html(data);
      
    });

    event.preventDefault();
  });

//delete task
  $(".delbutton").on("click",(function (event) {
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
    }, 2000);
    });
}
    event.preventDefault();
  }));
});