create database lab_project;
use lab_project;

create table users
(
  id serial primary key,
  name varchar(255) not null,
  surname varchar(255) not null,
  rentingGames int check (rentingGames between 0 and 2),
  extensions int,
  violations int check (violations between 0 and 3),
  firstViolation date,
  latestViolation date,
  banned boolean not null default true,
  owingGame int,
  volunteer boolean not null default false,
  foreign key (owingGame) references Game (id)
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
  isAvailable boolean not null default true
);

create table rentals
(
  idUser serial not null,
  idGame serial not null,
  startDate date,
  endDate date,
  primary key (idUser, idGame),
  foreign key (idUser) references users (id),
  foreign key (idGame) references Game (id)
);
