create database lab_project;
use lab_project;

create table users
(
  id serial primary key,
  name varchar(255) not null,
  surname varchar(255) not null,
  extensions int,
  violations int check (violations between 0 and 3),
  firstViolation date,
  latestViolation date,
  banned boolean not null default true,
  volunteer boolean not null default false,
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
  foreign key (idUser) references users (id),
  foreign key (idRole) references roles (id)
);

-- ALTER TABLE users ADD COLUMN owingGame int;

create table game
(
  id serial primary key,
  name varchar(255),
  releaseYear INT,
  type varchar(255),
  description varchar(1000),
  platform varchar(255),
  rating DECIMAL(1,1),
  imageURL varchar(255)
);

create table rentals
(
  id serial primary key,
  iduser serial not null,
  idgame serial not null,
  startdate timestamp DEFAULT NOW(),
  enddate timestamp,
  foreign key (iduser) references users (id),
  foreign key (idgame) references Game (id)
);

