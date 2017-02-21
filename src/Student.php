<?php
    class Student
    {
        private $student_name;
        private $id;

        function __construct($student_name, $id = null)
        {
            $this->id = $id;
            $this->student_name = $student_name;
        }

        function setName($new_student_name)
        {
            $this->name = (string) $new_student_name;
        }

        function getName()
        {
            return $this->student_name;
        }

        function getId()
        {
            return $this->id;
        }

        function deleteAll()
        {
            // $GLOBALS['DB']->exec("DELETE FROM categories;");
        }
    }


 ?>
