<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        <?php if(isset($_SESSION['error'])): ?>
        $('.toast-body').text('<?php echo $_SESSION['error']; ?>');
        $('.toast').toast('show');
        <?php endif; ?>

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

        $('#inlineFormInputGroupUsername').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#all').addClass('active show');

        // Switch tabs on click
        $('.nav-link').click(function(){
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            var tabId = $(this).data('target');
            $('.tab-pane').removeClass('active show');
            $(tabId).addClass('active show');
        });
    });
</script>