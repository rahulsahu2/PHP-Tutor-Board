<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/School.php";
    require_once "src/Account.php";
    require_once "src/Course.php";
    require_once "src/Image.php";
    require_once "src/Lesson.php";
    require_once "src/Service.php";
    require_once "src/Student.php";
    require_once "src/Teacher.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class SchoolTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            School::deleteAll();
            Account::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM accounts_schools;");
            $GLOBALS['DB']->exec("DELETE FROM schools_teachers;");
        }
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
            $test_school = new School("","","","","","","","","","");
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
        }

        function test_save_getAll()
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
            $test_school = new School($input_school_name,$input_manager_name,$input_phone_number,$input_email,$input_business_address,$input_city,$input_state,$input_country,$input_zip,$input_type);

            // Act
            $test_school->save();
            $result = School::getAll();

            // Assert
            $this->assertEquals([$test_school], $result);
        }

        function test_getAccounts()
        {
            // Arrange
            $input_family_name = "Bobsters";
            $input_parent_one_name = "Lobster";
            $input_parent_two_name = "Momster";
            $input_street_address = "Under the sea";
            $input_phone_number = "555555555";
            $input_email_address = "fdsfsda@fdasfads";
            $input_notes = "galj";
            $input_billing_history = "fdjfdas";
            $input_outstanding_balance = 31;
            $test_account = new Account($input_family_name, $input_parent_one_name, $input_street_address, $input_phone_number, $input_email_address);
            $test_account->setParentTwoName($input_parent_two_name);
            $test_account->setNotes($input_notes);
            $test_account->setBillingHistory($input_billing_history);
            $test_account->setOutstandingBalance($input_outstanding_balance);
            $test_account->save();

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
            $test_school = new School($input_school_name,$input_manager_name,$input_phone_number,$input_email,$input_business_address,$input_city,$input_state,$input_country,$input_zip,$input_type);
            $test_school->save();
            // Act
            $test_school->addAccount($test_account->getId());
            $result = $test_school->getAccounts();

            // Assert
            $this->assertEquals([$test_account], $result);

        }

        function test_getTeachers()
        {
            // Arrange
            $input_name = "Tester";
            $input_instrument = "Piano";
            $new_teacher_test = new Teacher($input_name, $input_instrument);
            $new_teacher_test->save();

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
            $test_school = new School($input_school_name,$input_manager_name,$input_phone_number,$input_email,$input_business_address,$input_city,$input_state,$input_country,$input_zip,$input_type);
            $test_school->save();
            // Act
            $test_school->addTeacher($new_teacher_test->getId());
            $result = $test_school->getTeachers();

            // Assert
            $this->assertEquals([$new_teacher_test], $result);

        }

        function test_getStudents()
        {
            // Arrange
            $input_name = "Test-9io ";
            $input_new_note = "Blah";
            $new_student = new Student($input_name);
            $new_student->setNotes($input_new_note);
            $new_student->save();

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
            $test_school = new School($input_school_name,$input_manager_name,$input_phone_number,$input_email,$input_business_address,$input_city,$input_state,$input_country,$input_zip,$input_type);
            $test_school->save();
            // Act
            $test_school->addStudent($new_student->getId());
            $result = $test_school->getStudents();

            // Assert
            $this->assertEquals([$new_student], $result);

        }
    }
?>
