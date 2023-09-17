<?
// EL CODIGO ENTRE /* y */ ES TRATADO COMO TEXTO
//error_reporting(E_ALL | E_STRICT |  E_WARNING | E_PARSE );  //manejador de Errores para depuracion
//ini_set('display_errors', true);  //manejador de Errores para depuracion

if(isset($_POST["nombre"])   && isset($_POST["emailForm"]) && isset($_POST["telefono"]) && isset($_POST["barrio"]) && isset($_POST["desde"]) && isset($_POST["hasta"])  && isset($_POST["machos"])
&& isset($_POST["hembras"]) && isset($_POST["palabras"])){

//IMPORTANTE Tener presente que el nombre que se pasa y recoge el Php es el name y no el Id en el caso exclusivo ce los CheckBox
  if (isset($_POST["chkbox1"])){
        $castrados1=true;
  }else{
      $castrados1=false;
  }
  if (isset($_POST["chkbox2"])){
      $castrados2=true;
  }else{
      $castrados2=false;
  }

  if(($castrados1===true) && ($castrados2===false)){ // El primero castrado (true) y el segundo  false  hace que solo hay  CASTRADOS
     $castrados='<font color="#2cd50e">'."Todos castrados"."<BR>";
  }else{
    if(($castrados1===true) && ($castrados2===true)){ //  los dos son true (Chequeados) (o sea hay castrados y sin castrar)
     $castrados='<font color="#B18904">'."Uno/s Si otro/s NO"."<BR>";
    }else{ //solo resta que sean todos sin castrar ya que la otra opcion (de que no haya ninguno seleccionado) no es posible porque lo valida el formulario de carga
     $castrados='<font color="#FF0000">'."Ninguno Castrado"."<BR>";
    }
  }
//  echo '<script language="javascript">';
//  echo 'alert("OK entramos en el Isset")';
  //echo 'alert("'.$castrados.'")';
//  echo '</script>';
//  exit();
	$hasta=date_format(new DateTime($_POST["hasta"]) ,"d/m/Y");
	$desde=date_format(new DateTime($_POST["desde"]) ,"d/m/Y");
  $fecha = date("d-M-y H:i");
  $arroba="@";
	$servo="gmail.com";
	$mymail="dormigato".$arroba.$servo;
            $header = "From:".$_POST["emailForm"]."\nReply-To:".$_POST["emailForm"]."\n";
            $header .= "X-Mailer:PHP/".phpversion()."\n";
            $header .= "Mime-Version: 1.0\n";
            $header .= "Content-Type: text/html; charset=iso-8859-1"; // otra opcion es : text/plain ; ;  text/xml; charset=UTF8; charset="windows-1256"
  $subject="Consulta de ".$_POST["nombre"];
	          $contenido  =   "<html>"."<BR>" ;
            $contenido .=  "<head>"."<BR>" ;
	          $contenido .=  "</head>"."<BR>" ;
	          $contenido .=  "<body>"."<BR>" ;
	          $contenido .='<table border="2" width="100%" style="border: 2px outset #808080" bordercolor="#3366FF" id="table1" bgcolor="#E8E8E8" bordercolorlight="#808080" bordercolordark="#000000"> <tr><td>';
            $contenido .="<b>". "Mensaje escrito el ".$fecha."</b>"."<BR>" ;
            $contenido .="Remitente:" .$_POST["nombre"]."<BR>";
            $contenido .="Telefono  :" .$_POST["telefono"]."<BR>";
            $contenido .="Barrio      :" .$_POST["barrio"]."<BR>";
            $contenido .="Email      :" .$_POST["emailForm"]."<BR>";
            $contenido .= "<b><u>Alojamiento </u></b>"."<BR>";
            $contenido .= "   Desde: " .$desde." Hasta: ".$hasta."<BR>";
            $contenido .= "  Machos: " .$_POST["machos"]."   Hembras: " .$_POST["hembras"]."<BR>";
            $contenido .= "   Castrados: ".$castrados."<BR>";
            $contenido .='<font color="#000000">'."Mensaje:".'<font color="#000066">'.$_POST["palabras"]."</font>"."<BR></tr></td></table>";
	          $contenido .=  "</body>"."<BR>" ;
	          $contenido .=  "</Html>"."<BR>" ;
    $respuesta= mail($mymail, $subject, utf8_decode($contenido) ,$header);
    if(!$resupuesta) { //Si la respuesta no es True
      echo '<script language="javascript">';
      echo 'alert("Error del sistema.No se envio el email")';
      echo '</script>';
      exit();
    }
 //Respuesta Automatica de cortesia -----------------------------------
$codigohtml = '
<html>
    <head>
    </head>
    <body>
	<p><font color="#0033CC" face="Arial Black"> Gracias por contactarnos. </p>
	<p><font color="#0033CC" face="Arial Black"> Tan pronto podamos le responderemos. </p>
        <a><img border="0" src="http://www.dormigato.com.ar/dormigatonewazul.png"  width="97" height="144"></a>
        <p><font color="#0033CC" face="Arial Black">Hotel DormiGato</font></p>
    </body>
 </html>
';

$asunto = "Respuesta Automatica - Dormigato";
$cabeceras = "Content-type: text/html\r\n";
$cabeceras .= "From:".$mymail;
$respuesta2=mail($_POST["emailForm"],$asunto,$codigohtml,$cabeceras);
if(!$respuesta2) {  // Si la respuesta No es true
  echo '<script language="javascript">';
  echo 'alert("Error en el envio de Email de cortesia. \n El email de consulta fue enviado correctamente")';
  echo '</script>';
  exit();
}

echo '<script language="javascript">document.getElementById("loader").style.visibility="hidden";</script>';
header("Location:returnFromPHP_prueba.html");
}else{
  //Si ocurre algun Error cualesquiera que fuese
  echo '<script language="javascript">';
  echo 'alert("Error inesperado , El Email NO fue enviado")';
  echo '</script>';
  exit();
}
?>
