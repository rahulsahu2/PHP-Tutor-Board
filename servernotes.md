
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

##accounts
| Field               | Type                | Null | Key | Default | Extra          |
|---------------------|---------------------|------|-----|---------|----------------|
| family_name         | varchar(255)        | YES  |     | NULL    |                |
| parent1_name        | varchar(255)        | YES  |     | NULL    |                |
| parent2_name        | varchar(255)        | YES  |     | NULL    |                |
| street_address      | varchar(255)        | YES  |     | NULL    |                |
| phone_number        | varchar(255)        | YES  |     | NULL    |                |
| email_address       | varchar(255)        | YES  |     | NULL    |                |
| notes               | text                | YES  |     | NULL    |                |
| billing_history     | text                | YES  |     | NULL    |                |
| outstanding_balance | int(11)             | YES  |     | NULL    |                |
| id                  | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
