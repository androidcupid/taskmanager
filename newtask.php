<?php
include('includes/header.php'); 
include('includes/connection.php'); 
if(!isset($_SESSION['user'])){
	header('location: index.php');
}
?>
<div class="container">
	<div class="new-task">
		<h1 class="display-2 text-center">New Task</h1>

		<form method="POST" action="controller.php">
							
			<input type="text" class="form-control" name="title" placeholder="Title" required/>
							
			<textarea type="textbox" class="form-control" name="content" style="height:200px" placeholder="Description...." required> </textarea>							

			<button class="btn btn-success" name="newtask">POST</button>
						
		</form>
	</div>
	
</div>
<?php
include('includes/footer.php'); 

?>
