<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-2 d-flex justify-content-center">
    <div class="w-100 p-2">
        <div id='calender'></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/data_home",
        async: true,
        dataType: "json",
        data: {},
        success: function(data) {
            console.log(data)
            jQuery.noConflict()
            var calendarEl = document.getElementById('calender');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 500,
                selectable: true,
                events: data,
                eventClick: function(data) {
                    jQuery.noConflict()
                    $('#exampleModalCenter').on('show.bs.modal', function(e) {
                        $.ajax({
                            type: 'POST',
                            url: "<?= base_url(); ?>/jadwal",
                            async: true,
                            dataType: "json",
                            data: {
                                start: data.start
                            },
                            success: function(data) {
                                console.log(data)

                            }

                        })
                    }).modal('show');

                }

            });
            calendar.render();
        }

    })
})
</script>
<?= $this->endSection() ?>