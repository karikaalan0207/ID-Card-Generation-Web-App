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
        $img_url = "images/" . $user->username . ".jpg";

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
            <button type="button" name="button"><a href="image.php" target="_blank" rel="noopener noreferrer">IMAGE</a></button>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include_once 'includes/footer.php'; ?>
