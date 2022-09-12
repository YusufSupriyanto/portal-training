<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">

    <div id='calendar'></div>

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
            $('#calendar').fullCalendar('renderEvent', {
                editable: true,
                selectable: true,
                selectHelper: true,
                header: {
                    left: 'prev,next today',
                    center: 'tittle',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                events: data
            })
        }

    })

});
</script>
<?= $this->endSection() ?>