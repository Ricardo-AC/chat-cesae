$(document).ready(function () {
   $("#loginModal").modal('show');
});
$("#signInBt").click(function () {
   $("#loginModal").modal('hide');
   $("#signInModal").modal('show');
});
$("#backLoginBt").click(function () {
   $("#loginModal").modal('show');
   $("#signInModal").modal('hide');
});
$("#confirmSignInBT").click(function () {
   if (document.getElementById("form-password1").value == document.getElementById("form-password2").value) {
      document.getElementById("signInform").submit();
   } else {
      alert("Passwords diferentes");
   }
});








