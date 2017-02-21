Database: CRM_Music

|teachers|
|:--------------:|
| id |
| teacher_name |


|students|
|:--------------:|
+--------------+---------------------+------+-----+---------+----------------+
| Field        | Type                | Null | Key | Default | Extra          |
+--------------+---------------------+------+-----+---------+----------------+
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_name | varchar(255)        | YES  |     | NULL    |                |
| instrument   | varchar(100)        | YES  |     | NULL    |                |
+--------------+---------------------+------+-----+---------+----------------+

|events|
|:--------------:|
| id |
| student_id |
| teacher_id |
| date_of_lesson |
