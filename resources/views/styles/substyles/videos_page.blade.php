/**** Videos page block ****/

nav.video__pad {
    justify-content: flex-start;
    flex-wrap: wrap;
    display: flex;
}

div.video__item__pad {
    margin: 0 10pt 20px;
    width: calc((800px - 50pt) / 3 - 21pt);
    flex-direction: column;
    flex-wrap: nowrap;
    display: flex;
}

.video__item__pad h6, .vf__title h6 {
    margin-bottom: 8px;
    color: var(--smnu-bgr);
    font-size: 11pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
}

.video__item__pad a {
    width: 100%;
    height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
    max-height: calc(((800px - 50pt) / 3 - 21pt) / 1.78);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    flex-grow: 1;
    display: flex;
}

.video__item__pad p, .vf__title p {
    margin: 16px 3px;
    color: var(--prg-clr);
    line-height: 1.4;
    font-size: 9pt;
    font-family: "Roboto Condensed", sans-serif;
}

div.empty__line {
    margin: 5px auto 20px;
    color: var(--hdr-clr);
    font-size: 13pt;
    font-weight: 400;
    font-family: "Roboto Condensed", sans-serif;
    justify-content: center;
    display: flex;
}

.video__item__pad span {
    margin: auto;
    height: 1.5em;
    font: 48px/1.5 sans-serif;
    color: #fff;
    text-shadow: 0 0 0.5em #000;
    opacity: .5;
}

/**** End of Videos page block ****/

/**** Video frame block ****/

div#video_frame_pad {
    position: fixed;
    padding: 0 5px 5px 5px;
    border: 1px solid var(--subpn-brd);
    border-radius: 5px;
    background-color: var(--def-bgr);
    box-shadow: 4px 4px 8px rgb(0, 0, 0, .5);
}

div.dad__panel {
    width: 100%;
    height: 5px;
    cursor: pointer;
}

iframe#video_frame {
    border-width: 0;
    background-color: var(--blk-clr);
}

section#video_frame_panel {
    justify-content: space-between;
    flex-grow: 1;
    display: flex;
}

div.vf__title {
    padding: 0 5pt 3px;
    flex-direction: column;
    display: flex;
}

.vf__title p {
    margin: 0 0 8px;
}

div.vf__controls {
    flex-basis: 5%;
    padding: 0 1pt 10px;
    align-items: flex-start;
    display: flex;
}

.vf__controls span {
    color: var(--mmnu-clr);
    font-size: 11pt;
    cursor: pointer;
    box-shadow: none;
}

/**** End of video frame block ****/
