(fm) => {
    hideError();
    @php($page = (isset($options['page']) && $options['page']) ? intval($options['page']) : 1)
    executeImageDelete(imgURL, {!! $options['id'] !!}, {!! $page !!}, 'images', reloadImageCollection);
    /*canClose = true;*/
    return false;
}
