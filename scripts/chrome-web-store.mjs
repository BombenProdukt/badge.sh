import puppeteer from 'puppeteer';

(async () => {
	const browser = await puppeteer.launch();
	const page = await browser.newPage();

	await page.goto(
		`https://chrome.google.com/webstore/detail/${process.argv[2]}`,
	);

	console.log(await page.content());

	await browser.close();
})();
