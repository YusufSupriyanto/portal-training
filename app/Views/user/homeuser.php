<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1 d-flex justify-content-center">
    <div class="w-100 p-3">
        <div id='calendar'></div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Home</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal Training</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Training</th>
                                        <th>Pendaftar</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="training"></div>
                                        </td>
                                        <td>
                                            <div id="pendaftar"></div>
                                        </td>
                                        <td>
                                            <div id="tanggal"></div>
                                        </td>
                                        <td>
                                            <div id="kategori"></div>
                                        </td>
                                        <td>
                                            <div id="notes"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
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
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 500,
                selectable: true,
                events: data,
                eventClick: function(data) {
                    // event.jsEvent.preventDefault(); // don't let the browser navigate
                    // alert(data.event.start)
                    $('#exampleModal').modal('show', function() {
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url(); ?>/jadwal",
                            async: true,
                            dataType: "json",
                            data: {
                                start: data.event.start
                            },
                            success: function(data) {

                            }

                        });
                    })


                    // $('#exampleModalLabel').html(event.title);
                    // $('#modalBody').html(event.description);
                    // $('#eventUrl').attr('href', event.url);
                    // $('#calendarModal').modal();
                    // if (info.event.url) {
                    //     window.open(info.event.url);
                    // }
                }


            });
            calendar.render();
        }

    })
})
</script>
<?= $this->endSection() ?>