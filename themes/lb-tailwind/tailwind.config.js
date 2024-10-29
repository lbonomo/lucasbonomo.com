module.exports = {
	content: ["./**/*.php", "./src/**/*.js"],
	plugins: [
		require("@tailwindcss/typography"),
		require("tailwind-hamburgers"),
		require('flowbite/plugin')
	]
}
