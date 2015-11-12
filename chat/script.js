jQuery(document).ready(function($) {
	
	var updatingScroll = false;
	var userScrolled = false;
	
	function updateMsgsScroll() {
		updatingScroll = true;
		if (!userScrolled) {
			var bottom = $('#msgs')[0].scrollHeight;
			$('#msgs')[0].scrollTop = bottom;
		}
	}
	updateMsgsScroll();
	
	$('#msgs').scroll(function() {
		var scrollMax = $('#msgs')[0].scrollHeight;
		var height = $('#msgs')[0].offsetHeight;
		console.log($('#msgs')[0].scrollTop + ', ' + (scrollMax - height));
		if (updatingScroll) {
			updatingScroll = false;
		} else if ($('#msgs')[0].scrollTop > scrollMax - height) {
			console.log('done');
			userScrolled = false;
		} else {
			userScrolled = true;
		}
	});
	
	$('form').submit(function(e) {
		e.preventDefault();
		if ($('input[name=msg]').val() == '') {
			// Check for empty value
			return;
		}
		userScrolled = false;
		$.ajax('submit.php', {
			method: 'POST',
			data: $('form').serialize(),
			success: function(msgs) {
				$('#msgs').html(msgs);
				updateMsgsScroll();
				$('input[name=msg]').val('');
			}
		});
	});
	
	setInterval(function() {
		$.ajax('update.php', {
			method: 'POST',
			success: function(msgs) {
				$('#msgs').html(msgs);
				updateMsgsScroll();
			}
		});
	}, 1000);
	
});
