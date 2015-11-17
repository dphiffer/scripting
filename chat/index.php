<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
		<title>Chat</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div id="page">
			<div id="msgs">
				<p>Loading...</p>
			</div>
			<form action="submit.php" method="post">
				<input type="hidden" name="img" value="">
				<input type="hidden" name="avatar_color" value="">
				<input type="hidden" name="avatar_position" value="">
				<input type="hidden" name="avatar_icon" value="">
				<input type="hidden" name="time" value="">
				<div id="avatar" class="avatar">
					<div class="relative">
						<div class="icon"></div>
					</div>
				</div>
				<textarea name="msg" placeholder="Type a message [return]" cols="80" rows="3"></textarea>
			</form>
		</div>
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/tinycolor-min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>
