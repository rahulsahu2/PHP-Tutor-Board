<?php
    class Student
    {
        private $student_name;
        private $instrument;
        private $id;

        function __construct($student_name, $instrument, $id = null)
        {
            $this->student_name = $student_name;
            $this->instrument = $instrument;
            $this->id = $id;
        }

        function setName($new_student_name)
        {
            $this->name = (string) $new_student_name;
        }

        function getName()
        {
            return $this->student_name;
        }
        function setInstrument ($new_student_instrument)
        {
            $this->instrument = (string) $new_student_instrument;
        }

        function getInstrument()
        {
            return $this->instrument;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO student (student_name, instrument) VALUES ('{$this->getName()}', '{$this->getInstrument()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM student;");
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM student;");
            $students = array();
            foreach($returned_students as $student){
                $student_name = $student['student_name'];
                $instrument = $student['instrument'];
                $id = $student['id'];
                $new_student = new Student($student_name, $instrument, $id);
                array_push($students, $new_student);
            }
            return $students;

        }
    }


 ?>
