<?php

    class School
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = (string) $name;
            $this->id = (int) $id;
        }

        // getters and setters
        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        // CRUD functions

        //

        // Database Maker // $your_classes is an array with all your object classes LOWERCASE
        static function serverBlaster($your_classes)
        {
            $pairs = array();
            $limit = count($your_classes);
            //
            for($x=0; $x<=($limit - 1); $x++)
            {
                for ($y= $x + 1 ; $y <= ($limit - 1); $y++)
                {
                    $combo = $your_classes[$x] . "|" . $your_classes[$y];
                    array_push($pairs, $combo);
                }
            }
            $commands=array();
            foreach($pairs as $pair)
            {
                $friends = explode("|", $pair);
                $first_class = $friends[0];
                $second_class = $friends[1];
                $command = 'CREATE TABLE ' . $first_class . '_' . $second_class . ' ' . '(id serial PRIMARY KEY, ' . $first_class . '_id INT, ' . $second_class . '_id INT, date_of_join DATETIME);';
                array_push($commands, $command);
            }
            return $commands;
        }
    }

 ?>
