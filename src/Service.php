<?php
// DB: crm_music TABLE event
// | Field          | Type                | Null | Key | Default | Extra          |
// |----------------|---------------------|------|-----|---------|----------------|
// | description     | varchar(255)        | YES  |     | NULL    |                |
// | duration        | int(11)             | YES  |     | NULL    |                |
// | price           | decimal(10,2)       | YES  |     | NULL    |                |
// | discount        | decimal(10,2)       | YES  |     | NULL    |                |
// | payed_for       | tinyint(1)          | YES  |     | NULL    |                |
// | notes           | text                | YES  |     | NULL    |                |
// | date_of_service | datetime            | YES  |     | NULL    |                |
// | id              | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

    ///////    NOTE Saved for later for when we learn JOIN !
    class Service
    {
        private $description;
        private $duration;
        private $price;
        private $discount;
        private $payed_for;
        private $notes;
        private $date_of_service;
        private $id;

        function __construct($description, $duration, $price, $discount, $payed_for, $notes, $date_of_service, $id = null)
        {
            $this->description = $description;
            $this->duration = (int) $duration; //in minutes
            $this->price = (float) $price; // stored as decimal(10,2)
            $this->discount = (float) $discount; // stored as decimal(10,2) portion of whole price remaining f.e. 0.9 => 10% discount.
            $this->payed_for = (bool) $payed_for; // convert to TINIINT 1s and 0s for server!!!
            $this->notes = (string) $notes;
            $this->date_of_service = (string) $date_of_service;
            $this->id = (int) $id;
        }

        // getters and setters
        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }
        function getDescription()
        {
            return $this->description;
        }
        function setDuration($new_duration)
        {
            $this->duration = (int) $new_duration;
        }
        function getDuration()
        {
            return $this->duration;
        }
        function setPrice($new_price)
        {
            $this->price = (float) $new_price;
        }
        function getPrice()
        {
            return $this->price;
        }
        function setDiscount($new_discount)
        {
            $this->discount = (float) $new_discount;
        }
        function getDiscount()
        {
            return $this->discount;
        }
        function setPayedFor($new_payed_for)
        {
            $this->payed_for = (bool) $new_payed_for;
        }
        function getPayedFor()
        {
            return $this->payed_for;
        }
        function setNotes($new_note)
        {
            $this->notes = (string) $new_note;
        }
        function getNotes()
        {
            return $this->notes;
        }
        function setDateOfService($new_date_of_service)
        {
            $this->date_of_service = (string) $new_date_of_service;
        }
        function getDateOfService()
        {
            return $this->date_of_service;
        }
        function getId()
        {
            return $this->id;
        }

        // CRUD Methods
        // function save()
        // {
        //
        //     $GLOBALS['DB']->exec("INSERT INTO event (student_id, teacher_id, date_of_lesson) VALUES ('{$this->getDate()}', '{$this->getInstrument()}');");
        //     $this->id = $GLOBALS['DB']->lastInsertId();
        // }
        //
        // static function deleteAll()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM event;");
        // }
        //
        // static function getAll()
        // {
        //     $returned_events = $GLOBALS['DB']->query("SELECT * FROM event;");
        //     $events = array();
        //     foreach($returned_events as $event){
        //         $event_date = $event['event_date'];
        //         $instrument = $event['instrument'];
        //         $id = $event['id'];
        //         $new_event = new Service($event_date, $instrument, $id);
        //         array_push($events, $new_event);
        //     }
        //     return $events;
        //
        // }
    }


 ?>
