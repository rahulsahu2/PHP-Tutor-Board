<?php
// DB: crm_music TABLE event
// | Field          | Type                | Null | Key | Default | Extra          |
// |----------------|---------------------|------|-----|---------|----------------|
// | description     | varchar(255)        | YES  |     | NULL    |                |
// | duration        | int(11)             | YES  |     | NULL    |                |
// | price           | decimal(10,2)       | YES  |     | NULL    |                |
// | discount        | decimal(10,2)       | YES  |     | NULL    |                |
// | paid_for        | tinyint(1)          | YES  |     | NULL    |                |
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
        private $paid_for;
        private $notes;
        private $date_of_service;
        private $recurrence;
        private $attendance;
        private $id;

        function __construct($description, $duration, $price, $discount, $paid_for, $notes, $date_of_service, $recurrence, $attendance,$id = null)
        {
            $this->description = $description;
            $this->duration = (int) $duration; //in minutes
            $this->price = number_format((float) $price, 2); // stored as decimal(10,2)
            $this->discount = number_format((float) $discount, 2); // stored as decimal(10,2) portion of whole price remaining f.e. 90 => 90% discounted price.
            $this->paid_for = (bool) $paid_for; // convert to TINIINT 1s and 0s for server!!!
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
        function setPaidFor($new_paid_for)
        {
            $this->paid_for = (bool) $new_paid_for;
        }
        function getPaidFor()
        {
            return $this->paid_for;
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
            // $paid_for = (int) $this->paid_for;
            $paid_for = 1;
            $notes = $this->getNotes();
            $date_of_service = $this->GetDateOfService();
            $recurrence = $this->getRecurrence();
            $attendance = $this->getAttendance();

            $GLOBALS['DB']->exec("INSERT INTO services (description, duration, price, discount, paid_for, notes, date_of_service, recurrence, attendance) VALUES ('{$description}', {$duration}, {$price}, {$discount}, {$paid_for}, '{$notes}', '{$date_of_service}', '{$recurrence}', '{$attendance}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // Retrieve
        static function getAll()
        {
            $returned_services = $GLOBALS['DB']->query("SELECT * FROM services;");
            $services = array();
            foreach($returned_services as $service){
                $description = $service['description'];
                $duration = $service['duration'];
                $price = $service['price'];
                $discount = $service['discount'];
                $paid_for = (bool) $service['paid_for'];
                $notes = $service['notes'];
                $date_of_service = $service['date_of_service'];
                $recurrence = $service['recurrence'];
                $attendance = $service['attendance'];
                $id = (int) $service['id'];
                $new_service = new Service($description, $duration, $price, $discount, $paid_for, $notes, $date_of_service, $recurrence, $attendance, $id);
                array_push($services, $new_service);
            }
            return $services;
        }

        // Update functions
        function updateDescription($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET description = '{$update}' WHERE id = {$this->getId()};");
            $this->setDescription($update);
        }
        function updateDuration($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET duration = {$update} WHERE id = {$this->getId()};");
            $this->setDuration($update);
        }
        function updatePrice($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET price = {$update} WHERE id = {$this->getId()};");
            $this->setPrice($update);
        }
        function updateDiscount($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET discount = {$update} WHERE id = {$this->getId()};");
            $this->setDiscount($update);
        }
        function updatePaidFor($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET paid_for = {$update} WHERE id = {$this->getId()};");
            $this->setPaidFor($update);
        }
        function updateNotes($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET notes = '{$update}' WHERE id = {$this->getId()};");
            $this->setNotes($update);
        }
        function updateDateOfService($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET date_of_service = '{$update}' WHERE id = {$this->getId()};");
            $this->setDateOfService($update);
        }
        function updateRecurrence($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET recurrence = '{$update}' WHERE id = {$this->getId()};");
            $this->setRecurrence($update);
        }
        function updateAttendance($update)
        {
            $GLOBALS['DB']->exec("UPDATE services SET attendance = '{$update}' WHERE id = {$this->getId()};");
            $this->setAttendance($update);
        }

        // Multi update ... NOTE could not get to work.
        // function update($field, $value)
        // {
        //     if ($field == 'description'){
        //         $GLOBALS['DB']->exec("UPDATE service SET {$field} = {$value} WHERE id = {$this->getId()};");
        //         $this->setDescription($value);
        //     }
        //     elseif ($field == 'duration'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = '{$value}' WHERE id = {$this->getId()};");
        //         $this->setDuration($value);
        //     }
        //     elseif ($field == 'price'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = {$value} WHERE id = {$this->getId()};");
        //         $this->setPrice($value);
        //     }
        //     elseif ($field == 'discount'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = {$value} WHERE id = {$this->getId()};");
        //         $this->setDiscount($value);
        //     }
        //     elseif ($field == 'paid_for'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = {$value} WHERE id = {$this->getId()};");
        //         $this->setPaidFor($value);
        //     }
        //     elseif ($field == 'notes'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = '{$value}' WHERE id = {$this->getId()};");
        //         $this->setNotes($value);
        //     }
        //     elseif ($field == 'date_of_service'){
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = '{$value}' WHERE id = {$this->getId()};");
        //         $this->setDateOfService($value);
        //     }
        //     elseif ($field == 'recurrence')
        //     {
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = '{$value}' WHERE id = {$this->getId()};");
        //         $this->setRecurrence($value);
        //     }
        //     elseif ($field == 'attendance')
        //     {
        //         $GLOBALS['DB']->exec("UPDATE service SET '{$field}' = '{$value}' WHERE id = {$this->getId()};");
        //     }
        //     else {
        //         echo "key not found";
        //     }
        // }
        // Delete
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM services;");
        }

    }


 ?>
