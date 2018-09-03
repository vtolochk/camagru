document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById('settings-form').addEventListener("submit", function (event) {
        event.preventDefault();
        sendRequest();
      });
})

// function validateRegister(text) {
//     let i = 0
//     let obj = JSON.parse(text)
//     while (obj[i] === '') {
//         i++
//     }
//     if (i === obj.length) {
//         showSuccess()
//     } else {
//         showErrors(obj[i], i)
//     }
// }

// function validateLogin(text) {
//     let i = 0
//     let obj = JSON.parse(text)
//     if (obj.length === undefined) {
//         window.location.href = '/';
//     } else {
//         errorDiv.style.visibility = 'visible'
//         errorDiv.style.opacity = '1'
//         errorDiv.innerHTML = obj[0]
//     }
// }

function sendRequest() {
    let form = document.getElementById('settings-form')
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
        let obj = JSON.parse(event.target.responseText)
        let errorDiv = document.getElementById('error')
        if (obj.length == 0) {
            //success
            alert('success');
        } else {
            errorDiv.style.visibility = 'visible'
            errorDiv.style.opacity = '1'
            errorDiv.innerHTML = obj[0]
        }
        console.log(obj.length)
    })
    XHR.open("POST", 'settings/save');
    XHR.send(formData)
  }
