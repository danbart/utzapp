<?php
session_start();
    $logusuario = $_POST['logusuario'];
    $logpassword = $_POST['logpassword'];

     
        
      if(!empty($logusuario) && !empty($logpassword)) {
            buscar($logusuario, $logpassword);
      }

 function buscar($logusuario, $logpassword) {
  $response = array(
    "result"  => false,
    "mensaje" => "No fue posible ejecutar la petición",
    "datos"   => ""
  );
      
      //$db = new PDO('mysql:host=localhost;dbname=utzdb_complet','root','danilosolos');
      $db = new PDO('mysql:host=mysql.hostinger.es;dbname=u265929643_utzap','u265929643_danil', 'dansrodas');
            //
            // $regupasmd5 = md5($logpassword);
            //
            $dbquery = $db->prepare("SELECT * FROM utz_usuario WHERE utz_usuario like :logusuario and utz_password like :logpassword LIMIT 1");
            //
            $dbquery->execute(array(':logusuario'=>$logusuario, ':logpassword'=>$logpassword));
            //
            	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
            //
            $contar = $dbquery->rowCount();

            if($contar != 0){
              $_SESSION["user"]["userlog"]=$data['utz_usuario'];
              $_SESSION["user"]["useradmin"]=$data['utz_adminitrador'];
              $_SESSION["user"]["iduserlog"]=$data['utz_idusuario'];
                 echo "<p class='label label-success'> Usuario '<b>".$data['utz_usuario']."</b>' Logeado. </p><br /><script > window.location='/'; </script> ";
                  return true;
            }else{
                echo "<p class='label label-danger'> Usuario o Contraseña incorrectos. Intente nuevamente o <a href='/registro'>Registrate</a></p><br /> <script> document.getElementById('logpassword').value=''; </script>";
                return false;
            }

            //echo json_encode($response);
      }
?>