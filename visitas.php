<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Laboratorio de Sistemas Distribuidos</title>
	<link href="http://pacifico.izt.uam.mx/pacifico.png" type="image/x-icon" rel="shortcut icon" />
	<link href="/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
		//hacemos la conexion para que se genere la grafica de visitas
			if(($con = ssh2_connect("pacifico.izt.uam.mx", 22))){
				if(ssh2_auth_password($con, "joshua", "Carlos-0816")){
					$sftp = ssh2_sftp($con);
					$clave = "V".uniqid();

					$ruta0 = "/home/alumnos/joshua/visitas";
					$ruta1 = "/var/www/html/visitas/";
					$ruta2 = "/home/alumnos/joshua/visitas/".$clave;
					$ruta3 = "/var/www/html/visitas/".$clave;
					ssh2_sftp_mkdir($sftp, "$ruta2");
					ssh2_sftp_mkdir($sftp, "$ruta3");
					$fp = fopen("ssh2.sftp://$sftp$ruta2/scriptVisitas.sh",'w');
						if (!$fp) {
							echo "<p>Imposible  abrir el archivo remoto para escritura.\n";
                            exit;
                            }
                        fwrite($fp, "cp $ruta0/visitas $ruta1/visitasNum.txt $ruta1/visitasPais.txt $ruta2/" . PHP_EOL);
                        fwrite($fp, "cp $ruta1/visitasNum.txt $ruta3/" . PHP_EOL);
                        fwrite($fp, "ssh pacifico9 'sh ~/visitas/$clave/script.sh'". PHP_EOL);
                        fwrite($fp, "convert $ruta2/visitas.png -rotate 90 $ruta2/visitas.png". PHP_EOL);
                        fwrite($fp, "cp  $ruta2/visitas.png $ruta3/" . PHP_EOL);
                        fwrite($fp, "exit" . PHP_EOL);
                        fclose($fp);
                        
                      $ln = count(file("visitasPais.txt"));//nuemero de paises*2
                        
					$fp = fopen("ssh2.sftp://$sftp$ruta2/script.sh",'w');
						if (!$fp){
							echo "<p>Imposible  abrir el archivo remoto para escritura.\n";
                            exit;
                            }
                        fwrite($fp, "cd $ruta2" . PHP_EOL);
                        fwrite($fp, "./visitas $ln" . PHP_EOL);
                        fwrite($fp, "exit" . PHP_EOL);
                        fclose($fp);
                        
					$script = "sh $ruta2/scriptVisitas.sh";
					$stream = ssh2_exec($con, $script);
					
					$archivo = "visitasNum.txt";
					$numVisitas = file_get_contents($archivo, "r");
					
					//obtenenos el tamaño de la imagen que se va a poner en la pagina 
					list($width, $height)=getimagesize("visitas/$clave/visitas.png");	
					echo "
								<body> 
									<div id=\"topPan\">
										<p><h1>VISITAS</h1></p>
										
										<div id=\"topMenuPan\">									  			  
											<div id=\"topMenuMiddlePan\">
													<h2>	
													Este Sitio ha tenido $numVisitas Visitas
													</h2>
											</div> 
										</div>
									</div>
									
									<p align = \"center\">
										<br><br>
										<img src=\"/visitas/$clave/visitas.png\"  height=\"$height\"  width=\"$width\"/><br><br><br>
										<input type=\"button\" value=\"Salir\" name=\"BotonSalir\" onclick=\"location ='/visitas/eliminar.php?carpeta=$clave&idioma=Vespañol'\">
									</p>";                        
					}
				}						 
	?>             
</body>
</html>
