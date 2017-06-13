var elems = document.getElementsByClassName('confirmation');
var confirmIt = function (e) {
    if (!confirm('Êtes vous sûr?')) e.preventDefault();
}
for (var i = 0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', confirmIt, false);
}


$('#datepick').on('changeDate', function(ev){
    $(this).datepicker('hide');
});

$('#datepick2').on('changeDate', function(ev){
    $(this).datepicker('hide');
});