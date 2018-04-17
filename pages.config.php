 <?php
 $conexion=new conexion();

$res=$conexion->conexion->query("select b.rol_evento from new_usuario a, sub_grupo b
where a.cedula=b.cedula and a.cedula='$userinfo->user_id'");

$log=$res->fetch_assoc();


?>



<?php


if($log['rol_evento']=='1'){



$_PAGE_PERMISSIONS = array(
		"1" => array(
				"006" => false,
				"017" => false,
				"018" => false,
				"014" => false,
				"015" => false,
				"016" => false,
				"023" => false,



                     ),
		"2" => array(
				"011" => false,
				"010" => false,
				"017" => false,
				"018" => false,
				"015" => false,
				"016" => false,
				"008" => false,
                "003" => false,
                "019" => false,
                "020" => false,
                "021" => false,
                "022" => false,
                "045" => false,
                "047" => false,
				"048" => false,
                "003" => false,
				"008" => false,
				"023" => false,




		),
		"3" => array(
				"006" => false,
				"017" => false,
				"018" => false,
				"009" => false,
				"011" => false,
				"010" => false,
				"014" => false,
				"015" => false,
				"016" => false,
				"023" => false,



          	),
		"4" => array(

		),
		"5" => array(
				"017" => false,
				"018" => false,
				"015" => false,
				"016" => false,
				"023" => false,





	),
);

}else{


	$_PAGE_PERMISSIONS = array(
		"1" => array(
				"006" => false,
				"017" => false,
				"018" => false,
				"012" => false,
				"014" => false,
				"013" => false,
				"015" => false,
				"016" => false,
				"023" => false,
				"024" => false,
				"025" => false,
				"026" => false,
			        "052" => false,
                          	"027" => false,
				"028" => false,
				"029" => false,
		        "041" => false,
                     ),
		"2" => array(
				"011" => false,
				"010" => false,
				"017" => false,
				"018" => false,
				"012" => false,
				"013" => false,
				"015" => false,
				"016" => false,
				"008" => false,
                "003" => false,
                "019" => false,
                "020" => false,
                "021" => false,
                "022" => false,
                "045" => false,
                "047" => false,
				"048" => false,
                "003" => false,
				"008" => false,
				"023" => false,
				"024" => false,
				"025" => false,
				"026" => false,
			        "052" => false,
                             	"027" => false,
				"028" => false,
				"029" => false,
                "041" => false,

		),
		"3" => array(
				"006" => false,
				"017" => false,
				"018" => false,
				"009" => false,
				"011" => false,
				"010" => false,
				"012" => false,
				"013" => false,
				"014" => false,
				"015" => false,
				"016" => false,
				"023" => false,
				"024" => false,
				"025" => false,
				"026" => false,
			        "052" => false,
                         	"027" => false,
				"028" => false,
	            "029" => false,
	            "041" => false,

          	),
		"4" => array(

		),
		"5" => array(
				"017" => false,
				"018" => false,
				"012" => false,
				"013" => false,
				"015" => false,
				"016" => false,
				"023" => false,
				"024" => false,
				"025" => false,
				"026" => false,
			        "052" => false,
                         	"027" => false,
				"028" => false,
				"029" => false,
				"041" => false,


	),
);



}



// Pagina Actual : 052

$_PAGE_CONFIG = array(
		//000 siempre es la home
		"000" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Tablero de control",
				"menu" => "Tablero de control",
				"menu_css_class" => "fa-dashboard",
				"link" => 'pages/tablero/body.php'
		),

		"009" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-clock-o",
				"small" => "Bitácora de Operación",
				"menu" => "Bitácora de operación",
				"submenu" => array(
						"2" => "006",
						"3" => "010",
						"4" => "011",
						"5" => "014"
				)
		),
		"006" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitácora de operación",
				"small" => "Actividades del mes",
				"menu" => "Actividades del mes",
				"link" => 'pages/bitacora_operacion/actividades_mes/body.php',
				"menu_css_class" => "fa-list"
		),
		"010" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitácora de operación",
				"small" => "Pendientes aprobación",
				"menu" => "Pendientes aprobación",
				"link" => 'pages/bitacora_operacion/actividades_pendientes/body.php',
				"menu_css_class" => "fa-edit"
		),
		"011" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitácora de operación",
				"small" => "Asignacion de contratos",
				"menu" => "Asignacion de contratos",
				"link" => 'pages/bitacora_operacion/asignacion_contratos/body.php',
				"menu_css_class" => "fa-edit"
		),
		"014" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitácora de operación",
				"small" => "Registro de Ausentismo",
				"menu" => "Registro de Ausentismo",
				"link" => 'pages/bitacora_operacion/registro_ausentismo/body.php',
				"menu_css_class" => "fa-plane"
		),



		//	---------GESTIÃ“N DE EVENTOS--------------

		"012" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa fa-bell",
				"small" => "Gestión de eventos",
				"menu" => "Gestión de eventos",
				"submenu" => array(
						"1" => "013",
						//"2" => "023",
						"3" => "024",
						//"4" => "025",
						"5" => "026",
						//"6" => "027",
					        "6" => "052",
                                                "8" => "053",
                                           	"7" => "028",
						//"8" => "029",
						"9" => '031',
						//"10" => "029",
						"11" => '043',
            "12" => '005',

				)
		),

    "005" => array(
        "show" => true,
        "isSubmenu" => true,
        "big" => "Gestión de eventos",
        "small" => "Descargar Caracterizacion",
        "menu" => "Descargar Caracterizacion",
        "link" => 'pages/gestion_eventos/descarga_caracterizacion/Caracterizacion.php',
        "menu_css_class" => "fas fa-download"
    ),


		"013" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Nuevo evento",
				"menu" => "Nuevo evento",
				"link" => 'pages/gestion_eventos/nuevo_evento/body.php',
				"menu_css_class" => "fa-plus"
		),

		"023" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Servicio",
				"menu" => "Servicio",
				"link" => 'pages/gestion_eventos/nuevo_evento/servicio.php',
				"menu_css_class" => "fa-plus"
		),

		"024" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Nuevo Contacto",
				"menu" => "Nuevo Contacto",
				"link" => 'pages/gestion_eventos/nuevo_contacto/body.php',
				"menu_css_class" => "fa-plus"
		),

		"025" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Detalles",
				"menu" => "Detalles",
				"link" => 'pages/gestion_eventos/nuevo_evento/detalles.php',
				"menu_css_class" => "fa-plus"
		),

		"026" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Nuevo CI",
				"menu" => "Nuevo CI",
				"link" => 'pages/gestion_eventos/nuevo_evento/nuevo_ci.php',
				"menu_css_class" => "fa-plus"
		),



               		"052" => array(
		"show" => true,
		"isSubmenu" => true,
		"big" => "Gestión de eventos",
		"small" => "Modificar CI",
		"menu" => "Modificar CI",
		"link" => 'pages/gestion_eventos/nuevo_evento/modificar_ci.php',
		"menu_css_class" => "fa-plus"
		    ),



                    "053" => array(
		    "show" => true,
		    "isSubmenu" => true,
		    "big" => "Gestión de eventos",
		    "small" => "Eliminar/Restaurar CI's",
		    "menu" => "Eliminar/Restaurar CI's",
		    "link" => 'pages/gestion_eventos/nuevo_evento/eliminar_restaurar_ci.php',
		    "menu_css_class" => "fa-plus"
		        ),



               	"027" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Registro de incidentes",
				"menu" => "Registro de incidentes",
				"link" => 'pages/gestion_eventos/nuevo_evento/registro_incidentes.php',
				"menu_css_class" => "fa-plus"
		),

		"028" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Solución a incidentes",
				"menu" => "Solución a incidentes",
				"link" => 'pages/gestion_eventos/nuevo_evento/solucion_incidentes.php',
				"menu_css_class" => "fa-plus"
		),

		"029" => array(
				"show" => false,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Registro Masivo",
				"menu" => "Registro Masivo",
				"link" => 'pages/gestion_eventos/nuevo_evento/registro_masivo.php',
				"menu_css_class" => "fa-plus"
		),

		"031" => array(
				"show" => false,
				"isSubmenu" => true,
				"big" => "Gestión de eventos",
				"small" => "Buscar evento",
				"menu" => "Buscar evento",
				"link" => 'pages/gestion_eventos/nuevo_evento/buscar_evento.php',
				"menu_css_class" => "fa-plus"
		),


		"015" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa fa-wrench",
				"small" => "Gestión de configuración",
				"menu" => "Gestión de configuración",
				"submenu" => array(
						"1" => "016",
				)
		),
		"016" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestión de configuracion",
				"small" => "Editar CIs",
				"menu" => "Editar CIs",
				"link" => 'pages/gestion_configuracion/editar_cis/body.php',
				"menu_css_class" => "fa-pencil-square-o"
		),
		"017" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-cogs",
				"small" => "Administración",
				"menu" => "Administración",
				"submenu" => array(
						"1" => "018",
            "2" => "054",
            "3" => "070",
				)
		),
		"018" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Administración",
				"small" => "Actualizar Usuarios",
				"menu" => "Actualizar Usuarios",
				"link" => 'pages/administracion/actualizar_usuarios/body.php',
				"menu_css_class" => "fa-user-plus"
		),

    "054" => array(
        "show" => true,
        "isSubmenu" => true,
        "big" => "Administración",
        "small" => "Crear Usuarios",
        "menu" => "Crear Usuarios",
        "link" => 'pages/administracion/crear_usuario/body.php',
        "menu_css_class" => "fa-user-plus"
    ),
    "070" => array(
        "show" => true,
        "isSubmenu" => true,
        "big" => "Administración",
        "small" => "Asignar a Escalamiento",
        "menu" => "Asignar a Escalamiento",
        "link" => 'pages/administracion/asig_escalamiento/body.php',
        "menu_css_class" => "fa-users"
    ),

		"007" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Cambiar contraseña",
				"menu" => "Cambiar contraseña",
				"link" => 'pages/cambiar_contrasena/body.php',
				"menu_css_class" => "fa-key"
		),
		"001" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa fa-pie-chart",
				"small" => "Reportes",
				"menu" => "Reportes bitácora",
				"submenu" => array(
						"page1" => "003",
						"page2" => "008",
						"page3" => "019",
						"page4" => "020",
						"page5" => "021",
						"page6" => "022",
						"page7" => "030",
					    "page8" => "045",
			            "page9" => "047",
                        "page10" => "048",
	                    "page11" => "049",
	                    "page12" => "055",
                            "page13" => "056",
				)
		),


		"041" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "Reportes",
				"small" => "Gestion de eventos",
				"menu" => "Reportes eventos",
				"menu_css_class" => "fa fa-area-chart",
				"submenu" => array(
                                                "page9" => "044",
						"page10"=> "032",
						"page11"=> "033",
						"page12"=> "034",
						"page13"=> "035",
						"page14"=> "036",
					       "page21" => "064",
                                           	"page15"=> "037",
						"page16"=> "040",
						"page17"=> "038",
						"page18"=> "039",
                                                "page19"=> "057",
                                                "page20" => "062",

				)


		),




               		"050" => array(
		"show" => true,
		"isSubmenu" => false,
		"big" => "Indicadores Operación",
		"small" => "Indicadores de operación",
		"menu" => "Indicadores de operación",
		"menu_css_class" => "fa-line-chart",
		"submenu" => array(
		"page8" => "042",
	        "page9" => "051",
	        "page10" => "058",
	        "page11" => "059",
	        "page12" => "060",
	        "page13" => "061",


	)


		),



		"042" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Indicadores de operación",
				"small" => "Registrar Indicadores",
				"menu" => "Registrar Indicadores",
				"menu_css_class" => "fa fa-bar-chart",
				"link" => 'pages/components/indicadores_operacion.php',

		),



		        "051" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Consultar indicadores",
				"small" => "Consultar indicadores",
				"menu" => "Consultar indicadores",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => 'pages/components/consulta_indicadores.php'
						),





                                 	"058" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Crear cliente o servicio",
						"small" => "Crear cliente o servicio",
						"menu" => "Crear cliente o servicio",
						"menu_css_class" => "fa-user-plus",
						"link" => 'pages/components/crear_cliente_servicio.php'
						    ),

						    "059" => array(
						    "show" => true,
						    "isSubmenu" => true,
						    "big" => "Asignar servicio a cliente",
						    "small" => "Asignar servicio a cliente",
						    "menu" => "Asignar servicio a cliente",
						    "menu_css_class" => "fa-pencil-square-o",
						    "link" => 'pages/components/asigna_servicio.php'
						        ),

						        "060" => array(
						        "show" => true,
						        "isSubmenu" => true,
						        "big" => "Reporte mensual indicadores de operación",
						        "small" => "Reporte mensual",
						        "menu" => "Reporte mensual",
						        "menu_css_class" => "fa fa-pie-chart",

						        "link" => 'pages/components/reporte_mensual_indicadores.php'
						            ),



                                                       "061" => array(
						            "show" => true,
						            "isSubmenu" => true,
						            "big" => "Gestionar permisos",
						            "small" => "Gestión de permisos",
						            "menu" => "Gestionar permisos",
						            "menu_css_class" => "fa fa-unlock",

						            "link" => 'pages/components/gestionar_permisos.php'
						                ),




                                                        "062" => array(
						                "show" => true,
						                "isSubmenu" => true,
						                "big" => "Editar informes",
						                "small" => "Editar informes",
						                "menu" => "Editar informes",
						                "menu_css_class" => "fa-pencil-square-o",

						                "link" => 'pages/components/editar_informes.php'
						                    ),




                                                               "064" => array(
						                        "show" => true,
						                        "isSubmenu" => true,
						                        "big" => "Detalles evento por CI",
						                        "small" => "Detalles",
						                        "menu" => "Detalles evento por CI",
						                        "menu_css_class" => "fa-file-pdf-o",

						                        "link" => 'pages/components/detalles_evento_ci.php'
						                            ),




		"003" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Contratos",
				"menu" => "Contratos",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/contratos/body.php"
		),
		"008" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Productividad",
				"menu" => "Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/productividad/body.php"
		),

		"019" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Grafico Productividad",
				"menu" => "Grafico Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_productividad/body.php"
		),
		"020" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Grafico Productividad Personas",
				"menu" => "Grafico Prod. Personas",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_productividad_personas/body.php"
		),
		"021" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Historico de actividades diarias",
				"menu" => "Grafico Hist. Act.",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_histo_actividades/body.php"
		),
		"022" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Reporte de novedades",
				"menu" => "Reporte de novedades",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/novedades/body.php"
		),



		"023" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Productividad",
				"menu" => "Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/productividad/body.php"
		),

		"030" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Mensuales",
				"menu" => "Mensuales",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/mensuales/body.php"
		),


		"043" => array(
				"show" => false,
				"isSubmenu" => false,
				"big" => "Reporte Mantenimiento",
				"small" => "Mantenimiento",
				"menu" => "Reporte Mantenimiento",
				"menu_css_class" => "fa-envelope",
				"link" => 'pages/components/mantenimiento.php',

		),


                      "044" => array(
                                "show" => true,
				"isSubmenu" => true,
				"big" => "Eventos abiertos",
				"small" => "Eventos abiertos ",
				"menu" => "Eventos abiertos",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_abierto_contrato/body.php"
                          ),



                       "045" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reporte productividad mensual",
				"small" => "Reporte productividad mensual",
				"menu" => "Reporte productividad mensual",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/productividad_mensual/body.php"
	                	),



                      "046" => array(
                              "show" => false,
                              "isSubmenu" => false,
                              "big" => "GTI",
                              "small" => "Registro por Demanda",
                              "link" => 'pages/bitacora_operacion/registro/registro_demanda.php'
                              ),


                       "047" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reporte nocturno",
				"small" => "Reporte nocturno",
				"menu" => "Reporte nocturno",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/reporte_nocturno/body.php"
		),

	         	"048" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reporte fin de semana",
				"small" => "Reporte fin de semana",
				"menu" => "Reporte fin de semana",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/reporte_fin_semana/body.php"
		),



                       "049" => array(

                             "show" => true,
                        "isSubmenu" => true,
                        "big" => "Reporte horas extra",
                           "small" => "Reporte horas extra",
                           "menu" => "Reporte horas extra",
                           "menu_css_class" => "fa-file-pdf-o",
                           "link" => "pages/reportes/reporte_hora_extra/body.php"

                                 ),


                                 "055" => array(
                                 "show" => true,
                                 "isSubmenu" => true,
                                 "big" => "Registro por contrato",
                                 "small" => "Registro por contrato",
                                 "menu" => "Registro por contrato",
                                 "menu_css_class" => "fa-file-pdf-o",
                                 "link" => "pages/reportes/registro_contrato/body.php"
                                     ),


			"056" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Registro detalles por contrato",
						"small" => "Registro por contrato",
						"menu" => "Registro detalles por contrato",
						"menu_css_class" => "fa-file-pdf-o",
						"link" => 'pages/reportes/registro_detalles_contrato/registro_detalles_contrato.php'
						    ),



                                    		    "057" => array(
						    "show" => true,
						    "isSubmenu" => true,
						    "big" => "Analisis de informes",
						    "small" => "Analisis de informes",
						    "menu" => "Analisis de informes",
						    "menu_css_class" => "fa-pencil-square-o",
						    "link" => 'pages/components/analisis_informes.php'
						        ),





		"032" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos masivos abiertos",
				"small" => "Eventos masivos abiertos",
				"menu" => "Eventos masivos abiertos",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_masivo_abierto/body.php"
		),

		"033" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos por responsable",
				"small" => "Eventos por responsable",
				"menu" => "Eventos por responsable",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_responsable/body.php"
		),

		"034" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos, reporte general",
				"small" => "Eventos, reporte general",
				"menu" => "Eventos general",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_general/body.php"
		),


		"035" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos masivos,reporte general",
				"small" => "Eventos masivos,reporte general",
				"menu" => "Eventos masivos general",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_masivo_general/body.php"
		),

		"036" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos por CI",
				"small" => "Eventos por CI",
				"menu" => "Eventos por CI",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_ci/body.php"
		),

		"037" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Eventos por servicio",
				"small" => "Eventos por servicio",
				"menu" => "Eventos por servicio",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/evento_servicio/body.php"
		),

		"038" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gráfico eventos por contrato",
				"small" => "Gráfico Eventos por contrato",
				"menu" => "Gráfico eventos por contrato",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_evento_contrato/body.php"
		),

		"039" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gráfico capacidad y disponbilidad",
				"small" => "Gráfico Eventos",
				"menu" => "Gráfico capacidad y disponbilidad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_dispo_capa/body.php"
		),

		"040" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reporte ,CI's por contrato",
				"small" => "Cantidad de CI's por contrato",
				"menu" => "Cantidad de CI's por contrato",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/ci_contrato/body.php"
		),







		"002" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Sugerencias",
				"menu" => "Sugerencias",
				"menu_css_class" => "fa-envelope",
				"link" => 'pages/sugerencias/body.php'
		),




		"004" => array(
				"show" => false,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Registro actividad",
				"link" => 'pages/bitacora_operacion/registro/body.php'
		),
		"500" => array(
				"show" => false,
				"link" => 'pages/error/500.php'
		),
		"404" => array(
				"show" => false,
				"link" => 'pages/error/404.php'
		)

);
