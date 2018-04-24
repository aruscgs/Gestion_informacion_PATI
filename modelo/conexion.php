<?php
class conexion{
    public $conexion;
    private $server = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $db = "gti_produccion_actual";

	public function __construct() {
		$this->conexion = new mysqli ( $this->server, $this->usuario, $this->pass, $this->db );
		//PRUEBA PULL
		if ($this->conexion->connect_errno) {

			die ( "Fallo al tratar de conectar con MySQL: (" . $this->conexion->connect_errno . ")" );
		}
		$this->conexion->query ( "SET NAMES 'utf8'" );
		$this->pdo_conn = new PDO ( "mysql:host=$this->server;dbname=$this->db", $this->usuario, $this->pass );
	}
	public function cerrar() {
		$this->conexion->close ();
	}
	public function login($correo, $password) {
	    $query = "select p.cedula,p.nombre,u.id,p.proyecto,u.fecha_control,p.cargo,p.correo_personal,p.jefe,p.celular,u.rol from new_usuario u,new_personas p where u.correo = '$correo' and u.correo = p.correo and u.password = '$password' and u.estado='A'";
	    $consulta = $this->conexion->query ( $query );
	    $num = mysqli_num_rows ( $consulta );
	    if ($num == 1) {
	        $row = mysqli_fetch_array ( $consulta );
	        $id = $row ['cedula'];
	        $proyecto = $row ['proyecto'];
	        $lider_id = $row ['jefe'];
	        $cargo = $row ['cargo'];
	        $area = $this->getAreaByUserId ( $id );
	        $name = $row ['nombre'];
	        session_start ();
	        $_SESSION ['authenticated'] = 1;
	        $_SESSION ['rol'] = $row ['rol'];
	        $_SESSION ['user_id'] = $id;
	        $_SESSION ['user_name'] = $name;
	        $_SESSION ['lider_id'] = $lider_id;
	        $_SESSION ['proyecto'] = $proyecto;
	        $_SESSION ['cargo'] = $cargo;
	        $_SESSION ['area'] = $area;
	        $_SESSION ['correo'] = $correo;

	        echo "<script>location.href ='index.php'</script>";
	        //header('Location: ../index.php');
	    }else{

	        echo "<script>alertify.error('Usuario o contraseña incorrecto/a.');
</script>";

	    }

	}
	public function tiempo($tiempo, $user_id, $minutos, $numero, $nombre) {
		//$this->tiempo = $tiempo;
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio,estado,id_contrato, tiempo_calculado, descripcion) VALUES ( '0','" . $user_id . "','" . $tiempo . "','R','" . $numero . "', " .$minutos.", '" .$nombre."')";
		$consulta = $this->conexion->query ( $query );
	}


public function reiniciar_reloj($user_id, $numero)
	{
		$query = "delete from registro_actividad where cedula=$user_id and id_contrato=$numero";
		$consulta = $this->conexion->query ( $query );
	}

	public function act_tiempo($user_id, $minutos, $numero) {
		//$this->tiempo = $tiempo;
		$query = "update registro_actividad set tiempo_calculado=".$minutos." where cedula=".$user_id." and id_contrato='" . $numero . "' and estado='R';";
		$consulta = $this->conexion->query ( $query );
	}

public function registrarActividad ($user_id,$id,$descripcion,$fecha_fin,$tiempoReal,$numerotiquete,$id_contrato, $dato)

	{
		$query = "update registro_actividad set id_actividad=" . $id . ", descripcion='" . $descripcion . "', id_contrato='" . $id_contrato . "', numerotiquete='" . $numerotiquete . "' ,tiempo_calculado='" . $tiempoReal. "', fecha_fin='" . $fecha_fin . "',tiempoReal='" . $tiempoReal . "', estado='F' where cedula=" . $user_id . " and fecha_inicio='".$dato."' and estado='R';";
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}

public function registrardemanda ($user_id,$id,$descripcion,$fecha_fin,$tiempoReal,$numerotiquete,$id_contrato, $horaExtra, $dato, $estado)

	{
		$query = "insert into registro_actividad (id_actividad, fecha_inicio, fecha_fin, estado, tiempoReal, numerotiquete, descripcion,
				id_contrato, tiempo_calculado, cedula, horaExtra) values ($id, '$dato', '$fecha_fin', '$estado', '$tiempoReal', '$numerotiquete', '$descripcion',
				'$id_contrato', $tiempoReal, '$user_id', '$horaExtra' )";
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}


	public function actualizarActividad($id_reg, $user_id, $id, $descripcion, $tiempoReal, $numerotiquete, $id_contrato, $fecha_inicio, $fecha_fin)

	{
		$query = "update registro_actividad set id_actividad=".$id.", descripcion='".$descripcion."',  id_contrato='".$id_contrato."',
				numerotiquete='".$numerotiquete."', tiempoReal='".$tiempoReal."', fecha_inicio='".$fecha_inicio."', fecha_fin='".$fecha_fin."' where id=$id_reg and cedula='$user_id';";

		echo $query;
		$consulta = $this->conexion->query ( $query );
	}

	public function getLiderByUserID($id) {
		$query = "select cedula from new_usuario where cedula = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActiveTaskForUser($user_id) {
		$query = "select * from registro_actividad where estado ='R' and cedula = " . $user_id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActividadesByID($id) {
		$query = "select actividad from actividad where id = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getPlataformaByID($id) {
		$query = "select plataforma from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function getCategoriaByID($id) {
		$query = "select categoria from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function cambiopass($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	public function cambiopasssuper($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	/*public function registrarNuevaActividad($id_actividad, $user_id, $fecha_inicio, $fecha_fin, $tiempoReal, $numerotiquete, $descripcion, $id_contrato, $horaExtra, $estado) {
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio, fecha_fin, estado,tiempoReal,numerotiquete,descripcion,id_contrato,horaExtra) VALUES ('" . $id_actividad . "','" . $user_id . "','" . $fecha_inicio . "','" . $fecha_fin . "','".$estado."','" . $tiempoReal . "','" . $numerotiquete . "','" . $descripcion . "','" . $id_contrato . "','" . $horaExtra. "')";
		$consulta = $this->conexion->query ( $query );

	}*/
	public function actualizarEstado($id, $nuevoEstado) {
		$query = "update registro_actividad set estado='" . $nuevoEstado . "' where id=" . $id . ";";

		$consulta = $this->conexion->query ( $query );
	}
	public function activarContrato($codigo, $alias, $lider) {
		$query = "insert into new_lider_contratos values('" . $codigo . "','" . $alias . "'," . $lider . ");";

		$consulta = $this->conexion->query ( $query );
	}
	public function desactivarContrato($codigo, $lider) {
		$query = "delete from new_lider_contratos where codigo = '" . $codigo . "' and id_lider = '" . $lider . "';";
		$consulta = $this->conexion->query ( $query );
	}
	/*
	 * public function registro_analista($nombre, $area, $correo, $pass, $horario, $lider) {
	 * $this->nombre = $nombre;
	 * $this->area = $area;
	 * $this->correo = $correo;
	 * $this->pass = $pass;
	 * $this->horario = $horario;
	 * $this->lider = $lider;
	 *
	 * $query = "INSERT INTO new_usuario (id,nombre,correo,horalaboral,area,lider,password,cargo_id,estado,ubicacion,educacion,habilidades) VALUES ('','" . $nombre . "','" . $correo . "','" . $horario . "','" . $area . "','" . $lider . "','" . $pass . "','2','A','','','')";
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 */
	public function getAreaByUserId($user_id) {
		$queryArea = "select area from new_usuario where cedula=" . $user_id . "";
		$resArea = $this->conexion->query ( $queryArea );
		$area_user = $resArea->fetch_object ();
		$area_user = $area_user->area;
		return $area_user;
	}
	/*
	 * public function actualizarperfil1($nombre, $user_id, $ubicacion, $educacion) {
	 * $query = "update new_usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "' where id=" . $user_id . "";
	 *
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 * public function actualizarperfil($nombre, $user_id, $ubicacion, $habilidades, $educacion) {
	 * $query = "update usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "', habilidades='" . $habilidades . "' where id=" . $user_id . "";
	 *
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 */
	function mysqli_result($res, $row, $field = 0) {
		$res->data_seek ( $row );
		$datarow = $res->fetch_array ();
		return $datarow [$field];
	}


	public function actualizarPersonasNomus() {
		ini_set ( 'display_errors', 'On' );
		set_time_limit ( 10000 );
		include_once 'modelo/conexion_nomus.php';
		$nomus = new NomusIntegracion ();
		$personas = $nomus->getUsuariosNomus ();
		$disable_query = "update new_personas set estado=2 where estado=0;";
		$this->conexion->query ( $disable_query );
		$disable_query = "update new_personas set estado=0 where estado=1;";
		$this->conexion->query ( $disable_query );
		foreach ( $personas as $key => $registro ) {
			$cedula = $registro ["CEDULA"];
			$nombre = $registro ["NOMBRE"];
			$nombre = str_replace ( "'", "", $nombre );
			$correo = $registro ["CORREO_CORPORATIVO"];
			$correo_personal = $registro ["CORREO_PERSONAL"];
			$celular = $registro ["TEL_CELULAR"];
			$cargo = $registro ["CARGO"];
			$proyecto = $registro ["COD_PROYECTO"];
			$jefe = $registro ["CEDULA_JEFE"];
			$persona_existe = $this->getUserByCedula ( $cedula );
			$número_filas = mysqli_num_rows ( $persona_existe );
			if ($número_filas == 1) {
				// echo "<br>$nombre existe verificando novedades.. ";
				$novedad = false;
				$row = $persona_existe->fetch_object ();
				$proyecto_nov = "";
				$cargo_nov = "";
				$jefe_nov = "";
				$celular_nov = "";
				if (trim ( $row->proyecto ) != trim ( $proyecto )) {
					$proyecto_nov = ",proyecto = '$proyecto'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula que pertenecía al proyecto $row->proyecto ahora pertenece al proyecto $proyecto";
					$this->insertarNovedadPersonal ( "CAMBIO_PROYECTO", $proyecto, $cedula, $descripcion );
					$this->insertarNovedadPersonal ( "CAMBIO_PROYECTO", $row->proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->cargo ) != trim ( $cargo )) {
					$cargo_nov = ",cargo = '$cargo'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de cargo de $row->cargo a $cargo";
					$this->insertarNovedadPersonal ( "CAMBIO_CARGO", $proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->jefe ) != trim ( $jefe )) {
					$jefe_nov = ",jefe = '$jefe'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de jefe ahora es $jefe";
					$this->insertarNovedadPersonal ( "CAMBIO_JEFE", $proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->celular ) != trim ( $celular )) {
					$celular_nov = ",celular = '$celular'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de celular ahora es $celular";
					$this->insertarNovedadPersonal ( "CAMBIO_CELULAR", $proyecto, $cedula, $descripcion );
				}
				if ($novedad) {
					$update = "update new_personas set cedula='$cedula' $cargo_nov $proyecto_nov $jefe_nov $celular_nov where cedula = '$cedula' ";
					$this->conexion->query ( $update );
					// echo $update;
				}
				$enable_query = "update new_personas set estado=1 where cedula='$cedula';";
				$this->conexion->query ( $enable_query );
			} else {
				$insert = "insert into new_personas (cedula,nombre,proyecto,cargo,jefe,correo,correo_personal,celular,estado)
	 		 			values('$cedula','$nombre','$proyecto','$cargo','$jefe','$correo','$correo_personal','$celular',1)";
				$this->conexion->query ( $insert );
				$descripcion = "$nombre con cédula $cedula con cargo $cargo ingresa a la compañía al proyecto $proyecto";
				$this->insertarNovedadPersonal ( "NUEVO_INGRESO", $proyecto, $cedula, $descripcion );
			}
		}

		$inactives_query  = "select * from new_personas where estado=0";
		$result = $this->conexion->query ( $inactives_query );
		while($obj = $result->fetch_object()){
			$descripcion = "$obj->nombre con cédula $obj->cedula del proyecto $obj->proyecto fué retirado de la compañía";
			$this->insertarNovedadPersonal("NUEVO_RETIRO",$obj->proyecto,$obj->cedula,$descripcion);
		}
		$disable_query = "update new_personas set estado=0 where estado=2;";
		$this->conexion->query ( $disable_query );
		ini_set ( 'display_errors', 'Off' );
	}
	function insertarNovedadPersonal($tipo, $proyecto, $cedula, $descripcion) {
		// echo "<br>$descripcion<br>";
		$query = "insert into new_novedades (fecha,tipo,proyecto,cedula,descripcion) values (now(),'$tipo','$proyecto','$cedula','$descripcion')";
		// echo $query;
		$this->conexion->query ( $query );
	}
	function getUserByCedula($cedula) {
		$query = "SELECT proyecto,cargo,jefe,correo_personal,celular FROM new_personas where cedula='$cedula'";
		$persona = $this->conexion->query ( $query );

		return $persona;
	}

	// Cantidad de analistas
	function getColaboradoresFromLider($lider) {
		$query = "SELECT COUNT(*) FROM new_personas where jefe=$lider";
		$numanalista = $this->conexion->query ( $query );
		return $numanalista;
	}
	// cantidad de actividades de mis analistas
	function getProductividadColaboradores($lider) {
		$query = "SELECT sum(a.tiempo_calculado)/count(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula  and r.jefe=$lider and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW()) AND a.estado='F'";
		$numeroactividades = $this->conexion->query ( $query );
		return $numeroactividades;
	}
	// Cantidad de contratos
	function getContratosByLider($lider) {
		$query = "SELECT COUNT(*) FROM new_lider_contratos where id_lider=$lider";
		$contratos = $this->conexion->query ( $query );
		return $contratos;
	}
	// cantidad de pendientes
	function getPendientesByLider($lider) {
		$query = "SELECT COUNT(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula and jefe=$lider AND a.estado='P'";
		$pendientes = $this->conexion->query ( $query );
		return $pendientes;
	}
	// cantidad de actividades mes
	function getActividadesMesAnalista($cedula) {
		$query = "SELECT COUNT(*) FROM registro_actividad WHERE cedula='$cedula'and estado='F' and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW())";
		$actividadesdelmes = $this->conexion->query ( $query );
		return $actividadesdelmes;
	}

	// productividad
	function getProductividad($cedula) {
		$query = " SELECT  round ((avg(a.tiempoReal)),1) productividad  FROM registro_actividad a,new_personas r WHERE a.cedula='$cedula' and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW()) AND a.estado='F'";
		$productividad = $this->conexion->query ( $query );
		return $productividad;
	}
	function getFechaControlUser($cedula) {
		$ctrl_q = "select fecha_control from new_usuario where cedula = '$cedula' ";
		$ctrl_r = $this->conexion->query ( $ctrl_q );
		$ctrl_arr = $ctrl_r->fetch_array ();
		$ctrl = $ctrl_arr ["fecha_control"];
		return $ctrl;
	}
	public function registrarAusentismo($user_id, $proyecto, $fecha_inicio, $fecha_fin, $tipo, $comentario) {
		$query = "insert into
					registro_actividad (id_actividad,fecha_inicio,estado,tiempoReal,descripcion,id_contrato,cedula)
					select
					'8' as id_actividad,
					date_format(v.selected_date,'%Y-%m-%d 07:30:00') as fecha_inicio,
					'F' as estado,
					'510' as tiempoReal,
					'$tipo - $comentario' as descripcion,
					'$proyecto' as id_proyecto,
					'$user_id' as cedula
					from
					(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
							where v.selected_date between '$fecha_inicio' and '$fecha_fin' - INTERVAL 1 DAY
							and DATE_FORMAT(v.selected_date,'%w') <> 0
							and DATE_FORMAT(v.selected_date,'%w') <> 6";

		$consulta = $this->conexion->query ( $query );
	}

	public function updateHostsFromNagios(){

		$oe = new NagiosIntegration();
		foreach ($oe->consolas as $key => $value){
			$conn = $oe->getConnection($key);
			$cis = $conn->query("select distinct address, alias  from ndo.nagios_hosts");
			$this->conexion->query ( "update new_host set estado = 2 where estado = 0;" );
			$this->conexion->query ( "update new_host set estado = 0 where estado = 1 and consola='$key';" );
			while ( $row = $cis->fetch_array()) {
				$host = $row["alias"];
				$ip = $row["address"];

				$exist = $this->conexion->query ( "select count(*) cantidad from new_host where alias = '$host' and address = '$ip' and consola = '$key'");
				$resul = $exist->fetch_array();
				if($resul["cantidad"] == 1){
					$this->conexion->query ( "update new_host set estado = 1 where alias = '$host' and address = '$ip' and consola ='$key'");
					//guardar la novedad
					echo "se actualiza $host en $key.<br>";
				}else{
					$this->conexion->query ("insert into new_host (estado, alias, address,consola) values(1, '$host', '$ip', '$key')");
					echo "se inserta $host en $key.<br>";
					//guardar la noveda
				}
			}
			$deletes = $this->conexion->query(" select * from new_host where estado = 0 and consola='$key'");
			while ( $row = $deletes->fetch_array ( ) ) {
			echo "se elimina $host en $key.<br>";

			 // guardar novedad
			 }
			$this->conexion->query ( "update new_host set estado = 0 where estado = 2;" );

		}



		/*
		 * 1. obtener la lista de funciones de la clase nagiosIntegration
	     * 2. Recorrer las consolas obteniendo su conexión y obtener los hosts de cada conexion
		 * 		query: select distinct address, alias  from ndo.nagios_hosts
		 * 3. Setear la tabla local de hosts de GTI para que todos los estados de los hosts que estan en 0 queden en 2
		 * 4. Setear la tabla local de hosts de GTI para que todos los estados de los hosts que estan en 1 queden 0
		 * 5. Recorrer cada host y revisar si estan en la tabla de hosts local
		 * 		-> validar en cada host, su nombre, ip y consola
		 * 		-> si no está, insertar el hostname, la ip y la consola, estado, en estado debe quedar un 1 (guardar novedad)
		 * 		-> si está se actualiza el estado a 1
		 * 6. Se consultan los hosts de la tabla de gti local donde los estados sean 0 y se guarda la novedad.
		 * 7. Se acualizan todos los estados que estaban 2 a 0.
		 */
	}


	public function registroNewContacto($nombre, $celular, $correo, $tipo, $descripcion)
	{
		$query = "insert into new_contactos (nombre, celular, correo, tipo, descripcion) values ('$nombre', $celular, '$correo', '$tipo', '$descripcion')";
		$consulta = $this->conexion->query ( $query );
	}

	public function nuevoservicio($tipo)
	{
		$query = "insert into tipo_servicios (tipo) values ('$tipo')";
		$consulta = $this->conexion->query ( $query );
	}


	public function servicio_ci($id_host, $id_servicio, $dispo, $delay, $val_war, $val_cri, $tipo, $check, $horario, $puerto, $accion_critica)
	{
	    $query = "insert into detalle_servicio (id_host, id_tipo_servicio, val_war, val_cri, id_tipo_umbral, disponibilidad,delay, tiempo_chequeo, horario, puerto, accion_critico,estado)
		values ('$id_host', '$id_servicio', '$val_war', '$val_cri', '$tipo', '$dispo', '$delay', '$check', '$horario', '$puerto', '$accion_critica','A')";
	    $consulta = $this->conexion->query ( $query );
	}

	public function deleteservicio($borrar)
	{
		$query = "update detalle_servicio set estado='I' where id_detalle=$borrar";
		$consulta = $this->conexion->query ( $query );
	}



    	public function crearCI( $ip, $nombre_ci, $id_contrato, $horario_operativo, $ambiente, $tipo_dispositivo,$servicio_nego,$servicio_admin,$plataforma )
	{
		$query = "insert into hosts (ip, nombre, id_contrato, horario_operativo, ambiente, tipo,servicio_negocio,servicio_administrado,plataforma,estado)
		values('$ip','$nombre_ci','$id_contrato','$horario_operativo','$ambiente','$tipo_dispositivo','$servicio_nego','$servicio_admin','$plataforma','A')";
		$consulta=$this->conexion->query($query);
	}

	public function crearPersona($cedula, $nombre, $proyecto, $cargo, $jefe, $correo, $correo_personal, $celular){
	   $query = "insert into new_personas (cedula, nombre, proyecto, cargo, jefe, correo, correo_personal, celular, estado)
		 values ('$cedula','$nombre','$proyecto','$cargo','$jefe','$correo','$correo_personal','$celular','2')";
		 $consulta=$this->conexion->query($query);
	}

	public function crearUsuario($id, $cedula, $correo, $rol, $hoy, $area){
	   $query = "insert into new_usuario (id, cedula, correo, rol, password, estado, fecha_control, area)
		 values ($id,'$cedula','$correo',$rol,'123','A','$hoy',$area)";
		 $consulta=$this->conexion->query($query);
	}

	public function crearEscalamiento($cedula){
	   $query = "insert into sub_grupo (cedula, contacto, rol_evento, admin_evento)
		 values ('$cedula', 1, 1, 0)";
		 $consulta=$this->conexion->query($query);
	}


	public function update_servicio_ci($id, $dispo, $delay, $check, $war, $cri, $tipo, $horario, $puerto, $accion_critico)
	{
		$query = "update detalle_servicio set disponibilidad='$dispo', delay=$delay, tiempo_chequeo=$check, val_war='$war', val_cri='$cri',
		id_tipo_umbral=$tipo, horario='$horario', puerto='$puerto', accion_critico='$accion_critico' where id_detalle=$id";
		$consulta = $this->conexion->query ( $query );
	}

  public function update_detalle_ci($id, $delay, $check, $war, $cri, $umbral, $horario)
	{
		$query = "update detalle_servicio set delay=$delay, tiempo_chequeo=$check, val_war='$war', val_cri='$cri',
		id_tipo_umbral=$umbral, horario='$horario' where id_detalle=$id";
		$consulta = $this->conexion->query ( $query );
	}

	public function deleteEscalamiento($id)
	{
		$query="delete from escalamiento where id_detalle=$id";
		$consulta=$this->conexion->query($query);
	}

	public function registro_masivo($id_evento, $id_host, $f_inicio, $tipo_evento, $causa_evento, $tipo_actividad, $horas_actividad, $descripcion, $mesa, $respo)
	{
		$query = "insert into registro_masivo (id_evento, id_host, f_inicio, descripcion, horas_actividad, tipo_evento, causa_evento, tipo_actividad, responsable, mesa, estado) values
				($id_evento, $id_host, '$f_inicio', '$descripcion', $horas_actividad, '$tipo_evento', '$causa_evento', '$tipo_actividad', '$respo', '$mesa', 'P')";
		$consulta = $this->conexion->query ( $query );
	}

	public function insertEscalamiento($id_detalle, $responsable,$nivel_escala)
	{
	    $query="insert into escalamiento (id_detalle, id_persona,nivel_escala) values ($id_detalle, $responsable,$nivel_escala)";
	    $consulta = $this->conexion->query($query);
	}





public function registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad, $mesa, $responsable, $estado, $id_host, $observaciones) {

                $query = "insert into incidentecop (servicio_afectado, tipo_evento, causa_evento, tipo_actividad, generado, fecha, horas, responsable, estado, id_host, mesa, observaciones)
                                values('$servicio','$tipo_evento','$causa_evento','$tipo_actividad','$reporta','$fecha','$hrs_actividad','$responsable', '$estado','$id_host','$mesa', '$observaciones')";
                $consulta= $this->conexion->query($query);
        }



public function insertarNuevoTiquet($tiquet,$id_evento,$tipo_evento,$tipo,$rfc,$fecha_fin,
	    $cedula,$detalles) {

	   $query= "INSERT INTO solucion_incidente (ticket, id_evento, tipo_incidente, tipo,num_rfc, fecha_cierre, cierra_evento,detalles) values('$tiquet', '$id_evento', '$tipo_evento','$tipo' ,'$rfc', '$fecha_fin','$cedula', '$detalles')";

		$consulta=$this->conexion->query($query);

	}






public function modificar_ci($id_ci, $ip,$nombre_ci,$horario_noti, $ambiente, $tipo_ci, $servicio_negocio, $servicio_admin, $plataforma)
	{
	    $query = "update hosts set ip='$ip', nombre='$nombre_ci' ,horario_operativo='$horario_noti', ambiente='$ambiente', tipo='$tipo_ci', servicio_negocio='$servicio_negocio',
		servicio_administrado='$servicio_admin',plataforma='$plataforma' where id=$id_ci";
	    $consulta = $this->conexion->query ( $query );
	}






	public  function cambiarEstadoIncidente($id){

		$query="update incidentecop set estado='S' where id=$id";

		$consulta=$this->conexion->query($query);
	}

	public  function cambiarEstadoIncidenteMasivo($id_masivo){

		$query="update registro_masivo set estado='S' where id_evento=$id_masivo";

		$consulta=$this->conexion->query($query);
	}

	// cantidad de eventos abiertos
	function getEventosAbiertos($cedula) {
		$query = "SELECT COUNT(*) FROM incidentecop  WHERE estado='P' and responsable='$cedula'" ;
		$eventos = $this->conexion->query ( $query );
		return $eventos;
	}

	// cantidad de eventos masivos abiertos
	function getEventosMasivosAbiertos($cedula){
		$query ="SELECT count(distinct id_evento)  FROM registro_masivo WHERE estado='P' and responsable='$cedula'";
		$eventos_masivos=$this->conexion->query($query);
		return $eventos_masivos;

	}

       	function insertar_indicadores($servicio,$cliente,$zona,$mes,$ans,$ind_cr,$ind_cl,$ind_gral,$cumplimiento,
			$justificacion,$plan_acc){
	$query="insert into indicador_operacion (descripcion_servicio,cliente,zona,fecha,ans_acordado,indicador_cr,indicador_cl,
	indicador_general,cumplimiento,justificacion,plan_accion) values ('$servicio','$cliente',
    '$zona','$mes','$ans',$ind_cr,$ind_cl,$ind_gral,$cumplimiento,'$justificacion','$plan_acc')";

	$consulta = $this->conexion->query($query);

	}



	public function actualiza_indicadores($id,$ind_cr,$ind_cl,$ind_gral,$cumplimiento,$justificacion,$plan_accion){
	    $query="update indicador_operacion set indicador_cr=$ind_cr,indicador_cl=$ind_cl,
        indicador_general=$ind_gral,cumplimiento=$cumplimiento,justificacion='$justificacion',
        plan_accion='$plan_accion' where id='$id'";

	    $consulta=$this->conexion->query($query);
	}



	function crea_cliente_indicador($nombre,$zona){

	    $query="insert into cliente (cliente,zona) values ('$nombre','$zona')";
	    $consulta = $this->conexion->query($query);
	}


	function asigna_servicio_cliente($id_cliente,$id_servicio,$ans){

	    $query="insert into cliente_servicio(id_cliente,id_servicio,ANS)values($id_cliente,$id_servicio,'$ans')";
	    $consulta = $this->conexion->query($query);


	}

	public function cambia_estado_editar_indicador($cedula){

	    $query="update permiso_indicador set editar=0 where cedula='$cedula'";

	    $consulta=$this->conexion->query($query);

	}

	public function cambia_estado_crear_indicador($cedula){

	    $query="update permiso_indicador set crear=0 where cedula='$cedula'";

	    $consulta=$this->conexion->query($query);

	}

	function crear_servicio_indicador($nombre_ser){
	    $query="insert into servicio_indicador (nombre) VALUE('$nombre_ser')";
	    $consulta = $this->conexion->query($query);
	}

	public function actualizar_permiso_indicador($cedula,$crear,$consultar,$editar,$administrar,$fecha_inicio_crear,
	    $fecha_fin_crear,$fecha_inicio_modificar,$fecha_fin_modificar,$ano,$mes){

	        $query="update permiso_indicador set crear='$crear',consultar='$consultar',editar='$editar',administrar='$administrar',
        f_inicio_crear='$fecha_inicio_crear',f_fin_crear='$fecha_fin_crear',f_inicio='$fecha_inicio_modificar',f_fin='$fecha_fin_modificar',
        mes_de_permiso='$mes',ano_permiso='$ano' where cedula='$cedula'";

	        $consulta=$this->conexion->query($query);

	}


	public function dar_permiso_indicador($cedula,$crear,$consultar,$editar,$administrar,$fecha_inicio_crear,
	    $fecha_fin_crear,$fecha_inicio_modificar,$fecha_fin_modificar,$ano,$mes){

	        $query="insert into permiso_indicador (cedula,crear,consultar,editar,administrar,f_inicio_crear,f_fin_crear,f_inicio,f_fin,mes_de_permiso,ano_permiso)
        values ('$cedula','$crear','$consultar','$editar','$administrar','$fecha_inicio_crear','$fecha_fin_crear','$fecha_inicio_modificar',
        '$fecha_fin_modificar','$mes','$ano')";

	        $consulta=$this->conexion->query($query);

	}

	public function rotarescala($cedula, $id_evento, $nota)
	{
		$query="update registro_masivo set responsable=$cedula, descripcion='$nota' where id_evento=$id_evento";
		$consulta = $this->conexion->query($query);
	}



         	public function inserta_primera_actividad($fecha,$fecha_fin,$cedula,$proyecto){

	        $query= "INSERT INTO registro_actividad (id_actividad, fecha_inicio, fecha_fin, estado, tiempoReal, numerotiquete,descripcion,
            id_contrato,tiempo_calculado,cedula,horaExtra) values(4202,'$fecha', '$fecha_fin', 'F', '50', 'N/A',
            'Actividades comunes de gestión laboral','$proyecto','50','$cedula','No')";

	        $consulta=$this->conexion->query($query);

	}

        public function recuperar_detalle($ci,$componente){

	    $query="update detalle_servicio set estado='A' where id_host='$ci' and id_tipo_servicio='$componente' and estado='I'";
	    $consulta=$this->conexion->query($query);

	}

				public function cambia_estado_persona($cedula){

	           $query="update new_personas set estado='1' where cedula='$cedula'";
	           $consulta=$this->conexion->query($query);
 }

         	public function cambia_estado_ci_desactivar($id_contrato,$id_ci){

	    $query="update hosts set estado='I' where id='$id_ci' and id_contrato='$id_contrato'";
	    $consulta=$this->conexion->query($query);

	}

	public function cambia_estado_ci_activar($id_contrato,$id_ci){

	    $query="update hosts set estado='A' where id='$id_ci' and id_contrato='$id_contrato'";
	    $consulta=$this->conexion->query($query);

	}



	public function registrar_analisis($contrato,$plataforma,$ano,$mes,$analisis){

	    $query="insert into analisis_reporte (id_contrato,plataforma,ano,mes,descripcion_analisis)
        values ('$contrato','$plataforma','$ano','$mes','$analisis')";

	    $consulta=$this->conexion->query($query);

	}

	public function edita_analisis($id_analisis,$descripcion_analisis){

	    $query="update analisis_reporte set descripcion_analisis='$descripcion_analisis' where id='$id_analisis'";
	    $consulta=$this->conexion->query($query);

	}


	public function numero_eventos_cerrados($cedula){

	    $query =" select count(a.id_evento) as num from (select a.id_evento from (select id as 'id_evento',tipo_evento,fecha,observaciones from
incidentecop where responsable='$cedula' and estado='S' and fecha between
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') order by
id_evento asc)a
left join solucion_incidente b on a.id_evento=b.id_evento
union
select a.id_evento  from (select distinct id_evento,tipo_evento,descripcion as 'observaciones',f_inicio as
'fecha'  from registro_masivo where responsable='$cedula' and f_inicio between
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') and estado='S')a
 left join
solucion_incidente b on a.id_evento=b.id_evento and b.tipo='masivo' order by id_evento asc)a";
	    $eventos_cerrados=$this->conexion->query($query);
	    return $eventos_cerrados;
	}

}
?>
