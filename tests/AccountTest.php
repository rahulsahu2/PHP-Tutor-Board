<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Account.php";

    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AccountTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Account::deleteAll();
            // Billing::deleteAll();
        }
        //1
        // function test_getEverything()
        // {
        //     // Arrange
        //     $input_family_name = "Bobsters";
        //     $input_parent_one_name = "Lobster";
        //     $input_parent_two_name = "Momster";
        //     $input_street_address = "Under the sea";
        //     $input_phone_number = "555555555";
        //     $input_email_address = "fdsfsda@fdasfads";
        //     $input_notes = "galj";
        //     $input_billing_history = "fdjfdas";
        //     $input_outstanding_balance = "afda";
        //     $new_account = new Account($input_family_name, $input_parent_one_name, $input_parent_two_name, $input_street_address,$input_phone_number,$input_email_address,$input_outstanding_balance);
        //     $new_account->setNotes($input_notes);
        //     $new_account->setBillingHistory($input_billing_history);
        //     $new_account->save();
        //
        //     // Act
        //     $result = Account::getAll();
        //
        //     // Assert
        //     $this->assertEquals($new_account, $result[0]);
        // }
        function test_getFamilyName()
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
            $input_outstanding_balance = "afda";
            $new_account = new Account($input_family_name, $input_parent_one_name, $input_parent_two_name, $input_street_address,$input_phone_number,$input_email_address,$input_outstanding_balance);
            $new_account->setNotes($input_notes);
            $new_account->setBillingHistory($input_billing_history);

            // Act
            $result = $new_account->getFamilyName();

            // Assert
            $this->assertEquals($input_family_name, $result);
        }
        function test_Constructor()
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
            $input_outstanding_balance = "afda";
            $new_account = new Account($input_family_name, $input_parent_one_name, $input_parent_two_name, $input_street_address,$input_phone_number,$input_email_address,$input_outstanding_balance);
            $new_account->setNotes($input_notes);
            $new_account->setBillingHistory($input_billing_history);

            // Act
            $result1 = $new_account->getFamilyName();
            $result2 = $new_account->getParentOneName();
            $result3 = $new_account->getParentTwoName();
            $result4 = $new_account->getStreetAddress();
            $result5 = $new_account->getPhoneNumber();
            $result6 = $new_account->getEmailAddress();
            $result7 = $new_account->getNotes();
            $result8 = $new_account->getBillingHistory();
            $result9 = $new_account->getOutstandingBalance();

            // Assert
            $this->assertEquals($input_family_name, $result1);
            $this->assertEquals($input_parent_one_name, $result2);
            $this->assertEquals($input_parent_two_name, $result3);
            $this->assertEquals($input_street_address, $result4);
            $this->assertEquals($input_phone_number, $result5);
            $this->assertEquals($input_email_address, $result6);
            $this->assertEquals($input_notes, $result7);
            $this->assertEquals($input_billing_history, $result8);
            $this->assertEquals($input_outstanding_balance, $result9);
        }
        function testSave()
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
              $input_outstanding_balance = 5;
              $new_account = new Account($input_family_name, $input_parent_one_name, $input_parent2_name, $input_street_address,$input_phone_number,$input_email_address,$input_outstanding_balance);
              $new_account->setNotes($input_notes);
              $new_account->setBillingHistory($input_billing_history);
              $new_account->save();

              // Act
              $result = Account::getAll();
              var_dump($result);
              // Assert
              $this->assertEquals($new_account, $result[0]);
        }
        function testSaveStep()
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
            $input_outstanding_balance = 5;
            $new_account = new Account($input_family_name, $input_parent_one_name, $input_parent_two_name, $input_street_address,$input_phone_number,$input_email_address,$input_outstanding_balance);
            $new_account->setNotes($input_notes);
            $new_account->setBillingHistory($input_billing_history);
            $new_account->save();

            // Act
            $result_accounts = Account::getAll();
            $result1 = $result_accounts[0]->getFamilyName();
            $result2 = $result_accounts[0]->getParentOneName();
            $result3 = $result_accounts[0]->getParentTwoName();
            $result4 = $result_accounts[0]->getStreetAddress();
            $result5 = $result_accounts[0]->getPhoneNumber();
            $result6 = $result_accounts[0]->getEmailAddress();
            $result7 = $result_accounts[0]->getNotes();
            $result8 = $result_accounts[0]->getBillingHistory();
            $result9 = $result_accounts[0]->getOutstandingBalance();
            $result10 = $result_accounts[0]->getId();

            // Assert
            $this->assertEquals($input_family_name, $result1);
            $this->assertEquals($input_parent_one_name, $result2);
            $this->assertEquals($input_parent_two_name, $result3);
            $this->assertEquals($input_street_address, $result4);
            $this->assertEquals($input_phone_number, $result5);
            $this->assertEquals($input_email_address, $result6);
            $this->assertEquals($input_notes, $result7);
            $this->assertEquals($input_billing_history, $result8);
            $this->assertEquals($input_outstanding_balance, $result9);
            $this->assertEquals($new_account->getId(), $result10);
        }
        //2

        // //3
        // function test_getId()
        // {
        //     // Arrange
        //     $input_name = "Amanda";
        //     $input_instrument = "Accordian";
        //     $input_teacher_id = 4;
        //     $input_id = 3;
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id, $input_id);
        //
        //     // Act
        //     $result = $new_student->getId();
        //
        //     // Assert
        //     $this->assertEquals( true , is_numeric($result));
        // }
        // //4
        // function test_setTeacherId()
        // {
        //     // Arrange
        //     $input_name = "Fred";
        //     $input_instrument = "violin";
        //     $input_teacher_id = 5;
        //     $input_id = 4;
        //     $new_student = new Account($input_name, $input_instrument, $input_id);
        //     $new_student->setTeacherId($input_teacher_id);
        //
        //     // Act
        //     $result = $new_student->getTeacherId();
        //
        //     // Assert
        //     $this->assertEquals($input_teacher_id, $result);
        //
        // }
        // //5
        // function test_save()
        // {
        //     // Arrange
        //     $input_name = "Flavio";
        //     $input_instrument = "Ukulele";
        //     $input_teacher_id = 13;
        //     $input_notes = "Wow!";
        //     // $input_id = 1;
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_notes);
        //     $new_student->save();
        //
        //     // Act
        //     $result = Account::getAll();
        //     var_dump(array($result));
        //
        //     // Assert
        //     $this->assertEquals($new_student, $result[0]);
        // }
        // //6
        // function test_notes()
        // {
        //     // Arrange
        //     $input_name = "Dylan";
        //     $input_instrument = "Skin Flute";
        //     $input_teacher_id = 55;
        //     $input_new_note = "had a great time!";
        //     $new_student_test = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student_test->setNotes($input_new_note);
        //     // Act
        //     $result = $new_student_test->getNotes();
        //     // Assert
        //     $this->assertEquals($input_new_note, $result);
        //
        // }
        // // 7
        // function test_getAll()
        // {
        //     // Arrange
        //     $input_name = "Tester";
        //     $input_instrument = "Piano";
        //     $input_teacher_id = 1;
        //     $new_student_test = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student_test->save();
        //     $input_name2 = "Stina";
        //     $input_instrument2 = "Sax";
        //     $input_teacher_id2 = 2;
        //     $new_student2_test = new Account($input_name2, $input_instrument2, $input_teacher_id2);
        //     $new_student2_test->save();
        //
        //     // Act
        //     $result = Account::getAll();
        //     // var_dump(array($new_student_test, $new_student2_test));
        //
        //     // Assert
        //     $this->assertEquals(array($new_student_test, $new_student2_test), $result);
        // }
        // //8
        // function test_save_notes()
        // {
        //     // Arrange
        //     $input_name = "Flavio";
        //     $input_instrument = "Ukulele";
        //     $input_teacher_id = 13;
        //     $input_new_note = "Mussolini was a great leader. - Nona ";
        //     $input_id = 1;
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_new_note);
        //     $new_student->save();
        //
        //     // Act
        //     $result = Account::getAll();
        //     var_dump(array($result));
        //
        //     // Assert
        //     $this->assertEquals($new_student, $result[0]);
        // }
        // //9
        // function testUpdateNotes()
        // {
        //     //Arrange
        //     $input_name = "Test-9io ";
        //     $input_instrument = "Horn";
        //     $input_teacher_id = 13;
        //     $input_new_note = "Blah";
        //     $input_id = 1;
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_new_note);
        //     $new_student->save();
        //
        //     $new_input_notes = "Had a great lesson.";
        //
        //     //Act
        //     $new_student->updateNotes($new_input_notes);
        //
        //     //Assert
        //     $this->assertEquals("Had a great lesson.Blah", $new_student->getNotes());
        // }
        //
        // function testDelete()
        // {
        //     //Arrange
        //     $input_name = "Test-is ";
        //     $input_instrument = "Horn";
        //     $input_teacher_id = 13;
        //     $input_new_note = "Blah";
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_new_note);
        //     $new_student->save();
        //
        //     $input_name2 = "Test-osterone ";
        //     $input_instrument2 = "Flugel";
        //     $input_teacher_id2 = 12;
        //     $input_new_note2 = "das";
        //     $new_student2 = new Account($input_name2, $input_instrument2, $input_teacher_id2);
        //     $new_student2->setNotes($input_new_note2);
        //     $new_student2->save();
        //
        //     //Act
        //     $new_student->delete();
        //
        //     //Assert
        //     $this->assertEquals([$new_student2], Account::getAll());
        // }
        //
        // function test_findAccount()
        // {
        //     // Arrange
        //     $input_name = "Stevo";
        //     $input_instrument = "Ukulele";
        //     $input_teacher_id = 99;
        //     $input_new_note = "Mussolini was a great leader. - Nona ";
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_new_note);
        //     $new_student->save();
        //     $id = $new_student->getId();
        //
        //     // Act
        //     $result = Account::getAll();
        //
        //     // Assert
        //     $this->assertEquals($id, $result[0]->getId());
        // }
        // function test_findAccountsByTeacher()
        // {
        //     // Arrange
        //     $input_name = "Stevo";
        //     $input_instrument = "Ukulele";
        //     $input_teacher_id = 99;
        //     $input_new_note = "Mussolini was a great leader. - Nona ";
        //     $new_student = new Account($input_name, $input_instrument, $input_teacher_id);
        //     $new_student->setNotes($input_new_note);
        //     $new_student->save();
        //     $teacher_id = $new_student->getTeacherId();
        //
        //     // Act
        //     $result = Account::findAccountsByTeacher($teacher_id);
        //
        //     // Assert
        //     $this->assertEquals([$new_student], $result);
        // }
    }
 ?>
