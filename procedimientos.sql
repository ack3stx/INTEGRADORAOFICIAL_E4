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
IN n_password text,
IN correo VARCHAR(40))
BEGIN
DECLARE usuario_id INT;
DECLARE rol_huesped INT DEFAULT 1; 
INSERT INTO Usuarios(nombre_usuario, password, correo)VALUES (nombre_usuario, n_password, correo);
SET usuario_id = LAST_INSERT_ID();
INSERT INTO ROL_USUARIO(rol, usuario)
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
