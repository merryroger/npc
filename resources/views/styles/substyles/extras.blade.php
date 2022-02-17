div.photo__frame {
    margin: 8px 20pt 20px 0;
    border-radius: 5px;
    background-size: contain !important;
    background: transparent var(--img-src) center top no-repeat;
    justify-content: center;
    align-items: flex-end;
    display: flex;
}

.pf__standard {
    --frame-width: calc(80vw);
    float: left;
    max-width: var(--w-max);
    max-height: var(--h-max);
    width: var(--frame-width);
    height: calc(var(--frame-width) * 2 / 3);
}

.pf__vertical {
    --frame-width: calc(80vw);
    float: left;
    max-width: var(--w-max);
    max-height: var(--h-max);
    width: var(--frame-width);
    height: calc(var(--frame-width) * 3 / 2);
}