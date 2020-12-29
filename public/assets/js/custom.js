/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  

//input form
$('#form').submit(function (e) {
  e.preventDefault();

  var formData = new FormData($("#form")[0]);
  
  $.ajax({
    url: $("#form").attr('action'),
    type: 'post',
    data: formData,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {
      if (response.success === true) {
        $("#form")[0].reset();
        $('#myModal').modal('hide');
        $(".text-danger").remove();

        if (typeof (response.redirect) !== 'undefined') {
          document.location.href = response.redirect;
        } 
        else
        {          
          dataTable.ajax.reload();
        }

      } else {
        $.each(response.messages, function (key, value) {
          var element = $('#' + key);          
          element.removeClass('is-invalid')
            .addClass(value.length > 0 ? 'is-invalid' : 'valid');
          element.closest('div.form-group')
            .find('.text-danger').remove();
          element.after(value);
        });
      }
    }
  });
});


$(document).ready(function () {
  $('#tabel').DataTable();
});


var uri = $(".lap").attr("id");
var dataTable = $('.lap').DataTable({  
  paging: false,
  info: false,
  info : false,
  ordering : false,
  dom: 'Bfrtip',
  buttons: [ 
    { extend: 'pdf', className: 'btn-primary' },
    { extend: 'print', className: 'btn-primary' }
   ],
  ajax: {
    url: uri,
    method: "POST",
  }
});
dataTable.buttons().container()
.appendTo( '.lap_wrapper .col-md-6:eq(0)' );


var uri = $(".tabel").attr("id");
var dataTable = $('.tabel').DataTable({    
  info: false,  
  ajax: {
    url: uri,
    method: "POST",
  }
});


function nomor() {

  new AutoNumeric('#price', {
    currencySymbol: 'Rp ',
    digitGroupSeparator: '.',
    decimalPlaces: '0',
    decimalCharacter: ','
  });
}

 
//up 
$(document).on("click", ".up", function (e) {
  var id = $(this).attr("id");
  var uri = $(this).attr("uri");
  bootbox.confirm("Are you sure update status and create account ?", function (result) {
    if (result) {

      $.ajax({
        url: uri,
        method: "POST",
        data: {
          Id: id
        },
        success: function (data) {
          iziToast.success({
            title: 'Update successfully',
            message: data,
            position: 'topRight'
          });
          dataTable.ajax.reload();
        }
      });

    }
  });
});


//send
$(document).on("click", ".edit", function (e) {  
  var id = $(this).attr("id");
  var currentRow = $(this).closest("tr")[0]; 
  var cells      = currentRow.cells;
  var nam    = cells[1].textContent;  

  $('#myModal').modal('show');
  $("#id").val(id);
  $("#name").val(nam);

});


//delete
$(document).on("click", ".del", function (e) {

  var id = $(this).attr("id");
  var uri = $(this).attr("uri");
  e.preventDefault();
  bootbox.confirm("Are you sure delete ?", function (result) {
    if (result) {

      $.ajax({
        url: uri,
        method: "POST",
        data: {
          Id: id
        },        
        success: function (data) {
          iziToast.success({
            title: 'Delete successfully',
            message: data,
            position: 'topRight'
          });
          dataTable.ajax.reload();
        }
      });

    }
  });
});


$("#pac").on("change", function (e) {
  e.preventDefault();
  var uri = $(this).attr('uri');
  var option = $('option:selected', this).val();

  $.getJSON(uri + "/" + option, function (data) {
    $.each(data, function (i, field) {

      $("#pa").html(field.service_name);
      $("#pr").html(field.pr);
      $("#sp").html(field.service_speed);
      $("#tim").html(field.service_time);


    });
  });
});

$("#temp").on("change", function (e) {
  e.preventDefault();
  var d = $(this).val();

  if (d == 1) {
    $("#tang").removeClass('d-none');
  } else {
    $("#tang").addClass('d-none');
  }


});

