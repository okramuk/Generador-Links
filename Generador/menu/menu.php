<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Rico 2.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base target="content">

<script src="../src/rico.js" type="text/javascript"></script>
<script type='text/javascript'>
Rico.loadModule('Accordion','Corner');

var acc;
Rico.onLoad( function() {
  $('RicoVersion').innerHTML=Rico.Version;
  $('ProtoVersion').innerHTML=Prototype.Version;
  Rico.Corner.round('menuheader');
  acc=new Rico.Accordion( '.accordionTabTitleBar', '.accordionTabContentBox', {panelHeight:100} );
  WinResize();
  setTimeout(function() {Event.observe(top, "resize", WinResize, false);},100);
});

function CalcAccHt() {
  var winht=RicoUtil.windowHeight();
  var txtht=$('accordion1').offsetTop;
  var titleht=acc.titles.length * acc.titles[0].offsetHeight;
  return Math.max(winht-txtht-titleht-30,60);
}

function WinResize(e) {
  acc.options.panelHeight=CalcAccHt();
  acc.initContent();
}

</script>

<style type="text/css">
html {
  padding: 10px;
}
body {
	font-family: Arial, Tahoma, Verdana;
	background: #4f4f4f;
	color: #fff;
	margin: 2px;
	overflow: hidden;
	margin-top: 2px;
	margin-bottom: 2px;
	margin-left: 2px;
}
div.top {
  margin: 6px 0px;
  padding-left: 5px;
  font-size: 11px;
}

#accordion1 {
  width: 99%;
}

div.selected, div.hover {
  background-color:#63699C;
  color:#FFFFFF;
  font-weight:bold;
  height: 22px;
  padding-left: 5px;
}

.accordionTabTitleBar {
  background-color:#6B79A5;
  color:#CED7EF;
  height: 22px;
  font-weight : normal;
  padding-left: 5px;
  padding-top: 5px;
  overflow: hidden;

  border-bottom:1px solid #182052;
  border-style:solid none;
  border-top:1px solid #BDC7E7;
  border-width:1px 0px;
  font-size:12px;
}

.accordionTabContentBox {
  font-size: 11px;
  padding-left: 5px;
  overflow: auto;
}

#menuheader {
  background-color: #1381d4;
  position: relative;
  width: 99%;
}

#menuheader p {
  padding: 1em;
  margin: 0px;
  font-weight: bold;
  font-size:11pt;
}

ul {
  margin:3px 0 0 0;
  padding: 0px;
}
ul li {
  background: url(../rico_borrar/documentos/client/images/phokus/blt-01.gif) no-repeat;  
  list-style: none;
  padding: 0 0 0 16px;
  margin: 4px 0;
  font-size: 11px;
}

a {
  color: #9999ff;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
div.subhead {
  font-weight: bold;
  margin-top:18px;
  margin-bottom:3px;
}
</style>
<!--[if lt IE 7]>
  <style type="text/css">
ul li {
   height: 1%;
}
 </style>
<![endif]-->
</head>


<body>


   <div id="menuheader">
<p>@GENERADOR LINKS<span id='RicoVersion'></span>
<br><span style="font-weight:normal;font-size:smaller;">Utilizando version: </span><span style="font-weight:normal;font-size:smaller;">
<span id='ProtoVersion'></span></span>
<br>Hola <?php echo $_SESSION["nombres"] . " " . $_SESSION['apellidos']?><span style="font-weight:normal;font-size:smaller;"></br>
<br><?php echo $_SESSION["tipo_usuario"]?> </span><span style="font-weight:normal;font-size:smaller;"></span></br>
</div>

<div class='top'>
<ul>
</ul>
</div>

<div id="accordion1"></div>

  <div class="accordionTabTitleBar">Información</div>
  <div id='overview' class="accordionTabContentBox">
<ul>
<li><a href='welcome.html' target='mainFrame' class='menu'>Bienvenido</a>
</ul>

</div>

<?php
if($_SESSION['codigoTipoUsuario'] == 1)
{
  ?>
  <div class="accordionTabTitleBar">Administración:</div>
  <div class="accordionTabContentBox" id="Accordion">
    <div class="subhead">
      <img src="../images/documento.jpg" width="50" height="50" alt="Documentos">
    </div><!-- fin subhead - Administracion -->

    <ul>
      <li><a href="../admin/crearUsuario.php" target='mainFrame' class="menu">Crear Usuarios</a></li>
       <li><a href="../admin/consultaUsuario.php" target='mainFrame' class="menu">Consultar Usuarios</a></li>
    </ul><!-- final ul - Administración -->

  </div><!-- fin Accordion - Administracion -->
  <?php
}
?>

<div class="accordionTabTitleBar">Opciones:</div>
<div class="accordionTabContentBox" id="admin">
  <div class="subhead">
    <IMG src='../images/Icono_usuario.jpg' width='50' height='50'>
  </div><!-- fin subhead - opciones -->

  <ul>
    <li><a href="../Forms/Generador/inicio.php" target='mainFrame' class="menu">Generador de Links</a></li>
    <li><a href="../Forms/Generador/consultar.php" target='mainFrame' class="menu">Consultar Links</a></li>
  </ul>
</div><!-- fin accordionTabContentBox - Opciones -->
 
  <div class="accordionTabTitleBar">Salir del sistema:</div>
  <div id='clave' class="accordionTabContentBox">
<div class='subhead'>
<IMG src='../images/llave.jpg' width='50' height='50'>
</div>

<p>
<p><a href="../clases/logout.php" target="_parent" class="menu">Salir</a></p>

<p class="powered">Desarrollado por:</p>
<p class="powered">Gesti&oacute;n de Tecnolog&iacute;a</p>
<p class="powered">IEPS - 2014</p>
<p class="powered"><a href="mailto:marco.molina@ieps.gob.ec?cc=angelo.sigsi@ieps.gob.ec&subject=ACTORES" class="powered">marco.molina@ieps.gob.ec</a></p>
<p class="powered"><a href="mailto:angelo.sigsi@ieps.gob.ec?cc=marco.molina@ieps.gob.ec&subject=ACTORES" class="powered">angelo.sigsi@ieps.gob.ec</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</body></html>
