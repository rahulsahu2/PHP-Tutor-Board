
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
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| student_name | varchar(255)        | NO   |     | NULL    |                |
| instrument   | varchar(255)        | NO   |     | NULL    |                |
| teacher_id   | int(11)             | NO   |     | NULL    |                |
| notes        | text                | YES  |     | NULL    |                |
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

##event
| Field          | Type                | Null | Key | Default | Extra          |
|----------------|---------------------|------|-----|---------|----------------|
| student_id     | int(11)             | NO   |     | NULL    |                |
| teacher_id     | int(11)             | NO   |     | NULL    |                |
| date_of_lesson | datetime            | NO   |     | NULL    |                |
| id             | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
