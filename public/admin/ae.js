$("body").on("click", ".saveCompose", function (e) {
  e.preventDefault()

  $(".c_element_row").each(function (index) {
    $(this)
      .find(".c_0")
      .attr("name", "task_detail[" + (index - 1) + "]")
    $(this)
      .find(".c_1")
      .attr("name", "task_stat[" + (index - 1) + "]")
    $(this)
      .find(".c_2")
      .attr("name", "task_year[" + (index - 1) + "]")
    $(this)
      .find(".c_3")
      .attr("name", "task_state[" + (index - 1) + "]")
  })
})

$("body").on("click", ".saveCompose2", function (e) {
  e.preventDefault()

  $(".c_element_row").each(function (index) {
    $(this)
      .find(".c_1")
      .attr("name", "year[" + (index - 1) + "]")
    $(this)
      .find(".c_2")
      .attr("name", "value[" + (index - 1) + "]")
    $(this)
      .find(".c_3")
      .attr("name", "type[" + (index - 1) + "]")
  })
})

$("body").on("click", ".addtoStat", function (e) {
  e.preventDefault()
  var action = AE_ADM_URL + "/task/accept/" + $(this).data("id")

  $.get(action, function (data) {
    ntf("Дані були успішно збережені", "info")
    location.reload()
  })
})

$(".ae_submit").click(function (e) {
  $(this).closest("form").submit()
})

$(document).ready(function () {
  $(".summernote").each(function (index) {
    $(this).summernote("code")
  })
})

function ntf(msg, type) {
  var type = typeof type !== "undefined" ? type : "info"
  $.notify(
    { message: msg },
    { type: type, placement: { from: "bottom", align: "right" } }
  )
}

function summernoteCall() {
  $(".summernote").each(function (index) {
    var v = $(this).summernote("code")
    var f = $(this).data("f")
    $("#" + f).val(v)
  })
}

/* AE Dynamic SaveMdl */
function saveMdl(action, datastring) {
  $.ajax({
    type: "POST",
    url: action,
    data: datastring,
    dataType: "json",

    success: function (data) {
      if (data.state !== 1) {
        console.log("data", data);
        ntf("Помилка при збереженні. 02.", "danger")
      } else {
        ntf("Дані були успішно збережені", "info")

        if (data.create_type == "NEW") {
          window.location.href =
            AE_ADM_URL + "/" + data.url + "/edit/" + data.model_id
        }
      }
    },

    error: function (data) {
      console.log("data", data);
      ntf("Помилка при збереженні", "danger")
    },
  })
}

$("body").on("click", ".statApi", function (e) {
  e.preventDefault()
  $.ajax({
    type: "GET",
    url: $(this).data("href"),
    success: function (d) {
      ntf("Дані були синхронізовані.", "info")
      location.reload()
    },
    error: function () {
      ntf("error.js.ae-ma", "danger")
    },
  })
})

$("body").on("click", ".statApiAll", function (e) {
  e.preventDefault()
  $.ajax({
    type: "GET",
    url: $(this).data("href"),
    success: function (d) {
      ntf("Дані були синхронізовані.", "info")
      location.reload()
    },
    error: function () {
      ntf("error.js.ae-ma", "danger")
    },
  })
})

$("body").on("click", ".saveSubForm", function (e) {
  e.preventDefault()
  summernoteCall()
  var $f = $(this).closest("form")
  var datastring = $f.serialize()
  var action =
    AE_ADM_URL + "/@/$form/" + $(this).data("f") + "/" + $(this).data("id")
  saveMdl(action, datastring)
})

$("body").on("click", ".saveRoute", function (e) {
  e.preventDefault()
  summernoteCall()

  var $f = $(this).closest("form")
  var datastring = $f.serialize()
  var action =
    AE_ADM_URL + "/@/$route/" + $(this).data("f") + "/" + $(this).data("id")
  saveMdl(action, datastring)
})

$("body").on("click", ".ae_delete_item", function (e) {
  e.preventDefault()
  var m = $(this).data("m")
  var id = $(this).data("id")
  var data =
    "<p><b>Ви впевнені що хочете усунути запис?</b></p><br>" +
    "<div class='row'> <div class='col-md-12' style='text-align:center;'><a hreh='#' class='btn btn-lg btn-primary ae_delete_no'>Ні</a> <a hreh='#' class='btn btn-lg btn-warning ae_delete_yes' data-m='" +
    m +
    "' data-id='" +
    id +
    "'>Так</a></div></div></div>"
  $("#aeModal").html(data)
  $("#aeSysModal").modal("show")
})

$("body").on("click", ".ae_delete_no", function (e) {
  $("#aeSysModal").modal("hide")
})

$("body").on("click", ".ae_delete_yes", function (e) {
  $("#aeSysModal").modal("hide")

  var m = $(this).data("m")
  var id = $(this).data("id")
  var u = AE_ADM_URL + "/@/$delete/" + m + "/" + id

  mdlAction(u)

  $(".row" + id).html("")
})

function mdlAction(action) {
  $.ajax({
    type: "GET",
    url: action,
    success: function (data) {
      $("#aeModal").html(data)
      load_mdl()
    },
    error: function () {
      ntf("error.js.ae-ma", "danger")
    },
  })
}

$("body").on("click", ".c_add_element", function (e) {
  e.preventDefault()
  var element = $(".ae_elements_0").clone()
  element.removeClass("ae_elements_0")
  $(".c_element_rows").append(element)
})

$("body").on("click", ".c_delete_element", function (e) {
  e.preventDefault()
  $(this).closest(".c_element_row").remove()
})
