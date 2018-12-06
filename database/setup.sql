create database lab_project;
use lab_project;

create table users
(
  id serial primary key,
  name varchar(255) not null,
  email varchar(255) not null,
  password varchar(255) not null,
  extensions int,
  violations int check (violations between 0 and 3),
  firstViolation date,
  latestViolation date,
  renting int check (renting<=2),
  volunteer boolean not null default false,
  banned boolean not null default false
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

-- ALTER TABLE users ADD COLUMN owingGame int;
CREATE TYPE platform AS ENUM ('PC', 'PS4', 'Xbox One', 'Nintendo Switch');
create table game
(
  id serial primary key,
  name varchar(255),
  releaseYear INT,
  type varchar(255),
  description varchar(1000),
  onplatform platform,
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
  extended boolean default false,
  foreign key (iduser) references users (id) on delete CASCADE on update CASCADE,
  foreign key (idgame) references Game (id) on delete set null on update CASCADE
);

create table violations 
(
  iduser serial not null,
  violationdate date,
  primary key (iduser),
  foreign key (iduser) references users (id) on delete set null on update cascade
);

create table bannedmembers 
( 
  iduser serial not null,
  datebanned date,
  primary key (iduser),
  foreign key (iduser) references users (id) on delete set null on update cascade
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
/*
create table rules
(
  name varchar primary key,
  friendlyName varchar not null,
  maxLimit int,
  period interval

);

insert into rules values('rentGameLimit', 'Max number of games users can rent', 2, null);
insert into rules values('rentalPeriod', 'Rental period', null, '3 weeks');
insert into rules values('extensionLimit', 'Max number of 1 week extensions', 2, null);
insert into rules values('ruleVioLimitPerPeriod', 'Max rule violations in period', 3, null);
insert into rules values('ruleVioPeriod', 'Rule violation period', null, '1 year');
insert into rules values('banPeriod', 'Ban period', null, '6 months');

*/
