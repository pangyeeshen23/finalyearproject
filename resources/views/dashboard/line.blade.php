<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div>
            <canvas id="{{ $chartId }}" style="height: 300px" data-chart="{{ json_encode($data,TRUE) }}"></canvas>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>

<script>
    $(function() {
        var chart = document.getElementById("{{ $chartId }}")
        var ctx = chart.getContext('2d');
        var data = chart.getAttribute('data-chart');

        var myChart = new Chart(ctx, {
            type: "line",
            data: JSON.parse(data),
            options:{
                "responsive": true,
                "maintainAspectRatio": false
            }
        })
    })


</script>