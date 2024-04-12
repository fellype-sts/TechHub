-- DB FODA --
DROP DATABASE IF EXISTS techhub;

CREATE DATABASE techhub CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE techhub;

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
    product_thumbnail VARCHAR(255),
    product_summary VARCHAR(255),
    product_seller VARCHAR(255),
    product_content TEXT,
    product_emp INT,
    product_category INT,
    product_views INT DEFAULT '0',
    product_status ENUM('on', 'off', 'del') DEFAULT 'on',
    product_price FLOAT,
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

CREATE TABLE ranking (
    rank_id INT PRIMARY KEY AUTO_INCREMENT,
    rank_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rank_product INT,
    rank_content TEXT,
    rank_scale INT,
    FOREIGN KEY (rank_product) REFERENCES product(product_id)
);

INSERT INTO
    `employee` (
        `emp_id`,
        `emp_date`,
        `emp_photo`,
        `emp_name`,
        `emp_birth`,
        `emp_email`,
        `emp_password`,
        `emp_type`,
        `emp_status`
    )
VALUES
    (
        '1',
        current_timestamp(),
        NULL,
        '',
        NULL,
        'emp@email.com',
        'emp',
        'moderator',
        'on'
    );

INSERT INTO
    `category` (`ctr_id`, `ctr_name`)
VALUES
    ('1', '\'mouse\''),
    ('2', '\'teclado\''),
    ('3', '\'monitor\''),
    ('4', '\'placa de video\''),
    ('5', '\'placa mae\'');

INSERT INTO
    product (
        product_id,
        product_name,
        product_date,
        product_thumbnail,
        product_summary,
        product_seller,
        product_content,
        product_emp,
        product_category,
        product_views,
        product_status,
        product_price
    )
VALUES
    (
        1,
        'Mouse Logitech 203',
        '2024-04-08',
        'www.placeholder.com',
        'Mouse Logitech 203 é um dos mouses mais vendidos do mercado.',
        'https://www.mercadolivre.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer"> 
    <figcaption>Imagem aleatória.</figcaption>
    </figure>
    
    ',
        1,
        1,
        0,
        'on',
        199.99
    ),
    (
        2,
        'Teclado Razer BlackWidow',
        '2024-04-08',
        'www.placeholder.com',
        'Teclado Razer BlackWidow é um dos teclados mais populares entre os gamers.',
        'https://www.magazineluiza.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">
    <figcaption>Imagem aleatória.</figcaption>
    </figure>
    
    ',
        1,
        2,
        0,
        'on',
        399.99
    ),
    (
        3,
        'Monitor Samsung 27"',
        '2024-04-08',
        'www.placeholder.com',
        'Monitor Samsung 27" proporciona uma experiência imersiva de alta qualidade.',
        'https://www.mercadolivre.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
    <figcaption>Imagem aleatória.</figcaption> 
    </figure>
    
    ',
        1,
        3,
        0,
        'on',
        999.99
    ),
    (
        4,
        'Placa de Vídeo NVIDIA RTX 3080',
        '2024-04-08',
        'www.placeholder.com',
        'Placa de Vídeo NVIDIA RTX 3080 oferece alto desempenho para jogos e renderização.',
        'https://www.magazineluiza.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        4,
        0,
        'on',
        1499.99
    ),
    (
        5,
        'Placa Mãe ASUS ROG Strix Z590-E',
        '2024-04-08',
        'www.placeholder.com',
        'Placa Mãe ASUS ROG Strix Z590-E é uma escolha popular entre os entusiastas de gaming.',
        'https://www.mercadolivre.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        5,
        0,
        'on',
        349.99
    ),
    (
        6,
        'Mouse Gamer HyperX Pulsefire FPS Pro',
        '2024-04-08',
        'www.placeholder.com',
        'O Mouse Gamer HyperX Pulsefire FPS Pro é projetado para jogadores profissionais.',
        'https://www.mercadolivre.com.br/',
        '<figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    ',
        1,
        1,
        0,
        'on',
        159.99
    ),
    (
        7,
        'Teclado mecânico Corsair K95 RGB Platinum XT',
        '2024-04-08',
        'www.placeholder.com',
        'O Teclado mecânico Corsair K95 RGB Platinum XT oferece desempenho premium e personalização avançada.',
        'https://www.magazineluiza.com.br/',
        '
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        2,
        0,
        'on',
        899.99
    ),
    (
        8,
        'Monitor LG UltraGear 27GN950-B',
        '2024-04-08',
        'www.placeholder.com',
        'O Monitor LG UltraGear 27GN950-B é ideal para jogos de alta velocidade e conteúdo 4K.',
        'https://www.mercadolivre.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        3,
        0,
        'on',
        2499.99
    ),
    (
        9,
        'Placa de Vídeo AMD Radeon RX 6800 XT',
        '2024-04-08',
        'www.placeholder.com',
        'A Placa de Vídeo AMD Radeon RX 6800 XT oferece desempenho excepcional para jogos e criação de conteúdo.',
        'https://www.magazineluiza.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        4,
        0,
        'on',
        1999.99
    ),
    (
        10,
        'Placa Mãe MSI MAG B550 TOMAHAWK',
        '2024-04-08',
        'www.placeholder.com',
        'A Placa Mãe MSI MAG B550 TOMAHAWK é uma escolha popular entre os entusiastas.',
        'https://www.mercadolivre.com.br/',
        '
    
    <figure>
    <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
                      
    </figure>
    
    ',
        1,
        5,
        0,
        'on',
        799.99
    );

INSERT INTO
    comment (
        cmt_product,
        cmt_social_id,
        cmt_social_name,
        cmt_social_photo,
        cmt_social_email,
        cmt_content
    )
VALUES
    (
        '1', 
    'abc123',
    'doutor bélico', 
    'https://randomuser.me/api/portraits/men/14.jpg',
    'doutor@belico.com',
    'bélico bélico'
    );