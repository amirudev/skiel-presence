const puppeteer = require('puppeteer');
const url = process.argv[2];
const tokenJetbrains = process.argv[3];

if (!url) {
    throw "Please provide a URL as the first argument";
}

(async () => {
    const browser = await puppeteer.launch({headless: false});
    const page = await browser.newPage();
    let startURL = `${url}/db/signout.php?_ijt=${tokenJetbrains}`;
    await page.goto(startURL);

    setTimeout(async () => {
        await page.screenshot({path: './screenshot/signout.png'});
        await browser.close();
    }, 10000);
})();