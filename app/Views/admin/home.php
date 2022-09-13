<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3 d-flex justify-content-center">
    <div class="w-100 p-3">
        <div id='calender'></div>
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
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate

                    if (info.event.url) {
                        window.open(info.event.url);
                    }
                }


            });
            calendar.render();
        }

    })
})
</script>
<?= $this->endSection() ?>