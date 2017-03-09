<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Course.php";
    require_once "src/Student.php";
    // require_once "src/Teacher.php";
    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class CourseTest extends PHPUnit_Framework_TestCase{
        protected function teardown()
        {
            Course::deleteAll();
            Student::deleteAll();
            Student::deleteJoin();
        }

        function test_construct()
        {
            // Arrange
            $input_title = "Basket weaving";
            $input_id = 1;
            $test_course = new Course($input_title, $input_id);
            // Act
            $result1 = $test_course->getTitle();
            $result2 = $test_course->getId();
            // Assert
            $this->assertEquals($input_title, $result1);
            $this->assertEquals($input_id, $result2);
        }
        function test_save()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            // Act
            $result = Course::getAll();
            // Assert
            $this->assertEquals($test_course, $result[0]);
        }
        function test_getAll()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $input_title2 = "Banana King";
            $test_course2 = new Course($input_title2);
            $test_course2->save();
            // Act
            $result = Course::getAll();
            // Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }
        function test_deleteAll()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $input_title2 = "Banana King";
            $test_course2 = new Course($input_title2);
            $test_course2->save();
            // Act

            Course::deleteAll();
            $result = Course::getAll();
            // Assert
            $this->assertEquals([], $result);
        }
        function test_update()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $new_title = "Squirl Suit Jumping";
            $test_course->update($new_title);
            // Act
            $result = Course::getAll();
            // Assert
            $this->assertEquals($new_title, $result[0]->getTitle());
        }
        function test_find()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $input_title2 = "Banana King";
            $test_course2 = new Course($input_title2);
            $test_course2->save();
            $id = $test_course2->getId();
            // Act
            $result = Course::find($id);
            // Assert
            $this->assertEquals($test_course2, $result);
        }
        function test_deleteCourse()
        {
            // Arrange
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $input_title2 = "Banana King";
            $test_course2 = new Course($input_title2);
            $test_course2->save();
            $test_course->deleteCourse();
            // Act
            $result = Course::getAll();
            // Assert
            $this->assertEquals($test_course2, $result[0]);
        }
        function test_findStudent()
        {
            // Arrange
            $input_name = "Stevo";
            $input_new_note = "Mangia que fa bene. - Nona  ";
            $new_student = new Student($input_name);
            $new_student->setNotes($input_new_note);
            $new_student->save();
            $id = $new_student->getId();
            // Act
            $result = Student::getAll();
            // Assert
            $this->assertEquals($id, $result[0]->getId());
        }
        function test_getStudents()
        {
            // Arrange
            $input_name = "Stevo";
            $input_new_note = "Mangia que fa bene. - Nona  ";
            $new_student = new Student($input_name);
            $new_student->setNotes($input_new_note);
            $new_student->save();
            $input_title = "Basket weaving";
            $test_course = new Course($input_title);
            $test_course->save();
            $new_student->addCourse($test_course->getId());
            // Act
            $result = $test_course->getStudents();
            // Assert
            $this->assertEquals($new_student, $result[0]);
        }

    }
 ?>
