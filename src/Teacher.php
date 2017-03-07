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
            $GLOBALS['DB']->exec("INSERT INTO teachers (teacher_name, instrument, notes) VALUES ('{$this->getName()}', '{$this->getInstrument()}', '{$this->getNotes()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function getStudents()
       {
           $students = Array();
           $query = $GLOBALS['DB']->query("SELECT students.* FROM
           teachers JOIN student_teachers ON teachers.id = students_teachers.teachers_id
                    JOIN students ON students_teachers.student_id = students.id
                    WHERE teachers.id = {$this->getId()};");

        if(!empty($query)){
            foreach($query as $student) {
                $student_name = $student['student_name'];
                $id = $student['id'];
                $new_student = new Student($student_name, $id);
                array_push($students, $new_student);
            }
        }
        return $students;

       }

       function assignStudent($student_id)
       {
           $GLOBALS['DB']->exec("INSERT INTO students_teachers (student_id, teacher_id) VALUES ({$this->getId()}, {$student_id});");
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
            $GLOBALS['DB']->exec("DELETE FROM teachers;");
        }

        static function getAll()
        {
            $returned_teachers = $GLOBALS['DB']->query("SELECT * FROM teachers;");
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
            $GLOBALS['DB']->exec("UPDATE teachers SET notes = '{$new_note}' WHERE id = {$this->getId()};");
            $this->setNotes($new_note);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM teachers WHERE id = {$this->getId()};");
        }
    }


 ?>
