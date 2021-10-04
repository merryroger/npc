(fm) => {
    hideError();
    executePreviewDelete(imgURL, {!! $options['id'] !!}, 'images', reloadImageCollection);
    /*canClose = true;*/
    return false;
}
