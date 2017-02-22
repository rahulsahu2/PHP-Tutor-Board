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


        function getStudents()
       {
           $students = Array();
           $returned_students = $GLOBALS['DB']->query("SELECT * FROM students WHERE techer_id = {$this->getId()};");
           foreach($returned_students as $student) {
               $student_name = $student['student_name'];
               $instrument = $student['instrument'];
               $teacher_id = $student['teacher_id'];
               $id = $student['id'];
               $new_student = new Student($student_name, $instrument, $teacher_id, $id);
               array_push($students, $new_student);
           }
           return $students;
       }

        static function find($search_id)
        {
           $found_student = null;
           $students = Student::getAll();
           foreach($students as $student){
               $student_id = $student->getId();
               if ( $student_id == $search_id){
                   $found_student = $student;
               }
           }
           return $found_student;
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
