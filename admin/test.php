<?php
    $arr = ['karan',  'arjun', 'gunjan', 'gangotri'];
    $name = "car";
 ?>
<select  name="<?php echo $name; ?>">
    <?php
        foreach ($arr as  $value) {
            echo "<option>" . $value . "</option>";
        }
     ?>
</select>
