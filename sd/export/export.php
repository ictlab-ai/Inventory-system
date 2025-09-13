<?php

$host="localhost:3306";
$user="ictlabkz_qr";
$pass="!SherLock2023";
$dbnm="ictlabkz_qr";

$connection=mysqli_connect($host,$user,$pass,$dbnm);

session_start(); $name = $_SESSION['nameus'];

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT 
 				equipment.thing,
				equipment.inventnum,
				equipment.inventnumcheck,
				equipment.login,
				usersinfo.login,
				usersinfo.fullname,
				usersinfo.location 
 		  FROM `equipment`,`usersinfo` WHERE `equipment`.`login` = '$name' AND `equipment`.`login` = `usersinfo`.`login`";
 $result = mysqli_query($connection, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Название ОС</th>  
                         <th>Инвентарный номер</th>  
                         <th>Проверка наличия</th>  
						 <th>Имя пользователя</th>  
						 <th>Расположение</th> 
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["thing"].'</td>  
                         <td>'.$row["inventnum"].'</td>  
                         <td>'.$row["inventnumcheck"].'</td>  
       					 <td>'.$row["fullname"].'</td>  
						 <td>'.$row["location"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$name.'_инвентаризация.xls');
  echo $output;
 }
}

?>