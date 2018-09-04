document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById('settings-form').addEventListener("submit", function (event) {
        event.preventDefault();
        sendRequest();
      });
})

function sendRequest() {
    let form = document.getElementById('settings-form')
    let oldPass = document.getElementById('old_pass')
    let newPass = document.getElementById('new_pass') 
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
        let obj = JSON.parse(event.target.responseText)
        let errorDiv = document.getElementsByClassName('errorDiv')
        if (obj.length == 0 || (obj.length == 1 && obj[0] === '')) {
            oldPass.value = ''
            newPass.value = ''
            errorDiv[0].classList.remove('errors')
            errorDiv[0].classList.add('success')
            errorDiv[0].innerHTML = 'Saved'
        } else {
            errorDiv[0].classList.remove('success')
            errorDiv[0].classList.add('errors')
            errorDiv[0].innerHTML = obj[0]
        }
    })
    XHR.open("POST", 'settings/save');
    XHR.send(formData)
  }
