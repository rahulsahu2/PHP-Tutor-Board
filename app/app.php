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
        return $app['twig']->render('owner_main.html.twig', array('teachers' => Teacher::getAll(), 'students' => Student::getAll()));
    });

    $app->get("/owner_teachers", function() use ($app) {
        return $app['twig']->render('owner_teachers.html.twig', array('teachers' => Teacher::getAll()));

    });

    $app->post("/owner_teachers", function() use ($app) {

        $new_teacher_name = $_POST['teacher_name'];
        $new_teacher_instrument = $_POST['teacher_instrument'];
        $new_teacher = new Teacher($new_teacher_name, $new_teacher_instrument);
        $new_teacher->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
        $new_teacher->save();
        return $app['twig']->render('owner_teachers.html.twig', array('teachers' => Teacher::getAll()));

    });

    $app->get("/owner_teacher/{id}", function($id) use ($app) {
        $teacher = Teacher::find($id);
        $notes_array = explode("|", $teacher->getNotes());
        $teachers_students = $teacher->getStudents();

        return $app['twig']->render('owner_teacher.html.twig', array('teacher' => $teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array, 'students' => Student::getAll()));
    });

    $app->post("/owner_teacher/{id}", function($id) use ($app) {
        $teacher = Teacher::find($_POST['teacher_id']);
        $student = Student::find($_POST['student_id']);
        $teacher->addStudent($_POST['student_id']);
        return $app->redirect("/owner_teacher/".$id);
    });

    $app->patch("/owner_teacher/{id}", function($id) use ($app) {
        $selected_teacher = Teacher::find($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_teacher->getNotes();
        $selected_teacher->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $teachers_students = $selected_teacher->getStudents();
        return $app['twig']->render('owner_teacher.html.twig', array('teacher' => $selected_teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array ));
    });

    $app->delete("/owner_teacher/teacher_termination/{id}", function($id) use ($app) {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return $app->redirect("/teachers/".$id);
    });

    $app->get("/owner_students", function() use ($app) {
          return $app['twig']->render('owner_students.html.twig', array('students' => Student::getAll(), 'teachers' => Teacher::getAll()));
    });

    $app->post("/owner_students", function() use ($app) {
          $new_student_name = $_POST['student_name'];
          $new_student = new Student($new_student_name);
          $new_student->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
          $new_student->save();
          return $app['twig']->render('owner_students.html.twig', array('students' => Student::getAll(), 'teachers' => Teacher::getAll()));
    });

    $app->get("/owner_student/{id}", function($id) use ($app) {
        $selected_student = Student::find($id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->find();
        return $app['twig']->render('owner_student.html.twig', array(
            'student' => $selected_student,
            'assigned_teachers' => $assigned_teachers,
            'notes_array' => $notes_array,
            'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses()));
    });

    $app->post("/owner_students/{id}", function($id) use ($app) {
        $selected_student = Student::find($id);
        $course_id = $_POST['course_id'];
        $selected_student->addCourse($course_id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->getTeachers();
        return $app['twig']->render('owner_student.html.twig', array('student' => $selected_student, 'assigned_teachers' => $assigned_teachers, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses() ));
    });


    $app->patch("/owner_students/{id}", function($id) use ($app) {
        $selected_student = Student::find($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_student->getNotes();
        $selected_student->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $assigned_teachers = $selected_student->getTeachers();

        return $app['twig']->render('owner_student.html.twig', array('student' => $selected_student, 'assigned_teachers' => $assigned_teachers, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses()  ));
    });

    $app->delete("/owner_students/student_termination/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();

        return $app->redirect("/students/".$id);
    });

    $app->get("/owner_accounts", function() use ($app) {
        return $app['twig']->render('owner_account.html.twig', array('accounts' => Account::getAll()) );
    });

    // Retrieve courses
    $app->get("/owner_courses", function() use ($app) {

        return $app['twig']->render('owner_courses.html.twig', array('courses'=>Course::getAll() ));
    });

    // Create new course and retrieve courses
    $app->post("/owner_courses", function() use ($app) {
        $course_title = $_POST['course_title'];
        $new_course = new Course($course_title);
        $new_course->save();

        return $app['twig']->render('owner_courses.html.twig', array('courses'=>Course::getAll() ));

    });

    $app->get("/owner_courses/{id}", function($id) use ($app){
        $course = Course::find($id);

        return $app['twig']->render('owner_course.html.twig', array('course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>Student::getAll()));
    });

    //ENROLL STUDENTS
    $app->post("/owner_courses/{id}", function($id) use ($app){
        $course = Course::find($id);
        $selected_student = Student::find($_POST['student_id']);

        $selected_student->addCourse($id);
        $students = $course->getStudents();

        return $app['twig']->render('owner_course.html.twig', array('course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>Student::getAll()));
    });

    //view lessons
    $app->get("/owner_lessons", function() use ($app) {

        return $app['twig']->render('owner_lessons.html.twig', array('lessons' => Lesson::getAll()) );

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
