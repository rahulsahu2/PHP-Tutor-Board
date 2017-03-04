
####Database: crm_music

###Table Descriptions:

##teacher
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| teacher_name | varchar(255)        | NO   |     | NULL    |                |
| instrument   | varchar(100)        | NO   |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
####REFACTOR WITH JOIN TABLE FOR DEPARTMENT INSTEAD OF INSTRUMENT


##student
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| student_name | varchar(255)        | NO   |     | NULL    |                |
| instrument   | varchar(255)        | NO   |     | NULL    |                |
| teacher_id   | int(11)             | NO   |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
####REFACTOR WITH JOIN TABLE INSTEAD OF TEACHER_ID


##service
| Field          | Type                | Null | Key | Default | Extra          |
|----------------|---------------------|------|-----|---------|----------------|
| description     | varchar(255)        | YES  |     | NULL    |                |
| duration        | int(11)             | YES  |     | NULL    |                |
| price           | decimal(10,2)       | YES  |     | NULL    |                |
| discount        | decimal(10,2)       | YES  |     | NULL    |                |
| payed_for       | tinyint(1)          | YES  |     | NULL    |                |
| notes           | text                | YES  |     | NULL    |                |
| date_of_service | datetime            | YES  |     | NULL    |                |
| recurrence      | varchar(255)        | YES  |     | NULL    |                |
| attendance      | varchar(255)        | YES  |     | NULL    |                |
| id              | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
#### SPELLING ERROR: payed_for --> paid_for
CREATE TABLE service (description VARCHAR(255), duration INT, price DECIMAL(10,2), discount DECIMAL(10,2), payed_for TINYINT(1), notes TEXT, date_of_service DATETIME, recurrence VARCHAR(255), attendance VARCHAR(255), id serial PRIMARY KEY);



##accounts
| Field               | Type                | Null | Key | Default | Extra          |
|---------------------|---------------------|------|-----|---------|----------------|
| family_name         | varchar(255)        | YES  |     | NULL    |                |
| street_address      | varchar(255)        | YES  |     | NULL    |                |
| phone_number        | varchar(255)        | YES  |     | NULL    |                |
| email_address       | varchar(255)        | YES  |     | NULL    |                |
| notes               | text                | YES  |     | NULL    |                |
| billing_history     | text                | YES  |     | NULL    |                |
| outstanding_balance | int(11)             | YES  |     | NULL    |                |
| id                  | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| parent_one_name     | varchar(255)        | YES  |     | NULL    |                |
| parent_two_name     | varchar(255)        | YES  |     | NULL    |                |


##course
| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| title | varchar(255)        | YES  |     | NULL    |                |
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
CREATE TABLE course (title VARCHAR(255), id serial PRIMARY KEY);

##lesson
###content set to varchar(30000) but will not work with certain characters I tryed TEXT but had issues...NOT SURE ABOUT BEST WAY FORWARD?
| Field       | Type                | Null | Key | Default | Extra          |
|-------------|---------------------|------|-----|---------|----------------|
| title       | varchar(255)        | YES  |     | NULL    |                |
| description | varchar(255)        | YES  |     | NULL    |                |
| content     | varchar(30000)      | YES  |     | NULL    |                |
| id          | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
CREATE TABLE lesson (title VARCHAR(255), description VARCHAR(255), content VARCHAR(30000), id serial PRIMARY KEY);

##image
| Field   | Type             | Null | Key | Default | Extra          |
|---------|------------------|------|-----|---------|----------------|
| idpic   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| caption | varchar(45)      | NO   |     | NULL    |                |
| img     | longblob         | NO   |     | NULL    |                |
CREATE TABLE image (idpic INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, caption VARCHAR(45) NOT NULL, img LONGBLOB NOT NULL, PRIMARY KEY(idpic));

#Join Tables:

##student_course

| Field              | Type                | Null | Key | Default | Extra          |
|--------------------|---------------------|------|-----|---------|----------------|
| id                 | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_id         | int(11)             | YES  |     | NULL    |                |
| course_id          | int(11)             | YES  |     | NULL    |                |
| date_of_enrollment | date                | YES  |     | NULL    |                |
CREATE TABLE student_course (id serial PRIMARY KEY, student_id INT, course_id INT, date_of_enrollment DATE);

##serverBlaster join table results:
CREATE account_course (id serial PRIMARY KEY, account_id INT, course_id INT, date_of_join DATE);
CREATE account_image (id serial PRIMARY KEY, account_id INT, image_id INT, date_of_join DATE);
CREATE account_lesson (id serial PRIMARY KEY, account_id INT, lesson_id INT, date_of_join DATE);
CREATE account_school (id serial PRIMARY KEY, account_id INT, school_id INT, date_of_join DATE);
CREATE account_service (id serial PRIMARY KEY, account_id INT, service_id INT, date_of_join DATE);
CREATE account_student (id serial PRIMARY KEY, account_id INT, student_id INT, date_of_join DATE);
CREATE account_teacher (id serial PRIMARY KEY, account_id INT, teacher_id INT, date_of_join DATE);
CREATE course_image (id serial PRIMARY KEY, course_id INT, image_id INT, date_of_join DATE);
CREATE course_lesson (id serial PRIMARY KEY, course_id INT, lesson_id INT, date_of_join DATE);
CREATE course_school (id serial PRIMARY KEY, course_id INT, school_id INT, date_of_join DATE);
CREATE course_service (id serial PRIMARY KEY, course_id INT, service_id INT, date_of_join DATE);
CREATE course_student (id serial PRIMARY KEY, course_id INT, student_id INT, date_of_join DATE);
CREATE course_teacher (id serial PRIMARY KEY, course_id INT, teacher_id INT, date_of_join DATE);
CREATE image_lesson (id serial PRIMARY KEY, image_id INT, lesson_id INT, date_of_join DATE);
CREATE image_school (id serial PRIMARY KEY, image_id INT, school_id INT, date_of_join DATE);
CREATE image_service (id serial PRIMARY KEY, image_id INT, service_id INT, date_of_join DATE);
CREATE image_student (id serial PRIMARY KEY, image_id INT, student_id INT, date_of_join DATE);
CREATE image_teacher (id serial PRIMARY KEY, image_id INT, teacher_id INT, date_of_join DATE);
CREATE lesson_school (id serial PRIMARY KEY, lesson_id INT, school_id INT, date_of_join DATE);
CREATE lesson_service (id serial PRIMARY KEY, lesson_id INT, service_id INT, date_of_join DATE);
CREATE lesson_student (id serial PRIMARY KEY, lesson_id INT, student_id INT, date_of_join DATE);
CREATE lesson_teacher (id serial PRIMARY KEY, lesson_id INT, teacher_id INT, date_of_join DATE);
CREATE school_service (id serial PRIMARY KEY, school_id INT, service_id INT, date_of_join DATE);
CREATE school_student (id serial PRIMARY KEY, school_id INT, student_id INT, date_of_join DATE);
CREATE school_teacher (id serial PRIMARY KEY, school_id INT, teacher_id INT, date_of_join DATE);
CREATE service_student (id serial PRIMARY KEY, service_id INT, student_id INT, date_of_join DATE);
CREATE service_teacher (id serial PRIMARY KEY, service_id INT, teacher_id INT, date_of_join DATE);
CREATE student_teacher (id serial PRIMARY KEY, student_id INT, teacher_id INT, date_of_join DATE);
