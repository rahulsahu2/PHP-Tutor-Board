<?php

    ///////    NOTE Saved for later for when we learn JOIN ! 
    class Event
    {
        private $student_id;
        private $teacher_id;
        private $event_date;
        private $id;

        function __construct($student_id, $teacher_id, $event_date, $id = null)
        {
            $this->student_id = $student_id;
            $this->teacher_id = $teacher_id;
            $this->event_date = $event_date;
            $this->id = $id;
        }

        function setDate($new_event_date)
        {
            $this->date = $new_event_date;
        }

        function getDate()
        {
            return $this->event_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            // $GLOBALS['DB']->exec("INSERT INTO event (student_id, teacher_id, date_of_lesson) VALUES ('{$this->getDate()}', '{$this->getInstrument()}');");
            // $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM event;");
        }

        static function getAll()
        {
            $returned_events = $GLOBALS['DB']->query("SELECT * FROM event;");
            $events = array();
            foreach($returned_events as $event){
                $event_date = $event['event_date'];
                $instrument = $event['instrument'];
                $id = $event['id'];
                $new_event = new Event($event_date, $instrument, $id);
                array_push($events, $new_event);
            }
            return $events;

        }
    }


 ?>
