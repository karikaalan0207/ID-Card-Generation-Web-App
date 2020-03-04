<?php

    class Db_object
    {

        public static function find_all()
        {
            $sql = "SELECT * FROM ". static::$db_table;
            return static::run_this_query($sql);

        }
        public static function find_by_id($id)
        {
            $sql = "SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1";
            $result_array = static::run_this_query($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
            /* empty tells if the array is empty or not*/
            /*array_shift removes fisrt element of the array and
              return the removed element*/
        }
        public static function run_this_query($sql)
        {
            global $database;
            $obj_array = [];
            $result_set = $database->query($sql);

            while ($row = mysqli_fetch_array($result_set)) {
                $obj_array[] = static::instantiation($row);
            }

            return $obj_array;
        }
        private static function instantiation($record)
        {
            $calling_class = get_called_class();
            $obj = new $calling_class;
            foreach ($record as $attribute => $value) {
                if ($obj->has_the_attribute($attribute)) {
                    $obj->$attribute = $value;
                }
            }
            return $obj;
        }
        /*get_called_class retruns the name of the class being called*/
        private function has_the_attribute($attribute)
        {
            $properties = get_object_vars($this);
            $result = array_key_exists($attribute, $properties);
            return $result;

        }
        /* get_object_vars returns the assoc_array of keys in the object taking object as arguement*/
        /* array_key_exists tells a key is present in the array*/

        public function save()
        {
            return isset($this->id) ? $this->update() : $this->create();


        }//end of save mdthod
        public function get_all_properties()
        {
            global $database;
            $properties = [];
            $db_table_fields;
            foreach (static::$db_table_fields as  $db_field) {
                if(property_exists($this, $db_field)){
                    $properties[$db_field] = $this->$db_field;
                }
            }
            return $properties;
        }
        protected function clean_all_properties()
        {
            global $database;
            $cleaned_properties = [];
            foreach ($this->get_all_properties() as $key => $value) {
                $cleaned_properties[$key] = $database->escape_string($value);
            }
            return $cleaned_properties;
        }

        public function create()
        {
            global $database;
            $properties = $this->clean_all_properties();//this is an assoc_array
            $sql = "INSERT INTO " . static::$db_table . " ( " .  implode(",", array_keys($properties)). " ) ";
            $sql .= "VALUES ('" . implode("','", array_values($properties)) . "' )";                                                         ")";

            if($database->query($sql)){
                $this->id = $database->insert_id();
                return true;
            }else {
                return false;
            }

        }// end of create method
        /*array_keys takes assoc_array as argument and returns array of the keys*/
        /*array_values takes assoc_array as argument and returns array of the keys*/
        /*implode takes separator and array as argument and returns string of array elements separated by separator*/
        /*explode takes a string of words separated by some delimeter and returns array of words*/

        public function update()
        {
            global $database;

            $properties = $this->clean_all_properties();
            $properties_pairs = [];
            foreach ($properties as $key => $value) {
                $properties_pairs[] = "{$key}='{$value}'";
            }

            $id = $database->escape_string($this->id);

            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(",", $properties_pairs);
            $sql .= "  WHERE id = {$id} ";

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;


        }// end of update method

        public function delete()
        {
            global $database;
            $id = $database->escape_string($this->id);
            $sql = "DELETE  FROM " . static::$db_table . " WHERE id = $id LIMIT 1";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;


        }// end of delete method




    }//end of Db_object class







 ?>
