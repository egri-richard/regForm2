let correctUsn = false
let correctPass = false
let correctRePass = false

function showText() {
    let text = document.getElementById("regSuccess")
    text.style.visibility = "visible"
}

function checkForm() {
    console.log(correctUsn)
    console.log(correctPass)
    console.log(correctRePass)

    if (correctUsn && correctPass && correctRePass) {
        showText()
    }
}

function comparePass() {
    let pass = document.getElementById("pass").value
    let rePass = document.getElementById("rePass").value
    let errorMess = document.getElementById("passCheckDisplay")
    let rePassField = document.getElementById("rePassField")

    if(pass != rePass) {
        rePassField.classList.add("error")
        errorMess.innerHTML = "A két jelszó nem egyezik"
        correctRePass = false
    } else {
        rePassField.classList.remove("error")
        errorMess.innerHTML = ""
        correctRePass = true
    }
}

function passIC() {
    let passCount = document.getElementById("pass").value.length
    let passCounterDisplay = document.getElementById("passCounter")
    let passField = document.getElementById("passField")
    
    passCounterDisplay.innerHTML = `${passCount}/8`

    if(passCount < 8) {
        passField.classList.add("error")
        correctPass = false
    } else {
        passField.classList.remove("error")
        correctPass = true
    }
}

function usernIC() {
    let usnCount = document.getElementById("usern").value.length
    let usnCountDisplay = document.getElementById("usernCounter")
    let usnField = document.getElementById("userField")

    usnCountDisplay.innerHTML = `${usnCount}/20`

    if(usnCount > 20) {
        usnField.classList.add("error")
        correctUsn = false
    } else {
        usnField.classList.remove("error")
        correctUsn = true
    }
}

function init() {
    document.getElementById("usern").addEventListener("input", usernIC)
    document.getElementById("pass").addEventListener("input", passIC)
    document.getElementById("rePass").addEventListener("focusout", comparePass)
    document.getElementById("submit").addEventListener("click", checkForm)
}

document.addEventListener("DOMContentLoaded", init)