<?php session_start()?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de reservas de tickets de viaje</title>

    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <script src="semantic/jquery.min.js"> </script>
    <script src="semantic/semantic.min.js"></script>
    <link href="semantic/datepicker.css" rel="stylesheet" type="text/css">
    <script src="semantic/datepicker.js"></script>
    <script src="nav.js"></script>

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

    <div class="ui fluid container center aligned" style="cursor:pointer;margin-top:40px">
      <div class="ui unstackable tiny steps">
        <div class="step" onclick="booking()">
          <i class="plane icon"></i>
          <div class="content">
            <div class="title">Detalles de la reserva</div>
            <div class="description">Información de viajes y reservas</div>
          </div>
        </div>
        <div class="step disabled" onclick="contact()" id="contactbtn">
          <i class="truck icon"></i>
          <div class="content">
            <div class="title">Detalles</div>
            <div class="description">Información del contacto</div>
          </div>
        </div>
        <div class="disabled step" id="billingbtn" onclick="billing()">
          <i class="money icon"></i>
            <div class="content">
              <div class="title">Facturación</div>
              <div class="description">Pago y verificación</div>
            </div>
        </div>
        <div class="disabled step" onclick="confirmdetails()" id="confimationbtn">
          <i class="info icon"></i>
          <div class="content">
            <div class="title">Confirmar detalles</div>
            <div class="description">Verificar los detalles del pedido</div>
          </div>
        </div> 
        <div class="disabled step" id="finishbtn">
          <i class="info icon"></i>
          <div class="content">
            <div class="title">Terminar e imprimir</div>
            <div class="description">Impresión de ticket</div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div id="dynamic">
      <div class="ui container text" id="booking-page">
        <div class="ui attached message">
          <div class="header">Información de reserva</div>
          <div class="header">Ref. De pedido: 
            <span style="color:red;font-size:15px">
              <?php echo $_SESSION['ORDERREF']?> 
              </br> 
              <a href='index.php'>Cancelar orden</a>
            </span> 
          </div> 
          <p>Ingrese la información de reserva de viaje</p>
        </div>

        <form class="ui form attached fluid loading segment" onsubmit="return contact(this)">
          <div class="field">
            <label>Destino</label>
            <div class="field">
              <select required id="destination">
                <option value="" selected disabled>--Destino de viaje--</option>
                <option>Arequipa - Cuzco</option>
                <option>Arequipa - Tacna</option>
    	          <option>Arequipa - Lima</option>
    	          <option>Arequipa - Puno</option>
              </select>
            </div>   
          </div>
          <div class="field">  
            <label>Clase de viaje</label>
            <div class="field">
              <select name="gender" required id="travelclass">
                <option value="" selected disabled>--Clase de viaje--</option>
                <option>Viaje de clase alta</option>
                <option>Viaje de clase media</option>
	              <option>Viaje de clase baja</option>
	              <option>Viaje con necesidades especiales</option>
              </select>
            </div>   
          </div>
          <div class="two fields"> 
            <div class="field"> 
              <label>Numero de asientos</label>
              <input placeholder="Numero de asientos" type="number" id="seats" min="1" max="72"  value="1" required>
            </div> 
            <div class="field"> 
              <label>Fecha de viaje</label>
              <input type="text" readonly required id="traveldate" class="datepicker-here form-control" placeholder=" ">
            </div>  
          </div>
          <div style="text-align:center">
            <div>
              <label>Asegúrese de que todos los detalles se hayan completado correctamente</label>
            </div>
            <button class="ui green submit button">Enviar detalles</button>
          </div> 
        </form>
      </div>

      <div class="ui container text" id="contact-page" style="display:none">
        <div class="ui attached message">
          <div class="header">Ingrese sus datos de cliente </div>
          <div class="header">Ref. De pedido: 
            <span style="color:red;font-size:15px">
              <?php echo $_SESSION['ORDERREF']?> 
              </br>
              <a href='index.php'> Cancelar orden</a>
              </br> 
            </span> 
          </div>
          <p>Complete los campos requeridos</p>
        </div>
        <form class="ui form attached fluid loading segment" onsubmit="return billing(this)">
          <div class="field">
            <label>Nombre completo</label>
            <input placeholder="Nombre completo" type="text" id="fullname" required>
          </div>
      
          <div class="field">
            <label>Dirección de contacto / móvil o correo electrónico</label>
            <input placeholder="Dirección de contacto / móvil o correo electrónico" type="text" id="contact" required>
          </div>
      
          <div class="field">
            <label>Genero</label>
            <div class="field">
              <select name="gender" required id="gender">
                <option value="" selected disabled>--Elija el género--</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>   
          </div>
 
          <div style="text-align:center">
            <div>
              <label>Asegúrese de que todos los detalles se hayan completado correctamente</label>
            </div>
            <button class="ui green submit button">Enviar detalles</button>
          </div>
        </form>
      </div>

      <div class="ui container text" id="billing-page" style="display:none">
        <div class="ui attached message">
          <div class="header">Validar la información de pago</div>
          <div class="header">Order Ref: 
            <span style="color:red;font-size:15px">
              <?php echo $_SESSION['ORDERREF']?> 
              </br> 
              <a href='index.php'>Cancelar orden</a>
            </span> 
          </div> 
          <p>Ingrese los detalles del pago para continuar</p>
        </div>
        
        <form class="ui form attached fluid loading segment" onsubmit="return confirmdetails(this)">
          <div class="field"> 
            <label>Pago</label>  
            <select name="gender" required id="paymentmethod">
              <option value="" selected disabled>Forma de pago</option>
              <option value="Paypal">Paypal</option>
              <option value="PagoEfectivo">PagoEfectivo</option>
	            <option value="PayU">PayU</option>
            </select>
          </div> 
          <div class="field"> 
            <label>ID de transacción</label> 
            <div class="ui icon input">
              <input placeholder="Codigo de transacción" type="text" required id="codebox">
              <i class="payment icon"></i>
            </div>
          </div>
          <div class="field"> 
            <label>Confirmar cantidad</label>
            <div class="ui icon input">
              <input value="40.50" type="text" id="amount" readonly>
            </div>
          </div>
          <div style="text-align:center">
            <button class="ui green submit button">Continuar</button>
          </div>
        </form>
        
      </div>

      <div class="ui text container" id ="confirmdetails-page" style="display:none">
        <div class="ui positive message">
          <b>Antes de continuar, vuelva a verificar los siguientes detalles que proporcionó</b><br>
          <i>Es posible que el boleto no se vuelva a imprimir, por lo tanto, los detalles que proporcionó deben ser válidos</i>
          <br>
          <div class="ui horizontal divider">Los detalles proporcionados</div>
          <div id="details"></div>
          <div class="ui horizontal divider">Confirmar detalles</div>
          <div class="ui fluid container center aligned">
            <a class="ui button green" onclick="senddata()">SI</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>