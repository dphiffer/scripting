jQuery(document).ready(function($) {
	function getArticle(article) {
		$.ajax('ajax.php', {
			data: {
				article: article.replace(' ', '_')
			},
			success: function(response) {
				console.log(response);
				$('#page').html(response.mobileview.sections[0].text);
			}
		});
	}
	$('form').submit(function(e) {
		e.preventDefault();
		var article = $('input[name=article]').val();
		console.log('loading article ' + article);
		getArticle(article);
	});
});
