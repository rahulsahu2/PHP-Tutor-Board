<?php
    class Teacher
    {
        private $teacher_name;
        private $instrument;
        private $notes;
        private $id;

        function __construct($teacher_name, $instrument, $id = null)
        {
            $this->teacher_name = $teacher_name;
            $this->instrument = $instrument;
            $this->notes;
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

        function setNotes($new_note)
        {
            $this->notes = $new_note . $this->notes;

        }

        function getNotes()
        {
            return $this->notes;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO teacher (teacher_name, instrument, notes) VALUES ('{$this->getName()}', '{$this->getInstrument()}', '{$this->getNotes()}');");
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

        static function findTeacher($search_id)
        {
           $found_teacher = null;
           $teachers = Teacher::getAll();
           foreach($teachers as $teacher){
               $teacher_id = $teacher->getId();
               if ( $teacher_id == $search_id){
                   $found_teacher = $teacher;
               }
           }
           return $found_teacher;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM teacher;");
        }

        static function getAll()
        {
            $returned_teachers = $GLOBALS['DB']->query("SELECT * FROM teacher;");
            $teachers = array();
            if (empty($returned_teachers)){
               return "returned teachers is empty.";
            } else {
              foreach($returned_teachers as $teacher){
                  $teacher_name = $teacher['teacher_name'];
                  $instrument = $teacher['instrument'];
                  $notes = $teacher['notes'];
                  $id = $teacher['id'];
                  $new_teacher = new Teacher($teacher_name, $instrument, $id);
                  $new_teacher->setNotes($notes);
                  array_push($teachers, $new_teacher);
              }
              return $teachers;
            }

        }

        function updateNotes($new_note)
        {
            $GLOBALS['DB']->exec("UPDATE teacher SET notes = '{$new_note}' WHERE id = {$this->getId()};");
            $this->setNotes($new_note);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM teacher WHERE id = {$this->getId()};");
        }
    }


 ?>
