(function() {
	var repos = document.querySelectorAll('#repos .repo');
	if (repos.length) {
		var checkbox;
		for (var i = 0; i < repos.length; i++) {
			checkbox = repos[i].querySelector('input[type=checkbox]');
			if (!checkbox) {
				continue;
			}
			checkbox.addEventListener('change', function(e) {
				var repo = e.target.parentNode.parentNode.getAttribute('id').substr(5);
				var label = document.querySelector('#repo-' + repo + ' .label');
				label.innerHTML += ' (working)';
				var status = e.target.checked ? 'enable' : 'disable';
				var data = 'repo=' + repo + '&status=' + status;
				var xhr = new XMLHttpRequest();
				xhr.open('POST', '/scripting/lib/repo.php', true);
				xhr.onreadystatechange = function() {
					if (this.readyState === 4) {
						label.innerHTML = this.responseText;
					}
				};
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.setRequestHeader('Content-Length', data.length);
				xhr.setRequestHeader('Connection', 'close');
				xhr.send(data);
			}, false);
		}
	}
})();
