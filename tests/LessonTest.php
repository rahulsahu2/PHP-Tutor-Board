<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Lesson.php";
    require_once "src/Teacher.php";
    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class LessonTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Lesson::deleteAll();
            Teacher::deleteAll();
            Student::deleteAll();
        }
        function test_construct()
        {
            // Arrange
            $input_title = "Sweet-Child-of-Mine";
            $input_description = "Lesson that teaches the song.";
            $input_content = "Guns N' Roses is an American hard rock band from Los Angeles formed in 1985. The lineup, when first signed to Geffen Records in 1986, consisted of vocalist Axl Rose, lead guitarist Slash, rhythm guitarist Izzy Stradlin, bassist Duff McKagan, and drummer Steven Adler. The current lineup consists of Rose, Slash, McKagan, keyboardists Dizzy Reed and Melissa Reese, guitarist Richard Fortus and drummer Frank Ferrer. The band has released six studio albums, accumulating sales of more than 100 million records worldwide, including shipments of 45 million in the United States, making them one of the world's best-selling bands of all time.";
            $input_id = 1;
            $test_lesson = new Lesson("","","",$input_id);
            $test_lesson->setTitle($input_title);
            $test_lesson->setDescription($input_description);
            $test_lesson->setContent($input_content);
            // Act
            $result1 = $test_lesson->getTitle();
            $result2 = $test_lesson->getDescription();
            $result3 = $test_lesson->getContent();
            $result4 = $test_lesson->getId();
            // Assert
            $this->assertEquals($input_title, $result1);
            $this->assertEquals($input_description, $result2);
            $this->assertEquals($input_content, $result3);
            $this->assertEquals($input_id, $result4);
        }
        function test_save_getAll()
        {
            // Arrange
            $input_title = "Sweet-Child-of-Mine";
            $input_description = "Lesson that teaches the song.";
            $input_content = "CONTENTjfdas;afdsjfdsa;safdfdsadfsj;fdj;dfasjfd;jfas;jfdsaj;fdsj;fdsaj;fdsj;fdsa;jfdsj;fds;jfdsa;jfdsaj;fdsaj;fdsj;fds;j;jdfsjadfs;fdj;fadj;fdsaj;fdasj;fd;jfdasj;fdsaj;fdsaj;fdsj;fdsaj;fdsaj;fdsj;fdsj;fdsaj;fdsj;fdsj;fdsj;fdsj;fdsaj;fsdaj;fdsj;fdj;fdsj;fdsj;dfsaj;fdsaj;fdsaj;fdsj;fdsj;fdsj;fdsaj;fdsaj;fdsj;fdsj;d;ldansf;kandsfjnowejewiopqjnjanfadskfnafsj;fadsj;fdj;dfasj;fadsj;fdasj;fdsj;fdsaj;fasdj;fdsaj;fadsj;fdsaj;fsdaj;fdsajfdsfdsajoiioe !@#%%^%$&^&*%%$^%^%jiijrwijnbvndsndasnmdfsmdfmvnvzcvzcxnfdhjgahrorwqhjropdfaifajfnanfandjfnadsjfndasjfnjadnkdmaslcmal;sdmckladmflkandsjgnadsjkgfnadsklnfladksmflkasdmfkjadnsfjkandsfkjandsf;adsf;ladjnsf;ldasnf;lkdasnf;ladsnf;ladsnfl;adskfna;lksdnfasj;fdsj;fdsaj;fdasj;fdasj;fdasj;fdsaj;dfsaj;dfsaj;fdasj;fdsj;fdsaj;fdasj;fdsj;dfsaj;fdsaj;dfsaj;fdsj;dfsaj;fdssa;j";
            $test_lesson = new Lesson("","","");
            $test_lesson->setTitle($input_title);
            $test_lesson->setDescription($input_description);
            $test_lesson->setContent($input_content);
            $test_lesson->save();
            $test_lesson->getId();
            // Act
            $result = Lesson::getAll();
            // Assert
            $this->assertEquals($test_lesson, $result[0]);
        }
        function test_updates()
        {
            // Arrange
            $input_title = "Sweet-Child-of-Mine";
            $input_description = "Lesson that teaches the song.";
            $input_content = "CONTENTjfdas;afdsjfdsa;safdfdsadfsj;fdj;dfasjfd;jfas;jfdsaj;fdsj;fdsaj;fdsj;fdsa;jfdsj;fds;jfdsa;jfdsaj;fdsaj;fdsj;fds;j;jdfsjadfs;fdj;fadj;fdsaj;fdasj;fd;jfdasj;fdsaj;fdsaj;fdsj;fdsaj;fdsaj;fdsj;fdsj;fdsaj;fdsj;fdsj;fdsj;fdsj;fdsaj;fsdaj;fdsj;fdj;fdsj;fdsj;dfsaj;fdsaj;fdsaj;fdsj;fdsj;fdsj;fdsaj;fdsaj;fdsj;fdsj;d;ldansf;kandsfjnowejewiopqjnjanfadskfnafsj;fadsj;fdj;dfasj;fadsj;fdasj;fdsj;fdsaj;fasdj;fdsaj;fadsj;fdsaj;fsdaj;fdsajfdsfdsajoiioe !@#%%^%$&^&*%%$^%^%jiijrwijnbvndsndasnmdfsmdfmvnvzcvzcxnfdhjgahrorwqhjropdfaifajfnanfandjfnadsjfndasjfnjadnkdmaslcmal;sdmckladmflkandsjgnadsjkgfnadsklnfladksmflkasdmfkjadnsfjkandsfkjandsf;adsf;ladjnsf;ldasnf;lkdasnf;ladsnf;ladsnfl;adskfna;lksdnfasj;fdsj;fdsaj;fdasj;fdasj;fdasj;fdsaj;dfsaj;dfsaj;fdasj;fdsj;fdsaj;fdasj;fdsj;dfsaj;fdsaj;dfsaj;fdsj;dfsaj;fdssa;j";
            $test_lesson = new Lesson("","","");
            $test_lesson->save();
            $test_lesson->updateTitle($input_title);
            $test_lesson->updateDescription($input_description);
            $test_lesson->updateContent($input_content);
            $test_lesson->setTitle($input_title);
            $test_lesson->setDescription($input_description);
            $test_lesson->setContent($input_content);
            // Act
            $result = Lesson::getAll();
            // Assert
            $this->assertEquals($test_lesson, $result[0]);
        }


    }
?>
