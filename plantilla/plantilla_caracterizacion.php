
<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */


//Include ('../../../pages/backend/includes/traer_caracterizacion.php');

include '../modelo/conexion.php';

$conexion=new conexion();

//$nombre=$con->conexion->query("select cedula,nombre,proyecto,cargo from new_personas");


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

$contrato=$_POST["contrato"];



$consulta1 = $conexion->conexion->query("SELECT a.id_detalle ,a.id_tipo_servicio,a.id,a.nombre,a.tipo_dispo,a.ip,a.servicio_negocio,a.servicio_administrado,
a.tipo_servicio,a.val_war,a.val_cri,a.tipo_umbral,a.horario,a.accion_critico
from (select a.*,b.*,c.tipo as 'tipo_dispo',d.tipo as 'tipo_servicio',e.nombre as 'tipo_umbral' from
 (select * from hosts where id_contrato='$contrato' and estado='A')a,
(select id_detalle,puerto,val_war,val_cri,id_tipo_umbral,horario,accion_critico,id_host,
id_tipo_servicio,estado as 'estado_detalle' from detalle_servicio)b, tipo_dispositivo c,tipo_servicios d,
tipo_umbral e where a.id=b.id_host
 and b.estado_detalle='A' and a.tipo=c.id and b.id_tipo_servicio=d.id and
 b.id_tipo_umbral=e.id_tipo_umbral order by id)a order by id asc;
");



$consulta2 = $conexion->conexion->query("   select count(a.id_host) as id from (select a.id_host from  detalle_servicio a,hosts b where a.id_host=b.id and
    b.id_contrato='$contrato' and a.estado='A' and b.estado='A' order by b.id asc)a group by id_host");


if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

    /** Include PHPExcel */
    require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

    $id_hosts= array();

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


    $objPHPExcel->getActiveSheet()
    ->getStyle('A8:O8')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('rgb(2, 23, 62)');



    $objPHPExcel->getActiveSheet()
    ->getStyle('A7:O7')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('rgb(2, 23, 62)');

    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('arus logo');
    $objDrawing->setDescription('logo de arus');
    $objDrawing->setPath('../dist/img/aruslogo.jpg');
    $objDrawing->setCoordinates('A1');
    //setOffsetX works properly
    $objDrawing->setOffsetX(5);
    $objDrawing->setOffsetY(5);
    //set width, height
    $objDrawing->setWidth(300);
    $objDrawing->setHeight(110);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

    $colorfontescala = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '380DD5'),
        ));

    $objPHPExcel->getActiveSheet()->getStyle('A8:O8')->applyFromArray($colorfontescala);

    $colorfont = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'ffffff'),
            'size'  => 8,
            'name'  => 'Verdana'
        ));

    $objPHPExcel->getActiveSheet()->getStyle('A8:O8')->applyFromArray($colorfont);

    $aliniarCell = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        )
    );

    $objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($aliniarCell);
    $objPHPExcel->getActiveSheet()->getStyle("O1")->applyFromArray($aliniarCell);
    $objPHPExcel->getActiveSheet()->getStyle("O4")->applyFromArray($aliniarCell);
    $objPHPExcel->getActiveSheet()->getStyle("A8:O8")->applyFromArray($aliniarCell);


    $objPHPExcel->getActiveSheet()->getStyle("I")->applyFromArray($aliniarCell);
    $objPHPExcel->getActiveSheet()->getStyle("H")->applyFromArray($aliniarCell);




    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:N6')
    ->mergeCells('O1:O3')
    ->mergeCells('O4:O6')
    ->setCellValue('A1', 'CARACTERIZACIÓN Y MODELO DE EVENTOS')
    ->setCellValue('O1', 'V1')
    ->setCellValue('O4', 'Acceso Restringido')
    ->setCellValue('A8', 'Nombre de CI')
    ->setCellValue('B8', 'Tipo dispositivo')
    ->setCellValue('C8', 'IP')
    ->setCellValue('D8', 'Servicio Negocio')
    ->setCellValue('E8', 'Servicio Administrado')
    ->setCellValue('F8', 'Subcomponentes')
    ->setCellValue('G8', 'Puerto')
    ->setCellValue('H8', 'Valor Warning')
    ->setCellValue('I8', 'Valor Critical')
    ->setCellValue('J8', 'Tipo de umbral')
    ->setCellValue('K8', 'Horario de operación')
    ->setCellValue('L8', 'Accion critica')
    ->setCellValue('M8', 'Escalamiento 1')
    ->setCellValue('N8', 'Escalamiento 2')
    ->setCellValue('O8', 'Escalamiento 3');

    // $conexion_caracteriza=$conexion_caracteriza->enviar_caracterizacion();

    $i=9;
    $Y=9;
    $aux_esc_1 = 9;
    $aux_esc_2 = 9;
    $aux_esc_3 = 9;

    $personas_esc_1="";
    $personas_esc_2="";
    $personas_esc_3="";



   // require_once '../pages/backend/crea_caracterizacion_modelo.php';

    while($res=$consulta1->fetch_assoc()){
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $res["nombre"])
        ->setCellValue('B'.$i, $res["tipo_dispo"])
        ->setCellValue('C'.$i, $res["ip"])
        ->setCellValue('D'.$i, $res["servicio_negocio"])
        ->setCellValue('E'.$i, $res["servicio_administrado"])
        ->setCellValue('F'.$i, $res["tipo_servicio"])
        ->setCellValue('H'.$i, $res["val_war"])
        ->setCellValue('I'.$i, $res["val_cri"])
        ->setCellValue('J'.$i, $res["tipo_umbral"])
        ->setCellValue('K'.$i, $res["horario"])
        ->setCellValue('L'.$i, $res["accion_critico"]);

        $id_detalles=$res["id_detalle"];
        $id_serv=$res["id_tipo_servicio"];
        $id_ci=$res["id"];



        $objPHPExcel->getActiveSheet()->getStyle("M")->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle("N")->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle("O")->getAlignment()->setWrapText(true);


                $consulta_escala_1=$conexion->conexion->query("SELECT b.nombre, b.celular, b.correo FROM
        (SELECT distinct (b.id_persona),a.id_tipo_servicio,a.id_detalle FROM detalle_servicio
        a,escalamiento b where a.id_detalle=b.id_detalle and a.id_host='$id_ci' and b.nivel_escala = '1' order by a.id_detalle)a,
        new_personas b,tipo_servicios c where a.id_persona=b.cedula and a.id_detalle='$id_detalles'
        and a.id_tipo_servicio=c.id order by a.id_detalle;");

                $consulta_escala_2=$conexion->conexion->query("SELECT b.nombre, b.celular, b.correo FROM
        (SELECT distinct (b.id_persona),a.id_tipo_servicio,a.id_detalle FROM detalle_servicio
        a,escalamiento b where a.id_detalle=b.id_detalle and a.id_host='$id_ci' and b.nivel_escala = '2' order by a.id_detalle)a,
        new_personas b,tipo_servicios c where a.id_persona=b.cedula and a.id_detalle='$id_detalles'
        and a.id_tipo_servicio=c.id order by a.id_detalle;");

                $consulta_escala_3=$conexion->conexion->query("SELECT b.nombre, b.celular, b.correo FROM
        (SELECT distinct (b.id_persona),a.id_tipo_servicio,a.id_detalle FROM detalle_servicio
        a,escalamiento b where a.id_detalle=b.id_detalle and a.id_host='$id_ci' and b.nivel_escala = '3' order by a.id_detalle)a,
        new_personas b,tipo_servicios c where a.id_persona=b.cedula and a.id_detalle='$id_detalles'
        and a.id_tipo_servicio=c.id order by a.id_detalle;");



     while($escala_1=$consulta_escala_1->fetch_assoc()){

                $personas_esc_1=$personas_esc_1.$escala_1["nombre"].": ".$escala_1["celular"].", ".$escala_1["correo"]."\r";

        }

        if($personas_esc_1 == ""){
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("M$aux_esc_1","No diligenciado");

            $objPHPExcel->getActiveSheet()->getStyle("M$aux_esc_1")->applyFromArray($colorfontescala);

        }else{
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("M$aux_esc_1",$personas_esc_1);
        }

        while($escala_2=$consulta_escala_2->fetch_assoc()){


            $personas_esc_2=$personas_esc_2.$escala_2["nombre"].": ".$escala_2["celular"].", ".$escala_2["correo"]."\r";

        }


        if($personas_esc_2 == ""){
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("N$aux_esc_2","No diligenciado");

            $objPHPExcel->getActiveSheet()->getStyle("N$aux_esc_2")->applyFromArray($colorfontescala);

        }else{
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("N$aux_esc_2",$personas_esc_2);

        }




        while($escala_3=$consulta_escala_3->fetch_assoc()){

            $personas_esc_3=$personas_esc_3.$escala_3["nombre"].": ".$escala_3["celular"].", ".$escala_3["correo"]."\r";

        }


        if($personas_esc_3 == ""){
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("O$aux_esc_3","No diligenciado");

            $objPHPExcel->getActiveSheet()->getStyle("O$aux_esc_3")->applyFromArray($colorfontescala);

        }else{
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("O$aux_esc_3",$personas_esc_3);

        }



        $i++;
        $aux_esc_1=$aux_esc_1+1;
        $aux_esc_2=$aux_esc_2+1;
        $aux_esc_3=$aux_esc_3+1;

        $personas_esc_1="";
        $personas_esc_2="";
        $personas_esc_3="";

        //$aux_esc_2=$aux_esc_1+1;
        //$aux_esc_3=$aux_esc_1+1;

}





    while ($res1 = $consulta2->fetch_assoc()) {
      $Z = $res1["id"];
      $aux=$Y+$Z;
      $auxres=$aux-1;
      $objPHPExcel->setActiveSheetIndex(0)
      ->mergeCells("A$Y:A$auxres")
      ->mergeCells("B$Y:B$auxres")
      ->mergeCells("C$Y:C$auxres")
      ->mergeCells("D$Y:D$auxres")
      ->mergeCells("E$Y:E$auxres");
      $objPHPExcel->getActiveSheet()->getStyle("A$Y:E$auxres")->applyFromArray($aliniarCell);
      $objPHPExcel->getActiveSheet()->getStyle("A$Y:E$auxres")->getAlignment()->setWrapText(true);
      $Y = $aux;

    }

    //$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);

    $objPHPExcel->getActiveSheet()->getStyle('A'.$objPHPExcel->getActiveSheet()->getHighestRow())
    ->getAlignment()->setWrapText(true);

    //$objPHPExcel -> getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("I")->setAutoSize(true);

    $objPHPExcel -> getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("K")->setAutoSize(true);

    $objPHPExcel -> getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
    $objPHPExcel -> getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);




    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Caracterización');


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename='Modelo de eventos y Caracterizacion $contrato.xls'");
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0



    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    ob_end_clean(); ob_start(); $objWriter->save('php://output');
    $objWriter->save('php://output');
    exit;
