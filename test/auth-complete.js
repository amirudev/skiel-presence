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

    try {
        if (page.url() !== startURL) {
            await page.goto(`${url}/db/signout.php?_ijt=${tokenJetbrains}`);
            await page.goto(`${url}/db/signup.php?_ijt=${tokenJetbrains}`);
        }
    } catch (e) {
        console.log(e);
    }

    await page.screenshot({path: './screenshot/auth/signout.png'});

    startURL = `${url}signup.php?_ijt=${tokenJetbrains}`;
    await page.goto(startURL);

    try {
        if (page.url() !== startURL) {
            await page.goto(`${url}/db/signout.php?_ijt=${tokenJetbrains}`);
            await page.goto(`${url}/db/signup.php?_ijt=${tokenJetbrains}`);
        }
    } catch (e) {
        console.log(e);
    }

    await page.type('input[id=form-signup-username]', 'amirudev');
    await page.type('input[id=form-signup-name]', 'Wahyu Amirulloh');
    await page.type('input[id=form-signup-email]', 'amirudev@gmail.com');
    await page.type('input[id=form-signup-phone]', '81283708972');
    await page.select('select[id=form-signup-role]', 'teacher');
    await page.type('input[id=form-signup-password]', 'wahyu1234');

    await page.screenshot({path: './screenshot/auth/signup.png'});

    await page.click('button[id=form-signup-button-action');

    await page.screenshot({path: './screenshot/auth/signup-complete.png'});

    startURL = `${url}/db/signout.php?_ijt=${tokenJetbrains}`;
    await page.goto(startURL);

    startURL = `${url}signin.php?_ijt=${tokenJetbrains}`;
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
    await page.screenshot({path: './screenshot/auth/signin.png'});

    await page.click('button[id=form-signin-button-action');

    await page.screenshot({path: './screenshot/auth/signin-complete.png'});

    setTimeout(async () => {
        await browser.close();
    }, 10000);
})();