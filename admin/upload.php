<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/nav.php'; ?>

<?php
    if($session->is_signed_in()){
        $user = new User();
        $user = $user->find_by_id($session->user_id);
        $properties = get_object_vars($user);//assoc_array
        $keys = array_keys($properties);
        $values = array_values($properties);

    }
    $message = "";
    if(isset($_POST['submit'])){
        $photo = new Photo();
        $photo->username = $user->username;
        $photo->set_file($_FILES['file_upload']);

        if($photo->save()){
            $message = "Photo uploaded Successfully";
            redirect("profile.php");
        }else {
            $message = join("<br />", $photo->errors);
        }
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
            <div class="col-md-6">
                <h3>Upload Image for your ID Card</h3>

                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="file_upload" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Upload Image" class="btn btn-primary">
                    </div>
                    <div class="form-group">
                        <h3><?php echo $message; ?></h3>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php include_once 'includes/footer.php'; ?>
