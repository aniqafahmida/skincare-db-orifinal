



document.getElementById("password").addEventListener("submit", checkInput);

function checkInput(form){
   
const last_name = document.getElementById('last_name');
    
var password = document.getElementById('password');

var upper =  document.getElementById('upper')
var lower =  document.getElementById('lower')
var num =  document.getElementById('num')
var len =  document.getElementById('length')
var special =  document.getElementById('special')

    if(password.value.match(/[0-9]/)) {
        num.style.color = 'green'
    
    }
    
    else {
        num.style.color = 'red'
    }
    
    if(password.value.match(/[A-Z]/)) {
        upper.style.color = 'green'
    }
    
    else {
        upper.style.color = 'red'
    }
    
    if(password.value.match(/[a-z]/)) {
        lower.style.color = 'green'
    }
    
    else {
        lower.style.color = 'red'
    }
    if(password.value.match(/[!\@\#\$\%\^\&\*\(\)\_\<\-\>\.\,]/)) {
        special.style.color = 'green'
       
    }
    
    else {
        special.style.color = 'red'
    }
    
    if (password.value.length >= 8) {
        len.style.color = 'green'
    }
    else {
        len.style.color = 'red'
    }
}