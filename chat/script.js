jQuery(document).ready(function($) {
	
	var updatingScroll = false;
	var userScrolled = false;
	
	function updateMsgsScroll() {
		updatingScroll = true;
		if (!userScrolled) {
			// If the user hasn't scrolled themselves, scroll to the very bottom
			var bottom = $('#msgs')[0].scrollHeight;
			$('#msgs')[0].scrollTop = bottom;
		}
	}
	updateMsgsScroll();
	
	$('#msgs').scroll(function() {
		// Detect whenever the msgs div gets scrolled
		var scrollMax = $('#msgs')[0].scrollHeight;
		var height = $('#msgs')[0].offsetHeight;
		
		if (updatingScroll) {
			// If we were scrolling from the updateMsgsScroll, it wasn't the user
			updatingScroll = false;
		} else if ($('#msgs')[0].scrollTop > scrollMax - height) {
			// If the user reaches the bottom, then reset userScrolled to false
			userScrolled = false;
		} else {
			// If the user has scrolled, then stop updating via updateMsgsScroll
			userScrolled = true;
		}
	});
	
	$('form').submit(function(e) {
		// Whene the form gets submitted, don't actually reload the page
		e.preventDefault();
		
		// Don't send an empty value
		if ($('input[name=msg]').val() == '') {
			return;
		}
		userScrolled = false;
		
		// Submit a message via AJAX POST
		$.ajax('submit.php', {
			method: 'POST',
			data: $('form').serialize(),
			success: function(msgs) {
				// Use the response HTML from submit.php to update the #msgs list
				$('#msgs').html(msgs);
				
				// Scroll to the bottom
				updateMsgsScroll();
				
				// Reset the input to an empty value
				$('input[name=msg]').val('');
			}
		});
	});
	
	setInterval(function() {
		// Every 1 second, poll the server for new messages
		$.ajax('update.php', {
			method: 'POST',
			success: function(msgs) {
				// Update the #msgs div and scroll to the bottom
				$('#msgs').html(msgs);
				updateMsgsScroll();
			}
		});
	}, 1000);
	
});
