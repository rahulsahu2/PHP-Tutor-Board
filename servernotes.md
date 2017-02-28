
####Database: crm_music

###Table Descriptions:

##teacher
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| teacher_name | varchar(255)        | NO   |     | NULL    |                |
| instrument   | varchar(100)        | NO   |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |


##student
// REFACTOR WITH JOIN TABLE INSTEAD OF TEACHER_ID
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| student_name | varchar(255)        | NO   |     | NULL    |                |
| instrument   | varchar(255)        | NO   |     | NULL    |                |
| teacher_id   | int(11)             | NO   |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

##student_course

| Field              | Type                | Null | Key | Default | Extra          |
|--------------------|---------------------|------|-----|---------|----------------|
| id                 | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_id         | int(11)             | YES  |     | NULL    |                |
| course_id          | int(11)             | YES  |     | NULL    |                |
| date_of_enrollment | date                | YES  |     | NULL    |                |

##course
| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| title | varchar(255)        | YES  |     | NULL    |                |
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

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
//>mysql command:
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
