create database fakeInstagram;
use fakeInstagram;

CREATE TABLE posts (
	id int(11) primary key auto_increment not null,
    img varchar(500) not null,
    postText varchar (1000) not null,
    users_username varchar(100)
); 

alter table posts add foreign key (users_username) references users(username);


CREATE TABLE users (
	id int (11) primary key auto_increment not null,
	username varchar(100) not null unique,
	useremail varchar (100) not null,
	userpassword varchar(100) not null,
    profileimg varchar(500) not null
);

select * from users;
select * from posts;
