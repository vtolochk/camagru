document.getElementById('forgot-form-wrapper').addEventListener("submit", function (event) {
    event.preventDefault();
    sendRequest();
});

function sendRequest() {
    let form = document.getElementById('forgot-form-wrapper')
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
       console.log(event.target.responseText)
    })
    XHR.open("POST", 'restore/request');
    XHR.send(formData)
  }
