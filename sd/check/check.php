<!DOCTYPE html>
<html>
<head>
	<title>Проверка отсутствующих основных средств</title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?load=Geolink&amp;lang=ru_RU&amp;apikey=922b0b91-cd1b-47ab-89c7-1b594e343f72" type="text/javascript"></script>
	
</head>
<body>
	<div id="side">
		<ul id="nav">
			<li><a href="../a_admin.php">ГЛАВНАЯ</a></li>
			<li><a href="../goods.php">ИМУЩЕСТВО</a></li>
			<li><a href="../users.php">О ПОЛЬЗОВАТЕЛЕ</a></li>
			<li><a href="../files.php">Файлы</a></li>
			<li><a href="../logout.php">ВЫйти</a></li>
		</ul>
	</div>
		
	<div id="content">
		<h2>Неотмеченные основные средства <span class="ymaps-geolink">Казахстан, Костанай, улица Г. Каирбекова, 312</span> </h2>
			
			<?php

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
			echo "</tr>";

			include '../connect.php';
			$name = $_SESSION['nameus'];
		
			$take1 = mysqli_query($connection,"SELECT * FROM `equipment` WHERE `login` = '$name' AND `inventnumcheck` = '';");

				while ($data1=mysqli_fetch_array($take1)) {
					echo "<tr>";
					echo "<td>".$data1['thing']."</td>";
					echo "<td>".$data1['inventnum']."</td>";
					echo "</tr>";
			}
			echo "</table>";
		
				
		?>
		
		
	</div>
</body>
</html>