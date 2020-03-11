
create table users (
  id int unique auto_increment primary key,
  CodCon varchar(8) not null,
  usuario varchar(191),
  email varchar(191) unique,
  password varchar(191),
  remember_token varchar(100),
  created_at timestamp,
  updated_at timestamp,
  condicion tinyint(1),
  foreign key (CodCon) references TabCon(CodCon))
  ENGINE=innodb DEFAULT CHARSET=utf8;
  
  create table roles(
  id int unique auto_increment primary key,
  name varchar(191),
  description varchar(191)
  );
  
  create table role_user(
  id int unique auto_increment primary key,
  user_id int,
  role_id int
  );
  
  insert into roles(name, description) values('lidercdp', 'Usuario para el líder de casa de paz');
  insert into roles(name, description) values('liderred', 'Usuario para ver los reportes del lider de casa de paz');
  insert into roles(name, description) values('mentor', 'Usuario para ver todo relacionado a sus discìpulos');
  insert into role_user(user_id, role_id) values(1, 1);
  insert into role_user(user_id, role_id) values(2, 2);
  insert into role_user(user_id, role_id) values(3, 1);
  insert into role_user(user_id, role_id) values(4, 1);
  
  SELECT * FROM role_user
  