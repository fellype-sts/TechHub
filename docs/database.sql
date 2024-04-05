-- DB FODA --

DROP DATABASE IF EXISTS techhub;


CREATE TABLE category (
ctr_id INT PRIMARY KEY AUTO_INCREMENT,
ctr_name VARCHAR(255)
);


CREATE TABLE employee(
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    emp_photo VARCHAR(255),
    emp_name VARCHAR(127) NOT NULL,
    emp_birth DATE,
    emp_email VARCHAR(255) NOT NULL,
    emp_password VARCHAR(63) NOT NULL,
    emp_type ENUM('admin', 'moderator') DEFAULT 'moderator',
    emp_status ENUM('on', 'off', 'del') DEFAULT 'on'
);
CREATE TABLE user (
user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_name VARCHAR(255),
    user_email VARCHAR(255),
    user_password VARCHAR(25) NOT NULL,
    user_type ENUM('ATIVO', 'BLOQUEADO', 'APAGADO') DEFAULT 'ATIVO',
    user_status ENUM('on', 'off', 'del') DEFAULT 'on'
);


CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255),
    product_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    product_title VARCHAR(255),
    product_thumbnail VARCHAR(255),
    product_summary VARCHAR(255),
    product_seller VARCHAR(255),
    product_content TEXT,
    product_emp INT,
    product_category INT,
    product_views INT DEFAULT '0',
    product_status ENUM('on', 'off', 'del') DEFAULT 'on',
    product_1 VARCHAR(255) NULL DEFAULT NULL,
    product_2 VARCHAR(255) NULL DEFAULT NULL,
    product_3 VARCHAR(255) NULL DEFAULT NULL,
    product_4 VARCHAR(255) NULL DEFAULT NULL,
    product_5 VARCHAR(255) NULL DEFAULT NULL,
    product_6 VARCHAR(255) NULL DEFAULT NULL,
    FOREIGN KEY (product_emp) REFERENCES employee(emp_id),
    FOREIGN KEY (product_category) REFERENCES category(ctr_id)
);
CREATE TABLE comment (
    cmt_id INT PRIMARY KEY AUTO_INCREMENT,
    cmt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cmt_product INT,
    cmt_social_id VARCHAR(255),
    cmt_social_name VARCHAR(255),
    cmt_social_photo VARCHAR(255),
    cmt_social_email VARCHAR(255),
    cmt_content TEXT,
    cmt_status ENUM('on', 'off', 'del') DEFAULT 'on',
    FOREIGN KEY (cmt_product) REFERENCES product(product_id)
);

