<?php include 'init.php'; ?>
<?php

    class City extends Db_object
    {
        protected static $db_table = "cities";
        protected static $db_table_fields = ['city_name'];
        public $city_id, $city_state, $city_name;

        public static function find_by_name($state_name)
        {
            $sql = "SELECT * FROM " . static::$db_table . " WHERE city_state = '$state_name'";
            $result_array = static::run_this_query($sql);
            return !empty($result_array) ? $result_array : false;
            /* empty tells if the array is empty or not*/
            /*array_shift removes fisrt element of the array and
              return the removed element*/
        }

    }
 ?>
