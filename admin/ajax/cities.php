<?php include_once '../includes/init.php'; ?>
<?php
    $city_initial = $_REQUEST['str2'];
    $state = $_REQUEST['variable'];
    $resultant_cities_string = city_name($city_initial, $state);
    echo $resultant_cities_string;

 ?>
<?php
    function city_name($str, $state){
        $cities = [];
        $city = new City();
        $cities =  $city->find_by_name($state);
        $total_city_names = [];
        foreach ($cities as $object) {
            $total_city_names[] = $object->city_name;
        }
        $city_initial = $str;
        $resultant_city_names = [];
        $cities_string = "";
        if($city_initial != ""){
            $city_initial = strtolower($city_initial);
            $city_initial_len = strlen($city_initial);
            foreach ($total_city_names as $city_name) {
                if(stristr($city_initial, substr($city_name, 0, $city_initial_len))){
                    if($cities_string === ""){
                        $cities_string = $city_name;
                    }else {
                        $city_name = "," . $city_name;
                        $cities_string  .= $city_name;

                    }
                }
            }
        }
        return $cities_string;
    }
 ?>
