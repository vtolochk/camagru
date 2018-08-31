let forgotPass = document.getElementsByClassName('forgot-pass')
let form = document.getElementById('sign-in-form')
let button = document.getElementsByClassName('login-button')
let text = document.getElementById('text')
let signUp = document.getElementById('sign-up')
let wrapper = document.getElementsByClassName('sign-in-wrapper')

let loginInput = document.getElementById('login-input')
let emailInput = document.getElementById('email-input')
let passInput = document.getElementById('pass-input')
let rePassInput = document.getElementById('re-pass-input')
let errorDiv = document.getElementById('error')

document.addEventListener("DOMContentLoaded", function(event) { 
    function toggleRegistrationForm () {
        if (button[0].value === 'Sign In') {
        
            let input = document.getElementById('email-input')
            input.required = true;
            input = document.getElementById('re-pass-input')
            input.required = true;
            text.innerHTML = 'Already registered?'
            signUp.innerHTML = 'Sign In'
            form.action = 'signup'
            button[0].style.marginTop = '25px'
            button[0].value = 'Sign Up'
            forgotPass[0].style.display = 'none'
            for (let i = 0; i < form.children.length; i++) {
                    form.children[i].classList.remove('disappear')
            }
        } else {
            let passDoesntMatch = document.getElementById('error')
            passDoesntMatch.style.visibility = 'hidden'
            passDoesntMatch.style.opacity = '0'
            passInput.classList.remove('error')
          
            let email = document.getElementById('email-div')
            email.classList.add('disappear')
            email = document.getElementById('email-input')
            email.classList.add('disappear')
            email.required = false
    
            let rePass = document.getElementById('re-pass-div')
            rePass.classList.add('disappear')
            rePass = document.getElementById('re-pass-input')
            rePass.classList.add('disappear')
            rePass.required = false
    
            text.innerHTML = "Don't have an account?"
            signUp.innerHTML = 'Sign Up'
            form.action = 'signin'
            button[0].style.marginTop = '0px'
            button[0].value = 'Sign In'
            forgotPass[0].style.display = 'block'
        }
    }   

    document.getElementById('sign-up').addEventListener('click', toggleRegistrationForm)
    document.getElementById('sign-in-form').addEventListener("submit", function (event) {
        event.preventDefault();
        sendRequest();
      });
})

function validateRegister(text) {
    let i = 0
    let obj = JSON.parse(text)
    while (obj[i] === '') {
        i++
    }
    if (i === obj.length) {
        showSuccess()
    } else {
        showErrors(obj[i], i)
    }
}

function validateLogin(text) {
    console.log(text)
    //window.location.href = '/';
}

function sendRequest() {
    let form = document.getElementById('sign-in-form')
    let action = form.action.split('/')
    action = action[action.length - 1]
    var XHR = new XMLHttpRequest()
    var formData = new FormData(form)
    XHR.addEventListener("load", function(event) {
        if (action === 'signup') {
            validateRegister(event.target.responseText)
        } else {
            validateLogin(event.target.responseText)
        }
    })
    XHR.open("POST", action);
    XHR.send(formData)
  }

  function showSuccess () {
    removeErrorClass()
    addSuccessClass()
    errorDiv.style.visibility = 'hidden'
    errorDiv.style.opacity = '0'
    removeEverything();
  }

  function removeEverything() {
      let forHome = document.getElementsByClassName('sign-up-wrapper')
      let form = document.getElementsByClassName('form-wrapper')
      let home = document.createElement('a');
      home.classList.add('homeA')
      home.href = '/'
      form[0].style.display = 'none'
      signUp.style.display = 'none'
      text.innerHTML = 'To finish the registration confirm you email via link that was send to your email.'
      text.style.textAlign = 'center'
      home.innerHTML = 'Home page'
      forHome[0].classList.add('afterRegister')
      forHome[0].appendChild(home)
  }

  function showErrors (obj, i) {
    if (i === 0) {
        removeErrorClass()
        loginInput.classList.add('error')
    } else if (i === 1) {
        removeErrorClass()
        emailInput.classList.add('error')
    } else if (i === 2) {
        removeErrorClass()
        passInput.classList.add('error')
        rePassInput.classList.add('error')
    }
    errorDiv.style.visibility = 'visible'
    errorDiv.style.opacity = '1'
    errorDiv.innerHTML = obj
  }

  function addSuccessClass() {
    loginInput.classList.add('success')
    emailInput.classList.add('success')
    passInput.classList.add('success')
    rePassInput.classList.add('success')
  }

  function removeErrorClass() {
    loginInput.classList.remove('error')
    emailInput.classList.remove('error')
    passInput.classList.remove('error')
    rePassInput.classList.remove('error')
  }