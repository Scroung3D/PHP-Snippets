
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Laboratorio de Sistemas Distribuidos</title>
	<link href="http://pacifico.izt.uam.mx/pacifico.png" type="image/x-icon" rel="shortcut icon" />
	<link href="/style.css" rel="stylesheet" type="text/css" />
	<!--codigo para crear slider -->
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	  <link rel="stylesheet" href="/resources/demos/style.css" />
	  <script>
	   <!-- Función que actualiza valor, cota inferior y cota superior del slider XMB -->
	   function patoPato (){
			var valorXms = $( "#deslizador_xms" ).slider( "value" ),
			valorSigma = $( "#deslizador_sigma" ).slider( "value" ),
			valorInferior = valorXms - 3*valorSigma -1,
			valorSuperior = valorXms - 1;
			$( "#deslizador_xmb" ).slider( "option", "value", (valorInferior)*0.5 + (valorSuperior)*0.5 );
			$( "#deslizador_xmb" ).slider( "option", "max", valorSuperior );
			$( "#deslizador_xmb" ).slider( "option", "min", valorInferior );
			$( "#xmbval" ).val( $( "#deslizador_xmb" ).slider( "value" ) );
	   }
	   $(document).ready(function(){
		<!-- deslizador del campo xms -->
			  $(function (){ 
					  $( "#deslizador_xms" ).slider({                               
							  range: "min",

							  min: 28,
							  max: 80,
							  value: 55,
							  change: patoPato,
							  slide: function( event, ui ) {
									$( "#xmsval" ).val( ui.value );
							  }
							});
							$( "#xmsval" ).val( $( "#deslizador_xms" ).slider( "value" ) );
					  });
		<!-- deslizador de sigma -->
			  $(function () {
					  $( "#deslizador_sigma" ).slider({                               
							  range: "min",

							  min: 3,
							  max: 9,
							  value:6,
							  change: patoPato,
							  slide: function( event, ui ) {
									$( "#sigmaval" ).val( ui.value );
							  }
							});
							$( "#sigmaval" ).val( $( "#deslizador_sigma" ).slider( "value" ) );
					  });
		
		<!-- deslizador de xmb -->
		  $(function () {
				  $( "#deslizador_xmb" ).slider({
				  range: "min",

				  min: 36,
				  max: 54,
				  value:45,

				  slide: function( event, ui ) {
					$( "#xmbval" ).val( ui.value );
				  }
				});
				$( "#xmbval" ).val( $( "#deslizador_xmb" ).slider( "value" ) );
		});
	});

	$(document).ready(function() {
		$('#formulario').submit(function() {
			window.open('', 'formpopup', 'scrollbars=0,resizable=0,width=900,height=650,left=0,top=0');
			this.target = 'formpopup';
		});
		
	});
	
	</script>


	<noscript>Tu navegador no soporta Javascript </noscript>
	<!-- Aqui termina el codigo del slider -->
</head>
<body >
	<div align ="right"><h2><a href="NomissSecI.php" >English</a></h2></div>
<div id="topPan">
	<p><h1>Simulacion NOMISS SECUENCIAL</h1></p>
  <div id="topContactPan">
  </div>
	<div id="topMenuPan">
	  
	  <div id="topMenuLeftPan"></div>
	  
	  <div id="topMenuMiddlePan">
	  	<ul>
			<li class="home"><a href="/indexE.php">Inicio</a></li>
			<li><a href="#">Contacto</a></li>
			<li><a href="#">Cursos</a></li>
			<li><a href="#">Profesores</a></li>
			<li><a href="/proyectos/proyectos.php"><u>Proyectos</u></a></li>
				<li><a href="/visitas/visitas.php"> Visitas</a></li>
			<div id="topMenuRightPan"></div>
		</ul>
	  </div> 
	</div>
</div>
<div id = "topMenuSec">
<h3>Correr Simulaciones: </h3>
<br/>
	<div id="topMenuMiddlePan">
	  	<ul>
	  		<li><a href="Nomiss.php">Regresar</a></li>
			<li><a href="NomissPar.php">NomissPar</a></li>
			<div id="topMenuRightPan"></div>
		</ul>
	  </div>
</div>


<div id="bodyPan">

  <div id="bodyLeftPan">

  	<p style = "font-size:20px"><span>Algoritmo NOMISS Secuencial</span></p>
	<p >Este algoritmo ejecuta la aplicacion de generacion de redes porosas.</p>
	<p>Datos Necesarios:</p><br/>
 	
	<p><span>No. de Sitios en Arista (L)</span> Numero de sitios por lado en la arista.
			El valor debe ser mayor a 0 y menor a 200.</p><br/>        
	
	<p><span>Tamaño Medio de Sitios (xms)</span> Este dato corresponde a  la media de todos los valores 				que pueden tomar cada uno de los sitios.</p><br/>
		
	<p><span>Tamaño Medio de Enlaces (xmb)</span> Este campo corresponde a la media de los tamaños de los 				enlaces. El valor debe ser menor a xms.</p><br/>
		
	<p><span>Sigma (sigma)</span> El valor de esta variable hace referencia a la correlación que hay entre                   tamaños, sitios y enlaces.</p><br/>
	</div>
	
</div>

<div id="bodyRightPan">
  
  	<h2><span>Datos</span></h2>
  	<FORM id="formulario"  ACTION="distribuciones.php" METHOD="post">
		
		<p> L: <input type="text" id ="lados" name="lados" size="10" value=""> </p>

                <p><label for="xmsval">Elige un valor para xms:</label></p>
                <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="text" name="xms" id="xmsval" size="3" style="border: 0; color: #000000; background:#f3f3f3; left:50px;" /></p>
                <p><div id="deslizador_xms" style="position:relative;left:30px;width:135px;"></div> </p>

				<p><label for="xmbval">Elige un valor para xmb:</label></p>
				<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<input type="text" name="xmb" id="xmbval" size="3" style="border: 0; color: #000000; background:#f3f3f3; left:50px;" /></p>
				<p><div id="deslizador_xmb" style="position:relative;left:30px;width:135px;" ></div> </p>
				
				<p><label for="sigmaval">Elige un valor para sigma:</label></p>
                <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="text" name="sigma" id="sigmaval" size="3" style="border: 0; color: #000000; background:#f3f3f3; left:50px;" /></p>
                <p><div id="deslizador_sigma" style="position:relative;left:30px;width:135px;"></div> </p>

  		<br/>
  		<br/>
  		&nbsp&nbsp&nbsp <input type="submit" value="Generar Red" name="enviarBtn" > 
  	</FORM>
</div>
</div>


<div id="footermainPan">
  <div id="footerPan">
  	<ul>
		<li><a href="/indexE.php">Inicio</a>| </li>
		<li><a href="#">Contacto</a>| </li>
		<li><a href="#">Cursos</a>| </li>
		<li><a href="#">Profesores</a>| </li>
		<li><a href="/proyectos/proyectos.php">Proyectos</a>| </li>
		<li><a href="/visitas/visitas.php">Visitas</a>| </li>
	</ul>
	
  </div>
</div>

</body>

</html>
