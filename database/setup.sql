create database lab_project;
use lab_project;

create table users
(
  id serial primary key,
  name varchar(255) not null,
  email varchar(255) not null,
  password varchar(255) not null,
  extensions int,
  banned boolean not null default false,
);

create table roles
(
  id serial not null primary key,
  name varchar(255) not null
);

create table user_roles
(
  idUser serial not null,
  idRole serial not null,
  primary key (idUser, idRole),
  foreign key (idUser) references users (id) on delete CASCADE on update CASCADE,
  foreign key (idRole) references roles (id)
);

create table violations
(
  id serial not null primary key,
  iduser serial not null,
  date datetime not null,
  foreign key (iduser) references users (id) on delete CASCADE on update CASCADE,
);

create table game
(
  id serial primary key,
  name varchar(255),
  releaseYear INT,
  type varchar(255),
  description varchar(1000),
  platform varchar(255),
  rating int CHECK (rating<=10 and rating>0),
  imageURL varchar(255)
);

create table rentals
(
  id serial primary key,
  iduser serial not null,
  idgame serial,
  startdate timestamp DEFAULT NOW(),
  enddate timestamp,
  foreign key (iduser) references users (id) on delete CASCADE on update CASCADE,
  foreign key (idgame) references Game (id) on delete set null on update CASCADE
);

create table rules
(

  rentGameLimit int not null,
  rentalPeriod interval not null,
  extensionLimit int not null,
  ruleVioLimitPerPeriod int not null,
  ruleVioPeriod interval not null,
  banPeriod interval not null
);

insert into rules
values(2, '3 weeks', 2, 3, '1 years', '6 months');