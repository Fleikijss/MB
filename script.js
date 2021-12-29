let checkbox = document.querySelector('.checkbox'),
    submitBtn = document.getElementById('submits');

document.getElementById("text").onclick = function() {onInput()};
document.getElementById("myForm").oninput = function() {onChange()};

function onInput() {
let     demo = document.getElementById('demo'),
        email = document.forms['form']['email'].value;
    if (email == '') {
        demo.innerHTML = 'Email address ir required';
    }
}

function onChange () {
let symbols = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    mail = document.getElementById('text').value,
    email = document.forms['form']['email'].value, 
    checkbox = document.querySelector('.checkbox');

    if (email == '') {
        demo.innerHTML = 'Email address ir required';
    }
    else if (!mail.match(symbols)) {
        demo.innerHTML = 'Please provide a valid e-mail address';
    }
    else if (email.endsWith('.co')) {  
        demo.innerHTML = 'We are not accepting subscriptions from Colombia emails';
    } 
    else if (checkbox.checked === false) {  
        demo.innerHTML = 'You must accept terms and conditions';  
    } 
    if (mail.match(symbols) && !email.endsWith('.co') && checkbox.checked === true) {
        demo.innerHTML = '';
        submitBtn.disabled = false;
    }  else {
        submitBtn.disabled = true;
    }  
}

document.getElementById('content-block').addEventListener('submit', function (event) {

    this.style.display = 'none';
    document.getElementById('content-subscribing').style.display = 'block';
    event.preventDefault();
    showHint();
});


function showHint() {
    let email = document.forms['form']['email'].value,
        data = {
        email : email, 
        checkbox : true},
        xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST","subscribe.php",true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        }
      };
    
    xmlhttp.setRequestHeader("Content-type", "application/json")
      
      xmlhttp.send(JSON.stringify(data));
}


  