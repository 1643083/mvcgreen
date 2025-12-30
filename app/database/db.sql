DROP DATABASE IF EXISTS vivero;
CREATE DATABASE vivero;

USE vivero;

CREATE TABLE planta
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR(100)  NOT NULL,
  tipo          VARCHAR(50)   NOT NULL,
  precio        DECIMAL(10,2) NOT NULL,
  stock         INT NOT NULL,
  descripcion   VARCHAR(100),
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado fecha y hora',
  updated       DATETIME      NULL COMMENT 'Se agrega al detectar un cambio'
)ENGINE = INNODB;

INSERT INTO planta (nombre, tipo, precio, stock, descripcion)
VALUES
('Rosa', 'Ornamental', 12.50, 30, 'Planta ornamental con flores rojas'),
('Aloe Vera', 'Medicinal', 8.00, 20, 'Planta medicinal de fácil cuidado'),
('Ficus', 'Interior', 15.75, 10, 'Planta ideal para interiores y oficinas');

SELECT * FROM planta;