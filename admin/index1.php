<?php include("includes/header.php"); ?>

<?php
    if(!$session->is_signed_in()){
        redirect("signup.php");
    }
 ?>

        <!-- Navigation -->
        <?php include("includes/nav.php"); ?>

        <!-- Content -->
        <?php include("includes/content.php"); ?>


<?php include("includes/footer.php"); ?>
