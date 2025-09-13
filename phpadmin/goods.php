<!DOCTYPE html>
<html>
<head>
	<title>Управление основными средствами</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
		<h2>Управление основными средствами</h2>
		
		<?php
		
		include 'connect.php';
		
		if (!isset($_POST['sort'])) {
			
				$login = '%%';
			
			session_start();
			if (empty($_SESSION['nameus'])) {
				echo 'Доступ запрещен!';
				die;
			}
		
		echo "<table border='0'>";
		
		/*форма для импорта данных из Excel*/
		
		    echo "<tr>";
			    echo "<td>"; //форма для очистки проверки наличия
				echo "<form method='POST' action = 'erase/erase.php'>";
				echo "<input name='erase' id='sub' type='submit' value='ОБНУЛИТЬ'>";
				echo "</form><br>";
			echo "</td>";
			
			echo "<td>"; /*форма для экспорта всех данных*/
				echo "<form method='POST' action = 'export/export.php'>";
				echo "<input name='export' id='sub' type='submit' value='ЭКСПОРТ В EXCEL'>";
				echo "</form><br>";
			echo "</td>";
			
			echo "<td>"; /*форма для сортировки данных по логину*/
				echo "<form method='POST' action = ''>";
				echo "<select id = 'txt' name='insort'>&nbsp;&nbsp;&nbsp;";
				echo "<option selected disabled>Выберите пользователя</option>";
				$took0 = mysqli_query($connection,"SELECT `usersinfo`.`login`,`usersinfo`.`fullname` FROM `users`,`usersinfo` WHERE `users`.`login` = `usersinfo`.`login`;");
				while ($listofusers=mysqli_fetch_array($took0)) {
					echo "<option value = '".$listofusers['login']."'>".$listofusers['fullname']."</option>";				
				}
				echo "</select>";
			
				echo "&nbsp;<input name='sort' id='sub' type='submit' value='СОРТИРОВКА ПО ИМЕНИ'>";
				echo "</form><br>";
			echo "</td>";
		
			
		
			
		
			/*echo "<td>";
			//форма для проверки не прошедших инвентаризацию

				echo "<form method='POST' action = 'check/check.php'>";
						echo "<input name='check' id='sub' type='submit' value='ПРОВЕРКА'>";
				echo "</form><br>";

			echo "</td>";*/
		
		
			
		
		echo "</tr>";

		echo "</table>";
		
		//include 'connect.php';
		
		//mysqli_query($connection,"UPDATE `equipment` SET `checked` = 'checked' WHERE `inventnum` = `inventnumcheck`;");	
			
		$took1 = mysqli_query($connection,"SELECT * FROM `equipment`;");
				$countr1 = 0;
				while ($data=mysqli_fetch_array($took1)) {
					$countr1 = $countr1 + 1;				
				}
		
		$took2 = mysqli_query($connection,"SELECT * FROM `equipment` WHERE `checked` = 'checked' OR `inventnum` = `inventnumcheck`;");
				$countr2 = 0;
				while ($data=mysqli_fetch_array($took2)) {
					$countr2 = $countr2 + 1;				
				}
		
		echo "Общее количество основных средств в базе данных = ".$countr1.". Из них отсканированных = ".$countr2.".<br><br>";
		
		/*echo "<br>";
		
		echo "<td>"; форма для сортировки данных по подразделению
				echo "<form method='POST' action = ''>";
				echo "<input name='insort1' id='txt' type='text' placeholder='Введите название РТС'>&nbsp;";
				echo "<input name='sort1' id='sub' type='submit' value='СОРТИРОВКА ПО РТС'>";
				echo "</form><br>";
		echo "</td>";*/
			
		}
		
		?>
			
		
		<?php
		
		
		
		?>
		
			<?php
				
			
				
			if (!isset($_POST['sort'])) {
			
				$login = '%%';
			
			session_start();
			if (empty($_SESSION['nameus'])) {
				echo 'Доступ запрещен!';
				die;
			}
		
		/*вывод списка имущества в форме таблицы для просмотра*/
			
			echo "<table cellpadding='0' cellspacing='0' border='1' id='tbl'>";
			echo "<tr>";
			echo "<td>☑</td>";
			echo "<td>№ п/п</td>";
			echo "<td>Название</td>";
			echo "<td>Инвентарный номер</td>";
			echo "<td>Проверка наличия</td>";
			echo "<td>Подразделение</td>";
			echo "<td>Ответственное лицо</td>";
			echo "<td>Изображение</td>";
			echo "<td>Редактирование</td>";
			//echo "<td>Отметка наличия</td>";
			echo "</tr>";

			include 'connect.php';
			$name = $_SESSION['nameus'];
		
			if ($name = 'admin') {
			
			$take = mysqli_query($connection,"SELECT * FROM `equipment` WHERE `login` LIKE '$login';");
				$count = 0;
				while ($data=mysqli_fetch_array($take)) {
					echo "<tr>";
					echo "<form method='POST' action=''>";
					echo "<input type='hidden' name='id' value='".$data['id']."'>";
					$str = htmlentities(file_get_contents("settings.txt"));
			echo "<td><input ".$data['checked']." ".$str." type='checkbox' class='update-checkbox' data-value='".$data['inventnum']."' data-id='".$data['id']."'></td>";
					$count = $count + 1;
					echo "<td>".$count."</td>";
					echo "<td><input type='hidden' name='thing' value='".$data['thing']."'>".$data['thing']."</td>";
					echo "<td><input type='hidden' name='inventnum' value='".$data['inventnum']."'>".$data['inventnum']."</td>";
					echo "<td><input type='hidden' name='inventnumcheck' value='".$data['inventnumcheck']."'>".$data['inventnumcheck']."</td>";
					echo "<td><input type='hidden' name='division' value='".$data['division']."'>".$data['division']."</td>";
					echo "<td><input type='hidden' name='login' value='".$data['login']."'>".$data['login']."</td>";

					echo "<td><a href='".'/php/'.$data['image']."'>Просмотр</a></td>";
					echo "<td><input type='submit' name='edt' value='Редактировать'></td>";
					//echo "<td><input type='submit' name='manchk' value='Отметить'></td>";
					echo "</form>";
					echo "</tr>";
			}
			echo "</table>";
				
				

			echo '<script>
			$(document).ready(function() {
				$(".update-checkbox").change(function() {
					var isChecked = "checked";
					var id = $(this).data("id");
					var value = $(this).data("value");
					console.log(id, isChecked, value);
					
					$.ajax({
						url: "update.php",
						type: "POST",
						data: { id: id, checked: isChecked, value: value },
						success: function(response) {
							console.log(response);
						},
						error: function(xhr, status, error) {
							console.error(error);
						}
					});
				});
			});
			</script>';

				

				if (isset($_POST['edt'])) {
					$_SESSION['ggg']=$_POST['thing'];
					$_SESSION['invent']=$_POST['inventnum'];

					echo "<script>window.location.href = 'gedit.php';</script>";
			}
				
				
				if (isset($_POST['manchk'])) {
					//$copy = mysqli_query($connection,"SELECT * FROM `equipment`;");
					/*while ($datacopy = mysqli_fetch_array($copy)) {
						echo $datacopy['id'];
						echo $datacopy['inventnum'];
						echo $datacopy['login'];
					}*/
					$cpy1 = $_POST['inventnum'];
					$cpy2 = $_POST['id'];
					//echo $cpy1."+".$cpy2;
					$copy = mysqli_query($connection, "UPDATE `equipment` SET `inventnumcheck` = '$cpy1' WHERE `equipment`.`id` = $cpy2;");
					echo "<script>window.location.href = 'goods.php';</script>";
			}
				
				
								
			}
					} 
		
		else if (isset($_POST['sort'])) {
		
			$login = $_POST['insort'];
			
			session_start();
			if (empty($_SESSION['nameus'])) {
				echo 'Доступ запрещен!';
				die;
			}
		
		/*вывод списка имущества в форме таблицы для просмотра*/
			
			echo "<table cellpadding='0' cellspacing='0' border='1' id='tbl'>";
			echo "<tr>";
			echo "<td>Название</td>";
			echo "<td>Инвентарный номер</td>";
			echo "<td>Проверка наличия</td>";
			echo "<td>Подразделение</td>";
			echo "<td>Ответственное лицо</td>";
			echo "<td>Изображение</td>";
			echo "<td>Редактирование</td>";
			//echo "<td>Отметка наличия</td>";
			echo "</tr>";

			include 'connect.php';
			$name = $_SESSION['nameus'];
		
			if ($name = 'admin') {
			
			$take = mysqli_query($connection,"SELECT * FROM `equipment` WHERE `login` LIKE '$login';");

				while ($data=mysqli_fetch_array($take)) {
					echo "<tr>";
					echo "<form method='POST' action=''>";
					echo "<input type='hidden' name='id' value='".$data['id']."'>";
					echo "<td><input type='hidden' name='thing' value='".$data['thing']."'>".$data['thing']."</td>";
					echo "<td><input type='hidden' name='inventnum' value='".$data['inventnum']."'>".$data['inventnum']."</td>";
					echo "<td><input type='hidden' name='inventnumcheck' value='".$data['inventnumcheck']."'>".$data['inventnumcheck']."</td>";
					echo "<td><input type='hidden' name='division' value='".$data['division']."'>".$data['division']."</td>";
					echo "<td><input type='hidden' name='login' value='".$data['login']."'>".$data['login']."</td>";

					echo "<td><a href='".'/php/'.$data['image']."'>Просмотр</a></td>";
					echo "<td><input type='submit' name='edt' value='Редактировать'></td>";
					//echo "<td><input type='submit' name='manchk' value='Отметить'></td>";
					echo "</form>";
					echo "</tr>";
			}
			echo "</table>";
		

				if (isset($_POST['edt'])) {
					$_SESSION['ggg']=$_POST['thing'];
					$_SESSION['invent']=$_POST['inventnum'];

					echo "<script>window.location.href = 'gedit.php';</script>";
			}
				
				if (isset($_POST['manchk'])) {
					
					$cpy1 = $_POST['inventnum'];
					$cpy2 = $_POST['id'];
					$copy = mysqli_query($connection, "UPDATE `equipment` SET `inventnumcheck` = '$cpy1' WHERE `equipment`.`id` = $cpy2;");
					echo "<script>window.location.href = 'goods.php';</script>";
			}
				
				if (isset($_POST['checkall'])) {
						
							echo "<script>window.location.href = 'https://google.com';</script>";
						
			}

				
			}
			
		}

		?>
		
		
		

		<!--форма для добавления товара-->

		<h2>Добавление основного средства по одному</h2>
		
		<?php
			echo "<form id='u' method='POST' enctype = 'multipart/form-data'>";
			echo "<fieldset id='fset'>";
			echo "<legend>Введите все данные</legend>";
		
				
			$gotouser = mysqli_query($connection,"SELECT `users`.`login`,
														 `usersinfo`.`login`,`usersinfo`.`fullname`
											FROM `users`,`usersinfo` 
											WHERE `usersinfo`.`login` = `users`.`login`;");
			
			echo "<select id='txt' name='ulist'>";
					while ($userlist=mysqli_fetch_assoc($gotouser)) {
						echo "<option value='".$userlist['login']."'>".$userlist['fullname']."</option>";
					}
			echo "</select><br>";
					
					echo "<input name='thing' id='txt' placeholder='Название' type='text'><br>";
					echo "<input name='inventnum' id='txt' placeholder='Инвентарный номер' type='text'><br>";
					echo "<input type='file' name='file'><br>";
					echo "<input name='pub' id='sub' type='submit' value='ДОБАВИТЬ В БАЗУ ДАННЫХ'>";
		
			echo "</form>";

			/*добавление товара*/

			if (isset($_POST['pub'])) {

				$host="localhost:3306";
				$user="ictlabkz_qr";
				$pass="!SherLock2023";
				$dbnm="ictlabkz_qr";
				
				$tempname=$_POST['ulist'];

				$link=mysqli_connect($host,$user,$pass,$dbnm);
				
				// определение папки для пользователя с именем name для загрузки файлов (по умолчанию php/images/..)
				$dir='../php/images/'.$tempname; 
								
				if(!is_dir($dir)) {
					mkdir($dir, 0777, true); // создаем папку с именем пользователя если она не существовала
				} else {
				
				$first=$_POST['thing'];
				$second=$_POST['inventnum'];
				$last=$_POST['ulist'];
				$upname=basename($_FILES['file']['name']);//записываем имя файла
				$uppath=$dir.'/'.$upname; // имя папки + имя файла
				
				//перемещение загруженного файла из временной папки сервера в папку, которую указали (uploadpath)

				if  (move_uploaded_file($_FILES['file']['tmp_name'], $uppath)) {
				/*запись нового основного средства c изображением*/
				$adding = mysqli_query($link,"INSERT INTO `equipment` (`thing`,`inventnum`,`login`,`image`) VALUES ('$first','$second','$last','$uppath');"); 
					} else {
				/*запись нового товара без изображения*/
				$adding = mysqli_query($connection,"INSERT INTO `equipment` (`thing`,`inventnum`,`login`,`image`) VALUES ('$first','$second','$last','$four','');");  
					}
				
				if ($adding) {
							echo "<script>window.location.href = 'goods.php';</script>";
							header("Location:goods.php");
						}
			}
			}

		?>
		
	</div>
</body>
</html>