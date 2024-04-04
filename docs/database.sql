DROP DATABASE IF EXISTS techhub;

CREATE DATABASE helloword CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE  techhub;

CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMENT , 
    product_name VARCHAR(255), 
    product_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP , 
    product_thumbnail VARCHAR(255) , 
    product_summary VARCHAR(255) , 
    product_seller VARCHAR(255)  , 
    product_content TEXT  , 
    product_views INT DEFAULT '0' , 
    product_status  ENUM('on' , 'off', 'del')  DEFAULT 'on' , 
    product_1  VARCHAR(255) NULL DEFAULT NULL , 
    product_2  VARCHAR(255) NULL DEFAULT NULL , 
    product_3  VARCHAR(255) NULL DEFAULT NULL , 
    product_4  VARCHAR(255) NULL DEFAULT NULL , 
    product_5  VARCHAR(255) NULL DEFAULT NULL , 
    product_6  VARCHAR(255) NULL DEFAULT NULL );