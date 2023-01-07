grecaptcha.ready(function() {
    grecaptcha.execute('6LelO4YgAAAAALww0mhkyM1VG0Mkf81PolDntSf3', {action: 'validate_captcha'}).then(function(token) {
        console.log(token);
       document.getElementById("token").value = token;
    });
    // refresh token every minute to prevent expiration
    setInterval(function(){
      grecaptcha.execute('6LelO4YgAAAAALww0mhkyM1VG0Mkf81PolDntSf3', {action: 'validate_captcha'}).then(function(token) {
        console.log( 'refreshed token:', token );
        document.getElementById("token").value = token;
      });
    }, 60000);

  });