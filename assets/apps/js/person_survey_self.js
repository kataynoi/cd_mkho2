$(document).ready(function () {
  $("#from_province").select2();
  $(".datepicker")
    .datepicker({
      format: "dd/mm/yyyy",
      todayBtn: false,
      language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true, //Set เป็นปี พ.ศ.
      autoclose: true,
    })
    .datepicker("setDate", "0");
  $("#date_in").datepicker();
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/person_survey/del_person_survey",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/person_survey_self/save_person_survey_self",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/person_survey/get_person_survey",
      params = {
        id: id,
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
  get_person_by_cid: function (cid, cb) {
    var url = "/person_survey/get_person_by_cid",
      params = {
        cid: cid,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },

  //
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

crud.save = function (items, row_id) {
  crud.ajax.save(items, function (err, data) {
    if (err) {
      //app.alert(err);
      swal("");
    } else {
      $("#frmModal").modal("toggle");
      swal(
        "บันทึกข้อมูลเรียบร้อยแล้วค่ะ อย่าลืมเว้นระยะห่าง สวมหน้ากากอนามัย ล้ามมือบ่อยๆนะคะ"
      );
      //console.log(data);
      location.reload();

      //window.location.href = site_url+"/person_survey_self/capture";
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
  $("#btn_save").attr("disabled", true);
  var action;
  var items = {};
  var row_id = $("#row_id").val();
  items.action = $("#action").val();
  // items.brand_name = $("#brand option:selected").text();
  items.id = $("#id").val();
  items.d_update = $("#d_update").val();
  items.cid = $("#cid").val();
  items.name = $("#name").val();
  items.age = $("#age").val();
  items.tel = $("#tel").val();
  items.from_conutry = $("#from_conutry").val();
  items.from_province = $("#from_province").val();
  items.date_in = $("#date_in").val();
  items.no = $("#no").val();
  items.moo = $("#moo").val();
  items.villagecode = $("#villagecode").val();
  items.tambon = $("#tambon").val();
  items.ampur = $("#ampur").val();
  items.province = $("#province").val();
  items.in_family = $("#in_family").val();
  items.comment = $("#comment").val();
  items.risk1 = $("input[name='risk1']:checked").val();
  items.risk2 = $("input[name='risk2']:checked").val();
  items.risk3 = $("input[name='risk3']:checked").val();
  items.risk4 = $("input[name='risk4']:checked").val();
  items.risk5 = $("input[name='risk5']:checked").val();
  items.risk6 = $("input[name='risk6']:checked").val();
  items.risk7 = $("input[name='risk7']:checked").val();
  items.risk8 = $("input[name='risk8']:checked").val();
  items.risk9 = $("input[name='risk9']:checked").val();
  items.risk10 = $("input[name='risk10']:checked").val();

  if (validate(items)) {
    //console.log(items);
    crud.save(items, row_id);
  }
});

$("#add_data").on("click", function (e) {
  e.preventDefault();
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);
  app.clear_form();
});

function validate(items) {
  //console.log(items);
  if (items.name == "") {
    swal("กรุณาระบุชื่อ สกุล");
    $("#name").focus();
    $("#btn_save").attr("disabled", false);
  } else if (items.from_province == "") {
    swal("กรุณาระบุมาจากจังหวัด");
    $("#from_province").focus();
    $("#btn_save").attr("disabled", false);
  } else if (items.date_in == "") {
    swal("กรุณาระบุวันเดินทางเข้า");
    $("#date_in").focus();
    $("#btn_save").attr("disabled", false);
  } else if (items.ampur == "") {
    swal("กรุณาระบุอำเภอ");
    $("#ampur").focus();
    $("#btn_save").attr("disabled", false);
  } else if (items.tambon == "") {
    swal("กรุณาระบุตำบล");
    $("#tambon").focus();
    $("#btn_save").attr("disabled", false);
  } else if (items.moo == "") {
    swal("กรุณาระบุหมู่บ้าน");
    $("#moo").focus();
    $("#btn_save").attr("disabled", false);
  } else if (!items.in_family) {
    swal("กรุณาระบุคนในครอบครัว");
    $("#in_family").focus();
    $("#btn_save").attr("disabled", false);
  } else {
    return true;
  }
}
$("#ampur").on("change", function () {
  var amp = $(this).val();
  crud.get_tambon_list(amp);
});
$("#tambon").on("change", function () {
  var tambon = $(this).val();
  crud.get_moo_list(tambon);
});
$("#moo").on("change", function () {
  var villagecode = $(this).find(":selected").data("villagecode");
  console.log(villagecode);
  $("#villagecode").val(villagecode);
});

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
            v.villagename +
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
crud.get_person_by_cid = function (cid) {
  crud.ajax.get_person_by_cid(cid, function (err, data) {
    if (!err) {
      if (data.check) {
        swal("บุคคลนี้บันทึกข้อมูลในระบบแล้ว");
        app.clear_form();
      } else if (data.rows) {
        $("#cid").val(data.rows["CID"]);
        $("#name").val(data.rows["NAME"] + " " + data.rows["LNAME"]);
        $("#no").val(data.rows["addr"]);
        $("#age").val(data.rows["age_y"]);
        $("#ampur").val(data.rows["vhid"].substring(0, 4));
        if (crud.get_tambon_list(data.rows["vhid"].substring(0, 4))) {
          $("#tambon").val(data.rows["vhid"].substring(0, 6));
        }
      } else {
        $("#name").focus();
      }
    }
  });
};

$("#cid").on("keyup", function () {
  var cid = $("#cid").val();
  if (cid.length == 13) {
    // alert(cid);
    crud.get_person_by_cid(cid);
  }

  //
});
