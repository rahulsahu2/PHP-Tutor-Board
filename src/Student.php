<?php
    class Student
    {
        private $student_name;
        private $instrument;
        private $teacher_id;
        private $notes;
        private $id;

        function __construct($student_name, $instrument, $teacher_id, $id = null)
        {
            $this->student_name = $student_name;
            $this->instrument = $instrument;
            $this->teacher_id = $teacher_id;
            $this->notes;
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

          $GLOBALS['DB']->exec("INSERT INTO student (student_name, instrument, teacher_id, notes) VALUES ('{$this->getName()}', '{$this->getInstrument()}', {$this->getTeacherId()}, '{$this->getNotes()}');");
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
            if (empty($returned_students)){
            } else {
            foreach($returned_students as $student){
                $name = $student['student_name'];
                $inst = $student['instrument'];
                $teach_id = $student['teacher_id'];
                $notes = $student['notes'];
                $id = $student['id'];
                $new_student = new Student($name, $inst, $teach_id, $id);
                $new_student->setNotes($notes);
                array_push($students, $new_student);
            }
          }
          return $students;
        }

        function updateNotes($new_note)
        {
            $GLOBALS['DB']->exec("UPDATE student SET notes = '{$new_note}' WHERE id = {$this->getId()};");
            $this->setNotes($new_note);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM student WHERE id = {$this->getId()};");
        }

        static function findStudent($search_id)
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

        static function findStudentsByTeacher($search_id)
        {
            $found_students = array();
            $students = Student::getAll();
            foreach($students as $student){
                $teacher_id = $student->getTeacherId();
                if ($teacher_id == $search_id){
                    array_push($found_students, $student);
                }
            }
            return $found_students;
        }
    }


 ?>
