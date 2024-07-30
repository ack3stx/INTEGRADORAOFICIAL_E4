----------------------------------------------------------------------------------------------------
-- CONSULTA PARA EL HISTORIAL DE LAS RESERVACIONES
select distinct concat(persona.nombre,'  ' ,persona.apellido_paterno,'   ', persona.apellido_materno) as Nombre_Huesped, reservacion.id_reservacion as folio_reserva,reservacion.estado_reservacion as estado, (timestampdiff(day,detalle_reservacion.fecha_inicio,detalle_reservacion.fecha_fin)) as noches,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
group by Nombre, folio_reserva,estado,noches;
--------------------------------------------------------------------------------------------------------------------------------
DETALLE de reservacion
select distinct concat(persona.nombre,'  ' ,persona.apellido_paterno,'   ', persona.apellido_materno) as Nombre_Huesped, reservacion.id_reservacion as folio_reserva,reservacion.estado_reservacion as estado, (timestampdiff(day,detalle_reservacion.fecha_inicio,detalle_reservacion.fecha_fin)) as noches,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where usuarios.nombre_usuario = 'leonel'
group by Nombre, folio_reserva,estado,noches;