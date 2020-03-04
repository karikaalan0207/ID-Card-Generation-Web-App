<?php require_once("includes/header.php"); ?>
<?php
    if($session->is_signed_in()){
        redirect("index.php");
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
            $new_user = new User();
            $new_user->username = $username;
            $new_user->password = $password;
            $new_user->year = trim($_POST['year']);
            $new_user->program = trim($_POST['program']);
            $new_user->address = trim($_POST['address']);
            $new_user->state = trim($_POST['state']);
            $new_user->district = trim($_POST['district']);
            if($new_user->create()){
                $session->login($new_user);
                redirect("index.php");
            }
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
                        <input type="text" class="form-control" name="username" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" >
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" class="form-control" name="program" >
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Name of the Place" >
                    </div>
                    <div class="form-group" id="states_container">
                        <input type="text" class="form-control" name="state" value="" placeholder="State Name" onkeyup="show_states(this.value)" id="dynamic_input1">

                    </div>
                    <div class="form-group" id="cities_container">
                        <input type="text" class="form-control" name="district" placeholder="District" onkeyup="show_cities(this.value)" id="dynamic_input2">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Signup" class="btn btn-primary">
                    </div>
                    <div class="form-group">
                        <a href="login.php">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script src="js/script.js" charset="utf-8"></script>
