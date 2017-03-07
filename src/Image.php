<?php

    // NOTE REFACTOR WITH NEW DATABASE NAMES !!

    class  Image
    {
        private $caption;
        private $img;
        private $idpic;

        function __construct($caption, $img, $idpic = null )
        {
            $this->caption = $caption;
            $this->img = $img;
            $this->idpic = $idpic;
        }
        // getters and setters
        function setCaption($new_caption)
        {
            $this->caption = $new_caption;
        }
        function getCaption()
        {
            return $this->caption;
        }
        function setImg($new_img)
        {
            $this->img = $new_img;
        }
        function getImg()
        {
            return $this->img;
        }
        function getId()
        {
            return $this->idpic;
        }

        // CRUD functions
    }

 ?>
