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
        protected function tearDown()
        {
            Student::deleteAll();
            // Teacher::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $input_name = "Bobster";
            $input_instrument = "Guitar";
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_student->getName();

            // Assert
            $this->assertEquals($input_name, $result);
        }
        function test_getInstrument()
        {
            // Arrange
            $input_name = "Sean";
            $input_instrument = "Flute";
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_student->getInstrument();

            // Assert
            $this->assertEquals($input_instrument, $result);
        }

        function test_getId()
        {
            // Arrange
            $input_name = "Amanda";
            $input_instrument = "Accordian";
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_student->getId();

            // Assert
            $this->assertEquals(true , is_numeric($result));
        }

        function test_save()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $new_student = new Student($input_name, $input_instrument);
            $new_student->save();

            // Act
            $result = Student::getAll();

            // Assert
            $this->assertEquals($new_student, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $input_name = "Tester";
            $input_instrument = "Piano";
            $new_student_test = new Student($input_name, $input_instrument);
            $new_student_test->save();
            $input_name2 = "Stina";
            $input_instrument2 = "Sax";
            $new_student2_test = new Student($input_name2, $input_instrument2);
            $new_student2_test->save();

            // Act
            $result = Student::getAll();

            // Assert
            $this->assertEquals(array($new_student_test, $new_student2_test), $result);
        }
        
    }
 ?>
