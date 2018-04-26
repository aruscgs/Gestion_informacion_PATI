<?php

// Reporte de productividad
/*
 * $consulta = "select `r`.`id_actividad` AS `id_actividad`,`a`.`plataforma` AS `plataforma`,
 * `a`.`categoria` AS `categoria`,`a`.`actividad` AS `actividad`
 * ,`r`.`cedula` AS `cedula`
 * ,(select area from areas where id=`d`.`area`) AS Namearea
 * ,`d`.`area` AS `area`
 * ,`r`.`fecha_inicio` AS `fecha_inicio`
 * ,`r`.`tiempoReal` AS `tiempoReal`
 * ,(select nombre from new_personas where cedula = r.cedula) AS nombre
 * ,`r`.`descripcion` AS `descripcion`
 * ,`r`.`id_contrato` AS `id_contrato`
 * ,`p`.`codigo` AS `proyecto`
 * from (((`registro_actividad` `r` join `actividad` `a`) join `new_usuario` `d`) join `new_proyectos` `p`)
 * where ( ( `r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>' )
 * and (`r`.`id_actividad` = `a`.`id`)
 * and (`r`.`id_contrato` = `p`.`codigo`)
 * and (`r`.`cedula` = `d`.`cedula`)
 * and (`r`.`estado` = 'F')
 * and (`d`.`area` <> 0 )
 * )
 * having
 * Namearea like '%<filtro3>%'
 * order by `r`.`fecha_inicio` asc";
 */

// Para los festivos
$dias=array();
$conn = $wish->conexion->query("SELECT fecha FROM festivo ");
while ($row=$conn->fetch_assoc())
{
	$dias[]=$row['fecha'];
}


$consulta="select v.selected_date,
r.cedula,
u.correo,
(select nombre from new_personas p where p.cedula = r.cedula ) nombre,
(select proyecto from new_personas p where p.cedula = r.cedula ) contrato,
a.area,
'8.5' as horas_programadas,
(select  round(sum(a.tiempoReal)/60,2) as registro
        from registro_actividad a,new_personas b
    where a.cedula = b.cedula and b.correo like '%<filtro3>%'
                and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date
) as horas_laboradas
from registro_actividad r, areas a, new_usuario u,
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where v.selected_date between '<filtro1>' and '<filtro2>'
and DATE_FORMAT(v.selected_date,'%w') <> 0
and DATE_FORMAT(v.selected_date,'%w') <> 6
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'
and u.cedula = r.cedula
and a.id = u.area
and r.cedula <> ''
group by  r.cedula,v.selected_date
having correo like '%<filtro3>%'
order by selected_date,r.cedula
limit 0,20000";








// el query debe retornar un campo con nombre columna y otro numerico
$consulta2 = "SELECT
categoria columna,
sum(tiempoReal) valores
FROM `productividad_historica`
where `fecha_inicio` > '<filtro1>'
and `fecha_inicio` < '<filtro2>'
and `area` like '%<filtro3>%'
GROUP by categoria";

$consulta3 = "SELECT
categoria columna,
sum(tiempoReal) valores
FROM `productividad_historica`
where `fecha_inicio` > '<filtro1>'
and `fecha_inicio` < '<filtro2>'
and `correo` = '<filtro3>'
GROUP by categoria";

$consulta4 = "select
	date_format(fecha_inicio,'%m-%d-%Y') as columna,
	(sum(tiempoReal)/60) as valores
from productividad_historica
where correo like '%<filtro3>%'
		and area like '%<filtro4>%'
		and `fecha_inicio` > '<filtro1>'
        and `fecha_inicio` < '<filtro2>'
group by date_format(fecha_inicio,'%m-%d-%Y')
order by columna;";

$consulta5 = "SELECT fecha,tipo,proyecto,descripcion FROM new_novedades where
			fecha > '<filtro1>'
        and fecha < '<filtro2>'
		and proyecto like '%<filtro3>%'
        and tipo like '%<filtro4>%'";

// Reporte mensual
$consulta6 = "select `r`.`fecha_inicio` AS `fecha_inicio`,
`r`.`tiempoReal` AS `tiempoReal`,
a.actividad,
a.plataforma,
r.descripcion,
`a`.`categoria` AS `categoria`,
r.id_contrato,
(select np.nombre from new_proyectos np where np.codigo = r.id_contrato )as Contrato,
`d`.`correo` AS `correo`,
(select `ar`.`area` from `areas` `ar` where (`d`.`area` = `ar`.`id`)) AS `area`
from
((`registro_actividad` `r` left join `actividad` `a` on((`a`.`id` = `r`.`id_actividad`)))
left join `new_usuario` `d` on((`d`.`cedula` = `r`.`cedula`))) where (`r`.`estado` = 'F')
and (`r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>'   )
and (d.area like '<filtro3>%' )
and (d.correo like '%<filtro4>%')
order by `r`.`fecha_inicio` asc";



// Reporte mensual de eventos abiertos por contrato
/*$consulta7 = "select a.id as 'ID del evento',b.nombre as 'CI',e.tipo as 'Servicio afectado', a.causa_evento as 'Causa del evento',d.nombre as
'Responsable' from incidentecop a,hosts b,new_proyectos c,new_personas d,tipo_servicios e,areas f,new_usuario g where a.estado='P' and a.id_host=b.id and
b.id_contrato=c.codigo and a.responsable=d.cedula and a.servicio_afectado=e.id and a.id_host=b.id and c.codigo like '%<filtro1>%' and a.fecha between '<filtro2>' and '<filtro3>'
and d.cedula=g.cedula and g.area=f.id and f.id like '%<filtro4>%'";
*/

// Reporte mensual de eventos abiertos por contrato
$consulta7 = "select DISTINCT a.id as 'ID del evento',b.nombre as
'CI',e.tipo as 'Servicio afectado', a.causa_evento as 'Causa del evento',
d.nombre as 'Responsable',d.correo as 'Correo Responsable',a.fecha, c.nombre as 'Contrato' from incidentecop a,hosts b,new_proyectos c,new_personas d,
tipo_servicios e,areas f,new_usuario g where a.estado='P' and a.id_host=b.id and b.id_contrato=c.codigo
and a.responsable=d.cedula and a.servicio_afectado=e.id and a.id_host=b.id and c.codigo like '%<filtro1>%'
and a.fecha between '<filtro2>' and '<filtro3>' and d.cedula=g.cedula and g.area=f.id and f.id like '%<filtro4>%'";


$consulta8 = "select a.id_evento as 'ID del evento',b.nombre as 'CI' , b.ip as 'IP' ,a.descripcion as 'Descripcion', a.horas_actividad as
'Hora de actividad',a.tipo_evento as 'Tipo de evento', a.causa_evento as 'Causa del evento' ,d.nombre as
'Responsable', d.correo as 'Correo Responsable', a.f_inicio as 'Fecha Creacion', c.nombre as 'Contrato' from registro_masivo a,hosts b,new_proyectos c,new_personas d,areas e,new_usuario f where a.estado='P' and a.id_host=b.id
AND b.id_contrato=c.codigo and a.responsable=d.cedula and c.codigo like '%<filtro1>%' and a.f_inicio between '<filtro2>' and '<filtro3>' and
d.cedula=f.cedula and f.area=e.id and e.id like '%<filtro4>%'";

$consulta9 = "select
reponsable as 'Responsable', sum(cantidad) as 'Cantidad de eventos abiertos' from
(select a.nombre as reponsable, count(distinct b.id)as cantidad from
new_personas a, incidentecop b , hosts c where a.cedula=b.responsable and b.estado='P' and b.id_host=c.id
and c.id_contrato='<filtro1>' and b.fecha between'<filtro2>' and '<filtro3>' group by b.responsable
union (select a.nombre as reponsable, count(distinct b.id_evento)as cantidad from new_personas a, registro_masivo b,hosts
c where a.cedula=b.responsable and b.estado='P' and b.id_host=c.id and c.id_contrato='<filtro1>' and b.f_inicio
between '<filtro2>' and '<filtro3>' group by b.responsable)) k group by Responsable";

/*$consulta10 = "select a.id as 'ID de evento',b.nombre as 'CI afectado', c.tipo as 'Servicio afectado',a.tipo_evento as 'Tipo de evento',
a.causa_evento as 'Causa del evento', a.tipo_actividad as 'Tipo de actividad', d.nombre as 'Persona que reporta',
a.fecha as 'Fecha del evento',e.fecha_cierre as 'Fecha de finalización',a.horas as 'Horas de actividad', d.nombre as 'Responsable',a.estado as
'Estado del evento',a.mesa as 'Mesa de notificación',e.ticket as 'Ticket' from incidentecop a
INNER JOIN hosts b on a.id_host=b.id
inner join tipo_servicios c on a.servicio_afectado=c.id
INNER join new_personas d on a.generado=d.cedula
left JOIN solucion_incidente e on a.id=e.id_evento and e.tipo='individual' and b.id_contrato='<filtro1>' and a.fecha between
'<filtro2>' and '<filtro3>'";*/

$consulta10 = "SELECT a.*,b.tipo_incidente,b.fecha_cierre,b.detalles,b.ticket
 FROM (select a.id as 'id_evento',b.nombre as 'ci_afectado' ,c.tipo as 'servicio_afectado',a.tipo_evento as
'tipo_evento',a.causa_evento as 'causa_evento' ,a.tipo_actividad as 'tipo_actividad' ,d.nombre as
'persona_responsable',a.fecha as 'fecha_evento',a.horas as 'horas_actividad',
e.nombre as 'persona_reporta',a.estado as 'estado_evento',a.mesa as 'mesa_ayuda' from incidentecop a,hosts b,tipo_servicios c,new_personas d,
new_personas e where
(DATE_FORMAT(a.fecha, '%Y-%m-%d') >= '<filtro2>' and DATE_FORMAT(a.fecha, '%Y-%m-%d') <= '<filtro3>')
and b.id=a.id_host and b.id_contrato='<filtro1>' and a.servicio_afectado=c.id and a.responsable=d.cedula and a.generado=e.cedula)a
   left JOIN (select * from solucion_incidente where tipo='individual')b
    ON a.id_evento=b.id_evento  order by a.id_evento asc ";


/*$consulta11 = "select a.id_evento as 'ID de evento',b.nombre as 'CI afectado',a.f_inicio as 'Fecha del evento',d.fecha_cierre as 'Fecha de finalización',
a.descripcion as 'Descripción', a.horas_actividad as 'Horas de actividad',a.tipo_evento as 'Tipo de evento',
a.causa_evento as 'Causa del evento',a.tipo_actividad as 'Tipo de actividad',c.nombre as 'Responsable',
a.estado as 'Estado del evento', a.mesa as 'Mesa de notificación',d.ticket as 'Tiquet' from registro_masivo a
inner join hosts b on a.id_host=b.id
inner join new_personas c on a.responsable=c.cedula
left join solucion_incidente d on a.id_evento=d.id_evento and d.tipo='masivo'
 and b.id_contrato='<filtro1>' and a.f_inicio between '<filtro2>' and '<filtro3>'";
*/

/*$consulta11 = "select a.id_evento as 'ID de evento',b.nombre as 'CI afectado',a.f_inicio as 'Fecha del evento',
d.fecha_cierre as 'Fecha de finalización', a.descripcion as 'Descripción', a.horas_actividad as 'Horas de actividad',
a.tipo_evento as 'Tipo de evento', a.causa_evento as 'Causa del evento',a.tipo_actividad as 'Tipo de actividad',
c.nombre as 'Responsable', a.estado as 'Estado del evento', a.mesa as 'Mesa de notificación',d.ticket as 'Tiquet'
from registro_masivo a inner join hosts b on a.id_host=b.id and (DATE_FORMAT(a.f_inicio, '%Y-%m-%d') >= '<filtro2>'
and DATE_FORMAT(a.f_inicio, '%Y-%m-%d') <= '<filtro3>') inner join new_personas c on a.responsable=c.cedula left join
solucion_incidente d on a.id_evento=d.id_evento and d.tipo='masivo' and b.id_contrato='<filtro1>' order by a.f_inicio asc";*/


$consulta11 = "select b.id,a.id_evento as 'evento',b.id_evento,a.ci,a.tipo_evento,a.tipo_actividad,a.reporta,a.f_inicio,
a.horas_actividad,a.descripcion,a.mesa,a.estado,b.fecha_cierre,b.detalles,a.causa_evento,
b.tipo_incidente,b.ticket from (select a.id_evento,b.nombre as 'ci',a.f_inicio,
a.descripcion,a.horas_actividad,a.tipo_evento,a.causa_evento,a.tipo_actividad,
c.nombre as 'reporta',a.mesa,a.estado from registro_masivo a, hosts b, new_personas c where a.id_host=b.id and
 a.responsable=c.cedula and (DATE_FORMAT(a.f_inicio, '%Y-%m-%d') >= '<filtro2>' and
 DATE_FORMAT(a.f_inicio, '%Y-%m-%d') <= '<filtro3>' and b.id_contrato='<filtro1>')
)a left JOIN (select * from solucion_incidente where tipo='masivo')b
    ON a.id_evento=b.id_evento order by a.id_evento asc";



$consulta12="Select nombre as 'CI', sum(Total_eventos) as 'Total de eventos', sum(Disponibilidad) as 'Disponibilidad',
sum(Capacidad) as 'Capacidad',area as 'Responsable' from (SELECT  a.nombre, count(b.id) as 'Total_eventos',
   COUNT(
       CASE
           WHEN causa_evento='Disponibilidad'
           THEN 'Disponibilidad'
           ELSE NULL
       END
   ) AS 'Disponibilidad',
   COUNT(
       CASE
           WHEN causa_evento='Capacidad'
           THEN 'Capacidad'
           ELSE NULL
       END
   ) AS 'Capacidad',d.area
FROM   hosts a, incidentecop b,new_usuario c,areas d where b.id_host=a.id and a.id_contrato like '%<filtro1>%' and b.fecha BETWEEN '<filtro2>' and '<filtro3>' and b.responsable=c.cedula
 and c.area=d.id and d.id like '%<filtro4>%' group by a.id
        union (SELECT  a.nombre, count(b.id_host) as 'Total_eventos',
   COUNT(
       CASE
           WHEN causa_evento='Disponibilidad'
           THEN 'Disponibilidad'
           ELSE NULL
       END
   ) AS 'Disponibilidad',
   COUNT(
       CASE
           WHEN causa_evento='Capacidad'
           THEN 'Capacidad'
           ELSE NULL
       END
   ) AS 'Capacidad',d.area
FROM   hosts a, registro_masivo b,new_usuario c,areas d where b.id_host=a.id and a.id_contrato like '%<filtro1>%'
and b.f_inicio BETWEEN '<filtro2>' and '<filtro3>' and b.responsable=c.cedula and c.area=d.id and d.id like '%<filtro4>%' group by a.nombre))k group by CI";


$consulta13 = "select a.nombre as 'Nombre de CI',count(b.servicio_afectado) as
'Cantidad de eventos en servicio por CI' from hosts a, incidentecop b where b.id_host=a.id
and a.id_contrato='<filtro1>' and b.servicio_afectado='<filtro2>'  and b.fecha BETWEEN '<filtro3>' and '<filtro4>'
GROUP by b.id_host";

$consulta14 = "SELECT columna, sum(valores) as 'valores' from (select a.nombre as 'columna' ,
count(DISTINCT b.id_evento) as 'valores' from  new_proyectos a, registro_masivo b,hosts c
where b.id_host=c.id and c.id_contrato=a.codigo and b.f_inicio between '<filtro1>' and '<filtro2>' GROUP
by a.codigo union (select  a.nombre as 'columna',COUNT(b.id) as 'valores'  from new_proyectos a,
incidentecop b,hosts c where b.id_host=c.id and c.id_contrato=a.codigo and
b.fecha between '<filtro1>' and '<filtro2>' GROUP by a.codigo))k group by columna";

$consulta16 = "SELECT columna, sum(valores) as 'valores' from (select a.nombre as 'columna' ,
count(DISTINCT b.id_evento) as 'valores' from  new_proyectos a, registro_masivo b,hosts c
where b.id_host=c.id and c.id_contrato=a.codigo and b.f_inicio between '<filtro1>' and '<filtro2>' GROUP
by a.codigo union (select  a.nombre as 'columna',COUNT(b.id) as 'valores'  from new_proyectos a,
incidentecop b,hosts c where b.id_host=c.id and c.id_contrato=a.codigo and
b.fecha between '<filtro1>' and '<filtro2>' GROUP by a.codigo))k group by columna";

$consulta15 = "select nombre as columna, sum(Disponibilidad) as 'valores',sum(Capacidad) as 'valores1'
from (select a.nombre, count(DISTINCT b.id_evento) as 'Disponibilidad' , (select count(DISTINCT b.id_evento)
as 'Capacidad' from registro_masivo b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Capacidad' and b.f_inicio BETWEEN
'<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'  group by a.nombre) as Capacidad
from new_proyectos a,registro_masivo b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Disponibilidad'
and b.f_inicio BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%' group by a.nombre
union
(select a.nombre, count(b.causa_evento) as 'Disponibilidad', (select count(b.id) as 'Capacidad' from incidentecop b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Capacidad' and b.fecha BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'
group by a.nombre) as Capacidad
from new_proyectos a,incidentecop b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Disponibilidad' and
b.fecha BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'
group by a.nombre))k group by nombre";

$consulta16 = "select a.proyecto as 'Código de proyecto', a.cedula as 'Cédula', a.nombre as 'Nombre',
d.descripcion as 'Mes', round(sum(b.tiempoReal)/60,1) as 'Horas laboradas',

(
select
count(selected_date) * 8.5 as 'horas_programadas'
from
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where month(v.selected_date) = '<filtro1>' and year(v.selected_date) = year(now())
and DATE_FORMAT(v.selected_date,'%w') <> 0
and DATE_FORMAT(v.selected_date,'%w') <> 6
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'
   ) AS Cantidad_horas

from gti.new_personas a,gti.registro_actividad b,gti.new_usuario c,gti.mes d
where a.cedula=b.cedula and a.cedula=c.cedula and d.id_mes='<filtro1>' and c.area like '%<filtro3>%' and
a.correo like '%<filtro2>%' and MONTH(fecha_inicio) = '<filtro1>'
and YEAR(fecha_inicio) = YEAR(NOW()) GROUP by a.nombre;";




$consulta17 = "select a.id_contrato, b.nombre,a.cedula ,d.area ,a.fecha_inicio,
a.fecha_fin,a.descripcion from registro_actividad a,new_personas b,new_usuario c,
areas d where a.cedula=b.cedula and a.fecha_inicio BETWEEN
'<filtro1>' and '<filtro2>' and YEAR(fecha_inicio) = YEAR(NOW())
and c.correo like '%<filtro3>%' and b.cedula=c.cedula
and c.area=d.id and c.area like '%<filtro4>%' and DATE_FORMAT(fecha_inicio,'%H') between '19' and '6'";


$consulta18 = "select a.id_contrato  , b.nombre ,a.cedula ,d.area ,a.fecha_inicio ,a.fecha_fin ,
a.descripcion  from registro_actividad a,new_personas b,new_usuario c,areas d where
a.cedula=b.cedula and b.cedula=c.cedula and c.area=d.id and c.area like '%<filtro4>%' and
c.correo like '%<filtro3>%' and a.fecha_inicio BETWEEN
'<filtro1>' and '<filtro2>' and YEAR(fecha_inicio) = YEAR(NOW())
and DATE_FORMAT(a.fecha_inicio,'%w') <> 1
and DATE_FORMAT(a.fecha_inicio,'%w') <> 2
and DATE_FORMAT(a.fecha_inicio,'%w') <> 3
and DATE_FORMAT(a.fecha_inicio,'%w') <> 4
and DATE_FORMAT(a.fecha_inicio,'%w') <> 5";




$consulta19 = "SELECT a.nombre , round(sum(b.tiempoReal)/60,2) as 'horas' ,
d.nombre as 'lider',d.correo ,c.alias from new_personas a,registro_actividad b,new_lider_contratos c,new_personas d,new_usuario e WHERE b.horaExtra ='Si' and
b.estado='P' and b.cedula=a.cedula and b.cedula=e.cedula and e.area like '%<filtro4>%' and a.correo like '%<filtro3>%' and b.id_contrato=c.codigo and
c.id_lider=d.cedula and b.fecha_inicio between '<filtro1>' and '<filtro2>' group by a.nombre";

$consulta20 = " Select sum(T.tiempoReal) as tiempo, T.correo, T.Contrato  from
(
select `r`.`fecha_inicio` AS `fecha_inicio`,`r`.`tiempoReal` AS `tiempoReal`,
a.actividad,a.plataforma,r.descripcion,`a`.`categoria` AS `categoria`,r.id_contrato,
(select np.nombre from new_proyectos np where np.codigo = r.id_contrato )as Contrato,
`d`.`correo` AS `correo`,
(select `ar`.`id` from `areas` `ar` where (`d`.`area` = `ar`.`id`)) AS `area`
from
((`registro_actividad` `r` left join `actividad` `a` on((`a`.`id` = `r`.`id_actividad`)))
left join `new_usuario` `d` on((`d`.`cedula` = `r`.`cedula`))) where (`r`.`estado` = 'F')
and (`r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>'  )
) T where T.area='<filtro3>'  Group by correo, Contrato;";



$consulta21 = " Select horas, total, Porcentaje, ((Porcentaje*208)/100) HorasProy ,
correo, contrato from (Select T4.horas, total, ((T4.horas*100)/total)
 as Porcentaje, T3.correo, T4.contrato from (Select sum(horas) total,
 correo  from ( Select sum(T.tiempoReal) as minutos, sum(T.tiempoReal/60)
 as horas ,T.correo, id_contrato ,T.Contrato  from
 (select r.fecha_inicio AS fecha_inicio,r.tiempoReal AS tiempoReal,
 a.actividad,a.plataforma,r.descripcion,a.categoria AS categoria,
 r.id_contrato, (select np.codigo from new_proyectos np
 where np.codigo = r.id_contrato )as Contrato, d.correo AS correo,
 (select ar.area from areas ar where (d.area = ar.id)) AS area from
 ((registro_actividad r left join actividad a on((a.id = r.id_actividad)))
 left join new_usuario d on((d.cedula = r.cedula))) where
 (r.estado = 'F')and (r.fecha_inicio > '<filtro1>' and
 r.fecha_inicio < '<filtro2>'  )) T Group by id_contrato,correo, Contrato)
 T2 Group by correo) T3 Inner Join
 (Select horas,correo,id_contrato,contrato from
 (Select sum(T.tiempoReal) as minutos, sum(T.tiempoReal/60)
 as horas ,T.correo, id_contrato ,T.Contrato  from
 (select r.fecha_inicio AS fecha_inicio,r.tiempoReal AS
 tiempoReal, a.actividad,a.plataforma,r.descripcion,a.categoria AS
 categoria,r.id_contrato, (select np.nombre from new_proyectos np where
 np.codigo = r.id_contrato )as Contrato, d.correo AS correo,
 (select ar.area from areas ar where (d.area = ar.id)) AS area
 from ((registro_actividad r left join actividad a
 on((a.id = r.id_actividad)))left join new_usuario d
 on((d.cedula = r.cedula))) where (r.estado = 'F') and
 (r.fecha_inicio > '<filtro1>' and r.fecha_inicio < '<filtro2>'  ))
 T Group by id_contrato,correo, Contrato ) T2 ) T4 on
 T3.correo=T4.correo ) T5;";

 $consulta22 = "SELECT columna, sum(valores) as 'valores' from (select a.nombre as 'columna' ,
 count(DISTINCT b.id_evento) as 'valores' from  new_proyectos a, registro_masivo b,hosts c
 where b.id_host=c.id and c.id_contrato=a.codigo and b.f_inicio between '<filtro1>' and '<filtro2>' GROUP
 by a.codigo union (select  a.nombre as 'columna',COUNT(b.id) as 'valores'  from new_proyectos a,
 incidentecop b,hosts c where b.id_host=c.id and c.id_contrato=a.codigo and b.estado = 'P' and
 b.fecha between '<filtro1>' and '<filtro2>' GROUP by a.codigo))k group by columna";



$_REPORTS_CONFIG = array (
		"ejemplo" => array (
				"tipo" => "tabla|grafico|grafico_linea",
				"titulo" => "Reporte de ...",
				"query" => "select columnaquery1,columnaquery2,columnaquery3 from ...",
				"columnas" => array (
						"columnaquery1" => "columnatabla1",
						"columnaquery2" => "columnatabla2",
						"columnaquery3" => "columnatabla3"
				),
				"filtros" => array (
						"columnaquery1" => array (
								"nombre" => "nombrecampoform",
								"tipo" => "text"
						),
						"columnaquery2" => array (
								"nombre" => "nombrecampoform",
								"tipo" => "datetime"
						)
				)
		),
		"contratos" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Estado de Contratos",
				"query" => "SELECT codigo,nombre,estado FROM new_proyectos;",
				"columnas" => array (
						"codigo" => "Codigo del proyecto",
						"nombre" => "Nombre",
						"estado" => "Estado"
				)
		),


                "productividad" => array (
                                "tipo" => "tabla",
                                "titulo" => "Reporte de Productividad",
                                "query" => $consulta,
                                "columnas" => array (
                                                "contrato" => "Código de Proyecto",
                                                "cedula" => "Cédula",
                                                "nombre" => "Nómbre",
                                                "area" => "Area",
                                                "selected_date" => "Fecha",
                                                "horas_programadas" => "Horas Programadas",
                                                "horas_laboradas" => "Horas Laboradas"
                                ),
                                "filtros" => array (
                                                "filtro1" => array (
                                                                "nombre" => "Fecha Inicio",
                                                                "tipo" => "date"
                                                ),
                                                "filtro2" => array (
                                                                "nombre" => "Fecha Fin",
                                                                "tipo" => "date"
                                                ),
                                                "filtro3" => array (
                                                                "nombre" => "Correo",
                                                                "tipo" => "text",
                                                ),
                                )
                ),







		"grafico_productividad" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad",
				"query" => $consulta2,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false
						)
				)
		),

		"grafico_productividad_personas" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad Personas",
				"query" => $consulta3,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text"
						)
				)
		),
		"grafico_hist_actividades" => array (
				"tipo" => "grafico",
				"grafico" => "bar",
				"titulo" => "Reporte Histórico de Actividades",
				"query" => $consulta4,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false
						)
				)
		),
		"novedades" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Novedades",
				"query" => $consulta5,
				"columnas" => array (
						"fecha" => "Fecha",
						"tipo" => "Tipo de Novedad",
						"proyecto" => "Código de Proyecto",
						"descripcion" => "Descripción"
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Código de Proyecto",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro4" => array (
								"nombre" => "Tipo de Novedad",
								"tipo" => "select",
								"query_select" => "select distinct tipo as value, tipo as display from new_novedades",
								"requerido" => false
						)
				)
		),



            		"mensuales" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual",
				"query" => $consulta6,
				"columnas" => array (
						"fecha_inicio" => "Fecha inicio",
						"actividad" => "Actividad",
						"plataforma" => "Plataforma",
						"descripcion" => "Descripción",
						"categoria" => "Categoria",
						"tiempoReal" => "Tiempo Real",
						"correo" => "Correo",
						"Contrato" => "Contrato",
						"area" => "Area"

				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),

						"filtro3" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						),
						"filtro4" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						)
				)
		),





		"evento_abierto_contrato" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual eventos abiertos por contrato",
				"query" => $consulta7,
				"columnas" => array (
						"ID del evento" => "ID del evento",
						"CI" => "CI",
						"Servicio afectado" => "Servicio afectado",
						"Causa del evento" => "Causa del evento",
						"Responsable" => "Responsable",
						"Correo Responsable" => "Correo Responsable",
				    "fecha" => "Fecha del evento",
						"Contrato" => "Contrato"
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)

				)
		),

		"evento_masivo_abierto" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual eventos masivos abiertos por contrato",
				"query" => $consulta8,
				"columnas" => array (
						"ID del evento" => "ID del evento",
						"CI" => "CI",
						"IP" => "IP",
						"Descripcion" => "Descripcion",
						"Hora de actividad" => "Hora de actividad",
						"Tipo de evento" => "Tipo de evento",
						"Causa del evento" => "Causa del evento",
						"Responsable" => "Responsable",
						"Correo Responsable" => "Correo Responsable",
						"Fecha Creacion" => "Fecha Creacion",
						"Contrato" => "Contrato"

				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)

				)
		),

		"evento_responsable" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos abiertos por cada responsable por contrato",
				"query" => $consulta9,
				"columnas" => array (

						"Responsable" => "reponsable",
						"Cantidad de eventos abiertos" => "Cantidad de eventos abiertos"

				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),

    "evento_general" => array (
        "tipo" => "tabla",
        "titulo" => "Reporte eventos",
        "query" => $consulta10,
        "columnas" => array (

            "id_evento" => "ID de evento",
            "ci_afectado" => "CI afectado",
            "servicio_afectado" => "Servicio afectado",
            "tipo_evento" => "Tipo de evento",
            "causa_evento" => "Causa del evento",
            "tipo_incidente" => "Tipo de incidente",
            "tipo_actividad" => "Tipo de actividad",
            "persona_reporta" => "Persona que reporta",
            "persona_responsable" => "Persona responsable",
            "fecha_evento" => "Fecha del evento",
            "fecha_cierre" => "Fecha de finalización",
            "horas_actividad" => "Horas de actividad",
            "mesa_ayuda" => "Mesa de notificación",
            "estado_evento" => "Estado del evento",
            "detalles" => "Detalles de solución",
            "ticket" => "Ticket",

        ),
        "filtros" => array (
            "filtro1" => array (
                "nombre" => "Contrato",
                "tipo" => "select",
                "query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir'",
                "requerido" => false
            ),
            "filtro2" => array (
                "nombre" => "Fecha Inicio",
                "tipo" => "date"
            ),
            "filtro3" => array (
                "nombre" => "Fecha Fin",
                "tipo" => "date"
            )

        )
    ),

		"evento_masivo_general" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos masivos",
				"query" => $consulta11,
				"columnas" => array (

						"evento" => "ID de evento",
						"ci" => "CI afectado",
						"tipo_evento" => "Tipo de evento",
						"tipo_actividad" => "Tipo de actividad",
						"reporta" => "Persona que reporta",
						"f_inicio" => "Fecha de inicio",
						"horas_actividad" => "Horas de actividad",
						"descripcion" => "Descripción del evento",
						"mesa" => "Mesa de ayuda",
				        "estado" => "Estado del evento",
						"fecha_cierre" => "Fecha de cierre",
						"detalles" => "Detalles de la solución",
						"causa_evento" => "Causa del evento",
						"tipo_incidente" => "Tipo de incidente",
				        "ticket" => "Ticket",


				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),

		"evento_ci" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos por CI",
				"query" => $consulta12,
				"columnas" => array (

						"CI" => "CI",
						"Total de eventos" => "Total de eventos",
						"Disponibilidad" => "Disponibilidad",
						"Capacidad" => "Capacidad"


				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)


				)
		),

		"evento_servicio" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos por Servicio",
				"query" => $consulta13,
				"columnas" => array (

						"Nombre de CI" => "Nombre de CI",
						"Cantidad de eventos en servicio por CI" => "Cantidad de eventos en servicio por CI"

				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Servicio",
								"tipo" => "select",

								"query_select" => "select id as value,tipo as display from tipo_servicios",
								"requerido" => false ,
								"search"=>true
						),

						"filtro3" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro4" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),

		"grafico_evento_contrato" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de eventos por contrato",
				"query" => $consulta14,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),

		"grafico_evento_abierto_contrato" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de eventos abiertos por contrato",
				"query" => $consulta22,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),



		"grafico_dispo_capa" => array (
				"tipo" => "grafico",
				"grafico" => "column",
				"titulo" => "Reporte disponibilidad , capacidad",
				"query" => $consulta15,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where estado='Abrir' order by display",
								"requerido" => false
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						)

				)
		),



		"ci_contrato" => array (
				"tipo" => "tabla",
				"titulo" => "Cantidad de CI's por contrato",
				"query" => "select a.nombre as 'Contrato',count(b.id) as 'Cantidad de CI por contrato'
                 from new_proyectos a,hosts b where b.id_contrato=a.codigo and
                 b.estado='A' group by a.codigo;",
				"columnas" => array (
						"Contrato" => "Nombre de contrato",
						"Cantidad de CI por contrato" => "Cantidad de CI's",

				)
		),



				"productividad_mensual" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Productividad Mensual",
				"query" => $consulta16,
				"columnas" => array (
						"Código de proyecto" => "Código de proyecto",
						"Cédula" => "Cédula",
						"Nombre" => "Nombre",
						"Mes" => "Mes",
						"Cantidad_horas" => "Horas programadas",
						"Horas laboradas" => "Horas laboradas",
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Mes",
								"tipo" => "month",
								"query_select" => "select id_mes as value,descripcion as display from mes",
								"requerido" => true
						),

						"filtro2" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro3" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)
				)

		),







		"reporte_nocturno" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Productividad ,actividades nocturnas",
				"query" => $consulta17,
				"columnas" => array (
						"id_contrato" => "Código de proyecto",
						"nombre" => "Nombre",
						"cedula" => "Cédula",
						"area" => "Area",
						"fecha_inicio" => "Fecha inicio",
						"fecha_fin" => "Fecha fin",
						"descripcion" => "Descripción",
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						) ,
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)
				)

		),


		"reporte_fin_semana" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Productividad ,actividades fín de semana",
				"query" => $consulta18,
				"columnas" => array (
						"id_contrato" => "Código de proyecto",
						"nombre" => "Nombre",
						"cedula" => "Cédula",
						"area" => "Area",
						"fecha_inicio" => "Fecha inicio",
						"fecha_fin" => "Fecha fin",
						"descripcion" => "Descripción",
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						) ,
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)
				)

		),




		"reporte_hora_extra" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Horas extra",
				"query" => $consulta19,
				"columnas" => array (
						"nombre" => "Nombre del analista",
						"horas" => "Horas Extras pendientes",
						"lider" => "Lider Encargado",
						"correo" => "Correo del Lider",
						"alias" => "Nombre del Contrato",
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						) ,
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						)

				)

		),


    "registro_contrato" => array (
        "tipo" => "tabla",
        "titulo" => "Registro por contrato de cada analista en una area específica.",
        "query" => $consulta20,
        "columnas" => array (
            "correo" => "Correo",
            "Contrato" => "Contrato",
            "tiempo" => "tiempo registrado",

        ),
        "filtros" => array (
            "filtro1" => array (
                "nombre" => "Fecha Inicio",
                "tipo" => "date"
            ),
            "filtro2" => array (
                "nombre" => "Fecha Fin",
                "tipo" => "date"
            ),
            "filtro3" => array (
                "nombre" => "Area",
                "tipo" => "select",
                "query_select" => "select id as value,area as display from areas",
                "requerido" => true
            )

        )

    ),



        "registro_detalles_contrato" => array (
        "tipo" => "tabla",
        "titulo" => "Registro detallado por contrato.",
        "query" => $consulta21,
        "columnas" => array (
            "horas" => "Horas",
            "total" => "Total",
            "Porcentaje" => "Porcentaje",
            "HorasProy" => "Horas en el proyecto",
            "correo" => "Correo del analista",
            "contrato" => "Nombre de contrato",



        ),
        "filtros" => array (
            "filtro1" => array (
                "nombre" => "Fecha Inicio",
                "tipo" => "date"
            ),
            "filtro2" => array (
                "nombre" => "Fecha Fin",
                "tipo" => "date"
            )

        )

    )





);
