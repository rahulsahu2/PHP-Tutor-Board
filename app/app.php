<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Teacher.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Lesson.php";
    require_once __DIR__."/../src/School.php";
    require_once __DIR__."/../src/Account.php";
    require_once __DIR__."/../src/Image.php";
    require_once __DIR__."/../src/Service.php";

    use Herrera\Pdo\PdoServiceProvider;

    session_start();
    if (empty($_SESSION['school_id']))
    {
           $_SESSION['school_id'] = null;
    }


    $app = new Silex\Application();

    $app['debug']=true;

    $server = 'mysql:host=localhost:8889;dbname=crm_music';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    // for postgresql
    // $dbopts = parse_url(getenv('DATABASE_URL'));
    // $app->register(new Herrera\Pdo\PdoServiceProvider(),
    // array(
    //     'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
    //     'pdo.username' => $dbopts["user"],
    //     'pdo.password' => $dbopts["pass"]
    //     )
    // );
    // $DB = $app['pdo'];

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../web/views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig');

    });


    $app->get("/login_owner", function() use ($app) {

        // NOTE This is going to create the school object from the Login using FIND
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
        $school = new School($input_school_name,$input_manager_name,$input_phone_number,$input_email,$input_business_address,$input_city,$input_state,$input_country,$input_zip,$input_type);
        $school->save();
        $_SESSION['school_id'] = intval($school->getId());
        var_dump($_SESSION['school_id']);
        var_dump($school->getTeachers());
        $school2 = School::find($school->getId());
        var_dump($school2);

        // This directs to owner main page and sends in keys with values only relating to that school: School Object, teachers, students, courses, accounts, services
        return $app['twig']->render('owner_main.html.twig', array('school'=> $school, 'teachers' => $school->getTeachers(), 'students' => $school->getStudents(), 'courses' => $school->getCourses(), 'accounts' => $school->getAccounts(), 'services' => $school->getServices()));
    });


    $app->get("/owner_teachers", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);




        return $app['twig']->render('owner_teachers.html.twig', array('school' => $school, 'teachers' => $school->getTeachers()));

    });

    $app->post("/owner_teachers", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);


        $new_teacher_name = $_POST['teacher_name'];
        $new_teacher_instrument = $_POST['teacher_instrument'];
        $new_teacher = new Teacher($new_teacher_name, $new_teacher_instrument);
        $new_teacher->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
        $new_teacher->save();

        $school->addTeacher($new_teacher->getId());
        return $app['twig']->render('owner_teachers.html.twig', array('school' => $school, 'teachers' => $school->getTeachers()));

    });

    $app->get("/owner_teacher/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

        $teacher = Teacher::find($id);
        $notes_array = explode("|", $teacher->getNotes());
        $teachers_students = $teacher->getStudents();

        return $app['twig']->render('owner_teacher.html.twig', array('school' => $school, 'teacher' => $teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array, 'students' => $school->getStudents()));
    });

    $app->post("/owner_teacher/{id}", function($id) use ($app) {
        $teacher = Teacher::find($_POST['teacher_id']);
        $student = Student::find($_POST['student_id']);
        $teacher->addStudent($_POST['student_id']);
        return $app->redirect("/owner_teacher/{$id}");
    });

    $app->patch("/owner_teacher/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

        $selected_teacher = Teacher::find($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_teacher->getNotes();
        $selected_teacher->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $teachers_students = $selected_teacher->getStudents();
        return $app['twig']->render('owner_teacher.html.twig', array('school' => $school, 'teacher' => $selected_teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array ));
    });

    $app->delete("/owner_teacher/teacher_termination/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

        $teacher = Teacher::find($id);
        // refactor to remove teacher from school not entire database
        $teacher->delete();
        return $app['twig']->render('owner_teachers.html.twig', array('school' => $school, 'teachers' => $school->getTeachers()));
    });

    $app->get("/owner_students", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

          return $app['twig']->render('owner_students.html.twig', array('school' => $school, 'students' => $school->getStudents(), 'teachers' => $school->getTeachers()));
    });

    $app->post("/owner_students", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

          $new_student_name = $_POST['student_name'];
          $new_student = new Student($new_student_name);
          $new_student->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
          $new_student->save();
          $school->addStudent($new_student);
          return $app['twig']->render('owner_students.html.twig', array('school' => $school, 'students' => $school->getStudents(), 'teachers' => $school->getTeachers()));
    });

    $app->get("/owner_student/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $selected_student = Student::find($id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->getTeachers();
        return $app['twig']->render('owner_student.html.twig', array(
            'school' => $school,
            'student' => $selected_student,
            'assigned_teachers' => $assigned_teachers,
            'notes_array' => $notes_array,
            'courses'=>$school->getCourses(), 'enrolled_courses'=>$selected_student->getCourses()));
    });

    $app->post("/owner_students/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $selected_student = Student::find($id);
        $course_id = $_POST['course_id'];
        $selected_student->addCourse($course_id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->getTeachers();
        return $app['twig']->render('owner_student.html.twig', array(
            'school' => $school,
            'student' => $selected_student,
            'assigned_teachers' => $assigned_teachers,
            'notes_array' => $notes_array,
            'courses'=>$school->getCourses(), 'enrolled_courses'=>$selected_student->getCourses()));
    });


    $app->patch("/owner_students/{id}", function($id) use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $selected_student = Student::find($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_student->getNotes();
        $selected_student->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $assigned_teachers = $selected_student->getTeachers();

        return $app['twig']->render('owner_student.html.twig', array(
            'school' => $school,
            'student' => $selected_student,
            'assigned_teachers' => $assigned_teachers,
            'notes_array' => $notes_array,
            'courses'=>$school->getCourses(), 'enrolled_courses'=>$selected_student->getCourses()));
    });

    $app->delete("/owner_students/student_termination/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();

        return $app->redirect("/students/{$id}");
    });

    $app->get("/owner_accounts", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        return $app['twig']->render('owner_account.html.twig', array('school' => $school, 'accounts' => $school->getAccounts()));
    });

    // Retrieve courses
    $app->get("/owner_courses", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        return $app['twig']->render('owner_courses.html.twig', array('school' => $school, 'courses' => $school->getCourses()));
    });

    // Create new course and retrieve courses
    $app->post("/owner_courses", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $course_title = $_POST['course_title'];
        $new_course = new Course($course_title);
        $new_course->save();
        $school->addCourse($new_course->getId());
        return $app['twig']->render('owner_courses.html.twig', array('school' => $school, 'courses' => $school->getCourses()));
    });

    $app->get("/owner_courses/{id}", function($id) use ($app){
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $course = Course::find($id);
        // NOTE need to send lessons for course

        return $app['twig']->render('owner_course.html.twig', array('school'=>$school, 'course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>$school->getStudents() ));
    });

    //ENROLL STUDENTS
    $app->post("/owner_courses/{id}", function($id) use ($app){
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);
        $course = Course::find($id);
        $selected_student = Student::find($_POST['student_id']);

        $selected_student->addCourse($id);
        $students = $course->getStudents();

        return $app['twig']->render('owner_course.html.twig', array('school'=>$school, 'course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>$school->getStudents() ));
    });

    //view lessons // SCHOULD BE ROUTED FROM COURSE
    $app->get("/owner_lessons", function() use ($app) {
        // session value of owner id

        // find school object by owner id

        $school=School::find($_SESSION['school_id']);

        return $app['twig']->render('owner_lessons.html.twig', array('school'=>$school, 'lessons' => $school->getLessons()) );

    });

    // $app->post("/owner_lessons/{id}", function($id) use($app) {
    //
    //     return $app['twig']->render('owner_lesson.html.twig', array('lesson' => ))
    // });

    // NOTE root page from contacts project
    // $app->get("/contacts", function() use($app) {
    //     // Contact::deleteAll();
    //     return $app['twig']->render('address_book_home.html.twig', array( 'list_of_contacts'=>Contact::getAll() ));
    // });

//add owner_clients page
//add owner_delete-accounts page

    return $app;
 ?>
