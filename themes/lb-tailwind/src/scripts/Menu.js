
class Menu {
	constructor() {
		this.start()
	}

	start() {
		const menuIcon = document.querySelector("#menu-icon");
		const menu = document.querySelector("#menu");
		menuIcon.addEventListener('click', () => {
			menuIcon.classList.toggle('tham-active');
			menu.classList.toggle('hidden');
		});
	}
}

export default Menu