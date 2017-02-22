Database: crm_music

##teacher
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|--------------|--------------|--------------|--------------|--------------|
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| teacher_name | varchar(255)        | YES  |     | NULL    |                |
| instrument   | varchar(100)        | YES  |     | NULL    |                |


##student
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|--------------|--------------|--------------|--------------|--------------|
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_name | varchar(255)        | YES  |     | NULL    |                |
| instrument   | varchar(100)        | YES  |     | NULL    |                |


##event
| Field          | Type                | Null | Key | Default | Extra          |
|--------------|--------------|--------------|--------------|--------------|--------------|
| id             | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| student_id     | int(11)             | YES  |     | NULL    |                |
| teacher_id     | int(11)             | YES  |     | NULL    |                |
| date_of_lesson | datetime            | YES  |     | NULL    |                |
