
function applyFilter(columnIndex, selectedValue) {
    inprog.search('').column(columnIndex).search(selectedValue, true, false).draw();
}
$('#date-filter, #filter-docx, #filter-dept').on('change', function() {
    if (this.id === 'date-filter') {
        const selectedDateTime = $(this).val();
        let formattedDate = moment(selectedDateTime).format('MMM D, YYYY');
        let formattedTime = '';

        if (selectedDateTime.includes(':')) {
            formattedTime = moment(selectedDateTime).format('h:mm a');
            formattedDate += ` | ${formattedTime}`;
        }

        applyFilter(2, formattedDate);
    } else if (this.id === 'filter-docx') {
        applyFilter(5, $(this).val());
    } else if (this.id === 'filter-dept') {
        applyFilter(6, $(this).val());
    }
});