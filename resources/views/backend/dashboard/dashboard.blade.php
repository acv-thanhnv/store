@push("css")
<style type="text/css">
    #container, #sliders {
        margin: 0 auto;
    }
    .value{
        float: right;
    }
</style>
@endpush
@extends("layouts.backend")
@section("content")
    DashBoard
    <div id="container" style="height: 800px"></div>
    <div id="sliders">
        <table>
            <tr>
                <td>Góc Alpha</td>
                <td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
            </tr>
            <tr>
                <td>Góc Beta</td>
                <td><input id="beta" type="range" min="-45" max="45" value="0"/> <span id="beta-value" class="value"></span></td>
            </tr>
            <tr>
                <td>Chiều sâu</td>
                <td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
            </tr>
        </table>
    </div>
@endsection
@push("js")
<script src="js/hightChart/highcharts.js"></script>
<script src="js/hightChart/highcharts-3d.js"></script>
<script src="js/hightChart/modules/exporting.js"></script>
<script src="js/hightChart/modules/export-data.js"></script>
<script type="text/javascript">

    var chart = new Highcharts.chart('container', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 15,
                viewDistance: 25,
                depth: 40
            }
        },

        title: {
            text: 'Doanh thu 5 ngày gần nhất'
        },

        xAxis: {
            categories: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6'],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Doanh số',
                skew3d: true
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },

        series: [{
            name: 'Vốn',
            data: [5, 3, 4, 7, 2],
            stack: 'male'
        }, {
            name: 'Thu nhập',
            data: [3, 4, 4, 2, 5],
            stack: 'male'
        }, {
            name: 'Lãi',
            data: [2, 5, 6, 2, 1],
            stack: 'female'
        }, {
            name: 'Thuế',
            data: [3, 0, 4, 4, 3],
            stack: 'female'
        }]
    });

    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }
    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = parseFloat(this.value);
        showValues();
        chart.redraw(false);
    });
    showValues();
</script>
@endpush
