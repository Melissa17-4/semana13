<?php session_start()?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link href="static/dist/semantic-ui/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="static/dist/jquery/jquery.min.js"></script>
	  <script src="admin.js"></script>
	  <style>
      body{
      background-color:#f2acac;
      }
    </style>
  </head>
  <body>
    <div class="ui inverted huge borderless fixed fluid menu">
      <a class="header item">SISTEMA DE RESERVA DE TICKETS DE VIAJE</a>
    </div><br>
	
    <div class="ui container" id="dynamic" style="margin-top:90px">
      <div class="ui text container">
        <div class="ui attached message">
          <div class="header">Panel de acceso del administrador</div>
          <?php
            if( (isset($_POST['username'])) && (isset($_POST['password'])) ){
              $username=$_POST['username'];
              $password=$_POST['password'];
              //validating no validation using admin admin as password	
              if(($username=="admin") && ($password=="password")){
            	  $_SESSION['username']=$username;
            	  header("location: bookings.php");
              }
              else{

                echo ("<p style='color:red;text-align:center'> Usuario o contraseña invalido</p>");	
              }	
            }
          ?> 
        </div>
        <form class="ui form attached fluid loading segment" method="POST">
          <input type="hidden" name="frmLogin" value="true">
          <div class="field">
            <label>Nombre de usuario</label>
            
            <input placeholder="Ingrese su nombre de usuario" name="username" type="text" autofocus required>   
          </div>
          <div class="field">
            <label>Contraseña</label>
            
            <input type="password" placeholder="Ingresa tu contraseña" name="password" required>
          </div>
          <div class="inline field">
            <div class="ui checkbox">
              <input type="checkbox" id="rememberPass">
              <label>Recordar Usuario</label>
            </div>
          </div>
          <div style="text-align:center">
            <input type="submit" name="login" class="ui blue submit button" tabindex=3 value="Acceder"> 
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
