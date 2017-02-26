<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Service.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ServiceTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Sevice::deleteAll();
        //     // Teacher::deleteAll();
        //     // Student::deleteAll();
        // }
        // test 1
        function test_ServiceConstructor()
        {
            // Arrange
            $input_description = "Music Lesson";
            $input_duration = 40;
            $input_price = (float) 40;
            $input_discount = (float) 95;
            $input_payed_for = true;
            $input_notes = "Teacher was tardy.";
            $input_date_of_service = "2/28/17";
            $input_recurrence = "Wednesdays|3:00pm";
            $input_attendance = "Attended";
            $input_id = 1;
            $test_service = new Service ($input_description, $input_duration, $input_price, $input_discount, $input_payed_for, $input_notes, $input_date_of_service, $input_recurrence, $input_attendance, $input_id);

            // Act
            $result1 = $test_service->getDescription();
            $result2 = $test_service->getDuration();
            $result3 = $test_service->getPrice();
            $result4 = $test_service->getDiscount();
            $result5 = $test_service->getPayedFor();
            $result6 = $test_service->getNotes();
            $result7 = $test_service->getDateOfService();
            $result8 = $test_service->getRecurrence();
            $result9 = $test_service->getAttendance();
            $result10 = $test_service->getId();


            // Assert
            $this->assertEquals($input_description, $result1);
            $this->assertEquals($input_duration, $result2);
            $this->assertEquals($input_price, $result3);
            $this->assertEquals($input_discount, $result4);
            $this->assertEquals($input_payed_for, $result5);
            $this->assertEquals($input_notes, $result6);
            $this->assertEquals($input_date_of_service, $result7);
            $this->assertEquals($input_recurrence, $result8);
            $this->assertEquals($input_attendance, $result9);
            $this->assertEquals($input_id, $result10);

        }
        // test 2
        // function test_SaveGetAll()
        // {
        //     // Arrange
        //     $input_description = "Music Lesson";
        //     $input_duration = 40;
        //     $input_price = (float) 40;
        //     $input_discount = (float) 95;
        //     $input_payed_for = true;
        //     $input_notes = "Teacher was tardy.";
        //     $input_date_of_service = "2/28/17";
        //     $test_service = new Service ($input_description, $input_duration, $input_price, $input_discount, $input_payed_for, $input_notes, $input_date_of_service, $input_id);
        //     $test_service->getId();
        //     $test_service->save();
        //     // Act
        //     $result = Service::getAll();
        //     // Assert
        //     $this->assertEquals($test_service, $result[0]);


        // }



    }
 ?>
