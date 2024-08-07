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

----------------------------------------------------------------------------------------------------------------------
-- Este procedimiento nos sera muy util para poder obtener la cantidad de las habitaciones disponibles que se encuentren en el rango de fechas
-- para poder ajustarlo a la disponibilidad de nuestras habitaciones 
DELIMITER //
create procedure Disponibilidad_habitaciones_doble
(in fecha_inicio dateTIME , in fecha_fin datetime)
begin

DECLARE fecha_inicioo datetime;
DECLARE fecha_finn datetime;

 SET fecha_inicioo = DATE_FORMAT(fecha_inicio, '%Y-%m-%d 15:00:00');
    SET fecha_finn = DATE_FORMAT(fecha_fin, '%Y-%m-%d 12:00:00');

select count(habitacion.id_habitacion) as doble
from habitacion inner join t_habitacion on habitacion.tipo_habitacion=t_habitacion.id_tipo_habitacion
where t_habitacion.nombre = 'Doble'
AND HABITACION.ID_HABITACION NOT IN (
SELECT DETALLE_RESERVACION.HABITACION 
FROM DETALLE_RESERVACION
WHERE DETALLE_RESERVACION.FECHA_INICIO <= fecha_finn
and DETALLE_RESERVACION.FECHA_FIN >= fecha_inicioo );



end //
DELIMITER ; 


--------------------------------------------------------------------------------------------------------------------------
DELIMITER //
create procedure Disponibilidad_habitaciones_kingsize
(in fecha_inicio date , in fecha_fin date)
begin

DECLARE fecha_inicioo date;
DECLARE fecha_finn date;

 SET fecha_inicioo = DATE_FORMAT(fecha_inicio, '%Y-%m-%d 15:00:00');
    SET fecha_finn = DATE_FORMAT(fecha_fin, '%Y-%m-%d 12:00:00');

select count(habitacion.id_habitacion) as 'King Size'
from habitacion inner join t_habitacion on habitacion.tipo_habitacion=t_habitacion.id_tipo_habitacion
where t_habitacion.nombre = 'King Size'
AND HABITACION.ID_HABITACION NOT IN (
SELECT DETALLE_RESERVACION.HABITACION 
FROM DETALLE_RESERVACION
WHERE DETALLE_RESERVACION.FECHA_INICIO <= fecha_finn
and DETALLE_RESERVACION.FECHA_FIN >= fecha_inicioo );



end //
DELIMITER ;

-------------------------------------------------------------------------------------------------------------------------------------
DELIMITER //
create procedure Disponibilidad_habitaciones_sencilla
(in fecha_inicio date , in fecha_fin date)
begin

DECLARE fecha_inicioo date;
DECLARE fecha_finn date;

     SET fecha_inicioo = DATE_FORMAT(fecha_inicio, '%Y-%m-%d 15:00:00');
    SET fecha_finn = DATE_FORMAT(fecha_fin, '%Y-%m-%d 12:00:00');

select count(habitacion.id_habitacion) as 'Sencilla'
from habitacion inner join t_habitacion on habitacion.tipo_habitacion=t_habitacion.id_tipo_habitacion
where t_habitacion.nombre = 'Sencilla'
AND HABITACION.ID_HABITACION NOT IN (
SELECT DETALLE_RESERVACION.HABITACION 
FROM DETALLE_RESERVACION
WHERE DETALLE_RESERVACION.FECHA_INICIO <= fecha_finn
and DETALLE_RESERVACION.FECHA_FIN >= fecha_inicioo );



end //
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
DECLARE rol_admin INT DEFAULT 3;
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
WHERE detalle_reservacion.ID_DETALLE_RESERVACION = detalle_reservacion;
END// 
DELIMITER ;

----------------------------------------------------------------------------------------------------------------------

-- PROCEDIMIENTO PARA BUSCAR LA INFORMACION DE CONTACTO DE UN HUESPED
DELIMITER //
CREATE PROCEDURE info_huesped(
in N_reservacion int
)
begin
SELECT
CONCAT(NOMBRE, ' ', APELLIDO_PATERNO, ' ', APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
FECHA_DE_NACIMIENTO,
CONCAT(DIRECCION, ', ', CIUDAD, ', ', ESTADO, ', ', CODIGO_POSTAL, ', ', PAIS) AS DIRECCION_COMPLETA,
GENERO,NUMERO_DE_TELEFONO
from persona
join huesped on huesped.PERSONA_HUESPED = persona.ID_PERSONA
join reservacion on reservacion.HUESPED = huesped.ID_HUESPED
WHERE reservacion.id_reservacion = N_reservacion;
end //
delimiter ;

CALL info_huesped(1)


---------------------------------------------------------------------------------------------------------------------------------------


-- PROCEDIMIENTO QUE USO PARA VERIFICAR LA DISPONIBILIDAD POR UNA SOLA HABITACION
DELIMITER //
CREATE PROCEDURE Verificar_Disponibilidad_Habitacion(
IN numero_de_habitacion INT, 
IN nueva_fecha_inicio DATE, 
IN nueva_fecha_fin DATE)
BEGIN
DECLARE inicio_datetime DATETIME;
DECLARE fin_datetime DATETIME;
SET inicio_datetime = CONCAT(nueva_fecha_inicio, ' 15:00:00');
SET fin_datetime = CONCAT(nueva_fecha_fin, ' 12:00:00');
SELECT CASE 
WHEN EXISTS (SELECT 1 FROM detalle_reservacion JOIN habitacion ON habitacion.ID_HABITACION = detalle_reservacion.HABITACION
WHERE habitacion.NUM_HABITACION = numero_de_habitacion AND ((fecha_inicio <= fin_datetime AND fecha_fin >= inicio_datetime))) THEN 'No Disponible'
ELSE 'Disponible'
END AS Disponibilidad;
END //
DELIMITER ;

CALL Verificar_Disponibilidad_Habitacion(124, '2024-07-26', '2024-07-30');


-----------------------------------------------------------------------------------------------------------------------------------------------

-- procedimiento para registrar el pago de la reservacion
-- este procedimiento inserta los detalles del monto del pago al finalizar nuestra reserva
DELIMITER //
CREATE PROCEDURE RegistrarPagoReservacion(
IN N_Reservacion INT,
IN metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia'),
IN monto_total DECIMAL(8,2)
)
BEGIN
INSERT INTO detalle_pago(reservacion, metodo_pago, monto_total)VALUES (N_Reservacion, metodo_pago, monto_total);
END //
DELIMITER ;

CALL RegistrarPagoReservacion(125,'tarjeta', 4500.00);


--------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Procedimiento para registrar los datos de facturacion de una persona
-- este procedimiente registra la informacion de mi tabla datos_facturacion para darle sobrecarga a la informacion de mi persona
DELIMITER //
 create procedure registro_facturacion 
(in nombre  varchar (25),in a_paterno varchar (25), in a_materno varchar (25),
in rfc varchar (18),in direccion varchar (50))
begin
declare max_detalle_pago int;
SELECT MAX(id_detalle_pago) INTO max_detalle_pago FROM detalle_pago;
insert into datos_facturacion(nombre,apellido_paterno,apellido_materno,rfc,direccion,detalle_pago) values 
(nombre,a_paterno,a_materno,rfc,direccion,max_detalle_pago);
END //
DELIMITER ;

call registro_facturacion('Victor Gael','Barajas','Vazquez','8715732505','calle centro 224 Norte');


--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--procedimiento para calcular las reservaciones

DELIMITER //
CREATE PROCEDURE CALCULO_RESERVA
(in fecha_inicio date,in fecha_fin date,in tipo varchar (25))
begin

DECLARE fecha_start date;
DECLARE fecha_end date;

set fecha_start = fecha_inicio;
set fecha_end=fecha_fin;

case tipo
when 'Doble' then
SELECT fecha_start,fecha_end,
(timestampdiff(day,fecha_start,fecha_end)) as diferencia, SUM((timestampdiff(day,fecha_start,fecha_end))*900) as monto;

when 'Sencilla' then
SELECT fecha_start,fecha_end,
(timestampdiff(day,fecha_start,fecha_end)) as diferencia, SUM((timestampdiff(day,fecha_start,fecha_end))*700) as monto1;

when 'King Size' then
SELECT fecha_start,fecha_end,
(timestampdiff(day,fecha_start,fecha_end)) as diferencia, SUM((timestampdiff(day,fecha_start,fecha_end))*1200) as monto2;
ELSE SELECT 'Tipo de habitación no válido';
    END CASE;
    
 

    
END//

DELIMITER ;

----------------------------------------------------------------------------------------------------------
--PROCEDIMIENTO PARA DAR DE ALTA A UN HUESPED FISICO CON SU CUENTA, DATOS DE PERSONA Y LA RELACION CON HUESPED


DELIMITER //
CREATE PROCEDURE RegistrarHuespedPersona_En_Fisica(
IN nombre_usuario text,
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
IN correo VARCHAR(100))
BEGIN
declare persona_id INT;
declare usuario_id INT;
declare password text default "'hLi2024!'";
INSERT INTO Usuarios (nombre_usuario,password,correo) VALUES (nombre_usuario,password ,correo );
SET usuario_id = LAST_INSERT_ID();
INSERT INTO Persona (Nombre, Apellido_paterno, Apellido_materno, Fecha_de_Nacimiento,
direccion, ciudad, estado, codigo_postal, pais, Genero,
Numero_De_Telefono, usuario)
VALUES (nombre, apellido_paterno, apellido_materno, fecha_nacimiento,
direccion, ciudad, estado, codigo_postal, pais, genero,
numero_telefono, usuario_id);
SET persona_id = LAST_INSERT_ID();
INSERT INTO Huesped (persona_huesped) VALUES (persona_id);
END //
DELIMITER ;

CALL RegistrarHuespedPersona_En_Fisica('JOOOO','Juan', 'Perez', 'Lopez', '1992-01-15', 'calle 1234', 'torreon', 'coahuila', '44100', 'México', 'M', '3211221823', 'juancoSrreo@gmail.com');

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE CANCELAR_RESERVACION_72HRS(
IN id_reservacion INT)
BEGIN
UPDATE reservacion
SET ESTADO_RESERVACION = 'cancelada'
WHERE reservacion.id_reservacion = id_reservacion;
END //
DELIMITER ;

CALL CANCELAR_RESERVACION_72HRS (130);
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--PROCEDIMIENTO PARA REGISTRAR A LA PERSONA Y PONERLO COMO HUESPED
DELIMITER //

CREATE PROCEDURE RegistrarHuespedPersona_En_Linea(
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
IN usuario_id INT)
BEGIN
DECLARE persona_id INT;
INSERT INTO Persona(Nombre, Apellido_paterno, Apellido_materno, Fecha_de_Nacimiento,direccion, ciudad, estado, codigo_postal, pais, Genero, Numero_De_Telefono, usuario)VALUES (nombre, apellido_paterno, apellido_materno, fecha_nacimiento,direccion,ciudad, estado, codigo_postal, pais, genero, numero_telefono, usuario_id);
SET persona_id = LAST_INSERT_ID();
INSERT INTO Huesped(persona_huesped)
VALUES (persona_id);
END //

DELIMITER ;

CALL RegistrarHuespedPersona_En_Linea('gaele2nlineapersona', 'martinez', 'Martinez', '1992-01-15', 'calle 1234', 'torreon', 'coahuila', '41100', 'México', 'M', '3233521470',78);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- PROCEDIMIENTO PARA CREAR LA RESERVACION EN LINEA PARA LOS NUEVOS
DELIMITER //

CREATE PROCEDURE CrearReservacion_En_Linea (
    IN recepcionista INT,
    IN fecha DATE,
    IN estado_reservacion VARCHAR(15)
)
BEGIN
    DECLARE ultimo_huesped INT;

    SELECT MAX(id_huesped) INTO ultimo_huesped FROM huesped;

    INSERT INTO reservacion(huesped, recepcionista, fecha_, estado_reservacion)
    VALUES (ultimo_huesped, recepcionista, fecha, estado_reservacion);
END //

DELIMITER ;

Call CrearReservacion_En_Linea(4,'2024-08-01','proceso');

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--PROCEDIMIENTO PARA CREAR LA RESERVACION A UNA PERSONA QUE YA RESERVO

DELIMITER //

CREATE PROCEDURE linea_reservacion_vieja (
    IN recepcionista INT,
    IN fecha DATE,
    IN estado_reservacion VARCHAR(15),
    IN huesped INT
)
BEGIN
    

    INSERT INTO reservacion(huesped, recepcionista, fecha_, estado_reservacion)
    VALUES (huesped, recepcionista, fecha, estado_reservacion);
END //

DELIMITER ;



----------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- PROCEDIMIENTO PARA EL DETALLE DE LA RESERVACION
DELIMITER //

CREATE PROCEDURE Detalle_Reservacion_Combinado (
    IN fecha_inicio DATE,
    IN fecha_fin DATE,
    IN titular VARCHAR(60),
    IN niños INT,
    IN adultos INT,
    IN tipo_habitacion VARCHAR(25)
)
BEGIN
    DECLARE HABITACION INT;
    DECLARE n_reservacion INT;
    
    
    SELECT MAX(id_reservacion) INTO n_reservacion FROM reservacion;

   
    IF tipo_habitacion = 'Doble' THEN
        SELECT habitacion.id_habitacion
        INTO HABITACION
        FROM habitacion 
        INNER JOIN t_habitacion ON habitacion.tipo_habitacion = t_habitacion.id_tipo_habitacion
        WHERE t_habitacion.nombre = 'Doble'
          AND habitacion.id_habitacion NOT IN (
              SELECT detalle_reservacion.habitacion 
              FROM detalle_reservacion
              WHERE detalle_reservacion.fecha_inicio < fecha_fin
                AND detalle_reservacion.fecha_fin > fecha_inicio
          )
        LIMIT 1;

    ELSEIF tipo_habitacion = 'King Size' THEN
        SELECT habitacion.id_habitacion
        INTO HABITACION
        FROM habitacion 
        INNER JOIN t_habitacion ON habitacion.tipo_habitacion = t_habitacion.id_tipo_habitacion
        WHERE t_habitacion.nombre = 'King Size'
          AND habitacion.id_habitacion NOT IN (
              SELECT detalle_reservacion.habitacion 
              FROM detalle_reservacion
              WHERE detalle_reservacion.fecha_inicio < fecha_fin
                AND detalle_reservacion.fecha_fin > fecha_inicio
          )
        LIMIT 1;

    ELSEIF tipo_habitacion = 'Sencilla' THEN
        SELECT habitacion.id_habitacion
        INTO HABITACION
        FROM habitacion 
        INNER JOIN t_habitacion ON habitacion.tipo_habitacion = t_habitacion.id_tipo_habitacion
        WHERE t_habitacion.nombre = 'Sencilla'
          AND habitacion.id_habitacion NOT IN (
              SELECT detalle_reservacion.habitacion 
              FROM detalle_reservacion
              WHERE detalle_reservacion.fecha_inicio < fecha_fin
                AND detalle_reservacion.fecha_fin > fecha_inicio
          )
        LIMIT 1;
    END IF;

    
    IF HABITACION IS NOT NULL THEN
        INSERT INTO detalle_reservacion (
            fecha_inicio, fecha_fin, titular_habitacion, reservacion, habitacion, cantidad_niños, cantidad_adultos
        )
        VALUES (
            fecha_inicio, fecha_fin, titular, n_reservacion, HABITACION, niños, adultos
        );
    ELSE
        SELECT 'No hay habitaciones disponibles';
    END IF;
END //

DELIMITER ;

----------------------------------------------------------------------------------------------------------------------------------------------------------------
DELIMITER //

CREATE PROCEDURE RegistrarPagoReservacionLinea(
    IN metodo_pago varchar (50),
    IN monto_total DECIMAL(8,2)
)
BEGIN
    DECLARE ultima_reservacion INT;
    SELECT MAX(id_reservacion) INTO ultima_reservacion FROM reservacion;
    INSERT INTO detalle_pago (reservacion, metodo_pago, monto_total)
    VALUES (ultima_reservacion, 'tarjeta', monto_total);
END //

DELIMITER ;

CALL RegistrarPagoReservacion('tarjeta',4500.00);