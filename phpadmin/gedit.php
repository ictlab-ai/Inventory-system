<!DOCTYPE html>
<html>
<head>
	<title>Карточка основного средства</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<div id="side">
		<ul id="nav">
			<li><a href="a_admin.php">ГЛАВНАЯ</a></li>
			<li><a href="goods.php">ИМУЩЕСТВО</a></li>
			<li><a href="vo/vo.php">Аналитика</a></li>
			<li><a href="users.php">ПОЛЬЗОВАТЕЛИ</a></li>
			<li><a href="files.php">Файлы</a></li>
			<li><a href="qrgen/index.php">QR генератор</a></li>
			<li><a href="logout.php">ВЫйти</a></li>
		</ul>
	</div>
		
	<div id="content">
		
		<h2>Карточка основного средства</h2>

		<div id="fcon">
		<?php
			include 'connect.php'; session_start(); $goo = $_SESSION['ggg']; $num = $_SESSION['invent'];
			
			$gdata = mysqli_query($connection,"SELECT * FROM `equipment` WHERE `thing` = '$goo' AND `inventnum`='$num';");
			while ($ud=mysqli_fetch_assoc($gdata)) {
					echo "<img src='".'/php/'.$ud['image']."'>";
			}

		?>
		</div>
		
		<div id="scon">
		<?php
			echo "<form id='u' method='POST' enctype = 'multipart/form-data'>";
			echo "<fieldset id='fset'>";
			echo "<legend>Объект:".$goo." - ".$add."</legend>";
			
			$guser = mysqli_query($connection,"SELECT 	`equipment`.`thing`,`equipment`.`login`, `equipment`.`division`,
														`usersinfo`.`login`,`usersinfo`.`fullname`
														FROM `equipment`,`usersinfo` 
														WHERE `usersinfo`.`login` = `equipment`.`login` 
														AND `equipment`.`thing`='$goo'
														AND `equipment`.`inventnum` = '$num';");

			echo "<select id='txt'>";
				while ($userlist=mysqli_fetch_assoc($guser)) {
					echo "<option value='".$userlist['login']."'>".$userlist['fullname']."</option>";
				}
			echo "</select><br>";
			
			$gotouser = mysqli_query($connection,"SELECT DISTINCT `equipment`.`login`,`usersinfo`.`login`,
														`usersinfo`.`fullname`
														FROM `equipment`,`usersinfo` 
														WHERE `usersinfo`.`login` = `equipment`.`login`;");
			
			echo "<select id='txt' name='ulist'>";
				while ($userlist=mysqli_fetch_assoc($gotouser)) {
					echo "<option value='".$userlist['login']."'>".$userlist['fullname']."</option>";
				}
			echo "</select><br>";
			
			$gdata = mysqli_query($connection,"SELECT 	`equipment`.`id`,`equipment`.`thing`,`equipment`.`login`, `equipment`.`division`,
														`usersinfo`.`login`,`usersinfo`.`fullname`,`equipment`.`inventnum`
											FROM `equipment`,`usersinfo` 
											WHERE `usersinfo`.`login` = `equipment`.`login` 
											AND `equipment`.`thing`='$goo'
											AND `equipment`.`inventnum` = '$num';");
			
			while ($ud=mysqli_fetch_assoc($gdata)) {
					
					echo "<input name='thingid' id='txt' placeholder='ID' type='hidden' value='".$ud['id']."'>";

					echo "<input name='thing' id='txt' placeholder='Название' type='text' value='".$ud['thing']."'><br>";
					echo "<input name='inventnum' id='txt' placeholder='Инвентарный номер' type='text' value='".$ud['inventnum']."'><br>";
					echo "<input name='division' id='txt' placeholder='Расположение' type='text' value='".$ud['division']."'><br>";

					echo "<input type='file' name='file'><br>";
					echo "<input name='pub' id='sub' type='submit' value='ОБНОВИТЬ ДАННЫЕ'>";
					
			}
			
			echo "</form>";

			if (isset($_POST['pub'])) {
				
				$host="localhost:3306";
				$user="ictlabkz_qr";
				$pass="!SherLock2023";
				$dbnm="ictlabkz_qr";
				
				
				
				$tempname=$_POST['ulist'];
				
				// определение папки для пользователя с именем name для загрузки файлов (по умолчанию php/images/..)
				$dir='../php/images/'.$tempname; 
				
				if(!is_dir($dir)) {
					mkdir($dir, 0777, true); // создаем папку с именем пользователя если она не существовала
				} else {
				
				$thingid=$_POST['thingid'];
					$first=$_POST['thing'];
				$login=$_POST['ulist'];
				$second=$_POST['inventnum'];
				$divis=$_POST['division'];
					
				$upname=basename($_FILES['file']['name']);//записываем имя файла
				$uploadpath=$dir.'/'.$upname; // имя папки + имя файла
				
				//перемещение загруженного файла из временной папки сервера в папку, которую указали (uploadpath)

				if  (move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath)) {
				
				$sql=mysqli_query($connection,"UPDATE `equipment` 
									SET `login`='$login', `thing`='$first',`inventnum`='$second',`division`='$divis', `image`='$uploadpath' 
									WHERE `thing`='$goo' AND  `id`='$thingid';");
					} else {
				
					$sql=mysqli_query($connection,"UPDATE `equipment` 
									SET `login`='$login',`thing`='$first',`inventnum`='$second',`division`='$divis' 
									WHERE `thing`='$goo' AND  `id`='$thingid';");		
				
					}

				if ($sql) {
							header("Location:goods.php");
						}
				}

			}

		?>
		</div>
	
	</div>

</body>
</html>