// bulk options
function toggle(source) {
  checkboxes = document.getElementsByClassName('check');
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = source.checked;
  }
}

function showPass() {
  var icon = document.querySelector('.pass-eye');
  const password = document.querySelector('#pass');

  if (password.type == 'password') {
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
    password.type = 'text';
  }
  else {
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
    password.type = 'password';
  }
}

function openNav() {
  let width = document.getElementById('sidenav').style.width;
  if (width == "0px")
    document.getElementById('sidenav').style.width = "150px";
  else
    document.getElementById('sidenav').style.width = "0px"
}

function hideAlert() {
  const el = document.querySelector('.alert');
  if (el)
    el.parentElement.removeChild(el);
};

// type is either 'success' or 'error'
function showAlert(type, msg, time = 2) {
  hideAlert();
  const markup = `<div class="alert alert--${type}">${msg}</div>`;
  //add alert at top of the body
  document.querySelector('body').insertAdjacentHTML('afterbegin', markup);
  window.setTimeout(hideAlert, time * 1000);  //multiply user sec with 1000 to conv to millisecs
};

// to lead voices array
document.addEventListener("DOMContentLoaded", function (event) {
  var voices = window.speechSynthesis.getVoices();
});
// as gogle cant speak lon texts so timeout for that
var myTimeout;
function myTimer() {
  window.speechSynthesis.pause();
  window.speechSynthesis.resume();
  myTimeout = setTimeout(myTimer, 10000);
}
// reading email func
function readEmail() {
  window.speechSynthesis.cancel();
  myTimeout = setTimeout(myTimer, 10000);
  var msg = new SpeechSynthesisUtterance();
  var voices = window.speechSynthesis.getVoices();
  msg.rate = 1.1;
  msg.volume = 0.5;
  msg.pitch = 0.9;
  msg.voice = voices[10];
  var body = document.querySelector('.sender-body').textContent;
  var subject = document.querySelector('.inbox-subject').textContent;
  var email = document.querySelector('.sender-name').textContent;
  msg.text = `this email is from: ${email}. Subject line is:  ${subject}. Message is: ${body}`;
  msg.onend = function () { clearTimeout(myTimeout); }
  window.speechSynthesis.speak(msg);
}

function stopread() {
  window.speechSynthesis.cancel();
}
