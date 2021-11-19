$(document).ready(function () {
  var crud = {};
  $("#btn_login_moph_ic").on("click", function () {
    crud.login_moph_ic();
  });
  $("#btn_check_vaccine").on("click", function () {
    crud.check_vaccine();
  });

  crud.login_moph_ic = function () {
    var username = $("#username").val();
    var password = $("#password").val();
    var hospcode = $("#hospcode").val();
    $.ajax({
      method: "GET",
      url: "https://cvp1.moph.go.th/token",
      dataType: "json",
      data: {
        Action: "get_moph_access_token",
        user: username,
        password_hash: password,
        hospital_code: hospcode,
      },
      success: function (data) {
        $("#token").val(data);
        window.localStorage.setItem("token_moph_ic", data);
        //console.log(data);
      },
      error: function (status) {
        console.log("Error occured");
      },
    });
  };

  crud.check_vaccine = function () {
    var token = $("#token").val();
    var cid = $("#cid").val();
    $.ajax({
      method: "GET",
      url: "https://cloud4.hosxp.net/api/moph/ImmunizationHistory",
      dataType: "json",
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token_moph_ic"),
        "Access-Control-Allow-Origin": "*",
      },
      data: {
        cid: cid,
      },
      success: function (data) {
        console.log(data);
      },
      error: function (status) {
        console.log("Error occured");
      },
    });
  };
});
