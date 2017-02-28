<?php

    class   Course
    {
        private $title;
        private $id;

        function __construct($title, $id = Null )
        {
            $this->title = $title;
            $this->id = $id;
        }

        // getters and setters
        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function getId()
        {
            return $this->id;
        }

        // CRUD
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO course (title) VALUES ('{$this->getTitle()}');");

            $this->id = $GLOBALS['DB']->LastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query( "SELECT * FROM course;");
            var_dump($returned_courses);
            $courses = array();
            foreach( $returned_courses as $course)
            {
                $new_title = $course['title'];
                $new_id = $course['id'];
                $new_course = new Course($new_title, $new_id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM course");
        }

        function update($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE course SET title = '{$new_title}';");

            $this->setTitle($new_title);

        }

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM course WHERE id = {$search_id};");
            $courses = array();
            $returned_courses = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($returned_courses as $course){
                $id = $course['id'];
                $title = $course['title'];
                $found_course = new Course($title, $id);
            }
            return $found_course;
        }


    }
 ?>
