<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1 d-flex justify-content-center">
    <div class="container-fluid">
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
                            <div></div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Training</th>
                                        <th>Pendaftar</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Kategori</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="home_table">
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

    <!-- Modal -->
    <div class="modal fade" id="user" tabindex="-1" aria-labelledby="user" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user">Daftar Unplanned Training</h5>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($user as $users) : ?>
                            <tr>
                                <td>
                                    <form action="<?= base_url() ?>\unplanned" id="dataform<?= $i ?>" method="post">
                                        <input type="hidden" name="member" id="member<?= $i ?>"
                                            value="<?= $users->id_user ?>">
                                        <input type="hidden" name="training" id="training">
                                        <input type="hidden" name="id_training" id="id_training">
                                        <input type="hidden" name="jenis" id="jenis">
                                        <input type="hidden" name="kategori" id="kategori">
                                        <input type="hidden" name="metode" id="metode">
                                        <input type="hidden" name="start" id="start">
                                        <input type="hidden" name="end" id="end">
                                        <input type="hidden" name="budget" id="budget">
                                    </form>
                                    <?php if (session()->get('id') == $users->nama) : ?>
                                    <h6><?= $users->nama ?></h6>
                                    <?php else : ?>
                                    <a href="#"
                                        onclick="document.getElementById('dataform<?= $i ?>').submit();"><?= $users->nama ?></a>
                                    <?php endif; ?>

                                </td>
                            </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closed">Close</button>
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
                editable: true,
                timeZone: 'local',
                initialView: 'dayGridMonth',
                height: 600,
                selectable: true,
                events: data,
                eventClick: function(data) {
                    console.log(data)
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
                                var html = '';
                                for (let i = 0; i < data
                                    .length; i++) {
                                    html += `
                                     <tr>
                                        <td>
                                           ${data[i]
                                        .Training}
                                        </td>
                                        <td>
                                          ${data[i]
                                    .Pendaftar}
                                        </td>
                                        <td>
                                            ${data[i]
                                        .mulai_training}
                                        </td>
                                        <td>
                                           ${data[i]
                                        .rencana_training}
                                        </td>
                                        <td>
                                            ${data[i]
                                        .kategori_training}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" onclick="call('${data[i].id_training}','${encodeURIComponent(data[i].Training)}','${data[i].jenis_training}','${data[i].kategori_training}','${data[i].metode_training}','${data[i].mulai_training}','${data[i].rencana_training}','${data[i].biaya_actual}')">Daftar</button>
                                        </td>
                                    </tr>
                                    `;
                                }
                                $('#exampleModal #home_table')
                                    .html(html)

                            }

                        })
                    }).modal('show');

                }


            });
            calendar.render();
        }

    })
})

function call(id_training, training, jenis, kategori, metode, mulai, ahir, biaya) {

    let Training = decodeURIComponent(training)
    //  console.log(Training)

    $('#user #id_training').val(id_training)
    $('#user #training').val(Training)
    $('#user #jenis').val(jenis)
    $('#user #kategori').val(kategori)
    $('#user #metode').val(metode)
    $('#user #start').val(mulai)
    $('#user #end').val(ahir)
    $('#user #budget').val(biaya)
    $('#user').modal('show')
}

$('#closed').on('click', function() {
    $('#user').modal('hide')
})
</script>
<?= $this->endSection() ?>