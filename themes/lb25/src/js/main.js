// Main JavaScript file.
document.addEventListener('DOMContentLoaded', function () {
	var menu_button = document.getElementById('mobile-menu-button');
	var mobile_menu = document.getElementById('mobile-menu');

	if (!menu_button || !mobile_menu) {
		return;
	}

	menu_button.addEventListener('click', function () {
		var is_open = menu_button.classList.toggle('is-open');
		mobile_menu.classList.toggle('is-open', is_open);
		menu_button.setAttribute('aria-expanded', is_open ? 'true' : 'false');
	});
});