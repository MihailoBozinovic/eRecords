const danas = new Date();

var godina = danas.getFullYear();

if (godina % 100 == 0 || godina % 400 == 0 || godina % 4 == 0){
    x = 29;
} else {
    x = 28;
}
meseci = ["Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"];
dMesec = [31, x, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
dani = ["Nedelja", "Ponedeljak", "Utorak", "Sreda", "Četvrtak", "Petak", "Subota"];

//          0           1           2          3        4           5       6

vreme = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
    '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00',
    '15:30', '16:00', '16:30', '17:00', '17:30'];


var danBroj = danas.getDay(); // vraca poziciju u nizu dani
var danDatum = danas.getDate(); // vraca danasnji datum
var mesecBroj = danas.getMonth(); // vraca poziciju u nizu meseci

var ime_lekara;
var lastTermin;

setupYearAndMonth(mesecBroj, godina);
setupCalendar(danBroj, danDatum, mesecBroj);

function setupYearAndMonth(mesecBroj, godina) {
    var monthAndYear = document.getElementById("monthAndYear");

    monthAndYear.innerHTML = meseci[mesecBroj] + ' | ' + godina;
}

if (danDatum - 1 <= danas.getDate()){
    $('#previous').prop('disabled', true);
} else {
    $('#previous').prop('disabled', false);
}

function next() {
    if (danDatum <= danas.getDate() - 1){
        $('#previous').prop('disabled', true);
    } else {
        $('#previous').prop('disabled', false);
    }
    var brojDanaUMesecu = dMesec[mesecBroj];
    if (danBroj < 6) {
        if (danDatum >= 1 && danDatum <= brojDanaUMesecu - 7) {
            danDatum += 1;
            danBroj += 1;
        }
        else {
            danDatum = 1;
            
            if (mesecBroj < 11 && mesecBroj > 0)
                mesecBroj += 1;
            else {
                mesecBroj = 0;
                godina += 1;
            }
        }
        setupCalendar(danBroj, danDatum, mesecBroj);
    } else {
        if (danDatum >= 1 && danDatum <= brojDanaUMesecu - 7) {
            danDatum += 1;
            danBroj = 0;
        }
        else {
            danDatum = 1;

            if (mesecBroj < 11 && mesecBroj > 0)
                mesecBroj += 1;
            else {
                mesecBroj = 0;
                godina += 1;
            }
        }
        setupCalendar(danBroj, danDatum, mesecBroj);
    }
    setupYearAndMonth(mesecBroj, godina);
}

function previous() {
    if (danDatum - 1 <= danas.getDate()){
        $('#previous').prop('disabled', true);
    } else {
        $('#previous').prop('disabled', false);
    }
    var brojDanaUMesecu = dMesec[mesecBroj];
    if (danBroj > 0) {
        if (danDatum > 1 && danDatum < brojDanaUMesecu - 7) {
            danDatum -= 1;
            danBroj -= 1;
        }
        else {
            if (mesecBroj < 11 && mesecBroj > 0)
                mesecBroj -= 1;
            else {
                mesecBroj = 0;
                godina -= 1;
            }
            brojDanaUMesecu = dMesec[mesecBroj];
            danDatum = brojDanaUMesecu - 6;
        }
        setupCalendar(danBroj, danDatum, mesecBroj);
    } else {
        danBroj = 6;
        if (danDatum > 1 && danDatum < brojDanaUMesecu - 7) {
            danDatum -= 1;
        }
        else {
            if (mesecBroj < 11 && mesecBroj > 0)
                mesecBroj -= 1;
            else {
                mesecBroj = 0;
                godina -= 1;
            }
            brojDanaUMesecu = dMesec[mesecBroj];
            danDatum = brojDanaUMesecu - 6;
        }
        setupCalendar(danBroj, danDatum, mesecBroj);
    }
    setupYearAndMonth(mesecBroj, godina);
}

function setupCalendar(danBroj, danDatum, mesecBroj) {
    var n = 7;

    let tmpDani = new Array(2*n);
    let tmpDatum = danDatum;

    for (var i = 0; i < n; i++) {
        tmpDani[i] = dani[i];
        tmpDani[n+i] = dani[i];
    }
    chead = document.getElementById('calendar-head');
    chead.innerHTML = "";
    cbody = document.getElementById('calendar-body');
    cbody.innerHTML = "";
    for (var j = danBroj; j < n + danBroj; j++, tmpDatum++) {
        $('#calendar-head').append(
            '<th>' +
            tmpDani[j] +
            '<br>' +
            tmpDatum +
            '</th>'
        );
        $('#calendar-body').append(
            '<td id="'+ tmpDani[j] + '-' + tmpDatum +'">' + 
            '</td>'
        ); 

        if (tmpDani[j] == 'Subota') {
            for (var k = 0; k < 10; k++) {
                if (k != 10) {
                    $('#Subota-' + tmpDatum).append(
                        '<button type="button" onclick="vremeDatum('+ (mesecBroj + 1) +',' + danBroj + ',' + tmpDatum + ',' + godina +',' + k + ', this.id);" class="btn btn-primary w-100" style="margin-bottom: 5px;" id="Subota-' + tmpDatum + '-' + k + '">' +
                        vreme[k] +
                        '</button>' + '<br>'
                    );
                }
            }
        } else if (tmpDani[j] == 'Nedelja') {
            $('#Nedelja-' + tmpDatum).append(
                '<p>' +
                'Nije dostupno!' +
                '</p>'
            );
        } else {
            for (var k = 0; k < 19; k++) {
                if (k != 19) {
                    $('#' + tmpDani[j] + '-' + tmpDatum).append(
                        '<button type="button" onclick="vremeDatum('+ (mesecBroj + 1) +',' + danBroj + ',' + tmpDatum + ',' + godina +',' + k + ', this.id);" class="btn btn-primary w-100" style="margin-bottom: 5px;" id="' + tmpDani[j] + '-' + tmpDatum + '-' + k + '">' +
                        vreme[k] +
                        '</button>' + '<br>'
                    );
                }
            }
        }
    }
}

function price(cena, id, vreme, usluga) {
    var c = parseInt(cena);

    var c_text = document.getElementById('cena');
    var c_vreme = document.getElementById('vreme_trajanja');
    var c_usluga = document.getElementById('usluga');

    var element = document.getElementById(id);
    const allElements = document.querySelectorAll('*');
    allElements.forEach((element) => {
        element.classList.remove('service_div_active');
    });

    c_text.innerHTML = "";
    c_vreme.innerHTML = "";
    c_usluga.innerHTML = "";

    element.classList.add('service_div_active');
    c_text.innerText = c + ",00 RSD";
    c_vreme.innerText = vreme + " min";
    c_usluga.innerText = usluga;

    $('#cenaInput').val(c);
    $('#vremeTrajanjaInput').val(vreme);
    $('#uslugaInput').val(usluga);
}



function vremeDatum(mesec, dan, datum, godina, k, id) {
    if (datum < 10) {
        datum = "0" + datum;
    }

    if (mesec < 10) {
        mesec = "0" + mesec;
    }

    terminID();
    setTimeout(() => {
        $('#id_termin').text("T-"+mesec+"-"+datum+"-"+lastTermin);
        $('#id').val("T-"+mesec+"-"+datum+"-"+lastTermin);
    }, 2000);

    $('#datum_vreme').text(String(vreme[k]) + " " + String(datum + "/" + mesec + "/" + godina));
    $('#lekar').text(ime_lekara);
    $('#datum').val(String(godina) + '-' + String(mesec) + '-' + String(datum) + " " + String(vreme[k]));
    $('#submit').prop('disabled', false);
    $('#vremeInput').val(vreme[k]);
    $('#k').val(k);
}

function loadSchedule(id_elementa) {
    const id_lekara = $('#'+id_elementa).val();
    $.ajax({
        type: "GET",
        url: '/patient/termini',
        data: {
            'id_lekara' : id_lekara
        },
        dataType: "json",
        success: function(result) {
            imeLekara(id_lekara);
            $('#id_lekar').val(id_lekara);
            $.each(result.termini, function(key, item) {
                var date = new Date(item.vreme_datum);

                var id = dani[date.getDay()] + "-" + date.getDate() + "-" + item.k;

                $('#' + id).prop('disabled', true);
            });
        },
        error: function(result) {
            console.log("Ne radi!");
        }
    });
}

function imeLekara(id_lekara) {
    $.ajax({
        type: "GET",
        url: '/patient/ime-lekara',
        data: {
            'id_lekara' : id_lekara
        },
        dataType: "json",
        success: function(result) {
            ime_lekara = result.lekar.name + " " + result.lekar.surname;
        },
        error: function(result) {
            console.log("Ne radi!");
        }
    });
}

function terminID() {
    $.ajax({
        type: "GET",
        url: '/patient/termin-id',
        dataType: "json",
        success: function(result) {
            lastTermin = result.termin.id + 1;
        },
        error: function(result) {
            console.log("Ne radi!");
        }
    });
}

