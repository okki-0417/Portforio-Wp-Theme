module.exports = {
	content: ["./components/**/*.php", "./assets/js/**/*.tsx", "./*.php"],
	theme: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/line-clamp'),
	],
};
