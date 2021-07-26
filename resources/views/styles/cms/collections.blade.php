/**** Collections` css list ****/

div.collection__header {
    flex-direction: row;
    justify-content: center;
    display: flex;
}

nav#collection_control_panel {
    position: absolute;
    margin: 0 20pt;
    right: 0;
    z-index: 2;
    flex-direction: row;
    justify-content: space-between;
    display: flex;
}

div.coll__ctrl__btn {
    margin: 0 3px;
    padding: 5px;
    width: 25px;
    height: 25px;
    text-align: center;
    color: var(--mmnu-abg);
    background-color: var(--def-bgr);
    border: 1px solid var(--xlt-gray);
    border-radius: 25px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    cursor: pointer;
}

div.coll__ctrl__btn:active {
    box-shadow: none;
}

/**** Form part ****/

div#form_pad {
    position: absolute;
    background-color: var(--def-bgr);
    border-radius: 10px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
}

.wait__form {
    width: 100px;
    height: 100px;
    background: var(--def-bgr) url("/images/accessories/form_await.gif") center center no-repeat;
}

