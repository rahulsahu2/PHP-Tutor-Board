<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Teacher.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $app['debug']=true;

    $server = 'mysql:host=localhost:8889;dbname=crm_music';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {

          return $app['twig']->render('index.html.twig', array('teachers' => Teacher::getAll(), 'students' => Student::getAll()));

    });

    $app->get("/teachers", function() use ($app) {
        if (empty(Teacher::getAll())) {
        return $app['twig']->render('teachers.html.twig', array('teachers' => array()));
        } else {
          return $app['twig']->render('teachers.html.twig', array('teachers' => Teacher::getAll()));
        }
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
        $teachers_students = Student::findStudentsByTeacher($id);
        // var_dump($teacher);
        // var_dump($teachers_students);
        return $app['twig']->render('teacher.html.twig', array('teacher' => $teacher, 'teachers_students' => $teachers_students, 'notes_array' => $notes_array ));

    });

    $app->patch("/teachers/{id}", function($id) use ($app) {
        $selected_teacher = Teacher::findTeacher($id);
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_teacher->getNotes();
        $selected_teacher->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $teachers_students = Student::findStudentsByTeacher($id);
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
          $new_student_instrument = $_POST['student_instrument'];
          $new_teacher_id = $_POST['teacher_id'];
          $new_student = new Student($new_student_name, $new_student_instrument, $new_teacher_id);
          $new_student->setNotes(date('l jS \of F Y h:i:s A') . " of first entry.");
          $new_student->save();
          return $app['twig']->render('students.html.twig', array('students' => Student::getAll(), 'teachers' => Teacher::getAll()));
    });

    // Individual student page  NOTE We could also use find techer by id to return students teacher info.
    $app->get("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $teacher_id = $selected_student->getTeacherId();
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teacher = Teacher::findTeacher($teacher_id);
        // var_dump($student);
        // var_dump($students_students);
        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teacher' => $assigned_teacher, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses() ));
    });

    $app->post("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $selected_student->enrollInCourse($_POST['course_id']);
        $teacher_id = $selected_student->getTeacherId();
        $notes_array = explode("|", $selected_student->getNotes());
        $assigned_teacher = Teacher::findTeacher($teacher_id);

        // var_dump($student);
        // var_dump($students_students);
        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teacher' => $assigned_teacher, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses() ));
    });


    $app->patch("/students/{id}", function($id) use ($app) {
        $selected_student = Student::findStudent($id);
        $teacher_id = $selected_student->getTeacherId();
        $new_notes = $_POST['new_notes'];
        $updated_notes =  date('l jS \of F Y ') . "---->"  . $new_notes  . "|" .$selected_student->getNotes();
        $selected_student->updateNotes($updated_notes);
        $notes_array = explode("|", $updated_notes);
        $assigned_teacher = Teacher::findTeacher($teacher_id);
        // var_dump($student);
        // var_dump($students_students);
        return $app['twig']->render('student.html.twig', array('student' => $selected_student, 'assigned_teacher' => $assigned_teacher, 'notes_array' => $notes_array, 'courses'=>Course::getAll(), 'enrolled_courses'=>$selected_student->getCourses()  ));
    });

    $app->delete("/students/student_termination/{id}", function($id) use ($app) {
        $deleted_student = Student::findStudent($id);
        $deleted_student->delete();

        return $app['twig']->render('student_termination.html.twig', array('deleted_student' => $deleted_student ));
    });

    $app->get("/accounts", function() use ($app) {
        return $app['twig']->render('account.html.twig', array('accounts' => Account::getAll()) );
    });

    // NOTE root page from contacts project
    $app->get("/contacts", function() use($app) {
        // Contact::deleteAll();
        return $app['twig']->render('address_book_home.html.twig', array( 'list_of_contacts'=>Contact::getAll() ));
    });
    return $app;
 ?>
