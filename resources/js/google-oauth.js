function handleCredentialResponse(response) {
  var formError = $('.errorMsg');
  var pageSession = $('#page-session').val();
  var baseUrl = $('#base-url').val();
  // decodeJwtResponse() is a custom function to decode the credential response.
  const responsePayload = decodeJwtResponse(response.credential);

  var id_token = response.credential;

  var xhr = new XMLHttpRequest();
  //For localhost
  xhr.open('POST', 'https://localhost/spexproject/includes/google-login.php');
  //For online
  //xhr.open('POST', 'https://www.developerspot.co.ke/includes/google-login.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    //console.log('Res is: '+xhr.responseText);
    if(xhr.responseText === 'success'){
      if(pageSession.trim().length !== 0){
        window.location.href = String(baseUrl + pageSession);
      }else{
        //For localhost
        window.location.href ='https://localhost/spexproject/index.php';
        //For online
        //window.location.href ='https://www.developerspot.co.ke/index.php';
      }
    }else{
      formError.text('Login was not successful.');;
    }
  };
  xhr.send('token=' + id_token);
}

function decodeJwtResponse (token) {
  var base64Url = token.split('.')[1];
  var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
      return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));

  return JSON.parse(jsonPayload);
}
/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser google-oauth.js --compress --mangle --output google-oauth.min.js"
*/