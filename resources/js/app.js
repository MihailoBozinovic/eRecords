import './bootstrap';
import './libs/trix';

window.posaljiPoruku = function(id) {
    var poruka = $('#poruka'+id).val();
    var ime = $("#ime"+id).val(); 
    var id_posiljalac = $('#id_posiljalac'+id).val();
    var id_primalac = $('#id_primalac'+id).val();
    const options = {
        method: 'post',
        url: '/posalji-poruku',
        data: {
            ime: ime,
            poruka: poruka,
            id_posiljalac: id_posiljalac,
            id_primalac: id_primalac,
            id_chat: id,
        },
        trasnformResponse: [(data)=>{
            return data;
        }]
    }
    axios(options);
    $('#poruka'+id).val('');
}

var id = $('.aktivnePoruke').data('id');
var poruke = document.getElementById('poruke'+id);

window.Echo.channel('chat-'+id).listen('.message', (e) => {
    if (e.id_posiljaoca != $('#id_posiljalac'+id).val()) {
        poruke.innerHTML +=
        '<div class="chat-messages p-4">'+
            '<div class="chat-message-left pb-4">'+
                '<div>'+
                    '<img src="https://e-karton.rs/img/doctor.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                    '<div class="text-muted small text-nowrap mt-2">'+ e.vreme +'</div>'+
                '</div>'+
                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-left: 20px;">'+
                    '<div class="font-weight-bold mb-1"><strong>'+ e.ime +'</strong></div>'+
                    e.poruka+
                '</div>'+
            '</div>'+
        '</div>';
        $('.aktivnePoruke').animate({
            scrollTop: $('.aktivnePoruke').get(0).scrollHeight * 10000
        }, 2000);
    } else {
        poruke.innerHTML +=
        '<div class="chat-messages p-4">'+
            '<div class="chat-message-right pb-4">'+
                '<div>'+
                    '<img src="https://e-karton.rs/img/doctor.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
                    '<div class="text-muted small text-nowrap mt-2">'+ e.vreme +'</div>'+
                '</div>'+
                '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="margin-right: 20px;">'+
                    '<div class="font-weight-bold mb-1"><strong>Vi</strong></div>'+
                    e.poruka+
                '</div>'+
            '</div>'+
        '</div>';
        $('.aktivnePoruke').animate({
            scrollTop: $('.aktivnePoruke').get(0).scrollHeight * 10000
        }, 2000);
    }
    });