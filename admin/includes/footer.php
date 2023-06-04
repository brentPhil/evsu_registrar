<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {

        const table = $('#myTable').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 2, targets: 0 },
                { responsivePriority: 3, targets: -3 },
                { responsivePriority: 1, targets: -1 }
            ],
            dom: 'topi',
            paging: false,
            info: false
        });

        function applyFilter(columnIndex, selectedValue) {
            table.search('').column(columnIndex).search(selectedValue, true, false).draw();
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

        $('#inlineFormInputGroupUsername').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#dept-select').on('change', function () {
            const deptValue = $(this).val();

            table.search('').draw();

            if (deptValue !== 'Select Department') {
                table.column(0).search(deptValue, true, false).draw();
            }
        });

        $('#search-input').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#myTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        // Activate the first tab by default
        $('#all').addClass('active show');

        // Switch tabs on click
        $('.nav-link').click(function(){
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            const tabId = $(this).data('target');
            $('.tab-pane').removeClass('active show');
            $(tabId).addClass('active show');
        });
    });
</script>
<script>
    function formatStudentId(input) {
        // Remove non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');

        // Add a dash after the fourth character
        if (input.value.length > 4) {
            input.value = input.value.slice(0, 4) + '-' + input.value.slice(4);
        }

        // Limit the input to the specified pattern
        if (!input.value.match(/^\d{4}-\d{5}$/)) {
            input.setCustomValidity('Please enter a valid student ID number in the format 0000-00000.');
        } else {
            input.setCustomValidity('');
        }
    }
</script>