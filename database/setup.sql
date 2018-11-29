create database lab_project;
use lab_project;

create table Member (
  idMember varchar(16) not null,
  name varchar(255) not null,
  surname varchar(255) not null,
  rentingGames int check (rentingGames between 0 and 2),
  extensions int,
  violations int check (violations between 0 and 3),
  firstViolation date,
  latestViolation date,
  banned boolean not null default true,
  owingGame varchar(16),
  primary key (idMember),
  foreign key (owingGame) references Game (idGame)
);

create table Game (
  idGame varchar(16) not null,
  name varchar(255),
  releaseYear INT,
  type varchar(255),
  description varchar(1000),
  platform varchar(255),
  rating DECIMAL(1,1)，
  ratingURL varchar(255),
  isAvailable boolean not null default true,
  primary key (idGame)
);

create table Rentals (
  idMember varchar(16) not null,
  idGame varchar(16) not null,
  startDate date,
  endDate date,
  primary key (idMember, idGame),
  foreign key (idMember) references Member (idMember),
  foreign key (idGame) references Game (idGame)
);
