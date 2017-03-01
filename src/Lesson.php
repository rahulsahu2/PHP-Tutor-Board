<?php
//CREATE TABLE lesson (title VARCHAR(255), description VARCHAR(255), content TEXT, id serial PRIMARY KEY);
    class Lesson
    {
        private $title;
        private $description;
        private $content;
        private $id;

        function __construct($title, $description, $content, $id = Null)
        {
            $this->title = (string) $title;
            $this->description = (string) $description;
            $this->content = (string) $content;
            $this->id = (int) $id;
        }

        // getters and setters

        function setTitle($new_title)
        {
            // $this->title = (string) $new_title;
        }

        function getTitle()
        {
            // return $this->title;
        }

        function setDescription($new_description)
        {
            // $this->description = (string) $new_description;
        }

        function getDescription()
        {
            // return $this->description;
        }

        function setContent($new_content)
        {
            // $this->content = $new_content;
        }

        function getContent()
        {
            // return $this->content;
        }

        function getId()
        {
            // return $this->id;
        }

        // CRUD functionality;


    }
 ?>
