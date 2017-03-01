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
            $this->id = (Int)$id;
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

        static function deleteJoin()
        {
            $GLOBALS['DB']->exec("DELETE FROM student_course;");
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



        function enrollInCourse($course_id)
        {
            $today = date('Y-m-d');
            $check_duplication = false;

            $query = $GLOBALS['DB']->query("SELECT * FROM student_course WHERE course_id = {$course_id} AND student_id = {$this->id};");
            $retrieved = $query->fetchAll(PDO::FETCH_ASSOC);


            foreach($retrieved as $registration){
                $student_id = $registration['student_id'];
                $courseid = $registration['course_id'];

                if($student_id == $this->id && $courseid  == $course_id){
                    $check_duplication = true;
                }
            }

            if($check_duplication == false ){
                $GLOBALS['DB']->exec("INSERT INTO student_course (course_id, student_id, date_of_enrollment) VALUES ({$course_id}, {$this->id}, '{$today}');");
            };
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT course.* FROM
            student JOIN student_course ON (student.id = student_course.student_id)
                    JOIN course ON (student_course.course_id = course.id)
            WHERE student.id = {$this->getId()};");
            $courses = array();
            foreach ($returned_courses as $course )
            {
                $title = $course['title'];
                $id = $course['id'];
                $returned_course = new Course($title, $id);
                array_push($courses, $returned_course);
            }
            return $courses;
        }

        function getDateOfEnrollment($course_id)
        {
            $query = $GLOBALS['DB']->query("SELECT date_of_enrollment FROM student_course WHERE student_id = {$this->id} AND course_id = {$course_id};");
            $returned_date = $query->fetch(PDO::FETCH_ASSOC);
            return $returned_date['date_of_enrollment'];
        }


    }


 ?>
