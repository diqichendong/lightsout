CREATE TABLE tipo_usuario (
  nombre VARCHAR(255) PRIMARY KEY
);

INSERT INTO tipo_usuario (nombre) VALUES('Normal');
INSERT INTO tipo_usuario (nombre) VALUES('Administrador');

CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  tipo VARCHAR(255) NOT NULL,
  foto VARCHAR(255),
  sobre_mi VARCHAR(255),
  FOREIGN KEY (tipo) REFERENCES tipo_usuario(nombre)
);

INSERT INTO usuarios (username, password, nombre, email, tipo, foto) VALUES(
  'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'admin@lightsout.com', 'Administrador', 'default.jpg'
);

CREATE TABLE amigos (
  id_usuario_1 INT NOT NULL,
  id_usuario_2 INT NOT NULL,
  PRIMARY KEY (id_usuario_1, id_usuario_2),
  FOREIGN KEY (id_usuario_1) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_usuario_2) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE tipo_ficha (
  nombre VARCHAR(255) PRIMARY KEY
);

INSERT INTO tipo_ficha (nombre) VALUES('tv');
INSERT INTO tipo_ficha (nombre) VALUES('movie');

CREATE TABLE fichas (
  id INT NOT NULL,
  tipo VARCHAR(255) NOT NULL,
  titulo VARCHAR(255) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  PRIMARY KEY (id, tipo),
  FOREIGN KEY (tipo) REFERENCES tipo_ficha(nombre)
);

CREATE TABLE posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  contenido VARCHAR(500) NOT NULL,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_usuario INT NOT NULL,
  id_ficha INT NOT NULL,
  ficha_tipo VARCHAR(255) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_ficha, ficha_tipo) REFERENCES fichas(id, tipo) ON DELETE CASCADE
);

CREATE TABLE lights (
  id_usuario INT NOT NULL,
  id_post INT NOT NULL,
  PRIMARY KEY (id_usuario, id_post),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_post) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE comentarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  contenido VARCHAR(255) NOT NULL,
  fecha TIMESTAMP NOT NULL,
  id_usuario INT NOT NULL,
  id_post INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_post) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE notas (
  id_usuario INT NOT NULL,
  id_ficha INT NOT NULL,
  ficha_tipo VARCHAR(255) NOT NULL,
  valor INT NOT NULL,
  PRIMARY KEY (id_usuario, id_ficha),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_ficha, ficha_tipo) REFERENCES fichas(id, tipo) ON DELETE CASCADE
);

CREATE TABLE estados (
  nombre VARCHAR(255) PRIMARY KEY
);

INSERT INTO estados (nombre) VALUES('Siguiendo');
INSERT INTO estados (nombre) VALUES('Pendiente');
INSERT INTO estados (nombre) VALUES('Favorita');
INSERT INTO estados (nombre) VALUES('Vista');

CREATE TABLE seguimiento (
  id_usuario INT NOT NULL,
  id_ficha INT NOT NULL,
  ficha_tipo VARCHAR(255) NOT NULL,
  estado VARCHAR(255) NOT NULL,
  fecha_actualizacion TIMESTAMP NOT NULL,
  PRIMARY KEY (id_usuario, id_ficha),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_ficha, ficha_tipo) REFERENCES fichas(id, tipo) ON DELETE CASCADE,
  FOREIGN KEY (estado) REFERENCES estados(nombre)
);

CREATE TABLE mensajes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  contenido VARCHAR(255) NOT NULL,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_usuario_emisor INT NOT NULL,
  id_usuario_receptor INT NOT NULL,
  FOREIGN KEY (id_usuario_emisor) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_usuario_receptor) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE denuncias_posts (
  id_post INT PRIMARY KEY,
  FOREIGN KEY (id_post) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE denuncias_comentarios (
  id_comentario INT PRIMARY KEY,
  FOREIGN KEY (id_comentario) REFERENCES comentarios(id) ON DELETE CASCADE
);