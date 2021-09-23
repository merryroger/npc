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

div#form_pad, div#extra_form_pad {
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

form.image__load__form, form.image__edit__form, form.preview__load__form {
    margin: 10px 10pt;
}

.image__load__form fieldset, .image__edit__form fieldset, .preview__load__form fieldset {
    padding: 10px 16pt;
    border-width: 0;
    font-family: "Roboto Condensed", sans-serif;
    //font-family: "PT Sans", sans-serif;
    flex-direction: column;
    display: flex;
}

.image__load__form label, .image__edit__form label, .preview__load__form label {
    color: var(--mmnu-clr);
    font-size: 14pt;
}

ul.image__selector__set {
    margin-top: 20px;
    max-width: 590px;
    font-size: 10pt;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    display: flex;
}

ul.preview__selector__set {
    margin-top: 12px;
    font-size: 10pt;
    flex-direction: row;
    justify-content: space-around;
    display: flex;
}

section.form__controls {
    margin-top: 20px;
    justify-content: center;
    display: flex;
}

.form__controls button {
    margin: 0 2px;
    padding: 2px 5pt;
    min-width: 80px;
    color: var(--xlt-gray);
    border: 1px solid var(--mmnu-abg);
    border-radius: 3pt;
    background-color: var(--dk-gr-cl);
    box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
    line-height: 1.3;
    font-size: 8pt;
    cursor: pointer;
}

.form__controls button:active {
    box-shadow: none;
}

.button__disabled {
    box-shadow: none !important;
    opacity: .5;
    cursor: default !important;
}

.image__selector__set button {
    margin: 2px 3pt;
    padding: 5px 0;
    width: 25px;
    color: var(--mmnu-clr);
    border: 1px solid var(--xlt-gray);
    background-color: var(--def-bgr);
    border-radius: 5px;
    box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
    cursor: pointer;
}

.image__selector__set button:active {
    box-shadow: none;
}

li.image__upload__elem__pad {
    margin: 2px 3pt;
    padding: 5px 5pt;
    border: 1px solid var(--lt-gr-cl);
    border-radius: 5px;
    list-style-type: none;
    cursor: pointer;
}

div.img_ld_struct {
    flex-direction: column;
    display: flex;
}

div.img__ld__pad {
    width: 160px;
    height: 120px;
    border-radius: 5px;
    justify-content: center;
    align-items: center;
    display: flex;
}

div.img__ld__pad.no__photo {
    background: transparent url("/images/accessories/no_photo.png") center center no-repeat;
}

.img__ld__pad img {
    border-radius: 5px;
}

div.no__file__selected {
    padding: 5px 0 0 0;
    width: 100%;
    color: var(--mmnu-abg);
    font-size: 8pt;
    flex-direction: row;
    justify-content: space-between;
    display: flex;
    cursor: default;
}

.no__file__selected > * {
    margin: 0 3px;
}

.wait__upload {
    background: var(--def-bgr) url("/images/accessories/upload_await.gif") right 8px no-repeat;
}

span.img__status {
    max-width: 120px;
    overflow: hidden;
}

span.rm__image {
    cursor: pointer;
}

span.upload__ok {
    cursor: default;
}

iframe#file_upload, iframe#preview_upload {
    display: none;
}

/**** Edit form part ****/

div.image__edit__area, div.image__preview__titlebar {
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: nowrap;
    display: flex;
}

div.image__edit__parameters {
    margin: 7px 0 0;
}

.image__edit__parameters > p {
    padding: 2px 0 0 5pt;
    line-height: 1;
    color: var(--mmnu-abg);
    font: 400 9pt "PT Sans", sans-serif;
}

.image__edit__pad > h3, .image__preview__titlebar > h3 {
    margin: 0 2pt 6px;
    color: var(--dk-gr-cl);
    font-size: 11pt;
}

