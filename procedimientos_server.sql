DELIMITER //
CREATE PROCEDURE AGREGAR_HABITACIONES
(IN TIPO VARCHAR(25))
BEGIN
    DECLARE NUM_HABITACION1 INT DEFAULT 122; 
    DECLARE INCREMENTO INT DEFAULT 1;
    DECLARE NUM_HABITACION2 INT DEFAULT 204;
    DECLARE NUM_HABITACION3 INT DEFAULT 303;
    DECLARE NUM_HABITACIONES INT;

    IF TIPO='1' THEN
        SELECT MAX(NUM_HABITACION) INTO NUM_HABITACIONES FROM HABITACION WHERE HABITACION.NUM_HABITACION LIKE '1%';
        SET NUM_HABITACIONES = NUM_HABITACIONES + INCREMENTO;
        INSERT INTO HABITACION (NUM_HABITACION, PISO, ESTADO_HABITACION, TIPO_HABITACION)
        VALUES (NUM_HABITACIONES, 1, 'DISPONIBLE', TIPO);
    END IF;

    IF TIPO='2' THEN
        SELECT MAX(NUM_HABITACION) INTO NUM_HABITACIONES FROM HABITACION WHERE HABITACION.NUM_HABITACION LIKE '2%';
        SET NUM_HABITACIONES = NUM_HABITACIONES + INCREMENTO;
        INSERT INTO HABITACION (NUM_HABITACION, PISO, ESTADO_HABITACION, TIPO_HABITACION)
        VALUES (NUM_HABITACIONES, 2, 'DISPONIBLE', TIPO);
    END IF;

    IF TIPO='3' THEN
        SELECT MAX(NUM_HABITACION) INTO NUM_HABITACIONES FROM HABITACION WHERE HABITACION.NUM_HABITACION LIKE '3%';
        SET NUM_HABITACIONES = NUM_HABITACIONES + INCREMENTO;
        INSERT INTO HABITACION (NUM_HABITACION, PISO, ESTADO_HABITACION, TIPO_HABITACION)
        VALUES (NUM_HABITACIONES, 3, 'DISPONIBLE', TIPO);
    END IF;
END //
DELIMITER ;



----------------------------------------------------------------------------------------------------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE REGISTRARUSUARIOHUESPED(
    IN NOMBRE_USUARIO VARCHAR(30),
    IN N_PASSWORD TEXT,
    IN CORREO VARCHAR(40)
)
BEGIN
    DECLARE USUARIO_ID INT;
    DECLARE ROL_HUESPED INT DEFAULT 1;
    INSERT INTO USUARIOS (NOMBRE_USUARIO, PASSWORD, CORREO)
    VALUES (NOMBRE_USUARIO, N_PASSWORD, CORREO);
    SET USUARIO_ID = LAST_INSERT_ID();
    INSERT INTO ROL_USUARIO (ROL, USUARIO)
    VALUES (ROL_HUESPED, USUARIO_ID);
END //

DELIMITER ;


----------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE CONSULTAR_INFORMACION_FACTURACION(
    IN N_RESERVACION INT
)
BEGIN
    SELECT NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, RFC, DIRECCION, MONTO_TOTAL, METODO_PAGO
    FROM RESERVACION
    JOIN DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
    JOIN FACTURACION ON DETALLE_PAGO.ID_DETALLE_PAGO = FACTURACION.DETALLE_PAGO 
    WHERE RESERVACION.ID_RESERVACION = N_RESERVACION;
END //

DELIMITER ;

----------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE REGISTRARUSUARIORECEPCIONISTA(
    IN NOMBRE_USUARIO VARCHAR(30),
    IN N_PASSWORD TEXT,
    IN CORREO VARCHAR(40)
)
BEGIN
    DECLARE USUARIO_ID INT;
    DECLARE ROL_RECEPCIONISTA INT DEFAULT 2;
    INSERT INTO USUARIOS (NOMBRE_USUARIO, PASSWORD, CORREO)
    VALUES (NOMBRE_USUARIO, N_PASSWORD, CORREO);
    SET USUARIO_ID = LAST_INSERT_ID();
    INSERT INTO ROL_USUARIO (ROL, USUARIO)
    VALUES (ROL_RECEPCIONISTA, USUARIO_ID);
END //
DELIMITER ;

----------------------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE REGISTRARRECEPCIONISTAPERSONA(
    IN NOMBRE VARCHAR(30),
    IN APELLIDO_PATERNO VARCHAR(30),
    IN APELLIDO_MATERNO VARCHAR(30),
    IN FECHA_NACIMIENTO DATE,
    IN DIRECCION VARCHAR(100),
    IN CIUDAD VARCHAR(50),
    IN ESTADO VARCHAR(50),
    IN CODIGO_POSTAL VARCHAR(10),
    IN PAIS VARCHAR(50),
    IN GENERO CHAR(1),
    IN NUMERO_TELEFONO CHAR(10),
    IN CURP VARCHAR(18),
    IN FECHA_DE_CONTRATACION DATE,
    IN NUMERO_DE_SEGURIDAD_SOCIAL VARCHAR(20),
    IN AFORE VARCHAR(30),
    IN NUMERO_DE_EMERGENCIA CHAR(10)
)
BEGIN
    DECLARE PERSONA_ID INT;
    DECLARE USUARIO_ID INT;
    SELECT MAX(ID_USUARIO) INTO USUARIO_ID FROM USUARIOS;
    INSERT INTO PERSONA (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_DE_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_TELEFONO, USUARIO
    ) 
    VALUES (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_TELEFONO, USUARIO_ID
    );
    SET PERSONA_ID = LAST_INSERT_ID();
    INSERT INTO RECEPCIONISTA (
        CURP, FECHA_DE_CONTRATACION, NUMERO_DE_SEGURIDAD_SOCIAL, AFORE,
        NUMERO_DE_EMERGENCIA, PERSONA_RECEPCIONISTA
    ) 
    VALUES (
        CURP, FECHA_DE_CONTRATACION, NUMERO_DE_SEGURIDAD_SOCIAL, AFORE,
        NUMERO_DE_EMERGENCIA, PERSONA_ID
    );
END //

DELIMITER ;



---------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE DISPONIBILIDAD_HABITACIONES_DOBLE
(IN FECHA_INICIO DATETIME, IN FECHA_FIN DATETIME)
BEGIN

    DECLARE FECHA_INICIOO DATETIME;
    DECLARE FECHA_FINN DATETIME;

    SET FECHA_INICIOO = DATE_FORMAT(FECHA_INICIO, '%Y-%m-%d 15:00:00');
    SET FECHA_FINN = DATE_FORMAT(FECHA_FIN, '%Y-%m-%d 12:00:00');

    SELECT COUNT(HABITACION.ID_HABITACION) AS DOBLE
    FROM HABITACION 
    INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
    WHERE T_HABITACION.NOMBRE = 'Doble'
    AND HABITACION.ID_HABITACION NOT IN (
        SELECT DETALLE_RESERVACION.HABITACION 
        FROM DETALLE_RESERVACION
        WHERE DETALLE_RESERVACION.FECHA_INICIO <= FECHA_FINN
        AND DETALLE_RESERVACION.FECHA_FIN >= FECHA_INICIOO
    );

END //
DELIMITER ;


----------------------------------------------------------------------------------------------------

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

-----------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE DISPONIBILIDAD_HABITACIONES_SENCILLA
(IN FECHA_INICIO DATE, IN FECHA_FIN DATE)
BEGIN

    DECLARE FECHA_INICIOO DATETIME;
    DECLARE FECHA_FINN DATETIME;

    SET FECHA_INICIOO = DATE_FORMAT(FECHA_INICIO, '%Y-%m-%d 15:00:00');
    SET FECHA_FINN = DATE_FORMAT(FECHA_FIN, '%Y-%m-%d 12:00:00');

    SELECT COUNT(HABITACION.ID_HABITACION) AS 'SENCILLA'
    FROM HABITACION 
    INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
    WHERE T_HABITACION.NOMBRE = 'Sencilla'
    AND HABITACION.ID_HABITACION NOT IN (
        SELECT DETALLE_RESERVACION.HABITACION 
        FROM DETALLE_RESERVACION
        WHERE DETALLE_RESERVACION.FECHA_INICIO <= FECHA_FINN
        AND DETALLE_RESERVACION.FECHA_FIN >= FECHA_INICIOO
    );

END //
DELIMITER ;


-----------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE ACTUALIZAR_INFORMACION_CORREO_ELECTRONICO(
    IN CORREO_ELECTRONICO VARCHAR(40),
    IN USUARIO INT
)
BEGIN
    UPDATE USUARIOS
    SET
        CORREO = CORREO_ELECTRONICO
    WHERE
        USUARIOS.ID_USUARIO = USUARIO;
END// 
DELIMITER ;



-------------------------------------------------------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE ACTUALIZAR_INFORMACION_CONTRASEÑA(
    IN CONTRASEÑA_USUARIO TEXT,
    IN USUARIO INT
)
BEGIN
    UPDATE USUARIOS
    SET
        PASSWORD = CONTRASEÑA_USUARIO
    WHERE
        USUARIOS.ID_USUARIO = USUARIO;
END// 
DELIMITER ;


-------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE ACTUALIZAR_INFORMACION_NOMBRE_USUARIO(
    IN NOMBRE_USUARIO_LOGUEADO VARCHAR(30),
    IN USUARIO INT
)
BEGIN
    UPDATE USUARIOS
    SET
        NOMBRE_USUARIO = NOMBRE_USUARIO_LOGUEADO
    WHERE
        USUARIOS.ID_USUARIO = USUARIO;
END// 
DELIMITER ;


------------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE REGISTRARUSUARIOADMIN(
    IN NOMBRE_USUARIO VARCHAR(30),
    IN N_PASSWORD TEXT,
    IN CORREO VARCHAR(40)
)
BEGIN
    DECLARE USUARIO_ID INT;
    DECLARE ROL_ADMIN INT DEFAULT 3;
    INSERT INTO USUARIOS (NOMBRE_USUARIO, PASSWORD, CORREO)
    VALUES (NOMBRE_USUARIO, N_PASSWORD, CORREO);
    SET USUARIO_ID = LAST_INSERT_ID();
    INSERT INTO ROL_USUARIO (ROL, USUARIO)
    VALUES (ROL_ADMIN, USUARIO_ID);
END //
DELIMITER ;

------------------------------------------------------------------------------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE CHECK_IN_HUESPED(
    IN DETALLE_RESERVACION INT,
    IN NOMBRE_TITULAR_RESERVACION VARCHAR(60)
)
BEGIN
    UPDATE DETALLE_RESERVACION
    SET DETALLE_RESERVACION.TITULAR_HABITACION = NOMBRE_TITULAR_RESERVACION
    WHERE DETALLE_RESERVACION.ID_DETALLE_RESERVACION = DETALLE_RESERVACION;
END// 
DELIMITER ;


-------------------------------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE INFO_HUESPED(
    IN N_RESERVACION INT
)
BEGIN
    SELECT
        CONCAT(NOMBRE, ' ', APELLIDO_PATERNO, ' ', APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
        FECHA_DE_NACIMIENTO,
        CONCAT(DIRECCION, ', ', CIUDAD, ', ', ESTADO, ', ', CODIGO_POSTAL, ', ', PAIS) AS DIRECCION_COMPLETA,
        GENERO, NUMERO_DE_TELEFONO
    FROM PERSONA
    JOIN HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
    JOIN RESERVACION ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
    WHERE RESERVACION.ID_RESERVACION = N_RESERVACION;
END //
DELIMITER ;


----------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE VERIFICAR_DISPONIBILIDAD_HABITACION(
    IN NUMERO_DE_HABITACION INT, 
    IN NUEVA_FECHA_INICIO DATE, 
    IN NUEVA_FECHA_FIN DATE
)
BEGIN
    DECLARE INICIO_DATETIME DATETIME;
    DECLARE FIN_DATETIME DATETIME;
    SET INICIO_DATETIME = CONCAT(NUEVA_FECHA_INICIO, ' 15:00:00');
    SET FIN_DATETIME = CONCAT(NUEVA_FECHA_FIN, ' 12:00:00');

    SELECT CASE 
    WHEN EXISTS (
        SELECT 1 
        FROM DETALLE_RESERVACION 
        JOIN HABITACION ON HABITACION.ID_HABITACION = DETALLE_RESERVACION.HABITACION
        WHERE HABITACION.NUM_HABITACION = NUMERO_DE_HABITACION 
        AND (DETALLE_RESERVACION.FECHA_INICIO <= FIN_DATETIME 
        AND DETALLE_RESERVACION.FECHA_FIN >= INICIO_DATETIME)
    ) THEN 'No Disponible'
    ELSE 'Disponible'
    END AS DISPONIBILIDAD;
END //
DELIMITER ;


----------------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE REGISTRAR_PAGO_RESERVACION(
    IN N_RESERVACION INT,
    IN METODO_PAGO ENUM('efectivo', 'tarjeta', 'transferencia'),
    IN MONTO_TOTAL DECIMAL(8,2)
)
BEGIN
    INSERT INTO DETALLE_PAGO (RESERVACION, METODO_PAGO, MONTO_TOTAL)
    VALUES (N_RESERVACION, METODO_PAGO, MONTO_TOTAL);
END //
DELIMITER ;


-------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE REGISTRO_FACTURACION(
    IN NOMBRE VARCHAR(25),
    IN A_PATERNO VARCHAR(25),
    IN A_MATERNO VARCHAR(25),
    IN RFC VARCHAR(18),
    IN DIRECCION VARCHAR(50)
)
BEGIN
    DECLARE MAX_DETALLE_PAGO INT;
    SELECT MAX(ID_DETALLE_PAGO) INTO MAX_DETALLE_PAGO FROM DETALLE_PAGO;
    INSERT INTO DATOS_FACTURACION (NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, RFC, DIRECCION, DETALLE_PAGO)
    VALUES (NOMBRE, A_PATERNO, A_MATERNO, RFC, DIRECCION, MAX_DETALLE_PAGO);
END //
DELIMITER ;


-------------------------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE CALCULO_RESERVA(
    IN FECHA_INICIO DATE,
    IN FECHA_FIN DATE,
    IN TIPO VARCHAR(25)
)
BEGIN

    DECLARE FECHA_START DATE;
    DECLARE FECHA_END DATE;

    SET FECHA_START = FECHA_INICIO;
    SET FECHA_END = FECHA_FIN;

    CASE TIPO
        WHEN 'Doble' THEN
            SELECT FECHA_START, FECHA_END,
                   (TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) AS DIFERENCIA, 
                   SUM((TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) * 900) AS MONTO;
        WHEN 'Sencilla' THEN
            SELECT FECHA_START, FECHA_END,
                   (TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) AS DIFERENCIA, 
                   SUM((TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) * 700) AS MONTO1;
        WHEN 'King Size' THEN
            SELECT FECHA_START, FECHA_END,
                   (TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) AS DIFERENCIA, 
                   SUM((TIMESTAMPDIFF(DAY, FECHA_START, FECHA_END)) * 1200) AS MONTO2;
        ELSE 
            SELECT 'Tipo de habitación no válido' AS ERROR;
    END CASE;
    
END//
DELIMITER ;



---------------------------------------------------------------------------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE REGISTRAR_HUESPED_PERSONA_EN_FISICA(
    IN NOMBRE_USUARIO TEXT,
    IN NOMBRE VARCHAR(30),
    IN APELLIDO_PATERNO VARCHAR(30),
    IN APELLIDO_MATERNO VARCHAR(30),
    IN FECHA_NACIMIENTO DATE,
    IN DIRECCION VARCHAR(100),
    IN CIUDAD VARCHAR(50),
    IN ESTADO VARCHAR(50),
    IN CODIGO_POSTAL VARCHAR(10),
    IN PAIS VARCHAR(50),
    IN GENERO CHAR(1),
    IN NUMERO_TELEFONO CHAR(10),
    IN CORREO VARCHAR(100)
)
BEGIN
    DECLARE PERSONA_ID INT;
    DECLARE USUARIO_ID INT;
    DECLARE PASSWORD TEXT DEFAULT "'hLi2024!'";

    INSERT INTO USUARIOS (NOMBRE_USUARIO, PASSWORD, CORREO) 
    VALUES (NOMBRE_USUARIO, PASSWORD, CORREO);
    SET USUARIO_ID = LAST_INSERT_ID();

    INSERT INTO PERSONA (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_DE_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_DE_TELEFONO, USUARIO
    )
    VALUES (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_TELEFONO, USUARIO_ID
    );
    SET PERSONA_ID = LAST_INSERT_ID();

    INSERT INTO HUESPED (PERSONA_HUESPED) 
    VALUES (PERSONA_ID);
END //
DELIMITER ;


--------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE CANCELAR_RESERVACION_72HRS(
    IN ID_RESERVACION INT
)
BEGIN
    UPDATE RESERVACION
    SET ESTADO_RESERVACION = 'CANCELADA'
    WHERE RESERVACION.ID_RESERVACION = ID_RESERVACION;
END //
DELIMITER ;



-------------------------------------------------------------------------------------------------------


DELIMITER //

CREATE PROCEDURE REGISTRAR_HUESPED_PERSONA_EN_LINEA(
    IN NOMBRE VARCHAR(30),
    IN APELLIDO_PATERNO VARCHAR(30),
    IN APELLIDO_MATERNO VARCHAR(30),
    IN FECHA_NACIMIENTO DATE,
    IN DIRECCION VARCHAR(100),
    IN CIUDAD VARCHAR(50),
    IN ESTADO VARCHAR(50),
    IN CODIGO_POSTAL VARCHAR(10),
    IN PAIS VARCHAR(50),
    IN GENERO CHAR(1),
    IN NUMERO_TELEFONO CHAR(10),
    IN USUARIO_ID INT
)
BEGIN
    DECLARE PERSONA_ID INT;
    
    INSERT INTO PERSONA (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_DE_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_DE_TELEFONO, USUARIO
    )
    VALUES (
        NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_NACIMIENTO,
        DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO,
        NUMERO_TELEFONO, USUARIO_ID
    );

    SET PERSONA_ID = LAST_INSERT_ID();

    INSERT INTO HUESPED (PERSONA_HUESPED)
    VALUES (PERSONA_ID);
END //

DELIMITER ;


----------------------------------------------------------------------------------------------------------------


DELIMITER //

CREATE PROCEDURE CREAR_RESERVACION_EN_LINEA (
    IN RECEPCIONISTA INT,
    IN FECHA DATETIME,
    IN ESTADO_RESERVACION VARCHAR(15)
)
BEGIN
    DECLARE ULTIMO_HUESPED INT;

    SELECT MAX(ID_HUESPED) INTO ULTIMO_HUESPED FROM HUESPED;

    INSERT INTO RESERVACION (HUESPED, RECEPCIONISTA, FECHA_, ESTADO_RESERVACION)
    VALUES (ULTIMO_HUESPED, RECEPCIONISTA, FECHA, ESTADO_RESERVACION);
END //

DELIMITER ;


-------------------------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE LINEA_RESERVACION_VIEJA (
    IN RECEPCIONISTA INT,
    IN FECHA DATETIME,
    IN ESTADO_RESERVACION VARCHAR(15),
    IN HUESPED INT
)
BEGIN
    INSERT INTO RESERVACION (HUESPED, RECEPCIONISTA, FECHA_, ESTADO_RESERVACION)
    VALUES (HUESPED, RECEPCIONISTA, FECHA, ESTADO_RESERVACION);
END //

DELIMITER ;


------------------------------------------------------------------------------------------------------------------------------------------


DELIMITER //

CREATE PROCEDURE DETALLE_RESERVACION_COMBINADO (
    IN FECHA_INICIO DATETIME,
    IN FECHA_FIN DATETIME,
    IN TITULAR VARCHAR(60),
    IN NIÑOS INT,
    IN ADULTOS INT,
    IN TIPO_HABITACION VARCHAR(25)
)
BEGIN
    DECLARE HABITACION INT;
    DECLARE N_RESERVACION INT;
    
    SELECT MAX(ID_RESERVACION) INTO N_RESERVACION FROM RESERVACION;

    IF TIPO_HABITACION = 'Doble' THEN
        SELECT HABITACION.ID_HABITACION
        INTO HABITACION
        FROM HABITACION 
        INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
        WHERE T_HABITACION.NOMBRE = 'Doble'
          AND HABITACION.ID_HABITACION NOT IN (
              SELECT DETALLE_RESERVACION.HABITACION 
              FROM DETALLE_RESERVACION
              WHERE DETALLE_RESERVACION.FECHA_INICIO < FECHA_FIN
                AND DETALLE_RESERVACION.FECHA_FIN > FECHA_INICIO
          )
        LIMIT 1;

    ELSEIF TIPO_HABITACION = 'King Size' THEN
        SELECT HABITACION.ID_HABITACION
        INTO HABITACION
        FROM HABITACION 
        INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
        WHERE T_HABITACION.NOMBRE = 'King Size'
          AND HABITACION.ID_HABITACION NOT IN (
              SELECT DETALLE_RESERVACION.HABITACION 
              FROM DETALLE_RESERVACION
              WHERE DETALLE_RESERVACION.FECHA_INICIO < FECHA_FIN
                AND DETALLE_RESERVACION.FECHA_FIN > FECHA_INICIO
          )
        LIMIT 1;

    ELSEIF TIPO_HABITACION = 'Sencilla' THEN
        SELECT HABITACION.ID_HABITACION
        INTO HABITACION
        FROM HABITACION 
        INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
        WHERE T_HABITACION.NOMBRE = 'Sencilla'
          AND HABITACION.ID_HABITACION NOT IN (
              SELECT DETALLE_RESERVACION.HABITACION 
              FROM DETALLE_RESERVACION
              WHERE DETALLE_RESERVACION.FECHA_INICIO < FECHA_FIN
                AND DETALLE_RESERVACION.FECHA_FIN > FECHA_INICIO
          )
        LIMIT 1;
    END IF;

    IF HABITACION IS NOT NULL THEN
        INSERT INTO DETALLE_RESERVACION (
            FECHA_INICIO, FECHA_FIN, TITULAR_HABITACION, RESERVACION, HABITACION, CANTIDAD_NIÑOS, CANTIDAD_ADULTOS
        )
        VALUES (
            FECHA_INICIO, FECHA_FIN, TITULAR, N_RESERVACION, HABITACION, NIÑOS, ADULTOS
        );
    ELSE
        SELECT 'No hay habitaciones disponibles';
    END IF;
END //

DELIMITER ;


-------------------------------------------------------------------------------------------------------------------------


DELIMITER //

CREATE PROCEDURE REGISTRAR_PAGO_RESERVACION_LINEA(
    IN METODO_PAGO VARCHAR(50),
    IN MONTO_TOTAL DECIMAL(8,2)
)
BEGIN
    DECLARE ULTIMA_RESERVACION INT;
    SELECT MAX(ID_RESERVACION) INTO ULTIMA_RESERVACION FROM RESERVACION;
    INSERT INTO DETALLE_PAGO (RESERVACION, METODO_PAGO, MONTO_TOTAL)
    VALUES (ULTIMA_RESERVACION, METODO_PAGO, MONTO_TOTAL);
END //

DELIMITER ;


--------------------------------------------------------------------------------------------------------------------------------------

















