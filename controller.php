<!DOCTYPE html>
<html>
<head>
    <title>Taskmanager</title>
    <link rel="stylesheet" type="text/css" href="/Taskmanager/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Taskmanager/css/font-awesome.css"/>
    <link href = "/Taskmanager/css/animate.css" rel = "stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/Taskmanager/css/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
        
</head>
<body>
    <?php session_start(); 
//include('includes/header.php'); 
include('includes/connection.php');

function clean($str) {
        $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        $str = @trim($str);  //removes trailing spaces between and after the string
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str); //removes slashes
        }
        return mysqli_real_escape_string($connection,$str); //removes and escapes single qoutes
    }

//index.php
if(isset($_POST['login'])){
    //sanitize login credentials
    $username = clean($_POST['username']);
    $password = clean(MD5($_POST['password']));

    //check for valid username
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
                    echo '<div class="alert alert-danger text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
                            <p>Invalid Password! Try Again!</p>
                        </div>';
                }
            }
        }
    }
}


//newtask.php
if (isset($_GET['action'])) {
if ($_GET['action']=='newtask') {
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];

    //insert form data into database
    $newtask = "INSERT INTO `task`(`task_title`, `task_content`, `status`, `date_created`, `createdby`) VALUES ('$title','$content','active',(select(current_timestamp())),'$user')";
    $rs_newtask = mysqli_query($connection,$newtask);

    if ($rs_newtask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
                <p class="text-center">Task Successfully Created!</p><br/>
                <a href="dashboard.php?view=active">View task</a>
            </div>';
    }else{
        echo "ERROR!";
    }
}
}

//edit-task.php
if (isset($_GET['action'])) {
if($_GET['action']=='edit'&&isset($_GET['tid'])){

    
    $status = $_POST['status'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];
    $taskid = $_GET['tid'];
    
    //update task table in the instance where status is active
    if ($status=='active') {
       
    $uptask = "UPDATE `task` SET `task_content`='$content',`status`='$status' WHERE task_id='$taskid'";
    $rs_uptask = mysqli_query($connection,$uptask);
    
    if ($rs_uptask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
                <p class="text-center">Task Successfully Updated!</p><br/>
                <a href="dashboard.php?view=active">View task</a>
            </div>';
    }

}else{
    //if updating from 'active' to 'complete', update date_completed field in database
    $uptask = "UPDATE `task` SET `task_content`='$content',`status`='$status',`date_completed`=(select(current_timestamp())) WHERE task_id='$taskid'";
    $rs_uptask = mysqli_query($connection,$uptask);
    
    if ($rs_uptask) {
        echo '<div class="alert alert-success text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
                <p class="">Task Successfully Updated!</p><br/>
                <a href="dashboard.php?view=complete">View task</a>
            </div>';
    }
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
        echo '<div class="alert alert-success text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
        <strong>Task Deleted! </strong><br/>
        <a href="dashboard.php?view=active">Refresh Page</a>
        </div>';
    }else{
        echo '<div class="alert alert-success text-center"><button type="button" class="close" aria-label="Close" data-dismiss="alert">&times</button>
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
