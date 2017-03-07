<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/School.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class SchoolTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     School::deleteAll();
        // }
        // test 1
        function test_SchoolConstructor()
        {
            // Arrange
            $input_school_name = "SPMS";
            $input_manager_name = "Carlos Munoz Kampff";
            $input_phone_number = "617-780-8362";
            $input_email = "info@starpowermusic.net";
            $input_business_address = "PO 6267";
            $input_city = "Alameda";
            $input_state = "CA";
            $input_country = "USA";
            $input_zip = "94706";
            $input_type = "music";
            $input_id = 1;
            $test_school = new School("","","","","","","","","","",$input_id);
            $test_school->setSchoolName($input_school_name);
            $test_school->setManagerName($input_manager_name);
            $test_school->setPhoneNumber($input_phone_number);
            $test_school->setEmail($input_email);
            $test_school->setBusinessAddress($input_business_address);
            $test_school->setCity($input_city);
            $test_school->setState($input_state);
            $test_school->setCountry($input_country);
            $test_school->setZip($input_zip);
            $test_school->setType($input_type);

            // Act
            $result1 = $test_school->getSchoolName();
            $result2 = $test_school->getManagerName();
            $result3 = $test_school->getPhoneNumber();
            $result4 = $test_school->getEmail();
            $result5 = $test_school->getBusinessAddress();
            $result6 = $test_school->getCity();
            $result7 = $test_school->getState();
            $result8 = $test_school->getCountry();
            $result9 = $test_school->getZip();
            $result10 = $test_school->getType();
            $result11 = $test_school->getId();
            // Assert
            $this->assertEquals($input_school_name, $result1);
            $this->assertEquals($input_manager_name, $result2);
            $this->assertEquals($input_phone_number, $result3);
            $this->assertEquals($input_email, $result4);
            $this->assertEquals($input_business_address, $result5);
            $this->assertEquals($input_city, $result6);
            $this->assertEquals($input_state, $result7);
            $this->assertEquals($input_country, $result8);
            $this->assertEquals($input_zip, $result9);
            $this->assertEquals($input_type, $result10);
            $this->assertEquals($input_id, $result11);
        }

    }
?>
