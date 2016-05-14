<html>

<?php
	$carpeta = $_GET['carpeta'];
	$idioma = $_GET['idioma'];
	
	if(($con = ssh2_connect("pacifico.izt.uam.mx", 22))){
				if(ssh2_auth_password($con, "joshua", "Carlos-0816")){
					$sftp = ssh2_sftp($con);
					$x = "";
					if($idioma == "español"){
						$x = "/proyectos/NomissSec.php";
						$script1 = "rm -R ~/paginaWeb/NomissRes/$carpeta/";
						$stream = ssh2_exec($con, $script1);
						$script2 = "rm -R /var/www/html/paginaWeb/imgNomissSec/$carpeta/";
						$stream = ssh2_exec($con, $script2);	
						}
		 			elseif($idioma == "ingles"){
						$x = "/proyectos/NomissSecI.php";
						$script1 = "rm -R ~/paginaWeb/NomissRes/$carpeta/";
						$stream = ssh2_exec($con, $script1);
						$script2 = "rm -R /var/www/html/paginaWeb/imgNomissSec/$carpeta/";
						$stream = ssh2_exec($con, $script2);
							}
						elseif($idioma == "Vespañol"){
							$x = "/indexE.php";
							$script1 = "rm -R ~/visitas/$carpeta/";
							$stream = ssh2_exec($con, $script1);
							$script2 = "rm -R /var/www/html/visitas/$carpeta/";
							$stream = ssh2_exec($con, $script2);
							}
							elseif($idioma == "Vingles"){
								$x = "/indexI.php";
								$script1 = "rm -R ~/visitas/$carpeta/";
								$stream = ssh2_exec($con, $script1);
								$script2 = "rm -R /var/www/html/visitas/$carpeta/";
								$stream = ssh2_exec($con, $script2);
								}
					echo"
						<body onload=\"location = '$x'\">
						</body>					
					";	
				}
			}
?>


</html>
