
####Database: crm_music

###Table Descriptions:

##accounts
| Field               | Type                | Null | Key | Default | Extra          |
|---------------------|---------------------|------|-----|---------|----------------|
| id                  | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| family_name         | varchar(255)        | YES  |     | NULL    |                |
| street_address      | varchar(255)        | YES  |     | NULL    |                |
| phone_number        | varchar(255)        | YES  |     | NULL    |                |
| email_address       | varchar(255)        | YES  |     | NULL    |                |
| notes               | text                | YES  |     | NULL    |                |
| billing_history     | text                | YES  |     | NULL    |                |
| outstanding_balance | int(11)             | YES  |     | NULL    |                |
| parent_one_name     | varchar(255)        | YES  |     | NULL    |                |
| parent_two_name     | varchar(255)        | YES  |     | NULL    |                |
CREATE TABLE accounts (id serial PRIMARY KEY, family_name VARCHAR (255), street_address VARCHAR (255), phone_number VARCHAR (255), email_address VARCHAR(255), notes TEXT, billing_history TEXT, outstanding_balance INT, parent_one_name VARCHAR (255), parent_two_name VARCHAR (255));

##courses
| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| title | varchar(255)        | YES  |     | NULL    |                |
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
CREATE TABLE courses (title VARCHAR(255), id serial PRIMARY KEY);

##images
| Field   | Type             | Null | Key | Default | Extra          |
|---------|------------------|------|-----|---------|----------------|
| idpic   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| caption | varchar(45)      | NO   |     | NULL    |                |
| img     | longblob         | NO   |     | NULL    |                |
CREATE TABLE images (idpic INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, caption VARCHAR(45) NOT NULL, img LONGBLOB NOT NULL, PRIMARY KEY(idpic));

##teachers
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| teacher_name | varchar(255)        | YES  |     | NULL    |                |
| instrument   | varchar(100)        | YES  |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
####REFACTOR WITH JOIN TABLE FOR DEPARTMENT INSTEAD OF INSTRUMENT
CREATE TABLE teachers (id serial PRIMARY KEY, teacher_name VARCHAR (255), instrument VARCHAR (100), notes TEXT);


##students
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_name | varchar(255)        | YES  |     | NULL    |                |
| instrument   | varchar(100)        | YES  |     | NULL    |                |
| teacher_id   | int(11)             | YES  |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |

####REFACTOR WITH JOIN TABLE INSTEAD OF TEACHER_ID
CREATE TABLE students (id serial PRIMARY KEY, student_name VARCHAR (255), instrument VARCHAR (100), teacher_id INT, notes TEXT);


##services
| Field          | Type                | Null | Key | Default | Extra          |
|----------------|---------------------|------|-----|---------|----------------|
| description     | varchar(255)        | YES  |     | NULL    |                |
| duration        | int(11)             | YES  |     | NULL    |                |
| price           | decimal(10,2)       | YES  |     | NULL    |                |
| discount        | decimal(10,2)       | YES  |     | NULL    |                |
| paid_for        | tinyint(1)          | YES  |     | NULL    |                |
| notes           | text                | YES  |     | NULL    |                |
| date_of_service | datetime            | YES  |     | NULL    |                |
| recurrence      | varchar(255)        | YES  |     | NULL    |                |
| attendance      | varchar(255)        | YES  |     | NULL    |                |
| id              | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
####  NOTE SPELLING ERROR: payed_for --> paid_for CHECK EVERYWHERE
CREATE TABLE services (description VARCHAR(255), duration INT, price DECIMAL(10,2), discount DECIMAL(10,2), paid_for TINYINT(1), notes TEXT, date_of_service DATETIME, recurrence VARCHAR(255), attendance VARCHAR(255), id serial PRIMARY KEY);

##lessons
###Refactor -> BLOB!!
| Field       | Type                | Null | Key | Default | Extra          |
|-------------|---------------------|------|-----|---------|----------------|
| title       | varchar(255)        | YES  |     | NULL    |                |
| description | varchar(255)        | YES  |     | NULL    |                |
| content     | varchar(30000)      | YES  |     | NULL    |                |
| id          | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
CREATE TABLE lessons (title VARCHAR(255), description VARCHAR(255), content VARCHAR(30000), id serial PRIMARY KEY);



#Join Tables:

##serverBlaster join table results:
CREATE TABLE accounts_courses (id serial PRIMARY KEY, account_id INT, course_id INT, date_of_join DATETIME);
CREATE TABLE accounts_images (id serial PRIMARY KEY, account_id INT, image_id INT, date_of_join DATETIME);
CREATE TABLE accounts_lessons (id serial PRIMARY KEY, account_id INT, lesson_id INT, date_of_join DATETIME);
CREATE TABLE accounts_schools (id serial PRIMARY KEY, account_id INT, school_id INT, date_of_join DATETIME);
CREATE TABLE accounts_services (id serial PRIMARY KEY, account_id INT, service_id INT, date_of_join DATETIME);
CREATE TABLE accounts_students (id serial PRIMARY KEY, account_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE accounts_teachers (id serial PRIMARY KEY, account_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE courses_images (id serial PRIMARY KEY, course_id INT, image_id INT, date_of_join DATETIME);
CREATE TABLE courses_lessons (id serial PRIMARY KEY, course_id INT, lesson_id INT, date_of_join DATETIME);
CREATE TABLE courses_schools (id serial PRIMARY KEY, course_id INT, school_id INT, date_of_join DATETIME);
CREATE TABLE courses_services (id serial PRIMARY KEY, course_id INT, service_id INT, date_of_join DATETIME);
CREATE TABLE courses_students (id serial PRIMARY KEY, course_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE courses_teachers (id serial PRIMARY KEY, course_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE images_lessons (id serial PRIMARY KEY, image_id INT, lesson_id INT, date_of_join DATETIME);
CREATE TABLE images_schools (id serial PRIMARY KEY, image_id INT, school_id INT, date_of_join DATETIME);
CREATE TABLE images_services (id serial PRIMARY KEY, image_id INT, service_id INT, date_of_join DATETIME);
CREATE TABLE images_students (id serial PRIMARY KEY, image_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE images_teachers (id serial PRIMARY KEY, image_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE lessons_schools (id serial PRIMARY KEY, lesson_id INT, school_id INT, date_of_join DATETIME);
CREATE TABLE lessons_services (id serial PRIMARY KEY, lesson_id INT, service_id INT, date_of_join DATETIME);
CREATE TABLE lessons_students (id serial PRIMARY KEY, lesson_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE lessons_teachers (id serial PRIMARY KEY, lesson_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE schools_services (id serial PRIMARY KEY, school_id INT, service_id INT, date_of_join DATETIME);
CREATE TABLE schools_students (id serial PRIMARY KEY, school_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE schools_teachers (id serial PRIMARY KEY, school_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE services_students (id serial PRIMARY KEY, service_id INT, student_id INT, date_of_join DATETIME);
CREATE TABLE services_teachers (id serial PRIMARY KEY, service_id INT, teacher_id INT, date_of_join DATETIME);
CREATE TABLE students_teachers (id serial PRIMARY KEY, student_id INT, teacher_id INT, date_of_join DATETIME);
