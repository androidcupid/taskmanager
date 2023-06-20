<?php 
include('includes/header.php');
include('includes/connection.php');
?>
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 signin">
                <h5 class="text-center">Sign In</h5>
                <form class="form-group" action="controller.php">
                    <input type="text" class="form-control" name="username" placeholder="Username" required/>
                    <input type="password" class="form-control" name="password" placeholder="Password" required/>

                    <button class="btn btn-sm" name="login">Log In</button>
                </form>
            </div>
        </div>
    </div>
    <?php 
include('includes/footer.php');
?>
