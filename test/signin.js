// const puppeteer = require('puppeteer');
// const url = process.argv[2];
// const tokenJetbrains = process.argv[3];
//
// if (!url) {
//     throw "Please provide a URL as the first argument";
// }
// (async () => {
//     try {
//         const browser = await puppeteer.launch({headless: false});
//         const page = await browser.newPage();
//         let startURL = `${url}/pages/signin.php?_ijt=${tokenJetbrains}`;
//         await page.goto(`${url}/pages/signin.php?_ijt=${tokenJetbrains}`);
//
//         // try {
//         //     if (page.url() !== startURL) {
//         //         await page.goto(`${url}/db/signout.php?_ijt=${tokenJetbrains}`);
//         //         await page.goto(`${url}/db/signup.php?_ijt=${tokenJetbrains}`);
//         //     }
//         // } catch (e) {
//         //     console.log(e);
//         // }
//
//         await page.type('input[id=form-signin-username]', 'amirudev');
//         await page.type('input[id=form-signin-password]', 'wahyu1234');
//         await page.click('button[id=form-signin-button-action');
//     } catch (e) {
//         throw e.toString();
//     }
//
//     setTimeout(async () => {
//         await page.screenshot({path: './screenshot/signin.png'});
//         await browser.close();
//     }, 10000);
// })();

const puppeteer = require('puppeteer');
const url = process.argv[2];
const tokenJetbrains = process.argv[3];

if (!url) {
    throw "Please provide a URL as the first argument";
}

(async () => {
    const browser = await puppeteer.launch({headless: false});
    const page = await browser.newPage();
    const startURL = `${url}/pages/signin.php?_ijt=${tokenJetbrains}`;
    await page.goto(startURL);

    try {
        if (page.url() !== startURL) {
            await page.goto(`${url}/db/signout.php?_ijt=${tokenJetbrains}`);
            await page.goto(`${url}/db/signup.php?_ijt=${tokenJetbrains}`);
        }
    } catch (e) {
        console.log(e);
    }

    await page.type('input[id=form-signin-username]', 'amirudev');
    await page.type('input[id=form-signin-password]', 'wahyu1234');
    await page.click('button[id=form-signin-button-action');

    setTimeout(async () => {
        await page.screenshot({path: './screenshot/signin.png'});
        await browser.close();
    }, 10000);
})();