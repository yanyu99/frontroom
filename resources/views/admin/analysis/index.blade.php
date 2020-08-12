@extends('admin.layouts.base')
@section('head')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            @if($err)
            <div class="form-group">
                <div>
                    <div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
                        <span class="text">{{$err}}</span>
                    </div>
                </div>
            </div>
            @endif
            <div id="main-chart-legend"  style="margin-bottom: 10px;" class="pull-left">

                <form  class="form-inline">
                
                    <div class="form-group">
                            <input type="text" style="width: 180px;"  name="startTime" value="{{$startTime}}" class="form-control form_datetime" readonly="" size="16">
                    </div>

                    <div class="form-group">
                            <input type="text"  style="width: 180px;"  name="endTime" value="{{$endTime}}" class="form-control form_datetime" readonly="" size="16">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">确定</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="main-chart">
            <div id="main-chart-day-container" class="main-chart"></div>
        </div>

    </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="{{$common_cdn}}/js/highcharts/js/highcharts.js"></script>
<script src="{{$common_cdn}}/js/highcharts/js/modules/exporting.js"></script>
<script>



$(function () {
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        minuteStep: 10
    });
   
    $("#main-chart #main-chart-day-container").highcharts({
        title: {
            text: '<b>在线人数</b>',
            x: -20 //center
        },
       chart: {
            type: 'spline'
        },
          plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                },
    
            }
        },
        xAxis: {
            categories: [
                @foreach ($arrTimes as $value)
                '{{date('Y-m-d H:i',$value)}}',
               @endforeach
            ],
        },
        yAxis: {
            title: {
                text: '人'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '人',
             shared: true,
                crosshairs: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '在线人数',
            data: [@foreach ($arrPoints as $value)
                    {{$value}},
               @endforeach]
        },{
            name: '游客人数',
            
            data: [@foreach ($arrPointGuests as $value)
                    {{$value}},
               @endforeach]
        },{
            name: '注册人数',
            
            data: [@foreach ($arrPointRegs as $value)
                    {{$value}},
               @endforeach]
        }]
    });
});

</script>
@endsection