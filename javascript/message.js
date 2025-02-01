document.addEventListener("DOMContentLoaded", function(){
        const sendBtn=document.getElementById('send-btn');
        const contactForm = document.querySelector("form");
        const validate=(event)=>{
            event.preventDefault();
            const fullName=document.getElementById('fname');
            const emailaddress=document.getElementById('email');
            const messages=document.getElementById('message');
    
            if(fullName.value.trim()===""){
                alert("Please enter your full name.");
                fullName.focus();
                return false;
            }
            const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,})$/;
            if(!emailRegex.test(emailaddress.value.trim())){
                alert("Please enter a valid Email.");
    
                emailaddress.focus();
                return false;
            }
            if(emailaddress.value.trim()!==emailaddress.value.trim().toLowerCase()){
            alert("Email must be in lowercase!");
            emailaddress.focus();
            return false;
        } 
        if(messages.value.trim()===""){
            alert("Please enter your message.");
            messages.focus();
            return false;
        }
        if(messages.value.trim().length<10){
            alert("Your message must be at least 10 characters long.");
            messages.focus();
            return false;
        }
        alert("Your message has been sent successfully!");
        contactForm.submit();
    };
    sendBtn.addEventListener("click",validate);
       
     });