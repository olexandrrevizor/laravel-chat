;(function () {
    var socket = io.connect('http://localhost:8890'),
        form = document.querySelector('#formMessage'),
        error = document.querySelector('#errorMessage'),
        messages = document.querySelector('#messages');

    socket.on('message', function (data) {
        var p = document.createElement('p');
        data = JSON.parse(data);

        p.innerHTML = data.message;
        p.classList.add('new-message');
        messages.appendChild(p);
    });

    if (!form) {
        console.error('Message form not found');
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var target = e.target,
            xhr = new XMLHttpRequest(),
            xhrResponse;

        xhr.open(
            target.getAttribute('method'),
            target.getAttribute('action'),
            true
        );

        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(
            '_token=' + target._token.value + '&' +
            'message=' + target.message.value
        );

        xhr.onreadystatechange = function() {
            error.innerText = '';
            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                target.message.value = '';
            } else {
                /*xhrResponse = JSON.parse(xhr.response);
                 error.innerText = xhrResponse.error;*/
            }
        };
    });
})();
