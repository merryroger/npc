:root {
    --bgr-white: #fff;
    --h1-color: #595752;
    --h3-color: #88867d;
    --p-color: #555;
}

* {
    margin: 0;
    padding: 0;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
}

html, body {
    width: 100%;
    height: 100%;
}

body {
    background-color: var(--bgr-white);
    justify-content: center;
    align-items: center;
    display: flex;
}

section#root {
    margin: auto;
    min-width: 200px;
    min-height: 150px;
    background: transparent url("/images/logo.png") center top no-repeat;
    text-align: center;
}

#root h1 {
    margin-top: 150px;
    color: var(--h1-color);
    line-height: 1.5;
    font-size: 35pt;
}

#root h3 {
    color: var(--h3-color);
    font-size: 15pt;
}

#root p {
    margin: 60px 30pt;
    color: var(--p-color);
    line-height: 1.7;
    font-size: 10pt;
    font-family: "PT Sans", sans-serif;
    flex-wrap: wrap;
    justify-content: center;
    display: flex;
}
