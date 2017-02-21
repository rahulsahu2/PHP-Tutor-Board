<?php
    class Teacher
    {
        private $teacher_name;
        private $instrument;
        private $id;

        function __construct($teacher_name, $instrument, $id = null)
        {
            $this->teacher_name = $teacher_name;
            $this->instrument = $instrument;
            $this->id = $id;
        }

        function setName($new_teacher_name)
        {
            $this->name = (string) $new_teacher_name;
        }

        function getName()
        {
            return $this->teacher_name;
        }
        function setInstrument ($new_teacher_instrument)
        {
            $this->instrument = (string) $new_teacher_instrument;
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
            $GLOBALS['DB']->exec("INSERT INTO teacher (teacher_name, instrument) VALUES ('{$this->getName()}', '{$this->getInstrument()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM teacher;");
        }

        static function getAll()
        {
            $returned_teachers = $GLOBALS['DB']->query("SELECT * FROM teacher;");
            $teachers = array();
            foreach($returned_teachers as $teacher){
                $teacher_name = $teacher['teacher_name'];
                $instrument = $teacher['instrument'];
                $id = $teacher['id'];
                $new_teacher = new Teacher($teacher_name, $instrument, $id);
                array_push($teachers, $new_teacher);
            }
            return $teachers;

        }
    }


 ?>
