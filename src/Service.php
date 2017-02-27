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
// | recurrence      | varchar(255)        | YES  |     | NULL    |                |
// | attendance      | varchar(255)        | YES  |     | NULL    |                |
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
        private $recurrence;
        private $attendance;
        private $id;

        function __construct($description, $duration, $price, $discount, $payed_for, $notes, $date_of_service, $recurrence, $attendance,$id = null)
        {
            $this->description = $description;
            $this->duration = (int) $duration; //in minutes
            $this->price = number_format((float) $price, 2); // stored as decimal(10,2)
            $this->discount = number_format((float) $discount, 2); // stored as decimal(10,2) portion of whole price remaining f.e. 90 => 90% discounted price.
            $this->payed_for = (bool) $payed_for; // convert to TINIINT 1s and 0s for server!!!
            $this->notes = (string) $notes;
            $this->date_of_service = (string) $date_of_service;
            $this->recurrence = (string) $recurrence; // "Wednesdays|3:00pm"
            $this->attendance = (string) $attendance; // use codes and translate to numbers
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
            $this->price = number_format((float) $new_price,2);
        }
        function getPrice()
        {
            return $this->price;
        }
        function setDiscount($new_discount)
        {
            $this->discount = number_format((float) $new_discount, 2);
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
        function setRecurrence($new_recurrence)
        {
            $this->recurrence = (string) $new_recurrence;
        }
        function getRecurrence()
        {
            return $this->recurrence;
        }
        function setAttendance($new_attendance)
        {
            $this->attendance = (string) $new_attendance;
        }
        function getAttendance()
        {
            return $this->attendance;
        }
        function getId()
        {
            return (int) $this->id;
        }

        // CRUD Methods
        // Create
        function save()
        {
            $description = $this->getDescription();
            $duration = $this->getDuration();
            $price = $this->getPrice();
            $discount = $this->getDiscount();
            // $payed_for = (int) $this->payed_for;
            $payed_for = 1;
            $notes = $this->getNotes();
            $date_of_service = $this->GetDateOfService();
            $recurrence = $this->getRecurrence();
            $attendance = $this->getAttendance();

            $GLOBALS['DB']->exec("INSERT INTO service (description, duration, price, discount, payed_for, notes, date_of_service, recurrence, attendance) VALUES ('{$description}', {$duration}, {$price}, {$discount}, {$payed_for}, '{$notes}', '{$date_of_service}', '{$recurrence}', '{$attendance}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // Retrieve
        static function getAll()
        {
            $returned_services = $GLOBALS['DB']->query("SELECT * FROM service;");
            $services = array();
            foreach($returned_services as $service){
                $description = $service['description'];
                $duration = $service['duration'];
                $price = $service['price'];
                $discount = $service['discount'];
                $payed_for = (bool) $service['payed_for'];
                $notes = $service['notes'];
                $date_of_service = $service['date_of_service'];
                $recurrence = $service['recurrence'];
                $attendance = $service['attendance'];
                $id = (int) $service['id'];
                $new_service = new Service($description, $duration, $price, $discount, $payed_for, $notes, $date_of_service, $recurrence, $attendance, $id);
                array_push($services, $new_service);
            }
            return $services;
        }

        // Delete
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM service;");
        }
    }


 ?>
