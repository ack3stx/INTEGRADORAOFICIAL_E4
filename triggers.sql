DELIMITER //

CREATE TRIGGER TR_ACTUALIZAR_DETALLE_RESERVACION
AFTER UPDATE ON RESERVACION
FOR EACH ROW
BEGIN
    IF NEW.ESTADO_RESERVACION = 'cancelada' THEN
        UPDATE DETALLE_RESERVACION
        SET
            FECHA_INICIO = '0000-00-00 00:00:00',
            FECHA_FIN = '0000-00-00 00:00:00'
        WHERE
            RESERVACION = NEW.ID_RESERVACION;
    END IF;
END//

DELIMITER ;


DELIMITER //

CREATE TRIGGER ACTUALIZAR_ESTADO_HABITACION_ACTIVA
AFTER UPDATE ON RESERVACION
FOR EACH ROW
BEGIN
    IF NEW.ESTADO_RESERVACION = 'activa' THEN
        UPDATE HABITACION H
        INNER JOIN DETALLE_RESERVACION DR ON H.ID_HABITACION = DR.HABITACION
        SET H.ESTADO_HABITACION = 'ocupada'
        WHERE DR.RESERVACION = NEW.ID_RESERVACION;
    END IF;
END//

DELIMITER ;



DELIMITER //

CREATE TRIGGER ACTUALIZAR_ESTADO_HABITACION_FINALIZADA
AFTER UPDATE ON RESERVACION
FOR EACH ROW
BEGIN
    IF NEW.ESTADO_RESERVACION = 'finalizada' THEN
        UPDATE HABITACION H
        INNER JOIN DETALLE_RESERVACION DR ON H.ID_HABITACION = DR.HABITACION
        SET H.ESTADO_HABITACION = 'disponible'
        WHERE DR.RESERVACION = NEW.ID_RESERVACION;
    END IF;
END//

DELIMITER ;

------------------------------------------------------------------------------------

DELIMITER //

CREATE TRIGGER ACTUALIZAR_ESTADO_RESERVACION_DESPUES_UPDATE
AFTER UPDATE ON DETALLE_RESERVACION
FOR EACH ROW
BEGIN
    IF (SELECT ESTADO_RESERVACION FROM RESERVACION WHERE ID_RESERVACION = NEW.RESERVACION) != 'cancelada' 
    AND OLD.TITULAR_HABITACION != NEW.TITULAR_HABITACION THEN
        UPDATE RESERVACION
        SET ESTADO_RESERVACION = 'activa'
        WHERE ID_RESERVACION = NEW.RESERVACION;
    END IF;
END;
//

DELIMITER ;

---------------------------------------------------------------------------------------


SELECT `ID_HABITACION` 
FROM `HABITACION` 
WHERE `NUM_HABITACION` = '104';
