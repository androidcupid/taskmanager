<?php 
include('/includes/header.php');
include('/includes/connection.php');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form class="form-group" action="controller.php">
                    <input type="text" class="form-control" name="username" required/>
                    <input type="text" class="form-control" name="password" required/>

                    <button type="submit" class="btn btn-sm" name="login">Log In</button>
                </form>
            </div>
        </div>
    </div>
    <?php 
include('/includes/footer.php');
?>
