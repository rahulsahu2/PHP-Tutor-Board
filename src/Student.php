<?php
    class Student
    {
        private $student_name;
        private $instrument;
        private $teacher_id;
        private $id;

        function __construct($student_name, $instrument, $teacher_id, $id = null)
        {
            $this->student_name = $student_name;
            $this->instrument = $instrument;
            $this->teacher_id = $teacher_id;
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

        function setTeacherId($new_teacher_id)
        {
            $this->teacher_id = (int) $new_teacher_id;
        }

        function getTeacherId()
        {
            return $this->teacher_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO student (student_name, instrument, teacher_id) VALUES ('{$this->getName()}', '{$this->getInstrument()}', {$this->getTeacherId()})");
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
                $name = $student['student_name'];
                $inst = $student['instrument'];
                $teach_id = $student['teacher_id'];
                $id = $student['id'];
                $new_student = new Student($name, $inst, $teach_id, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

    }


 ?>
