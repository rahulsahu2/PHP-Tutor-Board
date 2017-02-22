<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Teacher::deleteAll();
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
            $input_id = 2;
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
            $input_teacher_id = 4;
            $input_id = 3;
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id, $input_id);

            // Act
            $result = $new_student->getId();

            // Assert
            $this->assertEquals( true , is_numeric($result));
        }

        function test_setTeacherId()
        {
            // Arrange
            $input_name = "Fred";
            $input_instrument = "violin";
            $input_teacher_id = 5;
            $input_id = 4;
            $new_student = new Student($input_name, $input_instrument, $input_id);
            $new_student->setTeacherId($input_teacher_id);

            // Act
            $result = $new_student->getTeacherId();

            // Assert
            $this->assertEquals($input_teacher_id, $result);

        }
        function test_save()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $input_teacher_id = 13;
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student->save();

            // Act
            $result = Student::getAll();
            var_dump(array($result));

            // Assert
            $this->assertEquals($new_student, $result[0]);
        }

        //     function test_save()
        //  {
        //      //Arrange
        //      $name = "Work stuff";
        //      $test_Category = new Category($name);
        //      $test_Category->save();
        //      //Act
        //      $result = Category::getAll();
        //      //Assert
        //      $this->assertEquals($test_Category, $result[0]);
        //  }
        function test_getAll()
        {
            // Arrange
            $input_name = "Tester";
            $input_instrument = "Piano";
            $input_teacher_id = 1;
            $new_student_test = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student_test->save();
            $input_name2 = "Stina";
            $input_instrument2 = "Sax";
            $input_teacher_id2 = 2;
            $new_student2_test = new Student($input_name2, $input_instrument2, $input_teacher_id2);
            $new_student2_test->save();

            // Act
            $result = Student::getAll();
            var_dump(array($new_student_test, $new_student2_test));

            // Assert
            $this->assertEquals(array($new_student_test, $new_student2_test), $result);
        }

    }
 ?>
