<?php
    class Student
    {
        private $student_name;
        private $notes;
        private $id;

        function __construct($student_name, $id = null)
        {
            $this->student_name = $student_name;
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

          $GLOBALS['DB']->exec("INSERT INTO students (student_name, notes) VALUES ('{$this->getName()}', '{$this->getNotes()}');");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");

        }

        static function deleteJoin()
        {
            $GLOBALS['DB']->exec("DELETE FROM students_courses;");
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student){
                $name = $student['student_name'];
                $notes = $student['notes'];
                $id = $student['id'];
                $new_student = new Student($name, $id);
                $new_student->setNotes($notes);
                array_push($students, $new_student);

          }
          return $students;
        }

        function updateNotes($new_note)
        {
            $GLOBALS['DB']->exec("UPDATE students SET notes = '{$new_note}' WHERE id = {$this->getId()};");
            $this->setNotes($new_note);
        }

        // NOTE  add other updates

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
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

        // NOTE refactor for join table

        function findTeachers()
        {
            $query = $GLOBALS['DB']->query("SELECT teachers.* FROM
            students JOIN students_teachers ON students.id = students_teachers.student_id
                     JOIN teachers ON students_teachers.teacher_id = teachers.id
                     WHERE students.id = {$this->getId()};");
            $teachers = array();
            foreach ($query as $teacher) {
                $teacher_name = $teacher['teacher_name'];
                $instrument = $teacher['instrument'];
                $notes= $teacher['notes'];
                $id = $teacher['id'];
                $found_teacher = new Teacher($teacher_name, $instrument, $id);
                $found_teacher->setNotes($notes);
                array_push($teachers, $found_teacher);
            }
            return $teachers;
        }

        function assignTeacher($teacher_id)
        {

            $GLOBALS['DB']->exec("INSERT INTO students_teachers (student_id, teacher_id) VALUES ({$this->getId()}, {$teacher_id});");
        }

        // static function findStudentsByTeacher($search_id)
        // {
        //     $found_students = array();
        //     $students = Student::getAll();
        //     foreach($students as $student){
        //         $teacher_id = $student->getTeacherId();
        //         if ($teacher_id == $search_id){
        //             array_push($found_students, $student);
        //         }
        //     }
        //     return $found_students;
        // }

        function enrollInCourse($course_id)
        {
            $today = date('Y-m-d h:i:s');
            // $today = '2017-3-6 10:10:10';

            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id, date_of_join) VALUES ({$course_id}, {$this->getId()}, '{$today}');");

            //
            // $check_duplication = false;
            // $query = $GLOBALS['DB']->query("SELECT * FROM courses_students WHERE course_id = {$course_id} AND student_id = {$this->id};");
            // var_dump($query);
            // $retrieved = $query->fetchAll(PDO::FETCH_ASSOC);
            //
            //
            // foreach($retrieved as $registration){
            //     $student_id = $registration['student_id'];
            //     $courseid = $registration['course_id'];
            //
            //     if($student_id == $this->id && $courseid  == $course_id){
            //         $check_duplication = true;
            //     }
            // }
            //
            // if($check_duplication == false ){
            //     $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id, date_of_enrollment) VALUES ({$course_id}, {$this->id}, '{$today}');");
            // };
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM
            students JOIN courses_students ON (students.id = courses_students.student_id)
                    JOIN courses ON (courses_students.course_id = courses.id)
            WHERE students.id = {$this->getId()};");
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
            $query = $GLOBALS['DB']->query("SELECT date_of_join FROM courses_students WHERE student_id = {$this->id} AND course_id = {$course_id};");
            $returned_date = $query->fetchAll(PDO::FETCH_ASSOC);
            return $returned_date[0]['date_of_join'];
        }


    }


 ?>
