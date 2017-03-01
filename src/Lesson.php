<?php
//CREATE TABLE lesson (title VARCHAR(255), description VARCHAR(255), content TEXT, id serial PRIMARY KEY);
    class Lesson
    {
        private $title;
        private $description;
        private $content;
        private $id;

        function __construct($title, $description, $content, $id = null)
        {
            $this->title = (string) $title;
            $this->description = (string) $description;
            $this->content = (string) $content;
            $this->id = (int) $id;
        }

        // getters and setters

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setContent($new_content)
        {
            $this->content = (string) $new_content;
        }

        function getContent()
        {
            return $this->content;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
        $GLOBALS['DB']->exec("INSERT INTO lesson (title, description, content) VALUES ('{$this->getTitle()}', '{$this->getDescription()}', '{$this->getContent()}');");
        $this->id = (int) $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $retrieved_lessons = $GLOBALS['DB']->query("SELECT * FROM lesson;");
            $lessons = array();
            foreach( $retrieved_lessons as $lesson )
            {
                $title_re = $lesson['title'];
                $description_re = $lesson['description'];
                $content_re = $lesson['content'];
                $id_re = $lesson['id'];
                $instant_lesson = new Lesson($title_re, $description_re, $content_re, $id_re);
                array_push($lessons, $instant_lesson);
            }
            return $lessons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM lesson;");
        }

    }
 ?>
