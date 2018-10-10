<?php
    $buscar = $_POST['regusuario'];
        
      if(!empty($buscar)) {
            buscar($buscar);
      }

 function buscar($regusuario) {
      
      //$db = new PDO('mysql:host=localhost;dbname=utzdb_complet','root','danilosolos');
      $db = new PDO('mysql:host=mysql.hostinger.es;dbname=u265929643_utzap','u265929643_danil', 'dansrodas');
            //
            //$regusuario = $_POST['regusuario'];
            //
            $dbquery = $db->prepare("SELECT * FROM utz_usuario WHERE utz_usuario like :regusuario LIMIT 1");
            //
            $dbquery->execute(array(':regusuario'=>$regusuario));
            //
            	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
            //
            $contar = $dbquery->rowCount();

            if($contar == 0){
                  echo "<div class='label label-success'> Usuario '<b>".$regusuario."</b>' disponible. </div><br /> ";
                  return false;
            }else{
                echo "<div class='label label-danger'> El usuario <b>".$regusuario. "</b> no esta disponible </div><br /> <script > document.getElementById('regusuario').value=''; </script>";
                return true;
            }
      }
?>
<?php
  
   //   $buscar = $_POST['regusuario'];
        
   //   if(!empty($buscar)) {
   //         buscar($buscar);
   //   }

      //$con = mysqli_connect('mysql.hostinger.es','u265929643_danil', 'dansrodas');
       //     mysqli_select_db('dbname=u265929643_utzap', $con);
        
 //     function buscar($regusuario) {
 //           $con = mysql_connect('localhost','root', 'danilosolos');
 //           mysql_select_db('utzdb_complet', $con);
 //       
 //           $sql = mysql_query("SELECT * FROM utz_usuario WHERE utz_usuario like '".$regusuario."' LIMIT 10" ,$con);
 //             
 //          $contar = mysql_num_rows($sql);
  //            
  //          if($contar == 0){
  //                echo "<div class='label label-success'> Usuario '<b>".$regusuario."</b>' disponible. </div><br /> ";
  //                return false;
  //          }else{
  //              echo "<div class='label label-danger'> El usuario <b>".$regusuario. "</b> no esta disponible </div><br /> <script > //document.getElementById('regusuario').value=''; </script>";
  //              return true;
 //          // }
//        }
 // }if(response.result === true){
//                      alert('funciona');
//                      $("#validation").empty();
//                      $("#validation").html("<p class='label label-success'> Usuario Inicio Correctamente</p>");
//                      $("#validation").html(response.datos);
//                      return true;
//                    } else {
//                      alert('error al validar');
//                      $("#validation").empty();
 //                     $("#validation").html("<p class='label label-danger'> Usuario o Contraseña incorrectos. Intente nuevamente o <a href='/registro'>Registrate</a></p>");
 //                     return false;
 //                   }    
        
?>