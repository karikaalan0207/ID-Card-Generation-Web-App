<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/nav.php'; ?>

<?php
    if($session->is_signed_in()){
        $user = new User();
        $photo = new Photo();

        $user = $user->find_by_id($session->user_id);
        $properties = get_object_vars($user);//assoc_array
        $keys = array_keys($properties);
        $values = array_values($properties);

        $photo = $photo->find_by_username($user->username);
        $img_url = "images".DS.$photo->filename;
    }else {
        redirect("login.php");
    }
 ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    User's Bio Date
                    <small><?php  echo "(". strtoupper($user->username) . ")"; ?></small>
                </h1>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php
                                foreach ($keys as $key) {
                                echo "<th>{$key}</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                foreach ($values as $value) {
                                echo "<td>{$value}</td>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" class="">
                <img src="<?php echo $img_url; ?>" alt="" class="img-thumbnail">
            </div>
            <h3>Generate your ID Card</h3>
            <button type="button" name="button"><a href="pdf.php" target="_blank">PDF</a></button>
            <button type="button" name="button"><a href="image.php" target="_blank">IMAGE</a></button>
            <button type="button" name="button"><a href="backup.php" target="_blank">BACKUP</a></button>
            <button type="button" name="button"><a href="restore.php" target="_blank">RESTORE</a></button>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
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
                        <h3></h3>
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
