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

