jQuery(document).ready(function($)
{
  var history = window.location.hash;

  $('.tex').text(history);
  if (window.history && window.history.pushState)
  {
    $(window).on('popstate', function()
    {
      var hashLocation = location.hash;
      var hashSplit = hashLocation.split("#!/");
      var hashName = hashSplit[1];

      if (hashName !== '')
      {
        var hash = window.location.hash;
        if (hash === '')
        {
          //window.location = history;
          window.location.history.back();
          return false;
        }
      }
    });
    window.history.pushState(null, null, window.location.href);
  }
});

$(".show-this-pass").on("click",function(e)
{
  e.preventDefault();

  var pass = $('input#password').prop('type');
  var gantitype   = pass=='password' ? 'text' : 'password';
  var ganticlass  = pass=='password' ? 'fa-eye-slash' : 'fa-eye';
  var title       = pass!='password' ? 'Tampilkan Password . . .' : 'Sembunyikan Password . . .';
  var removeClass = pass!='password' ? 'fa-eye-slash' : 'fa-eye';

  $('input#password').prop('type',gantitype);
  $(this).removeClass(removeClass).addClass(ganticlass).attr('title',title);
});

$(document).on('change','#form-register input[name=email]',function(e){
  e.preventDefault();
  var dataString  = $(this).serialize();
  validateregister(dataString,'email');
});

$(document).on('change','#form-register input[name=password]',function(e){
  e.preventDefault();
  var dataString  = $(this).serialize();
  validateregister(dataString,'password');
});

$(document).on('change','#form-register input[name=re-password]',function(e){
  e.preventDefault();
  var dataString  = $('#form-register').serialize();
  validateregister(dataString,'repass');
});

$(document).on('change','#form-register',function(e) {
  e.preventDefault();
  var dataString  = $('#form-register').serialize();
  $.ajax({
      type : "POST",
      url  : $("#verify").val(),
      dataType : "JSON",
      data : dataString,
      success: function(response)
      {
        if ( response.status == 'success') $('#register').attr('disabled','');
      }
  });
});

var email_verify    = 0;
var password_verify = 0;
var verify_repass   = 0;

function validateregister(dataString, pick)
{
  $.ajax({
      type : "POST",
      url  : $("#verify").val(),
      dataType : "JSON",
      data : dataString,
      success: function(response)
      {
        switch (pick) {
          case 'email':
            var emailAdd    = response.error_email === '' ? 'valid' : 'invalid';
            var emailRmv    = response.error_email === '' ? 'invalid' : 'valid';
            $("#error_email").html(response.error_email);
            $("input[name=email]").removeClass(emailRmv).addClass(emailAdd).prop('content','');
            email_verify = response.error_password === '' ? 1 : 0;
            break;

          case 'password':
            var passAdd    = response.error_password === '' ? 'valid' : 'invalid';
            var passRmv    = response.error_password === '' ? 'invalid' : 'valid';
            $("#error_password").html(response.error_password);
            $("input[name=password]").removeClass(passRmv).addClass(passAdd).prop('content','');
            password_verify = response.error_password === '' ? 1 : 0;
            break;

          case 'repass':
            var repassAdd    = response.error_repassword === '' ? 'valid' : 'invalid';
            var repassRmv    = response.error_repassword === '' ? 'invalid' : 'valid';
            $("#error_repassword").html(response.error_repassword);
            $("input[name=re-password]").removeClass(repassRmv).addClass(repassAdd).prop('content','');
            verify_repass = response.error_repassword === '' ? 1 : 0;
            break;

          case 'all':
            var emailAdd    = response.error_email === '' ? 'valid' : 'invalid';
            var emailRmv    = response.error_email === '' ? 'invalid' : 'valid';
            $("#error_email").html(response.error_email);
            $("input[name=email]").removeClass(emailRmv).addClass(emailAdd).prop('content','');

            var passAdd    = response.error_password === '' ? 'valid' : 'invalid';
            var passRmv    = response.error_password === '' ? 'invalid' : 'valid';
            $("#error_password").html(response.error_password);
            $("input[name=password]").removeClass(passRmv).addClass(passAdd).prop('content','');

            var repassAdd    = response.error_repassword === '' ? 'valid' : 'invalid';
            var repassRmv    = response.error_repassword === '' ? 'invalid' : 'valid';
            $("#error_repassword").html(response.error_repassword);
            $("input[name=re-password]").removeClass(repassRmv).addClass(repassAdd).prop('content','');

            return response.status;

            /*
            if ( response.status == 'success')
            {
              processregister(dataString);
            }
            */
            break;
        }

      }
  });
}


/*
$(document).on('change','#form-register',function(e){
  e.preventDefault();
  var dataString  = $(this).serialize();

  $.ajax({
      type : "POST",
      url  : $("#verify").val(),
      dataType : "JSON",
      data : dataString,
      success: function(response)
      {
        var emailAdd    = response.error_email === '' ? 'valid' : 'invalid';
        var emailRmv    = response.error_email === '' ? 'invalid' : 'valid';
        $("#error_email").html(response.error_email);
        $("input[name=email]").removeClass(emailRmv).addClass(emailAdd).prop('content','');

        var passAdd    = response.error_password === '' ? 'valid' : 'invalid';
        var passRmv    = response.error_password === '' ? 'invalid' : 'valid';
        $("#error_password").html(response.error_password);
        $("input[name=password]").removeClass(passRmv).addClass(passAdd).prop('content','');

        var repassAdd    = response.error_repassword === '' ? 'valid' : 'invalid';
        var repassRmv    = response.error_repassword === '' ? 'invalid' : 'valid';
        $("#error_repassword").html(response.error_repassword);
        $("input[name=re-password]").removeClass(repassRmv).addClass(repassAdd).prop('content','');

        var choice       = response.status== 'gagal' ? 'disabled' : '';

        $("button[name=submit]#register").removeClass('disabled');
        $("button[name=submit]#register").addClass(choice);
      }
  });
});

$(document).on('change','#form-validasicode',function(e){
  e.preventDefault();
  var dataString  = $(this).serialize();

  $.ajax({
      type : "POST",
      url  : $("#verify").val(),
      dataType : "JSON",
      data : dataString,
      success: function(response)
      {
        var emailAdd    = response.error_email === '' ? 'valid' : 'invalid';
        var emailRmv    = response.error_email === '' ? 'invalid' : 'valid';
        $("#error_email").html(response.error_email);
        $("input[name=email]").removeClass(emailRmv).addClass(emailAdd).prop('content','');

        var passAdd    = response.error_password === '' ? 'valid' : 'invalid';
        var passRmv    = response.error_password === '' ? 'invalid' : 'valid';
        $("#error_password").html(response.error_password);
        $("input[name=password]").removeClass(passRmv).addClass(passAdd).prop('content','');

        var repassAdd    = response.error_repassword === '' ? 'valid' : 'invalid';
        var repassRmv    = response.error_repassword === '' ? 'invalid' : 'valid';
        $("#error_repassword").html(response.error_repassword);
        $("input[name=re-password]").removeClass(repassRmv).addClass(repassAdd).prop('content','');

        var choice       = response.status== 'gagal' ? 'disabled' : '';

        $("button[name=submit]#register").removeClass('disabled');
        $("button[name=submit]#register").addClass(choice);
      }
  });
});
*/
$(document).on('change','#form-login',function(e){
  e.preventDefault();
  var dataString  = $(this).serialize();

  $.ajax({
      type : "POST",
      url  : $(this).prop('action'),
      dataType : "JSON",
      data : dataString,
      success: function(response)
      {
        var emailAdd    = response.error_email === '' ? 'valid' : 'invalid';
        var emailRmv    = response.error_email === '' ? 'invalid' : 'valid';
        $("#error_email").html(response.error_email);
        $("input[name=email]").removeClass(emailRmv).addClass(emailAdd).prop('content','');

        var passAdd    = response.error_password === '' ? 'valid' : 'invalid';
        var passRmv    = response.error_password === '' ? 'invalid' : 'valid';
        $("#error_password").html(response.error_password);
        $("input[name=password]").removeClass(passRmv).addClass(passAdd).prop('content','');
      }
  });
});
