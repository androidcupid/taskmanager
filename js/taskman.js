$(document).ready(function(){

  //switching views in dashboard.php
    
    var showact = $("a#showactive");
    var showcomp = $("a#showcomplete");

    //view active tasks
    $(showact).click(function(e){
      
      //e.preventDefault();
      $("div#alltasks").hide();
      $("div#complete").hide();
      $("div#active").show();

    });

    //view completed tasks
    $(showcomp).click(function(e){
      //e.preventDefault();
      $("div#alltasks").hide();
      $("div#active").hide();
      $("div#complete").show();
    });

//new task
$(".task_data").submit(function (event) {
    var formData = {
      name: $("#title").val(),
      email: $("#content").val()
    };

    $.ajax({
      type: "POST",
      url: "controller.php?action=newtask",
      data: $('.task_data').serialize()
      //cache: true
    }).done(function (data) {
      //console.log(data);
      //alert('success');
      $('#msg').html(data);
    });

    event.preventDefault();
  });


//delete task
  $(".delbutton").on("click",(function(event){
    var id =  $("#tid").val();
    var link = "controller.php?action=delete&taskid="+id;
    if(confirm("Are you sure you want to delete this task?"))
   {
    $.ajax({
      type: "POST",
      url: link,
      data: id
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