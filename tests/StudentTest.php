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
        //1
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
        //2
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
        //3
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
        //4
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
        //5
        function test_save()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $input_teacher_id = 13;
            $input_notes = "Wow!";
            // $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student->setNotes($input_notes);
            $new_student->save();

            // Act
            $result = Student::getAll();
            var_dump(array($result));

            // Assert
            $this->assertEquals($new_student, $result[0]);
        }
        //6
        function test_notes()
        {
            // Arrange
            $input_name = "Dylan";
            $input_instrument = "Skin Flute";
            $input_teacher_id = 55;
            $input_new_note = "had a great time!";
            $new_student_test = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student_test->setNotes($input_new_note);
            // Act
            $result = $new_student_test->getNotes();
            // Assert
            $this->assertEquals($input_new_note, $result);

        }
        // 7
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
            // var_dump(array($new_student_test, $new_student2_test));

            // Assert
            $this->assertEquals(array($new_student_test, $new_student2_test), $result);
        }
        //8
        function test_save_notes()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $input_teacher_id = 13;
            $input_new_note = "Mussolini was a great leader. - Nona ";
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student->setNotes($input_new_note);
            $new_student->save();

            // Act
            $result = Student::getAll();
            var_dump(array($result));

            // Assert
            $this->assertEquals($new_student, $result[0]);
        }
        //9
        function testUpdateNotes()
        {
            //Arrange
            $input_name = "Test-9io ";
            $input_instrument = "Horn";
            $input_teacher_id = 13;
            $input_new_note = "Blah";
            $input_id = 1;
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student->setNotes($input_new_note);
            $new_student->save();

            $new_input_notes = "Had a great lesson.";

            //Act
            $new_student->updateNotes($new_input_notes);

            //Assert
            $this->assertEquals("Had a great lesson.Blah", $new_student->getNotes());
        }

        function testDelete()
        {
            //Arrange
            $input_name = "Test-is ";
            $input_instrument = "Horn";
            $input_teacher_id = 13;
            $input_new_note = "Blah";
            $new_student = new Student($input_name, $input_instrument, $input_teacher_id);
            $new_student->setNotes($input_new_note);
            $new_student->save();

            $input_name2 = "Test-osterone ";
            $input_instrument2 = "Flugel";
            $input_teacher_id2 = 12;
            $input_new_note2 = "das";
            $new_student2 = new Student($input_name2, $input_instrument2, $input_teacher_id2);
            $new_student2->setNotes($input_new_note2);
            $new_student2->save();

            //Act
            $new_student->delete();

            //Assert
            $this->assertEquals([$new_student2], Student::getAll());
        }
    }
 ?>
