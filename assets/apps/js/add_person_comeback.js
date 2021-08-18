$(document).ready(function () {
  //$("#prov").select2();

  var birth = $("#birth").val();
  var travel_date = $("#travel_date").val();
  var lab_date = $("#lab_date").val();
  $(".datepicker").datepicker({
    format: "dd/mm/yyyy",
    todayBtn: false,
    language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true, //Set เป็นปี พ.ศ.
    autoclose: true,
  });
  if (travel_date) {
    $("#travel_date").datepicker("setDate", travel_date);
  }
  if (lab_date) {
    $("#lab_date").datepicker("setDate", lab_date);
  }
});

var crud = {};

crud.ajax = {
  save: function (items, cb) {
    var url = "/person_comeback/save_person_comeback",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save_org: function (items, cb) {
    var url = "/person_comeback/save_org",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/person_comeback/get_person_comeback",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_person_by_cid: function (cid, cb) {
    var url = "/person_comeback/get_person_by_cid",
      params = {
        cid: cid,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_ampur_list: function (provcode, cb) {
    var url = "/basic/get_ampur_list",
      params = {
        provcode: provcode,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_tambon_list: function (amp, cb) {
    var url = "/basic/get_tambon_list",
      params = {
        amp: amp,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_moo_list: function (code, cb) {
    var url = "/basic/get_moo_list",
      params = {
        code: code,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
};

crud.del_data = function (id) {
  crud.ajax.del_data(id, function (err, data) {
    if (err) {
      swal(err);
    } else {
      //swal('ลบข้อมูลเรียบร้อย')
      app.alert("ลบข้อมูลเรียบร้อย");
    }
  });
};

crud.save = function (items) {
  crud.ajax.save(items, function (err, data) {
    if (err) {
      //app.alert(err);
      //swal(err);
      //window.location = site_url + "/person_comeback";
      history.go(-1);
    } else {
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      //window.location = site_url + "/person_comeback";
      history.go(-1);
    }
  });
};

crud.get_update = function (id, row_id) {
  crud.ajax.get_update(id, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
      //location.reload();
      crud.set_update(data, row_id);
    }
  });
};

$("#btn_save").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  items.action = $("#action").val();
  // items.brand_name = $("#brand option:selected").text();
  items.id = $("#id").val();
  items.prov = $("#prov").val();
  items.ampur = $("#ampur").val();
  items.tambon = $("#tambon").val();
  items.moo = $("#moo").val();
  items.no = $("#no").val();
  items.cid = $("#cid").val();
  items.prename = $("#prename").val();
  items.name = $("#name").val();
  items.lname = $("#lname").val();
  items.sex = $("#sex").val();
  items.birth = $("#birth").val();
  items.age_y = $("#age_y").val();
  items.tel = $("#tel").val();
  items.weight = $("#weight").val();
  items.chronic = $("#chronic").val();

  items.lab_type = $("#lab_type").val();
  items.lab_date = $("#lab_date").val();
  items.travel_date = $("#travel_date").val();
  items.travel_type = $("#travel_type").val();
  items.travel_status = $("#travel_status").val();
  items.note = $("#note").val();
  items.symptom = $("#symptom").val();
  items.process_status = $("#process_status").val();
  items.tel = $("#tel").val();

  items.hospcode = $("#hospcode").val();
  items.hospname = $("#hospcode").find(":selected").html();

  if (validate(items)) {
    crud.save(items);
  }
});

$("#add_data").on("click", function (e) {
  e.preventDefault();
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);
  $("#action").val("insert");
  app.clear_form();
});

function validate(items) {
  if (!items.name) {
    swal("กรุณาระบุชื่อ");
    $("#name").focus();
  } else if (!items.lname) {
    swal("กรุณาระบุนามสกุล");
    $("#lname").focus();
  }
  if (!items.tel || items.tel.length != 10) {
    swal("กรุณาระบุเบอร์โทรให้ถูกต้อง");
    $("#tel").focus();
  } else if (!items.prov) {
    swal("กรุณาระบุจังหวัด");
    $("#prov").focus();
  } else if (!items.ampur) {
    swal("กรุณาระบุอำเภอ");
    $("#amp").focus();
    // }
    // else if (items.lab_type >= 3 && !items.lab_date) {
    //// swal("กรุณาระบุวันที่ตรวจ Lab");
    // $("#amp").focus();
  } else if (!items.process_status) {
    swal("กรุณาระบุสถานะดำเนินการ");
    $("#process_status").focus();
  } else {
    return true;
  }
}

$("#cid").on("keyup", function () {
  var cid = $("#cid").val();
  if (cid.length == 13) {
    // alert(cid);
    crud.get_person_by_cid(cid);
  }

  //
});
crud.get_person_by_cid = function (cid) {
  crud.ajax.get_person_by_cid(cid, function (err, data) {
    $("#provchange").val("0");
    if (!err) {
      if (data.check) {
        swal("บุคคลนี้บันทึกข้อมูลในระบบแล้ว");
        app.clear_form();
        return;
      } else if (data.rows) {
        $("#cid").val(data.rows["CID"]);
        $("#prename").val(data.rows["PRENAME"]);
        $("#name").val(data.rows["NAME"]);
        $("#lname").val(data.rows["LNAME"]);
        $("#birth").val(data.rows["BIRTH"]);
        $("#sex").val(data.rows["SEX"]);
        $("#no").val(data.rows["addr"]);
        $("#age_y").val(data.rows["age_y"]);
        $("#hospcode").val(data.rows["HOSPMAIN"]);
        $("#hsub").val(data.rows["HOSPCODE"]);
        //$("#age").val(data.rows["age_y"]);
        $provcode = data.rows["vhid"].substring(0, 2);
        $amp = data.rows["vhid"].substring(0, 4);
        $tambon = data.rows["vhid"].substring(0, 6);
        $moo = data.rows["vhid"];
        crud.get_ampur_list($provcode);
        crud.get_tambon_list($amp);
        crud.get_moo_list($tambon);
        $(document).ajaxStop(function () {
          $check_provchange = $("#provchange").val();
          if ($check_provchange == 0) {
            $("#prov").val($provcode);
            $("#ampur").val($amp);
            $("#tambon").val($tambon);
            $("#moo").val($moo);
          }
        });
      } else {
        $("#name").focus();
      }
    }
  });
};
crud.get_ampur_list = function (provcode) {
  $("#ampur").empty();

  crud.ajax.get_ampur_list(provcode, function (err, data) {
    if (!err) {
      $("#ampur").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#ampur").append(
          '<option value="' + v.ampurcodefull + '">' + v.ampurname + "</option>"
        );
      });
    }
  });
};
crud.get_tambon_list = function (ampcode) {
  $("#tambon").empty();

  crud.ajax.get_tambon_list(ampcode, function (err, data) {
    if (!err) {
      $("#tambon").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#tambon").append(
          '<option value="' +
            v.tamboncodefull +
            '">' +
            v.tambonname +
            "</option>"
        );
      });
    }
  });
};

crud.get_moo_list = function (code) {
  $("#moo").empty();

  crud.ajax.get_moo_list(code, function (err, data) {
    if (!err) {
      $("#moo").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#moo").append(
          '<option value="' +
            v.villagecodefull +
            '" data-villagecode="' +
            v.villagecodefull +
            '">' +
            v.villagecode +
            ":" +
            v.villagename +
            "</option>"
        );
      });
    }
  });
};

$("#prov").on("change", function () {
  var prov = $(this).val();
  $("#provchange").val("1");
  crud.get_ampur_list(prov);
});
$("#ampur").on("change", function () {
  var amp = $(this).val();
  $("#provchange").val("1");
  crud.get_tambon_list(amp);
});
$("#tambon").on("change", function () {
  var tambon = $(this).val();
  $("#provchange").val("1");
  crud.get_moo_list(tambon);
});
$("#new_regis").on("click", function () {
  $("#alert").hide();
  app.clear_form();
  $("#register").show();
  $("#hos_regis").html("");
  $("#q").html("");
});

$("#birth").on("change", function () {
  var birth = $(this).val();
  var age_y = app.count_age_date_thai(birth);
  //alert(age_y);
  $("#age_y").val(age_y);
});
/*
$("#lab_date").on("click", function () {
  var date_now = app.date_now_thai();
  $("#lab_date").val(date_now);
});
$("#travel_date").on("click", function () {
  var date_now = app.date_now_thai();
  $("#travel_date").val(date_now);
});
*/
$(".btn-toggle").click(function () {
  $(this).find(".btn").toggleClass("active");

  if ($(this).find(".btn-primary").length > 0) {
    $(this).find(".btn").toggleClass("btn-primary");
  }
  if ($(this).find(".btn-danger").length > 0) {
    $(this).find(".btn").toggleClass("btn-danger");
  }
  if ($(this).find(".btn-success").length > 0) {
    $(this).find(".btn").toggleClass("btn-success");
  }
  if ($(this).find(".btn-info").length > 0) {
    $(this).find(".btn").toggleClass("btn-info");
  }

  $(this).find(".btn").toggleClass("btn-default");
});
function checkProcessStatus() {
  let cid = $("#cid").val();
  let tel = $("#tel").val();
  let amp = $("#ampur").val();
  let lab = $("#lab").val();
  let travel_status = 0;

  return travel_status;
}
