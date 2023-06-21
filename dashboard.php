
<?php 
include('includes/header.php'); 
include('includes/connection.php'); 
if(!isset($_SESSION['user'])){
	header('location: index.php');
}
$posts = "SELECT * FROM task";

$rs = mysqli_query($connection,$posts);

if ($rs) {
	//echo '<main>';
	echo '<div class="container">

			<div class="row">
				<div class="col-md-3">

					<div class="card" style="">			  
					  <div class="card-body">
					    <h5 class="card-title"><i class="fa fa-user"></i>'.$_SESSION['user'].'</h5>
						';
					    
					
							echo '
							<ul class="list-group">
								<li class="list-group-item">
									<a href="newtask.php">New Task</a>
								</li>
								
								<li class="list-group-item">
									<a href="?view=active" id="showactive">Active Tasks</a>';
									$active = "SELECT COUNT(task_id) as active FROM task WHERE status='active'";
						$rs_np = mysqli_query($connection, $active);
						
						while($rows=mysqli_fetch_array($rs_np)){
						echo'
					    <p class="badge bg-warning">'.$rows['active'].'</p>';
						}
						echo'
								</li>
								<li class="list-group-item">
									<a href="?view=complete" id="showcomplete">Completed Tasks</a>';
								$complete = "SELECT COUNT(task_id) as complete FROM task WHERE status='complete'";
						$rs_np = mysqli_query($connection, $complete);
						
						while($rows=mysqli_fetch_array($rs_np)){
						echo'
					    <p class="badge bg-success">'.$rows['complete'].'</p>';
						}
						echo'	
								</li>
								<li class="list-group-item">
									<a href="controller.php?action=logout" id="">Logout</a>
								</li>

							</ul>
							
						</form>
					  </div>
				</div>
				
			</div>';
		echo '<div class="col">';
		
		


if(isset($_GET['view'])){
if($_GET['view']=='active'){
$active = $_GET['view'];
$show_task = "SELECT * FROM task WHERE status='$active'";
$rs_cat = mysqli_query($connection,$show_task);

		echo '<div id="active">';
while ($rows=mysqli_fetch_assoc($rs_cat)) {
		
		echo '<div class="well post-card" >';
		
		echo '<span class="badge bg-warning pull-right">'.$rows['status'].'</span>
            <h3 class="text-center">'.$rows['task_title'].'</h3>
            <hr>
            <p class="lead">'.$rows['task_content'].'</p>
            <a class="btn btn-primary" href="edit-task.php?taskid='.$rows['task_id'].'">Edit</a>
            <a class="btn btn-danger" href="controller.php?action=delete&taskid='.$rows['task_id'].'">Delete</a>
            ';

            
		echo '</div>';
	
}
if($_GET['view']=="all"){
	echo '<div id="alltasks">';
		while ($rows=mysqli_fetch_assoc($rs)) {
			echo '<div class="well post-card">';

			echo '<span class="badge bg-success pull-right">'.$rows['status'].'</span>
            <h3 class="text-center">'.$rows['task_title'].'</h3>
            <p class="lead">'.$rows['task_content'].'</p>
            
             ';

			echo '</div>';
					
	}
		echo '</div>';
}
}

if($_GET['view']=='complete'){
$complete = $_GET['view'];
$view_comp = "SELECT * FROM task WHERE status='$complete'";
$rs_comp = mysqli_query($connection,$view_comp);
	echo '<div id="complete">';
		while ($rows=mysqli_fetch_assoc($rs_comp)) {
			echo '<div class="well post-card">';
					
			echo '<span class="badge bg-success pull-right">'.$rows['status'].'</span>
            <h3 class="text-center">'.$rows['task_title'].'</h3>
            <hr>
            <p class="lead">'.$rows['task_content'].'</p>
            <a class="btn btn-danger" href="controller.php?action=delete&taskid='.$rows['task_id'].'">Delete</a>
            ';

			echo '</div>';
					
	}
		echo '</div>';
}
}//if get view
		echo'</div>';
		
		echo '
		</div>';
	

echo'</div>';
echo '</div>';

}
include('includes/footer.php');
?>

