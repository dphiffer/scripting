jQuery(document).ready(function($) {
	
	window.scrollTo(0, 0);
	
	var updatingScroll = false;
	var userScrolled = false;
	var inputFocused = false;
	var messages = [];
	var liveAvatar = !!window.localStorage.liveAvatar;
	var timeMarker = null;
	
	function updateScroll() {
		updatingScroll = true;
		if (userScrolled) {
			return;
		}
		if (inputFocused && $(window).width() < 600) {
			return;
		}
		setTimeout(function() {
			if ($('#msg-container').height() < window.innerHeight - 70) {
				// Scroll to the top, if there aren't many messages yet
				window.scrollTo(0, 0);
			} else {
				// Scroll to the bottom
				var bottom = document.body.scrollHeight - window.innerHeight;
				window.scrollTo(0, bottom);
			}
		}, 0);
	}
	
	function displayMessage(msg) {
		if (!msg || messages.indexOf(msg.id) != -1) {
			return;
		}
		messages.push(msg.id);
		if (msg.img) {
			var img = '<span class="img" style="background-image: url(' + msg.img + ')"></span>';
		} else if (msg.avatar) {
			var avatar = '<span class="avatar ' + msg.avatar.icon + '-icon" style="background-color: ' + msg.avatar.color + '"><span class="icon" style="background-position: ' + msg.avatar.position + '"></span></span>';
			var img = '<span class="img">' + avatar + '</span>';
		}
		checkTimeMarker(msg.id);
		$('#msg-container').append('<p id="msg-' + msg.id + '" style="border-color: ' + msg.avatar.color + '">' +
		    img +
		    '<span class="msg">' + msg.msg + '</span>' +
		  '</p>');
	}
	
	function checkTimeMarker(msgId) {
		var now = new Date();
		var msgTimestamp = parseInt(msgId) * 1000;
		var msgTime = new Date(msgTimestamp);
		if (!timeMarker || msgTime.getTime() - timeMarker > 1000 * 60 * 5) {
			timeMarker = msgTime.getTime();
			var time = msgTime.toLocaleTimeString().match(/(\d+:\d+):\d+(.+)/);
			if (time) {
				$('#msg-container').append('<div class="time-marker" title="' + msgTime.toLocaleString() + '">' + time[1] + time[2] + '</div>');
			}
		}
	}
	
	$.ajax('load.php', {
		success: function(json) {
			$('#msgs').html('<div id="msg-container"></div>');
			$.each(json.msgs, function(i, msg) {
				displayMessage(msg);
			});
			updateScroll();
		}
	});
	
	function hasGetUserMedia() {
		return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
		          navigator.mozGetUserMedia || navigator.msGetUserMedia);
	}
	
	$('#avatar').click(function() {
		liveAvatar = !liveAvatar;
		if (liveAvatar && hasGetUserMedia()) {
			showLiveAvatar();
		} else {
			$('#video').remove();
			$('#canvas').remove();
		}
		window.localStorage.liveAvatar = liveAvatar ? 1 : 0;
	});
	
	function showLiveAvatar() {
		var $canvas = $('#canvas');
		if ($canvas.length == 0) {
			$('#avatar .relative').append(
				'<video id="video" width="128" height="96" autoplay></video>' +
				'<canvas id="canvas" width="96" height="96"></canvas>'
			);
			$canvas = $('#canvas');
		}
		context = $canvas[0].getContext("2d"),
		video = $('#video')[0];
		var errorHandler = function(error) {
			console.log("Video capture error: ", error.code); 
		};
		var settings = {
			video: true
		};
		context.translate(96, 0);
		context.scale(-1, 1);
		function drawAvatar() {
			context.drawImage(video, -16, 0, 128, 96);
			window.requestAnimationFrame(drawAvatar);
		}
		video.addEventListener('play', function() {
			drawAvatar();
		}, false);
		if (navigator.getUserMedia) {
			navigator.getUserMedia(settings, function(stream) {
				video.src = stream;
				video.play();
			}, errorHandler);
		} else if (navigator.webkitGetUserMedia) {
			navigator.webkitGetUserMedia(settings, function(stream) {
				video.src = window.webkitURL.createObjectURL(stream);
				video.play();
			}, errorHandler);
		} else if (navigator.mozGetUserMedia) {
			navigator.mozGetUserMedia(settings, function(stream) {
				video.src = window.URL.createObjectURL(stream);
				video.play();
			}, errorHandler);
		}
	}
	
	function getAvatar() {
		if (window.localStorage.avatar) {
			return JSON.parse(window.localStorage.avatar);
		}
		var hex = ['33', '66', '99'];
		var ri = Math.floor(Math.random() * 3);
		var gi = Math.floor(Math.random() * 3);
		var bi = Math.floor(Math.random() * 3);
		var r = hex[ri];
		var g = hex[gi];
		var b = hex[bi];
		var color = '#' + r + g + b;
		var i = Math.floor(Math.random() * 5);
		var j = Math.floor(Math.random() * 5);
		var x = i * -38;
		var y = j * -38;
		var icon = tinycolor(color).isDark() ? 'white' : 'black';
		var avatar = {
			position: x + 'px ' + y + 'px',
			color: color,
			icon: icon
		};
		window.localStorage.avatar = JSON.stringify(avatar);
		return avatar;
	}
	
	$(window).scroll(function() {
		// Detect whenever the msgs div gets scrolled
		var scrollMax = document.body.scrollHeight - window.innerHeight;
		
		if (updatingScroll) {
			// If we were scrolling from the updateScroll, it wasn't the user
			updatingScroll = false;
		} else if (window.scrollY > scrollMax - 10) {
			// If the user reaches the bottom, then reset userScrolled to false
			userScrolled = false;
		} else {
			// If the user has scrolled, then stop updating via updateScroll
			userScrolled = true;
		}
	});
	
	$('textarea[name=msg]').keypress(function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			$('form').submit();
		}
	});
	
	$('textarea[name=msg]').focus(function(e) {
		inputFocused = true;
	});
	
	$('textarea[name=msg]').blur(function(e) {
		inputFocused = false;
	});
	
	$('form').submit(function(e) {
		// Whene the form gets submitted, don't actually reload the page
		e.preventDefault();
		
		// Don't send an empty value
		if ($('textarea[name=msg]').val() == '') {
			return;
		}
		userScrolled = false;
		
		// Set the hidden img input's value to the current canvas image
		if (liveAvatar) {
			var $canvas = $('#canvas');
			$('input[name=img]').val($canvas[0].toDataURL('image/jpeg', 0.7));
		}
		
		// Set the current time
		var time = Math.round((new Date()).getTime() / 1000);
		time += (new Date).getTimezoneOffset() * 60;
		$('input[name=time]').val(time);
		
		// Submit a message via AJAX POST
		$.ajax('submit.php', {
			method: 'POST',
			data: $('form').serialize(),
			success: function(msg) {
				// Show the current message
				displayMessage(msg);
				
				// Reset the inputs to empty values
				$('textarea[name=msg]').val('');
				$('input[name=img]').val('');
				
				// On mobile sized screens, hide the software keyboard
				if ($(window).width() < 600) {
					$('textarea[name=msg]')[0].blur();
				}
				
				// Scroll to the bottom
				updateScroll();
			}
		});
	});
	
	setInterval(function() {
		// Every 1 second, poll the server for new messages
		$.ajax('update.php', {
			method: 'POST',
			data: 'known=' + messages.join(','),
			success: function(json) {
				$.each(json.msgs, function(i, msg) {
					displayMessage(msg);
				});
				updateScroll();
			}
		});
	}, 1000);
	
	if (liveAvatar && hasGetUserMedia()) {
		showLiveAvatar();
	}
	var avatar = getAvatar();
	$('#avatar').css('background-color', avatar.color);
	$('#avatar .icon').css('background-position', avatar.position);
	if (avatar.icon == 'black') {
		$('#avatar').addClass('black-icon');
	}
	$('input[name=avatar_color]').val(avatar.color);
	$('input[name=avatar_position]').val(avatar.position);
	$('input[name=avatar_icon]').val(avatar.icon);
	$('form').css('background-color', avatar.color);
	
});
