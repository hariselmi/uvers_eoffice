
$(function () {
    // initializing select 2
    $('#auditor_id, #auditee_id, #semester_period, #academic_year, #member_one, #member_two').select2({
        width:'100%'
    });

    //initializing datatable
    // $('#myTable').DataTable({});
});

// change role change related permissions
function onChange() {
    var roleId = $("#role_id").val();
    var url = site_url + '/allpermissions' + '/' + roleId;
    $.get(url);
}

// check permissions check all if checked
function checkPermissions(elem) {
    var boxCheck = $(elem).parents();
    if($(elem).is(":checked")){
        boxCheck.children('div.box-body').children('p').children('input').attr('checked', 'checked');
    } else {
        boxCheck.children('div.box-body').children('p').children('input').removeAttr('checked');
    }
}

// check all permissons is checked
function checAllkPermissions(elem) {
    var boxCheckLen = $(elem).parents().children('div.box-body').children('p').children('input').length;
    var boxCheckedLen = $(elem).parents().children('div.box-body').children('p').children('input:checked').length;
    if (parseInt(boxCheckLen) === parseInt(boxCheckedLen)) {
        $(elem).parents().children('div.box-header').children('input').attr('checked', true);
    } else {
        $(elem).parents().children('div.box-header').children('input').attr('checked', false);
    }
}


// Installation page style

var x = document.getElementById('error_alert');
var y = document.getElementById('close_alert');
if ( y !== null) {
    y.onclick = function() {
        x.style.display = "none";
    };
}
function checkEnvironment(val) {
    var element=document.getElementById('environment_text_input');
    if(val=='other') {
        element.style.display='block';
    } else {
        element.style.display='none';
    }
}
function showDatabaseSettings() {
    document.getElementById('tab2').checked = true;
}
function showApplicationSettings() {
    document.getElementById('tab3').checked = true;
}


function closeEl(removeParentDiv='', removeClass='') {
    $(removeParentDiv).removeClass("in");
    $(removeParentDiv).hide();
    $(".modal-backdrop").remove();
}

function calculateTotal(elem) {
    var curForm = $(elem).parents("form");
    var qty = curForm.find("#qty").val();
    // console.log(qty);
    var unit_price = curForm.find("#unit_price").val();
    var payment = curForm.find("#payment").val();
    var total_price = 0;
    var due = 0;
    if(typeof qty !== 'undefined' && typeof unit_price !== 'undefined') {
        total_price = parseFloat(qty) * parseFloat(unit_price);
        if(! Number.isNaN(total_price)) {
            curForm.find("#total_price").text(total_price);
        }
        if(typeof payment !== 'undefined') {
            // console.log('payment '+payment);
            due = parseFloat(total_price) - parseFloat(payment);
            if( ! Number.isNaN(due)) {
                curForm.find("#dues").text(due);
            }
        }
    }
}

$("#start_date, #end_date").datepicker({
    changeMonth:true,
    changeYear:true,
    yearRange:'1970:+0',
    dateFormat:'yy-mm-dd',
});

function onclickTextChange(id, value)
{
    $("#"+id).text(value);
}

function onclickHide(id){
	$("#"+id).hide();
}

function submitWithConfirm(id, message='Are you sure?') {
	var rConfirm = confirm(message);
    if (rConfirm) {
		$(id).submit();
	}
}

function submitOnEnter(id) {
	if (event.which == '13') {
		event.preventDefault();
		$(id).submit();
	} 
}