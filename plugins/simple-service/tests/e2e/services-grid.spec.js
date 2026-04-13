const { test, expect } = require('@playwright/test');

test.describe('Services Grid block page', () => {
	test('renders selected services in expected order and excludes drafts', async ({ page }) => {
		await page.goto('/service-block-page-test/');

		const grid = page.locator('.simple-service-grid');

		if (await grid.count()) {
			await expect(grid.first()).toBeVisible();

			const cards = grid.first().locator('.simple-service-grid__card');
			const firstCard = cards.nth(0);
			const firstInner = firstCard.locator('.simple-service-grid__card-inner');
			const firstFront = cards.nth(0).locator('.simple-service-grid__face--front');
			const secondFront = cards.nth(1).locator('.simple-service-grid__face--front');
			await expect(cards).toHaveCount(2);

			await expect(firstFront.locator('.simple-service-grid__title')).toHaveText('Service Beta Test');
			await expect(secondFront.locator('.simple-service-grid__title')).toHaveText('Service Alpha Test');
			await expect(firstFront.locator('.simple-service-grid__image')).toHaveCount(1);
			await expect(secondFront.locator('.simple-service-grid__image')).toHaveCount(1);

			await expect(page.getByText('Service Draft Test')).toHaveCount(0);
			await expect(grid.first().locator('.simple-service-grid__link')).toHaveCount(0);
			await expect(firstFront.locator('.simple-service-grid__excerpt')).toHaveCount(0);
			await expect(secondFront.locator('.simple-service-grid__excerpt')).toHaveCount(0);
			await expect(cards.nth(0).locator('.simple-service-grid__long-description')).toContainText('LONG_DESCRIPTION_BETA_TEST');
			await expect(cards.nth(1).locator('.simple-service-grid__long-description')).toContainText('LONG_DESCRIPTION_ALPHA_TEST');

			await expect(firstInner).toHaveCSS('transform', 'none');
			await firstCard.hover();
			await expect
				.poll(async () => firstInner.evaluate((el) => window.getComputedStyle(el).transform))
				.not.toBe('none');
			return;
		}

		const rendered = await page.evaluate(async () => {
			const response = await fetch('/wp-json/wp/v2/pages?slug=service-block-page-test&_fields=content.rendered');
			if (!response.ok) {
				throw new Error('Failed to fetch rendered page content via REST');
			}

			const body = await response.json();
			if (!Array.isArray(body) || !body.length || !body[0].content) {
				throw new Error('Missing rendered page payload from REST');
			}

			return body[0].content.rendered || '';
		});

		expect(rendered).toContain('simple-service-grid');
		expect(rendered).toContain('Service Beta Test');
		expect(rendered).toContain('Service Alpha Test');
		expect(rendered).not.toContain('Service Draft Test');
		expect(rendered).not.toContain('simple-service-grid__excerpt');
		expect(rendered).toContain('simple-service-grid__image');
		expect(rendered).toContain('LONG_DESCRIPTION_BETA_TEST');
		expect(rendered).toContain('LONG_DESCRIPTION_ALPHA_TEST');
		expect(rendered).not.toContain('simple-service-grid__link');
	});
});
