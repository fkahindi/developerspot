grecaptcha.ready(function() {
    grecaptcha.execute('MY SITE KEY', {action: 'validate_captcha'}).then(function(token) {
        //console.log(token);
       document.getElementById("token").value = token;
    });
    // refresh token every minute to prevent expiration
    setInterval(function(){
      grecaptcha.execute('MY SITE KEY', {action: 'validate_captcha'}).then(function(token) {
        //console.log( 'refreshed token:', token );
        document.getElementById("token").value = token;
      });
    }, 60000);

  });