<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Student::deleteAll();
        //     // Teacher::deleteAll();
        // }
        function test_getName()
        {
            // Arrange
            $input_name = "Bob";
            $new_student = new Student($input_name);

            // Act
            $result = $new_student->getName();

            // Assert
            $this->assertEquals($input_name, $result);
        }
        function test_getId()
        {
            // Arrange
            $input_name = "Bob";
            $input_id = 1;
            $new_student = new Student($input_name, $input_id);

            // Act
            $result = $new_student->getId();

            // Assert
            $this->assertEquals(true , is_numeric($result));
            
        }

    }
 ?>
