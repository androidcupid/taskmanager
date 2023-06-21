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
                    header('location: dashboard.php');
                }else{
                    echo '<div class="alert alert-danger>
                            <p>Invalid Password! Try Again!</p>
                        </div>"';
                }
            }
        }
    }
}

if (isset($_POST['newtask'])) {
    session_start();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];
    $newtask = "INSERT INTO `task`(`task_title`, `task_content`, `status`, `date_created`, `createdby`) VALUES ('$title','$content','active',(select(current_timestamp())),'$user')";
    $rs_newtask = mysqli_query($connection,$newtask);

    if ($rs_newtask) {
        echo '<div class="alert alert-success>
                <p class="text-center">Task Successfully Created!</p><br/>
                <a href="dashboard.php?view=active">View task</a>
            </div>"';
    }else{
        echo "ERROR!";
    }
}
?>
