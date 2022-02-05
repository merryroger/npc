/**** Section of banners ****/

section#banners {
    margin: 0 auto 80px;
    justify-content: center;
    align-items: center;
    display: flex;
}

div.banner__band__pad {
    margin 0 auto;
    width: auto;
    overflow: hidden;
    flex-grow: 0;
    display: flex;
}

div.banner__band {
    position: relative;
    margin: 0 auto;
    left: 0;
    width: auto;
    justify-content: space-evenly;
    flex-wrap: nowrap;
    display: flex;
    transition: left .25s ease-out;
}

a.banner__cell {
    margin: 5px 5pt;
    width: 120px;
    height: 60px;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.25);
    border-width: 0;
}

.banner__cell img {
    width: 120px;
    height: 60px;
    border-width: 0;
}

div.banner__ctrls {
    position: relative;
    width: 30px;
    min-width: 30px;
    height: 30px;
    min-height: 30px;
    border-radius: 30px;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    visibility: hidden;
    z-index: -1;
    cursor: pointer;
}

div.banner__ctrls:active {
    box-shadow: none;
}

.scroll__left {
    left: calc(15px - 2pt);
    background: transparent url("/images/accessories/scroll_left.png") center center no-repeat;
}

.scroll__right {
    left: calc(-15px + 2pt);
    background: transparent url("/images/accessories/scroll_right.png") center center no-repeat;
}
