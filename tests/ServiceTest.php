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

    class TeacherTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Teacher::deleteAll();
        //     Student::deleteAll();
        // }

        function test_getDescription()
        {
            // Arrange
            $input_description = "Music Lesson";
            $input_duration = 40;
            $input_price = (float) 40;
            $input_discount = .95;
            $input_payed_for = true;
            $input_notes = "Teacher was tardy.";
            $input_date_of_service = "2/28/17";
            $input_id = 1;
            $test_service = new Service ($input_description, $input_duration, $input_price, $input_discount, $input_payed_for, $input_notes, $input_date_of_service, $input_id);

            // Act
            $result1 = $test_service->getDescription();
            $result2 = $test_service->getDuration();
            $result3 = $test_service->getPrice();
            $resutl4 = $test_service->getDiscount();
            $resutl5 = $test_service->getPayedFor();
            $resutl6 = $test_service->getNotes();
            $resutl7 = $test_service->getDateOfService();
            $resutl8 = $test_service->getId();


            // Assert
            $this->assertEquals($input_description, $result1);
            $this->assertEquals($input_duration, $result2);
            $this->assertEquals($input_price, $result3);
            $this->assertEquals($input_discount, $result4);
            $this->assertEquals($input_payed_for, $result5);
            $this->assertEquals($input_notes, $result6);
            $this->assertEquals($input_date_of_service, $result7);
            $this->assertEquals($input_id, $result8);

        }




    }
 ?>
