<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Chat demo</title>
	</head>
	<body>
		<div id="msgs">
			<?php
			
			$msgs = glob('msg/*.txt');
			foreach ($msgs as $filename) {
				$msg = file_get_contents($filename);
				echo '<p>' . htmlentities($msg) . '</p>';
			}
			
			?>
		</div>
		<form action="submit.php" method="post">
			<input type="text" name="msg" placeholder="Type a message here">
			<input type="submit" value="Send">
		</form>
		<script src="jquery-1.11.3.min.js"></script>
		<script src="script.js"></script>
	</body>
</html>
