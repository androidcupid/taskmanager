<?php
include('includes/header.php'); 
include('includes/connection.php'); 
if(!isset($_SESSION['user'])){
	header('location: index.php');
}

if(isset($_GET['taskid'])){
$taskid = $_GET['taskid'];

$edit = "SELECT * FROM task WHERE task_id='$taskid'";
$rs_edit = mysqli_query($connection,$edit);

if ($rs_edit) {
	while($rows=mysqli_fetch_array($rs_edit)){
		echo '
		<div class="container">

		<div id="msg"></div>

		<a class ="badge" href="dashboard.php?view=active"><<< Back </a>
			<div class="new-task">
				<h1 class="display-2 text-center">Edit Task</h1>

				<form method="POST" id="editform" action="controller.php?action=edit&tid='.$rows['task_id'].'">
					<label><strong>Title</strong></label>				
					<input type="text" class="form-control" name="title" placeholder="Title" value="'.$rows['task_title'].'" disabled="true" required/>
					<label><strong>Description</strong></label>				
					<textarea type="textbox" class="form-control" id="content" name="content" style="height:200px" placeholder="Description...." required>'.$rows['task_content'].'</textarea>							
					<label><strong>Status</strong></label>
					
					<select class="form-control bg-primary" id="status" name="status">
						<option value="active">Active</option>
						<option value="complete">Complete</option>
					</select>

					<input type="hidden" id="tid" value="'.$rows['task_id'].'"/>

					<button type="submit" class="btn btn-success">Update Task</button>
								
				</form>
			</div>
			
		</div>

		';
	}
}
}
?>


