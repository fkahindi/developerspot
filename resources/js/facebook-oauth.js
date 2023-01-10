$(document).ready(function() {
  var formError = $('.errorMsg');
  var pageSession = $('#page-session').val();
  var baseUrl = $('#base-url').val();

  $.ajaxSetup({ cache: true });

  $.getScript('https://connect.facebook.net/en_US/sdk.js', function(){
    FB.init({
      appId: '504038211760079',
      //For online
      //appId: '506047981483854',
      version: 'v15.0' // or v2.1, v2.2, v2.3, ...
    });

  });

  $('#login-button').click(function(){
    loginUser();
  });

  function loginUser(){
    FB.login(function(response) {
      if (response.authResponse) {
        if(response.status === 'connected'){
           getUserData();
        }else if(response.status === 'not_authorized') {
          formError.text('User cancelled login or not authorized.');
        }
      } else {
      formError.text('There was a problem');
      }
    }, {scope: 'public_profile,email'});
  }

  function getUserData() {
    FB.api('/me', {fields: 'first_name,name,email,picture'}, (response) => {
      let user = response;
      aJax(user);
    })
  }

  const aJax = async(data) => {
    await $.ajax({
        url: 'https://localhost/spexproject/includes/fb-login.php',
        //For online
        //url: 'https://www.developerspot.co.ke/includes/fb-login.php',
        type: 'post',
        data: data,
        success: function(response){
          if(response === 'success'){
            if(pageSession.trim().length !== 0){
              window.location.href = String(baseUrl + pageSession);
            }else{
              window.location.href ='https://localhost/spexproject/index.php';
              //For online
              //window.location.href ='https://www.developerspot.co.ke/index.php';
            }
          }else{
            formError.text('Login not successful.');;
          }
        }
    });
  }
});

/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser facebook-oauth.js --compress --mangle --output facebook-oauth.min.js"
*/