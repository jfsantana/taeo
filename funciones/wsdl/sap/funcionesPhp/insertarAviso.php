<?php

//$n_personal='15258628';
$equipment = @$_REQUEST[ "equipment" ];   //HEADER['CUSTODIO]
$short_text = @$_REQUEST[ "short_text" ]; //
$reportedby = @$_REQUEST[ "reportedby" ]; // EL CREADOR
$notif_date = @$_REQUEST[ "notif_date" ];
$notiftime = @$_REQUEST[ "notiftime" ];
$long_text = @$_REQUEST[ "long_text" ];


$equipment = '1050318';
$short_text = 'prueba fran2';
$reportedby = 'fpuerta';
$notif_date = '2022-10-04';
$notiftime = '07:34:00';
$long_text = 'esto es una prueba2';



 notifica($equipment,$short_text,$reportedby,$notif_date,$notiftime,$long_text);


function notifica($equipment,$short_text,$reportedby,$notif_date,$notiftime,$long_text){
		error_reporting(0);	
        
    if ( file_exists( "../../public/plugins/nusoap/lib/nusoap.php" ) ) {
        require_once( "../../public/plugins/nusoap/lib/nusoap.php" );

      } else {
        require_once( "../../../../public/plugins/nusoap/lib/nusoap.php" );

      }
	
		
    
		
		$ruta =  $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sap/in/ZEHS_CREATE_NOTIF_Sync_OutService.wsdl";
    //echo $ruta; die;
		$oSoapClient = new nusoap_client($ruta, true);
		$oSoapClient->setCredentials('PIUSERWS01', 'Pequiven21*', 'basic');
		if ($sError = $oSoapClient->getError()) 
		{
   			echo "No se pudo realizar la operación [" . $sError . "]";
   			die();
		}
		// desencripto variables
		$RFC_funcion='ZEHS_CREATE_NOTIF_Sync_Out';
        
        $IM_NOTIFHEADER = array("EQUIPMENT"=>$equipment,"SHORT_TEXT"=>$short_text,
                             "REPORTEDBY"=>$reportedby,"NOTIF_DATE"=>$notif_date,
                             "NOTIFTIME"=>$notiftime,"LONG_TEXT"=>$long_text);
    
		$aParametros = array("IM_NOTIFHEADER"=>$IM_NOTIFHEADER);
    
   		$aRespuesta = $oSoapClient->call($RFC_funcion, $aParametros);
    
	if ($oSoapClient->fault) { // Si
      echo 'No se pudo completar la operación';
      die();
   	} 
	else 
	{ // No
      $sError = $oSoapClient->getError();
      // Hay algun error ?
      if ($sError) 
	  { // Si
         echo 'Error:' . $sError;
      }
	  else
		{				
			
         // print_r($aRespuesta);
          
            $NOTIF_NO= $aRespuesta ['EX_NOTIFHEADER'] ['NOTIF_NO'];
            $PLANPLANT= $aRespuesta['PLANPLANT'];
            $LOC_ACT= $aRespuesta['EX_NOTIFHEADER']['LOC_ACT']; 
            $EQUIPMENT= $aRespuesta['EX_NOTIFHEADER']['EQUIPMENT'];  
            $CREATED_ON= $aRespuesta['EX_NOTIFHEADER']['CREATED_ON'];  
          
            

            //echo $ICNUM;			
          $resultado[]= array('NOTIF_NO'=>$NOTIF_NO,'PLANPLANT'=>$PLANPLANT,'LOC_ACT'=>$LOC_ACT,'EQUIPMENT'=>$EQUIPMENT,'CREATED_ON'=>$CREATED_ON);
		  //print_r ($resultado);
          $json_string = json_encode($resultado);
          print("<pre>".print_r($resultado,true)."</pre>"); die;
		 //echo $json_string;          
      }
    }
}