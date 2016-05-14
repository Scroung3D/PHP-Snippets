<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Laboratorio de Sistemas Distribuidos</title>
	<link href="http://pacifico.izt.uam.mx/pacifico.png" type="image/x-icon" rel="shortcut icon" />
	<link href="/style.css" rel="stylesheet" type="text/css" />
</head>

   <?php
    
	$clave = uniqid();
        $lados = $_POST['lados'];
        $xms = $_POST['xms'];
        $xmb = $_POST['xmb'];  
        $sigma = $_POST['sigma'];
        
        if (!$lados || !$xms || !$xmb || !$sigma ||$xmb>$xms 
				|| filter_var($lados, FILTER_VALIDATE_INT) == false
                || filter_var($xms, FILTER_VALIDATE_INT) == false
                || filter_var($xmb, FILTER_VALIDATE_INT) == false
                || filter_var($sigma, FILTER_VALIDATE_INT) == false) {
			echo"
						<body> 
							<div id=\"topPan\">
								<p><h1>Distribuciones NOMISS SECUENCIAL</h1></p>
							
								<div id=\"topMenuPan\">									  			  
									<div id=\"topMenuMiddlePan\">
									</div> 
								</div>
							</div>

							<div id=\"bodyPan\">
							<p align = \"center\">
								<h2>La informacion ingresada no es correcta</h2><br><br>
								<input type=\"button\" value=\"Cerrar\" name=\"BotonCerrar\" onclick=\"window.close()\">
							</p>
							</div>
							";
                } 
		else {
			
			if(($con = ssh2_connect("pacifico.izt.uam.mx", 22))){
				if(ssh2_auth_password($con, "joshua", "Carlos-0816")){
					$sftp = ssh2_sftp($con);
					
					ssh2_sftp_mkdir($sftp, "/home/alumnos/joshua/paginaWeb/NomissRes/$clave");
					ssh2_sftp_mkdir($sftp, "/var/www/html/paginaWeb/imgNomissSec/$clave");								

					$fp = fopen("ssh2.sftp://$sftp/home/alumnos/joshua/paginaWeb/NomissRes/$clave/documento.txt",'w');
						if (!$fp) {
							echo "<p>Imposible  abrir el archivo remoto para escritura docu.\n";
                            exit;
                            }
                        fwrite($fp, $lados . PHP_EOL);
                        fwrite($fp, $xms . PHP_EOL);
                        fwrite($fp, $xmb . PHP_EOL);
                        fwrite($fp, $sigma . PHP_EOL);
                        fclose($fp);
                                
					$fp = fopen("ssh2.sftp://$sftp/home/alumnos/joshua/paginaWeb/NomissRes/$clave/script1.sh",'w');
						if (!$fp) {
							echo "<p>Imposible  abrir el archivo remoto para escritura.\n";
                            exit;
                            }
						$nombre = $clave."/traslape_L".$lados."_xmb".$xmb."_xms".$xms."_s$sigma";
                        fwrite($fp, "cp ~/paginaWeb/nomissSec/traslape ~/paginaWeb/NomissRes/$clave/" . PHP_EOL);
                        fwrite($fp, "ssh pacifico9 'sh ~/paginaWeb/NomissRes/$clave/script2.sh'". PHP_EOL);
                        fwrite($fp, "cp ~/paginaWeb/NomissRes/$nombre.png /var/www/html/paginaWeb/imgNomissSec/".$clave."/" . PHP_EOL);
                        fwrite($fp, "exit" . PHP_EOL);
                        fclose($fp);
                                
					$fp = fopen("ssh2.sftp://$sftp/home/alumnos/joshua/paginaWeb/NomissRes/$clave/script2.sh",'w');
                        if (!$fp) {
							echo "<p>Imposible  abrir el archivo remoto para escritura.\n";
                            exit;
                            }
						fwrite($fp, "cd /home/alumnos/joshua/paginaWeb/NomissRes/$clave/". PHP_EOL);
                        fwrite($fp, "./traslape $clave" . PHP_EOL);
						fwrite($fp, "exit" . PHP_EOL);
                        fclose($fp);
					$script = "sh ~/paginaWeb/NomissRes/$clave/script1.sh";
					$stream = ssh2_exec($con, $script);
					if(!$stream)
						echo "fallo el script";
					else{        
						echo" 
							<body> 
								<div id=\"topPan\">
									<p><h1>Distribuciones NOMISS SECUENCIAL</h1></p>
									
									<div id=\"topMenuPan\">									  			  
										<div id=\"topMenuMiddlePan\">
												<h2>	
												L = $lados	||
												xms = $xms	||
												xmb = $xmb	||
												sigma = $sigma	
												</h2>
										</div> 
									</div>
								</div>
								
								<p align = \"center\">
									<img src=\"/paginaWeb/imgNomissSec/$nombre.png\" width=\"450\" height=\"350\"/><br><br><br>
									<input type=\"button\" value=\"Continuar\" name=\"BotonContinuar\" onclick= \"opener.location ='cargando.php?carpeta=$clave&lados=$lados&xms=$xms&xmb=$xmb&sigma=$sigma', window.close()\"/>
									<input type=\"button\" value=\"Cancelar\" name=\"BotonCancelar\" onclick=\"opener.location ='/eliminar.php?carpeta=$clave&idioma=español', window.close()\">
								</p>";
							# echo "realize el script";
							}

					}else
						echo"fallo la conexion";					
			}
		}
				
	?>
	
	
	
</body>
</html>


