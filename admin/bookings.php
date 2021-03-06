<?php require ("session.php")?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta content="Semantic-UI-Forest, collection of design, themes and templates for Semantic-UI." name="description" />
    <meta content="Semantic-UI, Theme, Design, Template" name="keywords" />
    <meta content="PPType" name="author" />
    <meta content="#ffffff" name="theme-color" />
    <title>Reservaciones</title>
    <link href="static/dist/semantic-ui/semantic.min.css" rel="stylesheet" type="text/css" />
    <link href="static/stylesheets/default.css" rel="stylesheet" type="text/css" />
    <link href="static/stylesheets/pandoc-code-highlight.css" rel="stylesheet" type="text/css" />
    <script src="static/dist/jquery/jquery.min.js"></script>
	  <script src="admin.js"></script>
  </head>
  <body>
    <div class="ui inverted huge borderless fixed fluid menu">
      <a class="header item">SISTEMA DE RESERVA DE TICKETS DE VIAJE</a>
      <div class="right menu">
        <div class="item">
          <div class="ui small input">
		        <form>
              <input placeholder="Buscar ..." name="search" /> 
			      </form>
          </div>
        </div>
        <a class="item" href="logout.php">Cerrar sesión</a>
      </div>
    </div>
	
    <div class="ui grid">
      <div class="row">
        <div class="column" id="sidebar">
          <div class="ui secondary vertical fluid menu">
            <a class="active item" href="bookings.php">Reservaciones</a>
            <a class="item" href="transactions.php">Transacciones</a>
            
            
          </div>
        </div>
        <div class="column" id="content" style="display:none">
	        <div class="ui grid">
            <div class="row">
              <h1 class="ui huge header">Todas las reservas</h1>
            </div>
            <div class="ui horizontal divider"> Detalles de las Reservas </div>      
	          
            <?php 
              //rejection
              if(isset($_GET['reject'])){
              $or=$_GET['reject'];
              require("../dbengine/dbconnect.php");
              if(mysqli_query($conn,"DELETE FROM booking_details WHERE order_ref='$or'")){
              echo ("<div class='ui positive message' style='margin:auto'>Pedido eliminado / rechazado con éxito #$or.</div>");	
              }	
              else{
              echo ("<div class='ui negative message' style='margin:auto'>¡Error! No se pudo procesar la solicitud de rechazo del pedido #$or ! </div>");	
              }	
              }
              //end of Php 
            ?>
		        <div class="row">
              <table class="ui single line striped selectable center aligned  table">
                <thead>
                  <tr>
                    <th>ID </th>
                    <th>Nombre del cliente</th>
                    <th>Contacto</th>
                    <th>Clase Elegida</th>
                    <th>Ruta</th>
                    <th># asientos</th>
                    <th>Fecha de viaje</th>
                    <th>Opción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require("../dbengine/dbconnect.php");
                    if(isset($_GET['search'])){
                      $search=$_GET['search'];$data=mysqli_query($conn,"SELECT * FROM booking_details WHERE order_ref LIKE '%$search%' or fullname LIKE '%$search%' or class_reserved LIKE '%$search%' or destination LIKE '%$search%' or date_reserved LIKE '%$search%'");
                    }
                    else{
                      $data=mysqli_query($conn,"SELECT * FROM booking_details");
                    }

                    if(($data) && (mysqli_num_rows($data) >0)){
                      //obteniendo datos y generando una fila
                      while($row=mysqli_fetch_assoc($data)){
                        $order=$row['order_ref'];
                        echo("<tr><td>".$row['order_ref']."</td><td>".$row['fullname']."</td><td>".$row['contact']."</td><td>".$row['class_reserved']."</td><td>".$row['destination']."</td><td>".$row['seats_reserved']."</td><td>".$row['date_reserved']."</td><td><a class='ui tiny button grease' href='bookings.php?reject=$order'>Eliminar</a></td></tr>");
                      }		
                    }
                    else{
                      echo "<tr><td colspan='9'>¡No se encontraron registros que coincidan! </td></tr>";	
                    }
                    mysqli_close($conn);
                  ?>
                </tbody>
              </table>
            </div>
			    </div>	
		    </div>
      </div>
    </div>
    <style type="text/css">
      body {
        display: relative;
      }
      #sidebar {
        position: fixed;
        top: 51.8px;
        left: 0;
        bottom: 0;
        width: 18%;
        background-color: #eee1f0;
        padding: 0px;
      }
      #sidebar .ui.menu {
        margin: 2em 0 0;
        font-size: 16px;
      }
      #sidebar .ui.menu > a.item {

        color: #d413ed;
        border-radius: 0 !important;
      }
      #sidebar .ui.menu > a.item.active {
        
        background-color: #d413ed;
        color: white;
        border: none !important;
      }
      #sidebar .ui.menu > a.item:hover {

        background-color: #ea95f5;
        color: white;
      }
      #content {
        margin-left: 19%;
        width: 81%;
        margin-top: 3em;
        padding-left: 3em;
        float: left;
      }
      #content > .ui.grid {
        padding-right: 4em;
        padding-bottom: 3em;
      }
      #content h1 {
        font-size: 36px;
      }
      #content .ui.divider:not(.hidden) {
        margin: 0;
      }
      #content table.ui.table {
        border: none;
      }
      #content table.ui.table thead th {
        border-bottom: 2px solid #eee !important;
      }
    </style>
  </body>
</html>
