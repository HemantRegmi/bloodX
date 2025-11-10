create database blood_donation; /* creating database*/
use blood_donation;

/*create table donor_details in which all donor information gets stored.*/
create table donor_details(
donor_id int auto_increment NOT NULL,
donor_name varchar(50) NOT NULL,
donor_number varchar(10) NOT NULL,
donor_mail varchar(50),
donor_age int(60) NOT NULL,
donor_gender varchar(10) NOT NULL,
donor_blood varchar(10) NOT NULL,
donor_address varchar(100) NOT NULL,
latitude decimal(10,7) DEFAULT NULL,
longitude decimal(10,7) DEFAULT NULL,
last_donation_date date DEFAULT NULL,
availability_score tinyint DEFAULT NULL,
Primary key(donor_id)
);
/*create table admin_info in which all admin information gets stored.*/
create table admin_info(
admin_id int(10) NOT NULL UNIQUE AUTO_INCREMENT,
admin_name varchar(50) NOT NULL,
admin_username varchar(50) NOT NULL UNIQUE,
admin_password varchar(50) NOT NULL,
Primary key(admin_id)
);

/*  insert admin data into admin_info table*/
insert into admin_info(admin_name,admin_username,admin_password)
values("hemant","hemantregmi004",123);

/*create table blood in which all blood group is stored.*/
create table blood(
blood_id int auto_increment Not Null,
blood_group varchar(10) NOT NULL,
primary key(blood_id)
);

/* insert all blood groups*/
insert into blood(blood_group)
values("B+"),("B-"),("A+"),("O+"),("O-"),("A-"),("AB+"),("AB-");



/*create table contact_info in which your site contact information is stored.*/
create table contact_info(
contact_id int auto_increment Not Null,
contact_address varchar(100) NOT NULL,
contact_mail varchar(50) NOT NULL,
contact_phone varchar(100) NOT NULL,
primary key(contact_id)
);

insert into contact_info(contact_address,contact_mail,contact_phone)
values("PatanDhoka, Lalitpur","bloodbank@gmail.com","9866717332");
    
    
/*create table contact_query in which all querier inforamation gets stored.*/
create table contact_query(
query_id int auto_increment Not Null,
query_name varchar(100) NOT NULL,
query_mail varchar(120) NOT NULL,
query_number char(11) NOT NULL,
query_message longtext NOT NULL,
query_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
query_status int(11) DEFAULT NULL,
Primary key(query_id)
);    
alter table contact_query modify column query_date
timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;


insert into contact_query (query_name,query_mail,query_number,query_message) values
("Hemant","hemant@gmail.com","9866717332","I need O+ Blood.");

update contact_query set query_status="1" where query_id="1";

/*create table query_stat in which query status is stored.*/
CREATE TABLE query_stat(
  id INT NOT NULL Unique,
 query_type VARCHAR(45) NOT NULL,
  PRIMARY KEY (id)
  );
  
  
  insert into query_stat(id,query_type)
  values('1',"Read"),
  ('2',"Pending");
  

/* Create table for admin notifications to users */
CREATE TABLE IF NOT EXISTS admin_notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL, -- NULL means broadcast to all users
  title VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  seen TINYINT(1) NOT NULL DEFAULT 0
);

/*create table reservation in which all reservation information gets stored.*/
CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    hospital_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NULL,
    user_phone VARCHAR(20) NOT NULL,
    blood_group VARCHAR(10) NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NULL,
    status VARCHAR(50) DEFAULT NULL,
    type VARCHAR(50) NULL,
    health_questions TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    seen TINYINT(1) DEFAULT 0
);

/*create table users in which all user information gets stored.*/
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*create table hospitals in which all hospital information gets stored.*/
CREATE TABLE hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
