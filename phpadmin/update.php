<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : null;
	$checked = isset($_POST['checked']) ? $_POST['checked'] : null;
	$value = isset($_POST['value']) ? ($_POST['value']) : null;
	

		if ($id !== null && $value !== null) { // Проверяем, что значения не null
        // Подключение к базе данных
    	$mysqli = new mysqli("localhost:3306", "ictlabkz_qr", "!SherLock2023", "ictlabkz_qr");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
			
			 var_dump($checked, $value, $id);

			// Выполнение UPDATE запроса
			$stmt = $mysqli->prepare("UPDATE equipment SET inventnumcheck = ?, checked = ? WHERE id = ?");
			$stmt->bind_param("ssi", $value, $checked, $id); // Связываем параметры

			if ($stmt->execute()) {
				echo "Успешно обновлено";
			} else {
				echo "Ошибка: " . $stmt->error;
			}

			$stmt->close();
			$mysqli->close();
		}
}
?>
