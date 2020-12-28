-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2020 a las 03:18:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `frioven`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_venta_temp` (IN `codprod` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))  BEGIN
    		
            DECLARE precio_actual decimal(10,2);
            SELECT precio INTO precio_actual from producto WHERE idprod = codprod;
            
            INSERT INTO detalle_venta_temp(token_user,idprod,cantidad_venta,precio_venta) VALUES 				     				(token_user,codprod,cantidad,precio_actual);
            
            SELECT dt.iddet, dt.idprod,p.descripcion,dt.cantidad_venta,dt.precio_venta FROM detalle_venta_temp dt
            INNER JOIN producto p
            ON dt.idprod = p.idprod
            WHERE dt.token_user = token_user;
            
            
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura` (IN `no_factura` INT)  BEGIN
    	DECLARE existe_factura int;
        DECLARE registros int;
        DECLARE a int;
        
        DECLARE cod_producto int;
        DECLARE cant_producto int;
        DECLARE existencia_actual int;
        DECLARE nueva_existencia int;
        
        SET existe_factura = (SELECT COUNT(*) FROM factura WHERE nofactura = no_factura and activo = 'si');
        
        IF existe_factura > 0 THEN 
           CREATE TEMPORARY TABLE tbl_tmp( id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    cod_prod BIGINT,
                                    cant_prod int);
                                    
                                    SET a = 1;
                                    
                                    SET registros = (SELECT COUNT(*) FROM detallefactura WHERE nofactura = no_factura);
                                    IF registros > 0 THEN
                                    
                                    	INSERT INTO tbl_tmp(cod_prod,cant_prod) SELECT idprod,cantidad FROM detallefactura WHERE nofactura = no_factura;
                                    	
                                        WHILE a <= registros DO
                                        	SELECT cod_prod,cant_prod INTO cod_producto,cant_producto FROM tbl_tmp WHERE id = a;
                                            SELECT existencia INTO existencia_actual FROM producto where idprod = cod_producto;
                                            SET nueva_existencia = existencia_actual + cant_producto;
                                            
                                            UPDATE producto SET existencia = nueva_existencia WHERE idprod = cod_producto;
                                            SET a = a + 1;
                                         END WHILE;
                                         UPDATE factura SET activo = "no" WHERE nofactura = no_factura;
                                         DROP table tbl_tmp;
                                         
                                         SELECT * FROM factura WHERE nofactura = no_factura;
                                    
                                    
                                    END IF;
                                    
           
           
       
        
        ELSE
        	SELECT 0 FROM FACTURA;
        END IF;
        
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` VARCHAR(50))  BEGIN 
    		DELETE FROM detalle_venta_temp WHERE iddet = id_detalle;
            
            SELECT tmp.iddet,tmp.idprod,p.descripcion,tmp.cantidad_venta,tmp.precio_venta FROM detalle_venta_temp tmp
            INNER JOIN producto p
            ON tmp.idprod = p.idprod
            WHERE tmp.token_user = token;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
    		DECLARE factura INT;
            DECLARE registros INT;
            DECLARE total DECIMAL(10,2);
            DECLARE  nueva_existencia int;
            DECLARE existencia_actual int;
            DECLARE tmp_cod_producto int;
            DECLARE tmp_cant_producto int;
            DECLARE a int;
            SET a  = 1;
            
            CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
              id BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
              cod_prod BIGINT,
              cant_prod INT);
            
            
            
            
            SET registros = (SELECT COUNT(*) FROM detalle_venta_temp WHERE token_user = token);
            
            IF registros > 0 THEN
            
              	INSERT INTO tbl_tmp_tokenuser (cod_prod,cant_prod) SELECT idprod,cantidad_venta FROM detalle_venta_temp WHERE token_user = token;
                
                INSERT INTO factura (idusuario,idcliente) VALUES (cod_usuario,cod_cliente);
                SET factura = LAST_INSERT_ID();
                
                INSERT INTO detallefactura(nofactura,idprod,cantidad,precio_venta) SELECT (factura) as nofactura,idprod,cantidad_venta,precio_venta FROM detalle_venta_temp WHERE token_user = token;
                
                WHILE a <= registros DO
                
                SELECT cod_prod,cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
                SELECT existencia INTO existencia_actual FROM producto WHERE idprod = tmp_cod_producto;
                
                SET nueva_existencia = existencia_actual - tmp_cant_producto;
                UPDATE producto set existencia = nueva_existencia WHERE idprod = tmp_cod_producto;
                
                set a = a + 1;
                
                END WHILE;
                
                set total = (SELECT SUM(cantidad_venta * precio_venta) FROM detalle_venta_temp WHERE token_user = token);
                set total = (total +(total*0.18));
                UPDATE factura SET total_factura = total WHERE nofactura = factura;
                DELETE FROM detalle_venta_temp WHERE token_user = token;
                TRUNCATE TABLE tbl_tmp_tokenuser;
                SELECT * FROM factura WHERE nofactura = factura;
                
            ELSE
            	SELECT 0;
            END IF;
            
    
    
    
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `RNC` char(10) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `fecha_entrada` varchar(255) NOT NULL,
  `activo` char(2) NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `RNC`, `direccion`, `telefono`, `fecha_entrada`, `activo`) VALUES
(55, 'john', '0951670470', 'Pradera 2 Mz D31 Villa 28', '0986010023', '2020-10-22', 'si'),
(56, 'as', 'as', 'as', 'as', '2020-11-23', 'no'),
(57, 'John', '0946703560', 'Pradera 2 Mz D31 Villa 28', '+593986010023', '2020-11-06', 'no'),
(58, 'Carlos', '0974367810', 'Av. Quito', '0986023314', '2020-12-15', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `RNC` char(13) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `itbis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `RNC`, `nombre`, `telefono`, `direccion`, `email`, `itbis`) VALUES
(1, '0961261112001', 'MULTISERVICIOS FRIOVEN\r\n', '0960124924', 'Duran, ciudadela maldonado\r\n', 'multiserviciosfrioven@gmail.com', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `iddetfac` bigint(20) NOT NULL,
  `nofactura` bigint(20) NOT NULL,
  `idprod` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`iddetfac`, `nofactura`, `idprod`, `cantidad`, `precio_venta`) VALUES
(127, 62, 22, 2, '45.00'),
(128, 63, 22, 2, '45.00'),
(129, 63, 24, 10, '10.00'),
(130, 63, 24, 16, '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_temp`
--

CREATE TABLE `detalle_venta_temp` (
  `iddet` int(11) NOT NULL,
  `token_user` varchar(50) NOT NULL,
  `idprod` int(11) DEFAULT NULL,
  `cantidad_venta` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `total_factura` decimal(10,2) NOT NULL,
  `activo` char(2) NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nofactura`, `fecha_hora`, `idusuario`, `idcliente`, `total_factura`, `activo`) VALUES
(62, '2020-12-11 21:57:53', 28, 55, '106.20', 'si'),
(63, '2020-12-15 20:46:25', 28, 58, '413.00', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `activo` char(2) NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idprod`, `descripcion`, `precio`, `existencia`, `idproveedor`, `activo`) VALUES
(22, 'Lavadora', '45.00', 41, 53, 'si'),
(23, 'Cocina', '250.00', 100, 54, 'si'),
(24, 'Zapatos', '10.00', -1, 53, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `nombreprov` varchar(255) NOT NULL,
  `representante` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `activo` char(2) NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombreprov`, `representante`, `telefono`, `pais`, `activo`) VALUES
(53, 'La ganga', 'Juan Quiñonez', '0988567791', 'Ecuador', 'si'),
(54, 'Comandato', 'Richard Reyes', '0988745581', 'Ecuador', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `fullname`, `username`, `password`, `rol`) VALUES
(4, 'Alba Vasquez', 'Alba', '12345', 'vendedor'),
(27, 'Carlos Luis Pazmiño Palma', 'Carlos', '$2y$10$I4kvMhD4Jodl7b7Ro/IuwOEfdFP1uvB7hYPrMl6CXavHfhCE0xV96', 'administrador'),
(28, 'Emiliana Arismendi', 'emi', '$2y$10$LU5yxgn.AP399MiKQJJnSewlA3656WjEnt2vYjbU97JxWHt8lDT6S', 'administrador'),
(29, 'Christian Gonzalez', 'Christian', '$2y$10$lBu.Lp4Ql/9.Ea.WBiZFae86NGR7L4rz68Z.2zzVEGOEG0wJMxSZ.', 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_actual`
--

CREATE TABLE `usuario_actual` (
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `year`
--

CREATE TABLE `year` (
  `year` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `year`
--

INSERT INTO `year` (`year`) VALUES
('2019'),
('2020'),
('2021');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`iddetfac`),
  ADD KEY `nofactura` (`nofactura`),
  ADD KEY `idprod` (`idprod`);

--
-- Indices de la tabla `detalle_venta_temp`
--
ALTER TABLE `detalle_venta_temp`
  ADD PRIMARY KEY (`iddet`),
  ADD KEY `idprod` (`idprod`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idprod`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD KEY `idproveedor` (`idproveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `usuario_actual`
--
ALTER TABLE `usuario_actual`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `iddetfac` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_temp`
--
ALTER TABLE `detalle_venta_temp`
  MODIFY `iddet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario_actual`
--
ALTER TABLE `usuario_actual`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`);

--
-- Filtros para la tabla `detalle_venta_temp`
--
ALTER TABLE `detalle_venta_temp`
  ADD CONSTRAINT `detalle_venta_temp_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
