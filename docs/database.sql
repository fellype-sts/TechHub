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
        'https://m.media-amazon.com/images/I/61UxfXTUyvL._AC_SX679_.jpg',
        'Mouse Logitech 203 é um dos mouses mais vendidos do mercado.',
        'https://www.amazon.com.br/Logitech-LIGHTSYNC-Efeito-Bot%C3%B5es-Program%C3%A1veis/dp/B087CT8PWY/ref=asc_df_B087CT8PWY/?tag=googleshopp00-20&linkCode=df0&hvadid=379708004298&hvpos=&hvnetw=g&hvrand=13408018549920144133&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1001655&hvtargid=pla-986255958677&mcid=0ff7a2001aaa3f2487523e11227b7605&th=1',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/61UxfXTUyvL._AC_SX679_.jpg"> 
    <figcaption>Imagem aleatória.</figcaption>
    </figure>
    
    ',
        1,
        1,
        0,
        'on',
        193.91
    ),
    (
        2,
        'Teclado Razer BlackWidow',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/71Nqzh-u2rL._AC_SX679_.jpg',
        'Teclado Razer BlackWidow é um dos teclados mais populares entre os gamers.',
        'https://www.amazon.com.br/Razer-Rz-tc-bw-68rt-Teclado-Blackwidow-Tenkeyless/dp/B08H5LW86P/ref=asc_df_B08H5LW86P/?tag=googleshopp00-20&linkCode=df0&hvadid=379720486248&hvpos=&hvnetw=g&hvrand=14457608937992656664&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1001655&hvtargid=pla-1174544189686&psc=1&mcid=cf801737b29038ddb0051ea19eb3646b',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/71Nqzh-u2rL._AC_SX679_.jpg">
    <figcaption>Imagem aleatória.</figcaption>
    </figure>
    
    ',
        1,
        2,
        0,
        'on',
        899.00
    ),
    (
        3,
        'Monitor Samsung 27"',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/51Cu-Uh2WrL.__AC_SX300_SY300_QL70_ML2_.jpg',
        'Monitor Samsung 27" proporciona uma experiência imersiva de alta qualidade.',
        'https://www.amazon.com.br/Monitor-Gamer-Samsung-Freesync-Preto/dp/B098ZN8NTX/ref=asc_df_B098ZN8NTX/?tag=googleshopp00-20&linkCode=df0&hvadid=379720128954&hvpos=&hvnetw=g&hvrand=3873357588513448285&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1001655&hvtargid=pla-1601813349595&psc=1&mcid=6627ac35d80b3270868a3dc651a572e2',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/51Cu-Uh2WrL.__AC_SX300_SY300_QL70_ML2_.jpg" alt="Imagem qualquer">    
    <figcaption>Imagem aleatória.</figcaption> 
    </figure>
    
    ',
        1,
        3,
        0,
        'on',
        749.00
    ),
    (
        4,
        'Placa de Vídeo NVIDIA RTX 4060',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/7161hBXeyLL.__AC_SX300_SY300_QL70_ML2_.jpg',
        'Placa de Vídeo NVIDIA RTX 4060 oferece alto desempenho para jogos e renderização.',
        'https://www.amazon.com.br/Placa-RTX4060TI-1-CLICK-128BIT-46ISL8MD8COC/dp/B0C5T2N31S/ref=asc_df_B0C5T2N31S/?tag=googleshopp00-20&linkCode=df0&hvadid=647682162692&hvpos=&hvnetw=g&hvrand=5279484693416606797&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1001655&hvtargid=pla-2196911325316&psc=1&mcid=f08212cc0f13363685e91013f983657d',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/7161hBXeyLL.__AC_SX300_SY300_QL70_ML2_.jpg">    
                      
    </figure>
    
    ',
        1,
        4,
        0,
        'on',
        2728.80
    ),
    (
        5,
        'Placa Mãe ASUS ROG Strix Z590-E',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/61BGKxpx9LL.__AC_SX300_SY300_QL70_ML2_.jpg',
        'Placa Mãe ASUS ROG Strix Z590-E é uma escolha popular entre os entusiastas de gaming.',
        'https://www.pichau.com.br/placa-mae-asus-rog-strix-b760-f-gaming-wifi-ddr5-socket-lga1700-atx-chipset-intel-b760-rog-strix-b760-f-gaming-wifi?gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5jZfpeiFWHRDeJDEEX2w3YDA5exXCIx9i9xbvnAtT431ODzjw2MSxwaAvDpEALw_wcB',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/61BGKxpx9LL.__AC_SX300_SY300_QL70_ML2_.jpg">    
                      
    </figure>
    
    ',
        1,
        5,
        0,
        'on',
        2199.99
    ),
    (
        6,
        'Mouse Gamer HyperX Pulsefire FPS Pro',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/51pnw-Y7YaL._AC_SX679_.jpg',
        'O Mouse Gamer HyperX Pulsefire FPS Pro é projetado para jogadores profissionais.',
        'https://www.amazon.com.br/Mouse-Gamer-HyperX-Pulsefire-16000dpi/dp/B07FLP9391/ref=asc_df_B07FLP9391/?tag=googleshopp00-20&linkCode=df0&hvadid=379713309507&hvpos=&hvnetw=g&hvrand=14805611641800290201&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1001655&hvtargid=pla-487754611436&psc=1&mcid=112e0ba5bdee344ea3a812abb9da6fd2',
        '<figure>
    <img src="https://m.media-amazon.com/images/I/51pnw-Y7YaL._AC_SX679_.jpg">    
                      
    </figure>
    ',
        1,
        1,
        0,
        'on',
        292.59
    ),
    (
        7,
        'Teclado mecânico Corsair K95 RGB Platinum XT',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/61IH0WyrUvL._AC_SX679_.jpg',
        'O Teclado mecânico Corsair K95 RGB Platinum XT oferece desempenho premium e personalização avançada.',
        'https://www.pichau.com.br/teclado-mecanico-corsair-k95-rgb-platinum-xt-switch-cherry-mx-speed-us-ch-9127414-na?gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5jqkS4bleXZh340E-KBl83fV8ptlm2AX2X2dZxwcfr3uAmpYwhdKRYaAuJVEALw_wcB',
        '
    <figure>
    <img src="https://m.media-amazon.com/images/I/61IH0WyrUvL._AC_SX679_.jpg">    
                      
    </figure>
    
    ',
        1,
        2,
        0,
        'on',
        1438.99
    ),
    (
        8,
        'Monitor LG UltraGear 27GN950-B',
        '2024-04-08',
        'https://m.media-amazon.com/images/I/61wLIIrbSZL.__AC_SX300_SY300_QL70_ML2_.jpg',
        'O Monitor LG UltraGear 27GN950-B é ideal para jogos de alta velocidade e conteúdo 4K.',
        'https://www.kabum.com.br/produto/444038/monitor-gamer-lg-ultragear-27-full-hd-144hz-1ms-ips-hdmi-e-displayport-hdr-10-99-srgb-freesync-premium-vesa-27gn65r?gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5jmgyBT3r40fT1VDvqKq5SK_VH-RgwLPsETwK7t-Ifr3sAuZ6on6h8aAhu5EALw_wcB',
        '
    
    <figure>
    <img src="https://m.media-amazon.com/images/I/61wLIIrbSZL.__AC_SX300_SY300_QL70_ML2_.jpg">    
                      
    </figure>
    
    ',
        1,
        3,
        0,
        'on',
        999.99
    ),
    (
        9,
        'Placa de Vídeo AMD Radeon RX 6800 XT',
        '2024-04-08',
        'https://images.kabum.com.br/produtos/fotos/519910/placa-de-video-rx-6800xt-graffiti-series-16gb-gddr6-256-bits-pjrx6800gr616gbgs_1708529434_gg.jpg',
        'A Placa de Vídeo AMD Radeon RX 6800 XT oferece desempenho excepcional para jogos e criação de conteúdo.',
        'https://www.kabum.com.br/produto/519910/placa-de-video-rx-6800xt-graffiti-series-16gb-gddr6-256-bits-pjrx6800gr616gbgs?gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5hQ680Ew9jDEmNAMDiSo5JtMLtIx0C7vbDhWZy6ighfeLB8ruTPEjYaAks7EALw_wcB',
        '
    
    <figure>
    <img src="https://images.kabum.com.br/produtos/fotos/519910/placa-de-video-rx-6800xt-graffiti-series-16gb-gddr6-256-bits-pjrx6800gr616gbgs_1708529434_gg.jpg">    
                      
    </figure>
    
    ',
        1,
        4,
        0,
        'on',
        3499.99
    ),
    (
        10,
        'Placa Mãe MSI MAG B550 TOMAHAWK',
        '2024-04-08',
        'https://images.kabum.com.br/produtos/fotos/114334/placa-mae-msi-mag-b550-tomahawk-amd-am4-atx_1593462258_gg.jpg',
        'A Placa Mãe MSI MAG B550 TOMAHAWK é uma escolha popular entre os entusiastas.',
        'https://www.kabum.com.br/produto/114334/placa-mae-msi-mag-b550-tomahawk-amd-am4-atx-ddr4?gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5jOAfFuE3YVAP7HgmTr7bVkC23Q3lfud5tmbudVz_OiNqJElb4CVNYaAuW5EALw_wcB',
        '
    
    <figure>
    <img src="https://images.kabum.com.br/produtos/fotos/114334/placa-mae-msi-mag-b550-tomahawk-amd-am4-atx_1593462258_gg.jpg">    
                      
    </figure>
    
    ',
        1,
        5,
        0,
        'on',
        1199.99
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