document.addEventListener("DOMContentLoaded", function(event) { 

    function toggleRegistrationForm () {
        let forgotPass = document.getElementsByClassName('forgot-pass')
        let form = document.getElementById('sign-in-form')
        let button = document.getElementsByClassName('login-button')
        let text = document.getElementById('text')
        let signUp = document.getElementById('sign-up')
        let wrapper = document.getElementsByClassName('sign-in-wrapper')
    
       
        if (button[0].value === 'Sign In') {
            wrapper[0].classList.add('big-margin-top')
            let input = document.getElementById('email-input')
            input.required = true;
            input = document.getElementById('re-pass-input')
            input.required = true;
            text.innerHTML = 'Already registered?'
            signUp.innerHTML = 'Sign In'
            form.action = 'register'
            button[0].style.marginTop = '25px'
            button[0].value = 'Sign Up'
            forgotPass[0].style.display = 'none'
            for (let i = 0; i < form.children.length; i++) {
                    form.children[i].classList.remove('disappear')
            }
        } else {
            wrapper[0].classList.remove('big-margin-top')
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
            form.action = 'register'
            button[0].style.marginTop = '0px'
            button[0].value = 'Sign In'
            forgotPass[0].style.display = 'block'
        }
    }   

    document.getElementById('sign-up').addEventListener('click', toggleRegistrationForm)
    document.getElementById('pass-input').addEventListener("change", checkPasswords);
    document.getElementById('re-pass-input').addEventListener("change", checkPasswords);
})


function checkPasswords() {
    if (!document.getElementById('re-pass-input').classList.contains('disappear')) {
        let form = document.getElementById('sign-in-form')
        let passInput = document.getElementById('pass-input')
        let rePassInput = document.getElementById('re-pass-input')
        let warningMessage = document.getElementById('passwords-doesnt-match')

        if (passInput.value == rePassInput.value) {
            passInput.classList.remove('error')
            rePassInput.classList.remove('error')
            passInput.classList.add('success')
            rePassInput.classList.add('success')
            warningMessage.style.visibility = 'hidden'
            warningMessage.style.opacity = '0'
          } else {
            warningMessage.style.visibility = 'visible'
            warningMessage.style.opacity = '1'
            passInput.classList.remove('success')
            rePassInput.classList.remove('success')
            passInput.classList.add('error')
            rePassInput.classList.add('error')
            return false
          }
    }
}