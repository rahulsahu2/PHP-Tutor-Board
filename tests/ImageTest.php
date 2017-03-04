<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Image.php";
    $server = 'mysql:host=localhost:8889;dbname=crm_music_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class ImageTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Image::deleteAll();
        // }
        function test_construct()
        {
            // Arrange
            $input_caption = "Test";
            $input_img = 0x89504e;
            $new_image = new Image("",0);
            $new_image->setCaption($input_caption);
            $new_image->setImg($input_img);

            // Act
            $result1 = $new_image->getCaption();
            $result2 = $new_image->getImg();

            // Assert
            $this->assertEquals($input_caption, $result1);
            $this->assertEquals($input_img, $result2);
        }


    }

?>
