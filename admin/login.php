<?php require_once("includes/header.php"); ?>
<?php
    if($session->is_signed_in()){
        redirect("profile.php");
    }
    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //method to check the database
        $user_found = User::verify_user($username, $password);

        if($user_found){
            $session->login($user_found);
            redirect("index.php");
        }else {
            $message = "Your username or password are incorrect";
        }
    }else {
        $message = "";
        $username = "";
        $password = "";
    }
 ?>


<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Blank Page
                    <small>Subheading</small>
                </h1>
            </div>
            <div class="col-md-4 col-md-offset-3">
                <h4 class="bg-danger"><?php //echo $message; ?></h4>
                <form id="login-id" action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php //echo htmlentities($username); ?>" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php //echo htmlentities($password); ?>">
                        <?php echo $message; ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Login" class="btn btn-primary">
                    </div>
                    <div class="form-group">
                        <a href="signup.php">Don't have an account?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
