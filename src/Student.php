<?php
    class Student
    {
        private $id;
        private $student_name;

        function __construct($id = null, $student_name)
        {
            $this->id = $id;
            $this->student_name = $student_name;
        }

        function setStudentName($new_student_name)
        {
            $this->name = (string) $new_student_name;
        }

        function getStudentName()
        {
            return $this->student_name;
        }

        function getId()
        {
            return $this->id;
        }

        function deleteAll()
        {
            
        }
    }


 ?>
