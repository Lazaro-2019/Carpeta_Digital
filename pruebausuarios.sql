/*
Navicat MySQL Data Transfer

Source Server         : sistema
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : pruebausuarios

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2019-11-28 22:57:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for archivos
-- ----------------------------
DROP TABLE IF EXISTS `archivos`;
CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL auto_increment,
  `nombre_archivo` text,
  `descripcion_archivo` text,
  `id_categoria` int(11) default NULL,
  `id_pregunta` int(11) default NULL,
  `fecha_registro` date default NULL,
  `hora_registro` time default NULL,
  `anio` int(255) default NULL,
  `activo` int(11) default NULL,
  PRIMARY KEY  (`id_archivo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of archivos
-- ----------------------------

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL auto_increment,
  `nombre_categoria` text,
  `ico_categoria` text,
  `id_registro` int(11) default NULL,
  `fecha_registro` date default NULL,
  `hora_registro` time default NULL,
  `activo` int(11) default NULL,
  PRIMARY KEY  (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Planeación', 'fas fa-project-diagram', '1', '2019-11-13', '08:17:11', '1');
INSERT INTO `categorias` VALUES ('2', 'Liderazgo', 'fas fa-walking', '1', '2019-11-13', '08:17:25', '1');
INSERT INTO `categorias` VALUES ('3', 'Usuarios', 'fas fa-users', '1', '2019-11-13', '08:17:40', '1');
INSERT INTO `categorias` VALUES ('4', 'Talento Humano', 'fas fa-people-carry', '1', '2019-11-13', '08:17:57', '1');
INSERT INTO `categorias` VALUES ('5', 'Resp. Social', 'fas fa-universal-access', '1', '2019-11-13', '08:18:16', '1');
INSERT INTO `categorias` VALUES ('6', 'Procesos', 'fas fa-sitemap', '1', '2019-11-13', '08:18:30', '1');

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL auto_increment,
  `nombre` text,
  `ap_paterno` text,
  `ap_materno` text,
  `sexo` text,
  `direccion` text,
  `telefono` text,
  `fecha_nacimiento` date default NULL,
  `correo` text,
  `id_registro` int(11) default NULL,
  `fecha_registro` date default NULL,
  `hora_registro` time default NULL,
  `activo` int(11) default NULL,
  PRIMARY KEY  (`id_persona`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', 'Lázaro Humberto', 'Carmona', 'Sánchez', 'M', 'Montemorelos', '8261234567', '2019-11-06', 'Lazaro@gmail.com', '1', '2019-11-06', '12:37:07', '1');

-- ----------------------------
-- Table structure for preguntas
-- ----------------------------
DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL auto_increment,
  `pregunta` text,
  `id_categoria` int(11) default NULL,
  `fecha_registro` date default NULL,
  `hora_registro` time default NULL,
  `activo` int(11) default NULL,
  PRIMARY KEY  (`id_pregunta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of preguntas
-- ----------------------------

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `usuario` text,
  `contra` text,
  `id_persona` int(11) default NULL,
  `id_registro` int(11) default NULL,
  `pvez` int(11) default NULL,
  `fecha_registro` date default NULL,
  `hora_registro` time default NULL,
  `tipo_usuario` text,
  `idCategoria` int(255) default NULL,
  `activo` int(11) default NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'l4z4r0', '7815696ecbf1c96e6894b779456d330e', '1', '1', '0', '2019-11-06', '00:00:12', 'Administrador', null, '1');
