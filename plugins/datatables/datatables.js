$(document).ready(function() {
    $('#table').DataTable( {
        "language": {"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}
    });
            
    $('#table_calendrier').DataTable({
        "language": {"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"},
        "order": [[ 2, "asc" ]]
    });

});
