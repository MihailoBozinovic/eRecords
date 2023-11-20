const navikeDiv = document.querySelector('#navikeButton');
const posaoDiv = document.querySelector('#posaoButton');
const porodicaDiv = document.querySelector('#porodicaButton');
const hranaDiv = document.querySelector('#hranaButton');
// add a click event listener to the div
navikeDiv.addEventListener('click', function() {
    $("#navike").show();
    $("#posao").hide();
    $("#porodica").hide();
    $("#hrana").hide();

    $("#a").addClass('aktivno');
    $("#b").removeClass('aktivno');
    $("#c").removeClass('aktivno');
    $("#d").removeClass('aktivno');
});
posaoDiv.addEventListener('click', function() {
    $("#navike").hide();
    $("#posao").show();
    $("#porodica").hide();
    $("#hrana").hide();

    $("#a").removeClass('aktivno');
    $("#b").addClass('aktivno');
    $("#c").removeClass('aktivno');
    $("#d").removeClass('aktivno');
});
porodicaDiv.addEventListener('click', function() {
    $("#navike").hide();
    $("#posao").hide();
    $("#porodica").show();
    $("#hrana").hide();

    $("#a").removeClass('aktivno');
    $("#b").removeClass('aktivno');
    $("#c").addClass('aktivno');
    $("#d").removeClass('aktivno');
});
hranaDiv.addEventListener('click', function() {
    $("#navike").hide();
    $("#posao").hide();
    $("#porodica").hide();
    $("#hrana").show();

    $("#a").removeClass('aktivno');
    $("#b").removeClass('aktivno');
    $("#c").removeClass('aktivno');
    $("#d").addClass('aktivno');
});