<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/School.php";

    //NOTE NOTE NOTE NOTE NOTE NOTE NOTE //
    ///////USES DIFFERENT DATABASE!!!!////
    //NOTE NOTE NOTE NOTE NOTE NOTE NOTE //


    $server = 'mysql:host=localhost:8889;dbname=crm_music_test2';
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
        function test_ServiceConstructor()
        {
            // Arrange
            $input_name = "SPMS";
            $input_id = 1;
            $test_school = new School("", $input_id);
            $test_school->setName($input_name);

            // Act
            $result1 = $test_school->getName();
            $result2 = $test_school->getId();

            // Assert
            $this->assertEquals($input_name, $result1);
            $this->assertEquals($input_id, $result2);

        }

        function test_serverBlaster()
        {
            // Arrange
            $input_arr = ['account','course','image','lesson','school','service','student','teacher'];
            $combinations = array('a|b','a|c','a|c',);

            // Act
            $result = School::serverBlaster($input_arr);
            var_dump($result);

            // Assert
            $this->assertEquals($combinations, $result);

        }

    }

?>
