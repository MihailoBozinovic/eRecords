(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1000);
    };
    spinner();
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });
})(jQuery);


function otvoriDiv(){
    $('#promena_sifre').show();
}
function zatvoriDiv(){
    $('#promena_sifre').hide();
}
function proveriSifru() {
    var sifra = $('#nova_sifra').val();
    var sifraConfirm = $('#sifra_confirm').val();
    var potvrda_sifre = document.getElementById('potvrda_sifre');
    if (sifra == sifraConfirm) {
        potvrda_sifre.innerHTML = '<strong style="color:green; text-align:center;"><i class="fa-regular fa-circle-check"></i></strong>';
        $('#potvrdi').prop('disabled', false);
    } else {
        potvrda_sifre.innerHTML = '<strong style="color:red; text-align:center;"><i class="fa-solid fa-xmark"></i></strong>';
        $('#potvrdi').prop('disabled', true);
    }
}

function rasporedLekara(id) {
    const id_lekara = $('#'+id).val();
    $.ajax({
        type: "GET",
        url: '/admin/termini-lekara',
        data: {
            'id_lekara' : id_lekara
        },
        dataType: "json",
        success: function(result) {
            $('#termini_body').empty();
            $.each(result.termini, function(key, item) {
                $('#termini_body').append(
                    '<tr>'+
                    '<td>'+ item.ime_lekara +'</td>'+
                    '<td>'+ item.tag +'</td>'+
                    '<td>'+ item.id_termin +'</td>'+
                    '<td>'+ item.ime_pacijenta +'</td>'+
                    '<td><strong>'+ item.vreme +'</strong></td>'+
                    '</tr>'
                );
            });
            $('#alert').hide();
            $('#tabelaTerminaDiv').show();
        },
        error: function(result) {
            console.log("Ne radi!");
        }
    });
}

function otvoriChatPacijent(id) {
    $('.aktivanRazgovor').hide();
    $('.aktivanRazgovor').removeClass('aktivanRazgovor');
    $('.aktivnePoruke').removeClass('aktivnePoruke');

    $('#konverzacija'+id).show();
    $('#konverzacija'+id).addClass('aktivanRazgovor');
    $('#poruke'+id).addClass('aktivnePoruke');
}

function otvoriChatLekar(id) {
    $('.aktivanRazgovor').hide();
    $('.aktivanRazgovor').removeClass('aktivanRazgovor');

    $('#konverzacija'+id).show();
    $('#konverzacija'+id).addClass('aktivanRazgovor');
}

function ucitajChatPacijent() {
    var id = $('.aktivnePoruke').data('id');

    $.ajax({
        type: "GET",
        url: "/patient/get-poruke",
        data: {
            id: id,
        },
        success: function(response) {
            $('#poruke' + id).empty();
            $.each(response.poruke, function(key, item) {
                if (item.id_slao == $('#id_posiljalac' + id).val()) {
                    $('#poruke'+ id).append(
                        '<div class="chat-messages p-4">'+
                            '<div class="chat-message-right pb-4">'+
                                '<div>'+
                                    '<img src="http://127.0.0.1:8000/img/user.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                                    '<div class="text-muted small text-nowrap mt-2">'+ item.vreme +'</div>'+
                                '</div>'+
                                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-right: 20px;">'+
                                    '<div class="font-weight-bold mb-1"><strong>Vi</strong></div>'+
                                    item.poruka+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $('#poruke'+ id).append(
                        '<div class="chat-messages p-4">'+
                            '<div class="chat-message-left pb-4">'+
                                '<div>'+
                                    '<img src="http://127.0.0.1:8000/img/doctor.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                                    '<div class="text-muted small text-nowrap mt-2">'+ item.vreme +'</div>'+
                                '</div>'+
                                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-left: 20px;">'+
                                    '<div class="font-weight-bold mb-1"><strong>'+ item.ime +'</strong></div>'+
                                    item.poruka +
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
                $('#brojPoruka'+id).text("0");
            });
        },
        error: function(response) {
            console.log(response);
        }
    });

    $(document).ready(function() {
        $('.aktivnePoruke').animate({
            scrollTop: $('.aktivnePoruke').get(0).scrollHeight * 10000
        }, 2000);
    });
}

function ucitajChatLekar() {
    var id = $('.aktivnePoruke').data('id');

    $.ajax({
        type: "GET",
        url: "/doctor/get-poruke",
        data: {
            id: id,
        },
        success: function(response) {
            $('#poruke' + id).empty();
            $.each(response.poruke, function(key, item) {
                if (item.id_slao == $('#id_posiljalac' + id).val()) {
                    $('#poruke'+ id).append(
                        '<div class="chat-messages p-4">'+
                            '<div class="chat-message-right pb-4">'+
                                '<div>'+
                                    '<img src="http://127.0.0.1:8000/img/doctor.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                                    '<div class="text-muted small text-nowrap mt-2">'+ item.vreme +'</div>'+
                                '</div>'+
                                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-right: 20px;">'+
                                    '<div class="font-weight-bold mb-1"><strong>Vi</strong></div>'+
                                    item.poruka+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $('#poruke'+ id).append(
                        '<div class="chat-messages p-4">'+
                            '<div class="chat-message-left pb-4">'+
                                '<div>'+
                                    '<img src="http://127.0.0.1:8000/img/user.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                                    '<div class="text-muted small text-nowrap mt-2">'+ item.vreme +'</div>'+
                                '</div>'+
                                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-left: 20px;">'+
                                    '<div class="font-weight-bold mb-1"><strong>'+ item.ime +'</strong></div>'+
                                    item.poruka+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
                $('#brojPoruka'+id).text("0");
            });
        },
        error: function(response) {
            console.log(response);
        }
    });

    $(document).ready(function() {
        $('.aktivnePoruke').animate({
            scrollTop: $('.aktivnePoruke').get(0).scrollHeight * 10000
        }, 2000);
    });
}

function slanjePoruke(event, id) {
    var key = event.which || event.keyCode;
    var id = $("#"+id).data('id');
    if (key == '13') {
      $("#slanjePoruke" + id).click();
      $("#poruka"+id).val('');
      $("#poruka"+id).attr("placeholder", "Poruka...");
    }
}