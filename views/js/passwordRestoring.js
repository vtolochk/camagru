document.getElementById('forgot-form-wrapper').addEventListener("submit", function (event) {
    event.preventDefault();
    sendRequest();
});

function sendRequest() {
    let form = document.getElementById('forgot-form-wrapper')
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
        console.log(event.target.responseText);
        let obj = JSON.parse(event.target.responseText)
        let errorPlace = document.getElementsByClassName('error-message')
        if (obj.length == 0 || (obj.length == 1 && obj[0] === '')) {
            window.location.href = 'restore/request/email'
        } else {
            errorPlace[0].classList.add('error')
            errorPlace[0].innerHTML = obj[0]
        }
       console.log(obj[0])
    })
    XHR.open("POST", 'restore/request');
    XHR.send(formData)
  }
