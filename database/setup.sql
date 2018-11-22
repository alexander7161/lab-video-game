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
  primary key (idMember),
  foreign key (owingGame) references Game (id)
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
  idMember serial not null,
  idGame serial not null,
  startDate date,
  endDate date,
  primary key (idMember, idGame),
  foreign key (idMember) references users (id),
  foreign key (idGame) references Game (id)
);
