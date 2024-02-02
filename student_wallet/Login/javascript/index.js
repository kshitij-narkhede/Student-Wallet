//Sign Up data
var name=document.getElementById("name")
console.log(sign_name)
var dob=document.getElementById("dob")
console.log(sign_DOB)
var age=document.getElementById("age")
console.log(age)
var bloodgroup=document.getElementById("bloodgroup")

var gender=document.getElementById("gender")

var phno=document.getElementById("phoneNumber")
var email=document.getElementById("exampleInputEmail1")
var userpass=document.getElementById("password")
var cnfpass=document.getElementById("password2")

// Login data
var Aadharnum=document.getElementById("Aadhar")
var log_pass=document.getElementById("exampleInputPassword1")

function sendMail() {
    var params = {
      // name: document.getElementById("name").value,
      email1: document.getElementById("email1").value,
      email2: document.getElementById("email2").value,
      email3: document.getElementById("email3").value,
      // message: document.getElementById("message").value,
    };
  
    const serviceID = "service_x7hmstk";
    const templateID = "template_0rtaw3r";
  
      emailjs.send(serviceID, templateID, params)
      .then(res=>{
          // document.getElementById("name").value = "";
          document.getElementById("email1").value = "";
          document.getElementById("email2").value = "";
          document.getElementById("email3").value = "";
          // document.getElementById("message").value = "";
          console.log(res);
          alert("Your message sent successfully!!")
  
      })
      .catch(err=>console.log(err));
  
  }
  
  