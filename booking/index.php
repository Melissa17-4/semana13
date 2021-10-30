<?php  session_start()?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generando orden</title>

    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <script src="semantic/jquery.min.js"> </script>
    <script src="semantic/semantic.min.js"></script>
    <script src="order_validate.js"></script>

    <style>
      body{
        background-color:#f2acac;
      }
      a{
	      cursor:pointer;
      }
    </style>
  </head>
  <body>
    <div class="ui inverted huge borderless fixed fluid menu">
      <a class="header item">SISTEMA DE RESERVAS DE TICKETS DE VIAJE</a>
    </div><br>
    <div class="ui text container" style="margin-top:90px">
      <div id="err001" class="ui icon small attached message">
        <i class="notched circle loading icon"></i>
        <div class="content">
          <div class="header">Generando orden ...</div>
          <p>Solicitud de pedido Ref .. sólo un segundo.</p>
          <div id="proceed"></div>
        </div>  
      </div>
      <div class="ui attached bottom message">
        <div class="ui horizontal divider"></div>
        <form onsubmit="return ordval(this)">
          
        </form>
      </div>
    </div>
    <?php
      function generate_order(){
        //Estas son solo letras aleatorias que forman un ID de transacción
        $order_ref="";
        $char=array('O','T','R','S','A','C','B','E');
        $num=rand(11,99);
        $num2=rand(12,89);
        $num3=rand(13,92);
        shuffle($char);
        //Ahora el final
        $order_ref=$char[0].$char[3].$num.$char[1].$num2.$char[2].$num3.$char[4];
        //Asignación al usuario
        $_SESSION['ORDERREF']=$order_ref;
      }
      generate_order();
    ?>  
    <script>
      setTimeout(function(){
        document.getElementById("proceed").innerHTML="<a href='booking.php' class='ui button small green'>¡Hecho! Continuar</a> <a href='../admin/login.php' class='ui button small orange'>Iniciar sesión de administrador</a> "
      },5000);
    </script>
  </body>
</html>