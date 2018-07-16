create database camagru;
use camagru;
create table users (user_id int(11) not null, user_login text not null, user_email text not null, user_password text not null);
insert into users (user_id, user_login, user_email, user_password) values
(1, 'vtolochk', 'test@i.ua', 'vtolochk'),
(2, 'login2', 'test@gmail.com', '123456'),
(3, 'login3', 'vtl@gmail.com', '00000'),
(4, 'login4', 'kaka@gmail.com','333333');