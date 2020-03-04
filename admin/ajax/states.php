<?php include_once '../includes/init.php'; ?>
<?php
    $state_initial = $_REQUEST['str1'];
    $resultant_string = state_name($state_initial);
    echo $resultant_string;
 ?>

<?php
    function state_name($str)
    {
        $states = [];
        $state = new State();
        $states = $state->find_all();
        $total_state_names = [];
        foreach ($states as $object) {
            $total_state_names[] = $object->state_name;
        }
        $state_initial = $str;

        $resultant_state_names = [];
        $states_string = "";

        if($state_initial != ""){
            $state_initial = strtolower($state_initial);
            $state_initial_len = strlen($state_initial);
            foreach ($total_state_names as $state_name) {
                if(stristr($state_initial, substr($state_name, 0, $state_initial_len))){
                    if($states_string === ""){
                        $states_string = $state_name;
                    }else {
                        $state_name = "," . $state_name;
                        $states_string .= $state_name;
                    }
                }
            }
        }
        return $states_string;
    }
 ?>
