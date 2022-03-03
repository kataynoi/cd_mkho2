$(document).ready(function () {
  $("#btn_login").removeAttr("disabled");
  //User namespace
  var users = {};
  users.ajax = {
    do_auth: function (username, password, cb) {
      var url = "/user/do_auth",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
    do_auth_org: function (username, password, cb) {
      var url = "/user/do_auth_org",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
    do_auth_hospital: function (username, password, cb) {
      var url = "/user/do_auth_hospital",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },

    do_auth_comeback: function (username, password, cb) {
      var url = "/user/do_auth_comeback",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
    do_auth_asm: function (username, password, cb) {
      var url = "/user/do_auth_asm",
        params = {
          username: username,
          password: password,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
    do_auth_mobile: function (tel, cb) {
      var url = "/user/do_auth_mobile",
        params = {
          tel: tel,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
    regis_auth_mobile: function (tel, name, cb) {
      var url = "/user/regis_auth_mobile",
        params = {
          tel: tel,
          name: name,
        };
      app.ajax(url, params, function (err, data) {
        err ? cb(err) : cb(null, data);
      });
    },
  };

  users.do_auth = function (username, password) {
    users.ajax.do_auth(username, password, function (err, data) {
      if (err) {
        swal(err);
      } else {
        if (data.success) {
          swal("Login Success");
          window.location = base_url;
        }
      }
    });
  };
  users.do_auth_org = function (username, password) {
    users.ajax.do_auth_org(username, password, function (err, data) {
      if (err) {
        swal(err);
      } else {
        if (data.success) {
          //swal('Login Success');
          if (data.org) {
            window.location = site_url + "/whitelist_organization";
          } else {
            window.location = site_url + "/whitelist_organization/set_org";
          }
        }
      }
    });
  };

  users.do_auth_hospital = function (username, password) {
    users.ajax.do_auth_hospital(username, password, function (err, data) {
      if (err) {
        swal(err);
      } else {
        if (data.success) {
          //swal('Login Success');
          window.location = site_url + "/whitelist_person";
        }
      }
    });
  };

  users.do_auth_comeback = function (username, password) {
    users.ajax.do_auth_comeback(username, password, function (err, data) {
      if (err) {
        swal(err);
      } else {
        if (data.success) {
          //swal('Login Success');
          window.location = site_url + "/person_comeback";
        }
      }
    });
  };
  users.do_auth_asm = function (username, password) {
    users.ajax.do_auth_asm(username, password, function (err, data) {
      if (err) {
        //swal(err);
        window.location = site_url + "/person_asm";
      } else {
        if (data.success) {
          //swal('Login Success');
          window.location = site_url + "/person_asm";
        }
      }
    });
  };

  users.do_auth_mobile = function (tel) {
    users.ajax.do_auth_mobile(tel, function (err, data) {
      if (err) {
        swal("เบอร์โทรไม่ถูกต้อง หรือหาก ยังไม่เคยลงทะเบียยน กรุณาลงทะเบียน");
        $("#frm_login").hide();
        $("#frm_register").show();
      } else {
        if (data.success) {
          swal("Login Success");
          window.location = site_url + "/person_survey";
        }
      }
    });
  };

  users.regis_auth_mobile = function (tel, name) {
    users.ajax.regis_auth_mobile(tel, name, function (err, data) {
      if (err) {
        swal(err);
      } else {
        if (data.success) {
          swal("ลงทะเบียนสำเร็จ");
          window.location = site_url + "/person_survey";
        }
      }
    });
  };

  $("#btn_login").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var username = $("#username").val();
    var password = $("#password").val();
    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth(username, password);
  });

  $("#btn_login_org").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var username = $("#username").val();
    var password = $("#password").val();

    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth_org(username, password);
  });

  $("#btn_login_hospital").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var username = $("#username").val();
    var password = $("#password").val();

    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth_hospital(username, password);
  });

  $("#btn_login_comeback").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var username = $("#username").val();
    var password = $("#password").val();

    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth_comeback(username, password);
  });
  $("#btn_login_asm").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var username = $("#username").val();
    var password = $("#password").val();

    if (!username || !password) {
      swal("ระบุ Username Password ให้ครบถ้วน");
      return false;
    }
    users.do_auth_asm(username, password);
  });
  $("#btn_login_mobile").on("click", function (e) {
    e.preventDefault();
    console.log("click");
    var tel = $("#tel").val();
    if (!tel || tel.length != 10) {
      swal("ระบุ เบอร์โทร ให้ครบถ้วน");
      return false;
    }
    users.do_auth_mobile(tel);
  });
  //regis_login_mobile

  $("#regis_login_mobile").on("click", function (e) {
    e.preventDefault();

    var tel = $("#tel_reg").val();
    if (!tel || tel.length != 10) {
      swal("ระบุ เบอร์โทร ให้ครบถ้วน");
      return false;
    }
    var name = $("#name").val();
    users.regis_auth_mobile(tel, name);
  });
  $("#btn_show_reg").on("click", function (e) {
    $("#frm_login").hide();
    $("#frm_register").show();
  });

  $("#password").bind("keypress", function (e) {
    var username = $("#username").val();
    var password = $("#password").val();
    console.log("enter login");
    if (e.keyCode == 13) {
      users.do_auth(username, password);
    }
  });

  $("#btn_forget_pass").on("click", function () {
    $("#frm_login").hide();
    $("#frm_forgot_pass").show();
  });

  $("#send_mail_forget_pass").on("click", function (e) {
    e.preventDefault();
    var email = $("#txt_repass_email").val();
    if (!email) {
      app.alert("กรุณากรอกรหัสผ่าน");
      email.focus();
    } else {
      users.ajax.send_mail_forget_pass(email, function (err, data) {
        //console.log(data);
        if (err) {
          app.alert(err);
        } else {
          if (data.success) {
            app.alert("ส่งข้อมูลไป ที่" + email + " แล้ว กรุณาตรวจสอบ ");
          } else {
            app.alert("Email นี้ไม่มีอยู่ในระบบ");
          }
        }
      });
    }
  });
  $("#btn_back").on("click", function () {
    $("#frm_login").show();
    $("#frm_forgot_pass").hide();
  });
  $("#frm_login").on("submit", function (e) {
    return users.check_login();
  });

  $("#btn_save_pass").on("click", function () {
    var items = {};
    items.user_id = $("#user_id").val();
    items.password = $("#newPass").val();
    items.repassword = $("#rePass").val();
    if (!items.password) {
      app.alert("กรุณาระบุ หรัสผ่าน");
      $("#newPass").focus();
    } else if (items.password.length < 4) {
      app.alert("กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร");
      $("#newPass").focus();
    } else if (!items.repassword) {
      app.alert("กรุณาระบุการยืนยันรหัสผ่าน");
      $("#rePass").focus();
    } else if (items.repassword.length < 4) {
      app.alert("กรุณาระบุการรหัสผ่าน มากกว่า 4 ตัวอักษร");
      $("#rePass").focus();
    } else if (items.password != items.repassword) {
      app.alert("การยืนยันรหัสผ่านไม่ตรงกัน");
      $("#rePass").focus();
    } else {
      users.save_password(items.user_id, items.password);
    }
  });

  $("#btn_save_edit_user").on("click", function () {
    var items = {};
    items.id = $("#id").val();
    items.name = $("#name").val();
    items.cid = $("#cid").val();
    items.email = $("#email").val();
    items.user_mobile = $("#user_mobile").val();
    items.username = $("#username").val();

    items.nickname = $("#nickname").val();
    items.office = $("#office").val();
    items.position = $("#position").val();
    if (!items.name) {
      app.alert("กรุณาระบุ ชื่อสกุล");
      $("#name").focus();
    } else if (items.cid.length < 13) {
      app.alert("กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง");
      $("#newPass").focus();
    } else if (!items.email) {
      app.alert("กรุณาระบุ email");
      $("#email").focus();
    } else if (!items.username) {
      app.alert("กรุณาระบุ Username");
      $("#username").focus();
    } else {
      users.save_edit_user(items);
    }
  });

  $("#btn_save_register").on("click", function () {
    var items = {};
    items.id = $("#id").val();
    items.name = $("#name").val();
    items.email = $("#email").val();
    items.user_mobile = $("#user_mobile").val();
    items.username = $("#username").val();
    items.password = $("#password").val();
    items.nickname = $("#nickname").val();
    items.office = $("#office").val();
    items.sys_id = $("#sys_id").val();
    if (!items.name) {
      app.alert("กรุณาระบุ หน่วยบริการ");
      $("#name").focus();
    } else if (!items.email) {
      app.alert("กรุณาระบุ email");
      $("#email").focus();
    } else if (!items.username) {
      app.alert("กรุณาระบุ Username");
      $("#username").focus();
    } else if (!items.password) {
      app.alert("กรุณาระบุ Password");
      $("#password").focus();
    } else if (items.password.length < 4) {
      app.alert("กรุณาระบุ Password มากกว่า 4 ตัวอักษร");
      $("#password").focus();
    } else {
      users.save_register(items);
    }
  });
  $("#btn_request").on("click", function () {
    // app.alert('Request');
    var items = {};
    items.username = $("#txt_username").val();
    items.password = $("#txt_password").val();

    if (!items.username) {
      alert("กรุณาระบุชื่อผู้ใช้งาน");
      //app.alert('กรุณาระบุชื่อผู้ใช้งาน');
      $("#btn_login").removeProp("disabled");
      return false;
    } else if (!items.password) {
      alert("กรุณาระบุรหัสผ่าน");
      //app.alert('กรุณาระบุรหัสผ่าน');
      $("#btn_login").removeProp("disabled");
      return false;
    } else {
      users.ajax.request_use_system(
        items.password,
        items.username,
        sys_id,
        function (err, data) {
          //console.log(data);
          if (err) {
            app.alert(
              "การร้องขอใช้งาน ไม่สำเร็จ อาจเนื่องมาจาก    Username Password ไม่ถูกต้อง หรือ ท่านมีชื่ออยู่ในระบบนี้แล้ว "
            );
            //app.alert(err);
          } else {
            app.alert(
              "ทำการร้องขอใช้ ระบบ เรียบร้อยแล้ว จะส่งผลการอนุมัติการใช้ระบบไปทาง Email "
            );
          }
        }
      );
    }
  });
});
