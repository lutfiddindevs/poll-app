
-- create database if not exists 
create database if not exists phppoll 

-- select a database to perform SQL operations
use phppoll;

-- create table poll if not exists
create table if not exists polls (
    id int(11) auto_increment not null,
    title text  not null,
    description  text  not null,
    primary key (id)
);

-- create one more table poll_answers
create table if not exists poll_answers (
  id int(11) auto_increment not null,
  poll_id int(11) not null,
  title text not null,
  votes int(11) not null default 0,
  primary key (id)
);

-- insert values into polls
insert into polls (title, description) values ('What is your favourite programming language', '');

-- insert values into poll_answers
insert into poll_answers (poll_id, title) value (1, 'PHP'), (1, 'Python'), (1, 'C#'), (1, 'Java');

