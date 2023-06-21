<?php
include('includes/header.php'); 
include('includes/connection.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    $us_check = "SELECT * FROM admin WHERE username ='$username'";
    $rs_check= mysqli_query($connection,$us_check);

    if($rs_check){
        if(mysqli_num_rows($rs_check)>0){
            while($rows=mysqli_fetch_array($rs_check)){
                if($password==$rows['password']){
                    session_start();
				$_SESSION['user'] = $rows['username'];
                    header('location: dashboard.php?view=active');
                }else{
                    echo '<div class="alert alert-danger text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
                            <p>Invalid Password! Try Again!</p>
                        </div>';
                }
            }
        }
    }
}

if (isset($_POST['newtask'])) {
    //session_start();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];
    $newtask = "INSERT INTO `task`(`task_title`, `task_content`, `status`, `date_created`, `createdby`) VALUES ('$title','$content','active',(select(current_timestamp())),'$user')";
    $rs_newtask = mysqli_query($connection,$newtask);

    if ($rs_newtask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
                <p class="text-center">Task Successfully Created!</p><br/>
                <a href="dashboard.php?view=active">View task</a>
            </div>';
    }else{
        echo "ERROR!";
    }
}

if (isset($_GET['tid'])) {
    //session_start();
    $status = $_POST['status'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];
    $taskid = $_GET['tid'];
    //echo $task_id;
    if ($status=='active') {
       
    $uptask = "UPDATE `task` SET `task_content`='$content',`status`='$status' WHERE task_id='$taskid'";
    $rs_uptask = mysqli_query($connection,$uptask);
    
    if ($rs_uptask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
                <p class="text-center">Task Successfully Updated!</p><br/>
                <a href="dashboard.php?view=active">View task</a>
            </div>';
    }else{
        echo "ERROR! active";
    }

}else{
    $uptask = "UPDATE `task` SET `task_content`='$content',`status`='$status',`date_completed`=(select(current_timestamp())) WHERE task_id='$taskid'";
    $rs_uptask = mysqli_query($connection,$uptask);
    
    if ($rs_uptask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
                <p class="">Task Successfully Updated!</p><br/>
                <a href="dashboard.php?view=complete">View task</a>
            </div>';
    }else{
        echo "ERROR! success";
    }
}

}

//delete post
if (isset($_GET['action'])) {
if($_GET['action']=='delete'){
    $tid=$_GET['taskid'];
    $del= "DELETE FROM task WHERE task_id='$tid'";

    $dr = mysqli_query($connection, $del);

    if ($dr) {
        echo '<div class="alert alert-success text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
        <strong>Task Deleted! </strong><br/>
        <a href="dashboard.php?">Back</a>
        </div>';
    }else{
        echo '<div class="alert alert-success text-center"><button type="button" class="btn-close" aria-label="Close" data-dismiss="alert">X</button>
        <strong>Invalid Credentials! Please Try Again!</strong><br/>
        <a href="dashboard.php?">Back</a>
        </div>';
    }
}
}

//logout
if (isset($_GET['action'])) {
    if ($_GET['action']=='logout') {
    session_start();    
    unset($_SESSION['user']);
    session_destroy();
    header('location: index.php');
    }
}



?>
