<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Teacher.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TeacherTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Teacher::deleteAll();
            Student::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $input_name = "Bobster";
            $input_instrument = "Guitar";
            $input_id = 1;
            $new_teacher = new Teacher($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_teacher->getName();

            // Assert
            $this->assertEquals($input_name, $result);
        }
        function test_getInstrument()
        {
            // Arrange
            $input_name = "Sean";
            $input_instrument = "Flute";
            $input_id = 1;
            $new_teacher = new Teacher($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_teacher->getInstrument();

            // Assert
            $this->assertEquals($input_instrument, $result);
        }

        function test_getId()
        {
            // Arrange
            $input_name = "Amanda";
            $input_instrument = "Accordian";
            $input_id = 1;
            $new_teacher = new Teacher($input_name, $input_instrument, $input_id);

            // Act
            $result = $new_teacher->getId();

            // Assert
            $this->assertEquals(true , is_numeric($result));
        }

        function test_save()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $new_teacher = new Teacher($input_name, $input_instrument);
            $new_teacher->save();

            // Act
            $result = Teacher::getAll();

            // Assert
            $this->assertEquals($new_teacher, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            Teacher::deleteAll();
            $input_name = "Tester";
            $input_instrument = "Piano";
            $new_teacher_test = new Teacher($input_name, $input_instrument);
            $new_teacher_test->save();
            $input_name2 = "Stina";
            $input_instrument2 = "Sax";
            $new_teacher2_test = new Teacher($input_name2, $input_instrument2);
            $new_teacher2_test->save();

            // Act
            $result = Teacher::getAll();
            var_dump($result);
            var_dump($new_teacher2_test);

            // Assert
            $this->assertEquals(array($new_teacher_test, $new_teacher2_test), $result);
        }

        // function test_find()
        // {
        //     // Arrange
        //     // Act
        //     // Assert
        // }

    }
 ?>
