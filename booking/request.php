<?php
    session_start();

    if($_POST){
        //comenzando con la recopilación de todo
        $order=$_SESSION['ORDERREF'];    
        $destination=$_POST['d'];
        $travelclass=$_POST['tc'];
        $seats=$_POST['s'];
        $traveldate=$_POST['td'];
        //segunda pagina
        $fullname=$_POST['f'];
        $contact=$_POST['c'];
        $gender=$_POST['g'];
        //pago
        $amount=$_POST['a'];
        $code=$_POST['code'];
        $paymethod=$_POST['p'];
        //Pedir Referencia


        //PROCESAMIENTO DE LA RESERVA DE BILLETES
        $message="";    
        //comprobar el ID de la transacción recibida	
        require("../dbengine/dbconnect.php");

        //Validando ID de transacción # No estamos validando porque no tenemos una factura 
        $checkcode=mysqli_query($conn,"SELECT transaction_id FROM booking_details WHERE transaction_id='$code'");  
        if((!$checkcode) || (mysqli_num_rows($checkcode) >0)){    
            $message.="El código de transacción #$code Recibido ya se usó, ingrese un código válido que no se haya usado. ";     
        }    
        //Campos vacíos y dta vacío    
        if((empty($order)) || (empty($destination)) ||(empty($travelclass)) ||(empty($seats)) ||(empty($fullname)) ||(empty($amount)) ||(empty($code)) ||(empty($paymethod))){    
            $message.=" No se proporcionó uno de los campos obligatorios, vuelva a verificar las entradas y vuelva a intentarlo. ";     
        }      
	    
        //Número de referencia de redundancia   
        $checkcode=mysqli_query($conn,"SELECT order_ref FROM booking_details WHERE order_ref='$order'");  
        if((!$checkcode) || (mysqli_num_rows($checkcode) >0)){    
            $message.="La referencia de la orden #$order Recibida pertenece a otro cliente., Click <a href='index.php'>here</a> para generar otro. ";     
        }    

        //finalizando
        if(empty($message)){
            $insertdata=mysqli_query($conn,"INSERT into booking_details (order_ref,fullname,contact,gender,class_reserved,destination,seats_reserved,date_reserved,transaction_id,account,amount) VALUES('$order','$fullname','$contact','$gender','$travelclass','$destination','$seats','$traveldate','$code','$paymethod','$amount')");    
            if($insertdata){
                $message="éxito";
            }
            else{
                $message="¡No se pudieron publicar detalles ni actualizar el estado de la transacción!";
            }    
        }
        //finalmente
        echo $message;    
    }
?>
