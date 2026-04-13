const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({
	testDir: './tests/e2e',
	timeout: 45 * 1000,
	fullyParallel: false,
	retries: 0,
	workers: 1,
	use: {
		baseURL: 'https://lucasbonomo.lndo.site',
		ignoreHTTPSErrors: true,
		trace: 'retain-on-failure',
		headless: true,
	},
	reporter: [['list']],
});
