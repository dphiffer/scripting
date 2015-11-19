<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Meeting rooms</title>
		<style>
		
		body {
			font: 18px helvetica;
		}
		
		th {
			text-align: left;
		}
		
		form {
			border: 1px solid #ccc;
			padding: 15px;
			margin-top: 30px;
		}
		
		label {
			display: block;
			margin-bottom: 15px;
		}
		
		input[type=text] {
			display: block;
			margin-top: 5px;
		}
		
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th>Room</th>
				<th>Date/Time</th>
				<th>Club Name</th>
			</tr>
			<?php

			$db = new PDO('mysql:host=127.0.0.1;dbname=demodb', 'root', '');
			$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

			if (!empty($_GET['room_number'])) {
				$query = $db->prepare("
					INSERT INTO club_meeting_rooms
					(room_number, date_time, club_name)
					VALUES (?, ?, ?)
				");
				$query->execute(array(
					$_GET['room_number'],
					$_GET['date_time'],
					$_GET['club_name']
				));
			}

			$query = $db->query("
				SELECT *
				FROM club_meeting_rooms
			");

			$values = $query->fetchAll();
			foreach ($values as $row) {
				echo "<tr>
					<td>$row->room_number</td>
					<td>$row->date_time</td>
					<td>$row->club_name</td>
				</tr>\n";
			}

			?>
		</table>
		<form action="index.php">
			<label>
				Room number
				<input type="text" name="room_number">
			</label>
			<label>
				Date &amp; time (YYYY-MM-DD HH:MM:SS)
				<input type="text" name="date_time">
			</label>
			<label>
				Club name
				<input type="text" name="club_name">
			</label>
			<input type="submit" value="Create">
		</form>
	</body>
</html>
