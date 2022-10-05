<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1 d-flex justify-content-center">
    <div class="w-100 p-3">
        <div id='calendar'></div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berahir</th>
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
                                            <div id="tanggalmulai"></div>
                                        </td>
                                        <td>
                                            <div id="tanggalahir"></div>
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
                timeZone: 'local',
                initialView: 'dayGridMonth',
                height: 500,
                selectable: true,
                events: data,
                eventClick: function(data) {
                    console.log(data.event.start)
                    jQuery.noConflict()
                    $('#exampleModal').on('show.bs.modal', function(e) {
                        $.ajax({
                            type: 'POST',
                            url: "<?= base_url(); ?>/jadwal",
                            async: true,
                            dataType: "json",
                            data: {
                                start: data.event.start
                            },
                            success: function(data) {
                                console.log(data)
                                $('#training').text(data[0]
                                    .training)
                                $('#pendaftar').text(data[0]
                                    .pendaftar)
                                $('#tanggalmulai').text(data[0]
                                    .tanggal_start)
                                $('#tanggalahir').text(data[0]
                                    .tanggal_ahir)
                                $('#kategori').text(data[0]
                                    .kategori)
                                $('#notes').html(
                                    '<a href="<?= base_url() ?>/data_member_unplanned">daftar</a>'
                                )

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