<?php
//$db= new PDO('mysql:host=localhost;dbname=utzdb_complet','root','danilosolos');
//
//$regusuario = $_POST['regusuario'];
//
//$dbquery = $db->prepare("SELECT count(utz_idusuario) as id FROM utz_usuario WHERE utz_usuario like :regusuario");
//
//$dbquery->execute(array(':regusuario'=>$regusuario));
//
//	$data = $dbquery->fetchAll(PDO::FETCH_ASSOC);
//
//$contar = $dbquery->rowCount();
//              
//            if($contar!=0){
//                  echo "Puede usar este usuario '<b>".$regusuario."</b>'.";
//            }else{
//            	 echo "Usuario Disponible".$data;
//              };
//
?>
<?php
  
      $buscar = $_POST['regusuario'];
        
      if(!empty($buscar)) {
            buscar($buscar);
      }
        
      function buscar($regusuario) {
            $con = mysql_connect('localhost','root', 'danilosolos');
            mysql_select_db('utzdb_complet', $con);
        
            $sql = mysql_query("SELECT * FROM utz_usuario WHERE utz_usuario like '".$regusuario."' LIMIT 10" ,$con);
              
            $contar = mysql_num_rows($sql);
              
            if($contar == 0){
                  echo "<div class='label label-success'> Usuario '<b>".$regusuario."</b>' disponible. </div><br /> ";
                  return false;
            }else{
             // while($row=mysql_fetch_array($sql)){
             //   $nombre = $row['nombre'];
            //    $prefijo = $row['prefijo'];
             //   $continente = $row['continente'];
                echo "<div class='label label-danger'> El usuario <b>".$regusuario. "</b> no esta disponible </div><br /> <script > document.getElementById('regusuario').value=''; </script>";
                return true;
           // }
        }
  }
        
?>