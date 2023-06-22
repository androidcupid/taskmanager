<?php
include('includes/header.php'); 
include('includes/connection.php'); 
if(!isset($_SESSION['user'])){
	header('location: index.php');
}
?>
<div class="container">
	<div id="msg"></div>
	<a class ="badge" href="dashboard.php?view=active"><<< Back </a>
	<div class="new-task">
		<h1 class="display-2 text-center">New Task</h1>

		<form method="POST" action="controller.php" class="task_data">
							
			<input type="text" class="form-control" name="title" id="title"placeholder="Title" required/>
							
			<textarea type="textbox" class="form-control" name="content" id="content" style="height:200px" placeholder="Description...." required> </textarea>							

			<button type="submit" class="btn btn-success" id="newtask">POST</button>
						
		</form>
	</div>
	
</div>
<?php
include('includes/footer.php'); 

?>
