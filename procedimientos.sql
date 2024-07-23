--PROCEDIMIENTOS
--------------------------------------------------------------------------------------------------------------------
-- Este procemidiento nos serviria para poder agregar nuevas habitaciones con su respectivo tipo de habitacion

DELIMITER //
CREATE PROCEDURE agregar_habitaciones
(in tipo varchar(25))
begin
DECLARE num_habitacion1 int default 122; 
DECLARE incremento int default 1;

DECLARE num_habitacion2 int default 204;

DECLARE num_habitacion3 int default 303;

declare num_habitaciones int ;



if tipo=1 then
select max(num_habitacion) into num_habitaciones  from habitacion WHERE habitacion.num_habitacion LIKE "1%";
set num_habitaciones =num_habitaciones + incremento;
insert into habitacion (num_habitacion,piso,estado_habitacion,tipo_habitacion)
values (num_habitaciones,1,'disponible',tipo);
end if;

if tipo=2 then
select max(num_habitacion) into num_habitaciones  from habitacion WHERE habitacion.num_habitacion LIKE "2%";
set num_habitaciones =num_habitaciones + incremento;
insert into habitacion (num_habitacion,piso,estado_habitacion,tipo_habitacion)
values (num_habitaciones,2,'disponible',tipo);
end if;

if tipo=3 then
select max(num_habitacion) into num_habitaciones  from habitacion WHERE habitacion.num_habitacion LIKE "3%";
set num_habitaciones =num_habitaciones + incremento;
insert into habitacion (num_habitacion,piso,estado_habitacion,tipo_habitacion)
values (num_habitaciones,3,'disponible',tipo);
end if;

END //
DELIMITER ;

 call agregar_habitaciones (1);


 ----------------------------------------------------------------------------------------------------------------------

 -- PROCEDIMIENTO PARA ASIGNARLE EL ROL DE HUESPED A UNA PERSONA EN WEB

-- Estre procedimiento toma los datos de nuestro usuario para poder darle de alta dentro de la aplicacion web con su respectivo rol
DELIMITER //
CREATE PROCEDURE RegistrarUsuarioHuesped(
    IN nombre_usuario VARCHAR(30),
    IN n_password TEXT,
    IN correo VARCHAR(40)
)
BEGIN
    DECLARE usuario_id INT;
    DECLARE rol_huesped INT DEFAULT 1;
    INSERT INTO USUARIOS (nombre_usuario, password, correo)
    VALUES (nombre_usuario, n_password, correo);
    SET usuario_id = LAST_INSERT_ID();
    INSERT INTO ROL_USUARIO (rol, usuario)
    VALUES (rol_huesped, usuario_id);
END //

DELIMITER ;

 CALL RegistrarUsuarioHuesped('gaelenlinea','contraseña','holamundos1@gmail.com');


 ----------------------------------------------------------------------------------------------------------------------------


-- PROCEDIMIENTO PARA BUSCAR LA INFORMACION DE MI FACTURACION CON MI NUMERO DE RESERVACION

DELIMITER //

CREATE PROCEDURE Consultar_Informacion_Facturacion(
IN N_reservacion INT
)
BEGIN
SELECT nombre,apellido_paterno,apellido_materno,rfc,direccion,monto_total,metodo_pago
from reservacion
JOIN detalle_pago on reservacion.id_reservacion = detalle_pago.reservacion
JOIN facturacion on detalle_pago.id_detalle_pago = facturacion.detalle_pago 
where reservacion.id_reservacion = N_reservacion ;
END //
delimiter ;

CALL Consultar_Informacion_Facturacion ('23');

--------------------------------------------------------------------------------------------------------------------

--PROCEDIMIENTO PARA DAR DE ALTA EL USUARIO DEL RECCEPCIONISTA YA CON SU ROL DE RECEPCIONISTA

DELIMITER //
CREATE PROCEDURE RegistrarUsuarioRecepcionista(
IN nombre_usuario VARCHAR(30),
IN n_password text,
IN correo VARCHAR(40)
)
BEGIN
DECLARE usuario_id INT;
DECLARE rol_recepcionista INT DEFAULT 2;
INSERT INTO USUARIOS(nombre_usuario, password, correo)
VALUES (nombre_usuario, n_password, correo);
SET usuario_id = LAST_INSERT_ID();
INSERT INTO ROL_USUARIO(rol, usuario)
VALUES (rol_recepcionista, usuario_id);
END //
DELIMITER ;
CALL RegistrarUsuarioRecepcionista('examplessss','11223344','holassss@gmail.com');

----------------------------------------------------------------------------------------------------

--PROCEDIMIENTO PARA DAR DE ALTA LA INFORMACION COMPLETA DEL RECEPCIONISTA


DELIMITER //

CREATE PROCEDURE Registrarrecepcionistapersona(
IN nombre VARCHAR(30),
IN apellido_paterno VARCHAR(30),
IN apellido_materno VARCHAR(30),
IN fecha_nacimiento DATE,
IN direccion VARCHAR(100),
IN ciudad VARCHAR(50),
IN estado VARCHAR(50),
IN codigo_postal VARCHAR(10),
IN pais VARCHAR(50),
IN genero CHAR(1),
IN numero_telefono CHAR(10),
IN curp VARCHAR(18),
IN fecha_de_contratacion DATE,
IN Numero_de_Seguridad_social VARCHAR(20),
IN Afore VARCHAR(30),
IN Numero_De_Emergencia CHAR(10)
)
BEGIN
DECLARE persona_id INT;
DECLARE usuario_id INT;
SELECT MAX(id_usuario) INTO usuario_id FROM USUARIOS;
INSERT INTO PERSONA (
Nombre, Apellido_paterno, Apellido_materno, Fecha_de_Nacimiento,
direccion, ciudad, estado, codigo_postal, pais, Genero,
Numero_De_Telefono, usuario) 
VALUES (nombre, apellido_paterno, apellido_materno, fecha_nacimiento,
direccion, ciudad, estado, codigo_postal, pais, genero,
numero_telefono, usuario_id);
SET persona_id = LAST_INSERT_ID();
INSERT INTO RECEPCIONISTA (
curp, fecha_de_contratacion, Numero_de_Seguridad_social, Afore,
Numero_De_Emergencia, persona_recepcionista) VALUES (
curp, fecha_de_contratacion, Numero_de_Seguridad_social, Afore,
Numero_De_Emergencia, persona_id);
END //

DELIMITER ;


-----------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE actualizar_informacion_correo_electronico(
in correo_electronico varchar(40),
in usuario int
)
BEGIN
UPDATE usuarios
SET
correo = correo_electronico
WHERE
usuarios.id_usuario = usuario;
END// 
DELIMITER ;

CALL actualizar_informacion_correo_electronico('correoejemplo@gmail.com',1);


DELIMITER //
CREATE PROCEDURE actualizar_informacion_contraseña(
in contraseña_usuario text,
in usuario int
)
BEGIN
UPDATE usuarios
SET
password = contraseña_usuario
WHERE
usuarios.id_usuario = usuario;
END// 
DELIMITER ;

CALL actualizar_informacion_contraseña('12345',1);



DELIMITER //
CREATE PROCEDURE actualizar_informacion_nombre_usuario(
in nombre_usuario_logueado varchar(30),
in usuario int
)
BEGIN
UPDATE usuarios
SET
nombre_usuario = nombre_usuario_logueado
WHERE
usuarios.id_usuario = usuario;
END// 
DELIMITER ;

CALL actualizar_informacion_nombre_usuario('gaelhacker',1);



----------------------------------------------------------------------------------------------------------------------------------------


--PROCEDIMIENTO PARA DAR DE ALTA EL USUARIO DE ADMINISTRADOR YA CON SU ROL DE ADMINISTRADOR

DELIMITER //
CREATE PROCEDURE RegistrarUsuarioAdmin(
IN nombre_usuario VARCHAR(30),
IN n_password text,
IN correo VARCHAR(40)
)
BEGIN
DECLARE usuario_id INT;
DECLARE rol_admin INT DEFAULT 2;
INSERT INTO USUARIOS(nombre_usuario, password, correo)
VALUES (nombre_usuario, n_password, correo);
SET usuario_id = LAST_INSERT_ID();
INSERT INTO ROL_USUARIO(rol, usuario)
VALUES (rol_admin, usuario_id);
END //
DELIMITER ;
CALL RegistrarUsuarioAdmin('examplessss','11223344','holassss@gmail.com');


--------------------------------------------------------------------------------------------------------------------


-- procedimiento que nos ayudara a hacer un update en mi detalle reservacion para especificar que personas asistieron
DELIMITER //
CREATE PROCEDURE check_in_huesped(
in detalle_reservacion int,
in nombre_titular_reservacion varchar(60)
)
begin
UPDATE detalle_reservacion
SET detalle_reservacion.TITULAR_HABITACION = nombre_titular_reservacion
WHERE detalle_reservacion.ID_DETALLE_RESRVACION = detalle_reservacion;
END// 
DELIMITER ;

----------------------------------------------------------------------------------------------------------------------