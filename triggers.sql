DELIMITER //
CREATE TRIGGER actualizar_estado_reservacion_despues_update
AFTER UPDATE ON detalle_reservacion
FOR EACH ROW
BEGIN
UPDATE reservacion
SET estado_reservacion = 'activa'
WHERE id_reservacion = NEW.reservacion;
END;
//
DELIMITER ;