<?php

    class School
    {
        private $school_name;
        private $manager_name;
        private $phone_number;
        private $email;
        private $business_address;
        private $city;
        private $state;
        private $country;
        private $zip;
        private $type;
        private $id;

        function __construct($school_name, $manager_name, $phone_number, $email, $business_address, $city, $state, $country, $zip, $type, $id = null)
        {
            $this->school_name = $school_name;
            $this->manager_name = $manager_name;
            $this->phone_number = $phone_number;
            $this->email = $email;
            $this->business_address = $business_address;
            $this->city = $city;
            $this->state = $state;
            $this->country = $country;
            $this->zip = $zip;
            $this->type = $type;
            $this->id = $id;
        }

        // Setters
        function setSchoolName($new_school_name)
        {
            $this->school_name = $new_school_name;
        }

        function setManagerName($new_manager_name)
        {
            $this->manager_name= $new_manager_name;
        }

        function setPhoneNumber($new_phone_number)
        {
            $this->phone_number = $new_phone_number;
        }

        function setEmail($new_email)
        {
            $this->email = $new_email;
        }

        function setBusinessAddress($new_address)
        {
            $this->business_address = $new_address;
        }

        function setCity($new_city)
        {
            $this->city = $new_city;
        }

        function setZip($new_zip)
        {
            $this->zip = $new_zip;
        }

        function setState($new_state)
        {
            $this->state = $new_state;
        }

        function setCountry($new_country)
        {
            $this->country = $new_country;
        }

        function setType($new_type)
        {
            $this->type = $new_type;
        }

        // Getters
        function getSchoolName()
        {
            return $this->school_name;
        }

        function getManagerName()
        {
            return $this->manager_name;
        }

        function getPhoneNumber()
        {
            return $this->phone_number;
        }

        function getEmail()
        {
            return $this->email;
        }

        function getBusinessAddress()
        {
            return $this->business_address;
        }

        function getCity()
        {
            return $this->city;
        }

        function getZip()
        {
            return $this->zip;
        }

        function getType()
        {
            return $this->type;
        }

        function getState()
        {
            return $this->state;
        }

        function getCountry()
        {
            return $this->country;
        }
        
        function getId()
        {
            return $this->id;
        }

        // $school_name, $manager_name, $phone_number, $email, $business_address, $city, $state, $country, $zip, $type, $id
        // CRUD functions
            // NOTE create crud
        //



        // dejiakala at gmail dot com ¶
        // DON'T FULLY UNDERSTAND ...
        static function csvToArray()
        {

            $array = array_map('str_getcsv', file('jimi_attendance_march.csv'));

            return $array;
        }

    }

 ?>
