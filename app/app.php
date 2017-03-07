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

    // $dbopts = parse_url(getenv('DATABASE_URL'));
    // $app->register(new Herrera\Pdo\PdoServiceProvider(),
    // array(
    //   'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
    //   'pdo.username' => $dbopts["user"],
    //   'pdo.password' => $dbopts["pass"]
    //   )
    // );
    // $DB = $app['pdo'];



    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../web/views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig', array('teachers' => Teacher::getAll(), 'students' => Student::getAll()));

    });

    $app->get("/teachers", function() use ($app) {

        return $app['twig']->render('teachers.html.twig', array('teachers' => Teacher::getAll()));

    });

    $app->post("/teachers", function() use ($app) {

        $new_teacher_name = $_POST['teacher_name'];
        $new_teacher_instrument = $_POST['teacher_instrument'];
        $new_teacher = new Teacher($new_teacher_name, $new_teacher_instrument);
        $new_teacher->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
        $new_teacher->save();
        return $app['twig']->render('teachers.html.twig', array('teachers' => Teacher::getAll()));

    });

    $app->get("/teachers/{id}", function($id) use ($app) {
        $teacher = Teacher::findTeacher($id);
        $notes_array = explode("|", $teacher->getNotes());
        $teachers_students = $teacher->getStudents();

        return $app['twig']->render('teacher.html.twig', array('teacher' => $teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array ));

    });

    $app->patch("/teachers/{id}", function($id) use ($app) {
        $selected_teacher = Teacher::findTeacher($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_teacher->getNotes();
        $selected_teacher->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $teachers_students = $selected_teacher->getStudents();
        return $app['twig']->render('teacher.html.twig', array('teacher' => $selected_teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array ));
    });

    $app->delete("/teachers/teacher_termination/{id}", function($id) use ($app) {
        $deleted_teacher = Teacher::findTeacher($id);
        $deleted_teacher->delete();

        return $app['twig']->render('teacher_termination.html.twig', array ('deleted_teacher' => $deleted_teacher ));
    });

    $app->get("/students", function() use ($app) {

          return $app['twig']->render('students.html.twig', array('students' => Student::getAll(), 'teachers' => Teacher::getAll()));
    });

    $app->post("/students", function() use ($app) {
          $new_student_name = $_POST['student_name'];
          $new_student = new Student($new_student_name);
          $new_student->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
          $new_student->save();
          return $app['twig']->render('students.html.twig', array('students' => Student::getAll(), 'teachers' => Teacher::getAll()));
    });

    $app->get("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->findTeachers();
        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teachers' => $assigned_teachers, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses()));
    });

    $app->post("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $course_id = $_POST['course_id'];
        $selected_student->enrollInCourse($course_id);
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teachers = $selected_student->findTeachers();
        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teachers' => $assigned_teachers, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses() ));
    });


    $app->patch("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_student->getNotes();
        $selected_student->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $assigned_teachers = $selected_student->findTeachers();

        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teachers' => $assigned_teachers, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses()  ));
    });

    $app->delete("/students/student_termination/{id}", function($id) use ($app) {
        $deleted_student = Student::findStudent($id);
        $deleted_student->delete();

        return $app['twig']->render('student_termination.html.twig', array('deleted_student' => $deleted_student ));
    });

    $app->get("/accounts", function() use ($app) {
        return $app['twig']->render('account.html.twig', array('accounts' => Account::getAll()) );
    });

    // Retrieve courses
    $app->get("/courses", function() use ($app) {

        return $app['twig']->render('courses.html.twig', array('courses'=>Course::getAll() ));
    });

    // Create new course and retrieve courses
    $app->post("/courses", function() use ($app) {
        $course_title = $_POST['course_title'];
        $new_course = new Course($course_title);
        $new_course->save();

        return $app['twig']->render('courses.html.twig', array('courses'=>Course::getAll() ));

    });

    $app->get("/courses/{id}", function($id) use ($app){
        $course = Course::find($id);

        return $app['twig']->render('course.html.twig', array('course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>Student::getAll()));
    });

    //ENROLL STUDENTS
    $app->post("/courses/{id}", function($id) use ($app){
        $course = Course::find($id);
        $selected_student = Student::findStudent($_POST['student_id']);

        $selected_student->enrollInCourse($id);
        $students = $course->getStudents();

        return $app['twig']->render('course.html.twig', array('course' => $course, 'enrolled_students'=>$course->getStudents(), 'students'=>Student::getAll()));
    });

    //view lessons
    $app->get("/lessons", function() use ($app) {

        return $app['twig']->render('lessons.html.twig', array('lessons' => Lesson::getAll()) );

    });

    //create lesson
    // $app->post("/lessons/{id}", function($id) use($app) {
    //
    //     return $app['twig']->render('lesson.html.twig', array('lesson' =>))
    // });


    // NOTE root page from contacts project
    // $app->get("/contacts", function() use($app) {
    //     // Contact::deleteAll();
    //     return $app['twig']->render('address_book_home.html.twig', array( 'list_of_contacts'=>Contact::getAll() ));
    // });

    return $app;
 ?>
