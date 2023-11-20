let path = window.location.pathname;
if (path == '/admin/screenix/srce') {
    pacijenti();
}

$(function () {
    $("#pacijenti_list").select2({
        theme: "classic"
    });
});


let circularProgress = document.querySelector(".circular-progress");
let progressValue = document.querySelector(".progress-value");
var progressStartValue = -1;
var progressEndValue = 0;
var speed = 100;

function pacijenti() {
    $.ajax({
        type: "GET",
        url: "/admin/pacijenti_tabela",
        dataType: "json",
        success: function (result) {
            $.each(result.pacijenti, function (key, item) {
                $('#pacijenti_list').append(
                    '<option value="' + item.id + '">' +
                    item.ime + ' ' + item.prezime + ' | ' + item.jmbg +
                    '</option>'
                );
            });
        },
        error: function (result) {
            console.log("Ne radi");
        }
    });
}

function merePacijenta(id_pacijenta) {
    $.ajax({
        type: "GET",
        url: '/admin/mere_pacijenta',
        dataType: "json",
        data: {
            'id': id_pacijenta,
        },
        success: function (result) {
            if (result.mere != null) {
                $('#godine').val(result.godine);
                $('#godine').prop('disabled', true);

                $('#visina').val(result.mere.visina);
                $('#visina').prop('disabled', true);

                $('#tezina').val(result.mere.tezina);
                $('#tezina').prop('disabled', true);

                $("#pol").val(result.pol).change();
                $("#pol").prop('disabled', true);

                $("#mere_unos").prop('disabled', true);
                $("#korak1").show();
                var progress = setInterval(() => {
                    progressStartValue++;
                    progressValue.textContent = `${progressStartValue}%`
                    circularProgress.style.background = `conic-gradient(#009cff ${progressStartValue * 3.6}deg, #fff 0deg)`
                    if (progressStartValue == result.rizik) {
                        clearInterval(progress);
                    }
                }, speed);
            }
        }, error: function (result) {
            console.log("Ne radi!");
        }
    })
}

function disableSelect() {
    $('#izbor_pacijenta').hide();
    $('#pacijenti_list').prop('disabled', true);
    $('#weight_height').show();

    var id_pacijenta = $('#pacijenti_list').find(':selected').val();

    merePacijenta(id_pacijenta);
}

function posetePritisak() {
    $("#weight_height").hide();
    $("#posete_pritisak").show();
}

var progress = setInterval(() => {
    progressStartValue++;
    progressValue.textContent = `${progressStartValue}%`
    circularProgress.style.background = `conic-gradient(#009cff ${progressStartValue * 3.6}deg, #fff 0deg)`
    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }
}, speed);