document.getElementById('restoring-password-form').addEventListener("submit", function (event) {
    event.preventDefault();
    sendAjaxRequest();
});

function sendAjaxRequest(e) {
    let form = document.getElementById('restoring-password-form')
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
        console.log(event.target.responseText)
        let obj = JSON.parse(event.target.responseText)
        let errorPlace = document.getElementsByClassName('errorDiv')
        if (obj.length == 0 || (obj.length == 1 && obj[0] === '')) {
            errorPlace[0].classList.remove('errors')
            errorPlace[0].classList.add('success')
            errorPlace[0].innerHTML = 'Success'
            setTimeout(function(){ 
                 window.location.href = '/' }, 1200);
               
        } else {
            errorPlace[0].classList.add('errors')
            errorPlace[0].innerHTML = obj[0]
        }
    })
    XHR.open("POST", '/restore/request/password-form-data');
    XHR.send(formData)
  }
