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

            // Assert
            $this->assertEquals(array($new_teacher_test, $new_teacher2_test), $result);
        }

        function test_notes()
        {
            // Arrange
            $input_name = "Dylan";
            $input_instrument = "Flute";
            $input_new_note = "had a great time!";
            $new_teacher_test = new Teacher($input_name, $input_instrument);
            $new_teacher_test->setNotes($input_new_note);
            // Act
            $result = $new_teacher_test->getNotes();
            // Assert
            $this->assertEquals($input_new_note, $result);

        }

        function test_save_notes()
        {
            // Arrange
            $input_name = "Flavio";
            $input_instrument = "Ukulele";
            $input_new_note = "Mangia que fa bene. - Nona ";
            $new_teacher = new Teacher($input_name, $input_instrument);
            $new_teacher->setNotes($input_new_note);
            $new_teacher->save();

            // Act
            $result = Teacher::getAll();

            // Assert
            $this->assertEquals($new_teacher, $result[0]);
        }

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
            $this->assertEquals($new_input_notes . $input_new_note, $new_student->getNotes());
        }

        function testDelete()
        {
            //Arrange
            $input_name = "Test-is ";
            $input_instrument = "Horn";
            $input_new_note = "Blah";
            $new_teacher = new Teacher($input_name, $input_instrument);
            $new_teacher->setNotes($input_new_note);
            $new_teacher->save();

            $input_name2 = "Test-osterone ";
            $input_instrument2 = "Flugel";
            $input_new_note2 = "das";
            $new_teacher2 = new Teacher($input_name2, $input_instrument2);
            $new_teacher2->setNotes($input_new_note2);
            $new_teacher2->save();

            //Act
            $new_teacher->delete();

            //Assert
            $this->assertEquals([$new_teacher2], Teacher::getAll());
        }

        function test_findTeacher()
        {
            // Arrange
            $input_name = "Stevo";
            $input_instrument = "Ukulele";
            $input_new_note = "Mangia que fa bene. - Nona ";
            $new_teacher = new Teacher($input_name, $input_instrument);
            $new_teacher->setNotes($input_new_note);
            $new_teacher->save();
            $id = $new_teacher->getId();

            // Act
            $result = Teacher::getAll();

            // Assert
            $this->assertEquals($id, $result[0]->getId());
        }


    }
 ?>
