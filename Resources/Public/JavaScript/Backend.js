function saveorder() {
    let sorting = 0;
    $('ul#sortable li').each(function( index ) {
        sorting = (index+1)*10;
        $('#e' + $( this ).attr('id')).val(sorting);
    });
    $('#thumbform').submit();
}
$('#cambutso').click(function(event){
    saveorder();
});
