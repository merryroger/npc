'use strict';

let AJAX = (function () {

    let _post = post.bind(this);
    let _response = response.bind(this);
    let _recipient;

    let _ajax = {
        post: (url, params, cbf) => {
            _post(url, params, cbf);
        },
        response: (rsp) => {
            _response(rsp.target);
        }
    }

    function initXHTML() {
        let _xhr;
        if (window.XMLHttpRequest) {
            _xhr = new XMLHttpRequest();
            if (_xhr.overrideMimeType)
                _xhr.overrideMimeType('application/json;charset=UTF-8');

            return _xhr;
        }

        if (window.ActiveXObject) {
            try {
                _xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    _xhr = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    return false;
                }
            }

            return _xhr;
        }

        return false;
    }

    function post(url, params, cbf) {
        let xhr = initXHTML();
        if (xhr === false)
            return false;

        _recipient = cbf;
        xhr.onreadystatechange = _ajax.response;
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(params);
    }

    function response(rsp) {
        if (rsp.readyState == 4) {
            if (rsp.status == 200) {
                _recipient(rsp.responseText);
            } else if (rsp.status > 0) {
                console.log(rsp.status, ': ', rsp.statusText);
            } else {
                console.log('Ajax request error');
            }
        }
    }

    return _ajax;

})();
