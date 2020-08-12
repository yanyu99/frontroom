@extends('admin.layouts.base')
@section('head')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--statistics start-->
        <div class="row state-overview">
        <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel green">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$year->new_reg_num}}|{{$year->new_guest_num}}</div>
                        <div class="title">年注册人数</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel red">
                    <div class="symbol"> <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">
                            {{$year->reg_user_count?intval( $year->reg_life_time/60/$year->reg_user_count):0}}|{{$year->guest_user_count?intval($year->guest_life_time/60/$year->guest_user_count):0}}
                        </div>
                        <div class="title">年平均时长（分钟）</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel blue">
                    <div class="symbol"> <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$year->reg_visit_num}}|{{$year->guest_visit_num}}</div>
                        <div class="title">年访问次数</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel green">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$year->reg_user_count}}|{{$year->guest_user_count}}</div>
                        <div class="title">年访问人数</div>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--statistics start-->
        <div class="row state-overview">
         <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$month->new_reg_num}}|{{$month->new_guest_num}}</div>
                        <div class="title">月注册人数</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">
                            {{$month->reg_user_count?intval( $month->reg_life_time/60/$month->reg_user_count):0}}|{{$month->guest_user_count?intval($month->guest_life_time/60/$month->guest_user_count):0}}
                        </div>
                        <div class="title">月平均时长（分钟）</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$month->reg_visit_num}}|{{$month->guest_visit_num}}</div>
                        <div class="title">月访问次数</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="state-value">
                        <div class="value">{{$month->reg_user_count}}|{{$month->guest_user_count}}</div>
                        <div class="title">月访问人数</div>
                    </div>
                </div>
            </div>
           

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div id="main-chart-legend" class="pull-right"></div>
        </div>
        <div id="main-chart">
            <div id="main-chart-reg-container" class="main-chart"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div id="main-chart-legend" class="pull-right"></div>
        </div>

        <div id="main-chart">
            <div id="main-chart-usercount-container" class="main-chart"></div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="clearfix">
            <div id="main-chart-legend" class="pull-right"></div>
        </div>

        <div id="main-chart">
            <div id="main-chart-day-container" class="main-chart"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div id="main-chart-legend" class="pull-right"></div>
        </div>

        <div id="main-chart">
            <div id="main-chart-visit-container" class="main-chart"></div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{$common_cdn}}/js/highcharts/js/highcharts.js"></script>
<script src="{{$common_cdn}}/js/highcharts/js/modules/exporting.js"></script>
<script>



$(function () {
    $("#main-chart #main-chart-day-container").highcharts({
        title: {
            text: '<b>平均访问时长</b>',
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
                @foreach ($lifeTimes as  $value)
                '{{$value->ts}}',
               @endforeach
            ],
        },
        yAxis: {
            title: {
                text: '时长： (分钟)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '分钟',
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
            name: '注册用户',
            data: [@foreach ($lifeTimes as  $value)
                    @if(empty($value->reg_user_count))
                    0,
                    @else
                    {{$value->reg_life_time/60/$value->reg_user_count}},
                    @endif
               @endforeach]
            },{
                name: '游客',
                data: [@foreach ($lifeTimes as  $value)
                @if(empty($value->guest_user_count))
                0,
                @else
                {{$value->guest_life_time/60/$value->guest_user_count}},
                @endif
                        @endforeach]
            },
        ]
    });
    $("#main-chart-visit-container").highcharts({
        title: {
            text: '<b>访问次数</b>',
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
                @foreach ($lifeTimes as  $value)
                '{{$value->ts}}',
               @endforeach
            ],
        },
        yAxis: {
            title: {
                text: '次数：',
             shared: true,
                crosshairs: true
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '次数'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '注册用户',
            data: [@foreach ($lifeTimes as  $value)
                    {{$value->reg_visit_num}},
            
                        @endforeach]
            },{
                name: '游客',
                data: [@foreach ($lifeTimes as  $value)
                    {{$value->guest_visit_num}},
            
                        @endforeach]
            },
        ]
    });
    $("#main-chart-usercount-container").highcharts({
        title: {
            text: '<b>访问人数</b>',
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
                @foreach ($lifeTimes as  $value)
                '{{$value->ts}}',
               @endforeach
            ],
        },
        yAxis: {
            title: {
                text: '人数：'
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
            name: '注册用户',
            data: [@foreach ($lifeTimes as  $value)
                    {{$value->reg_user_count}},
            
                        @endforeach]
            },{
                name: '游客',
                data: [@foreach ($lifeTimes as  $value)
                    {{$value->guest_user_count}},
            
                        @endforeach]
            },
        ]
    });
    
    $("#main-chart-reg-container").highcharts({
        title: {
            text: '<b>注册人数</b>',
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
                @foreach ($lifeTimes as  $value)
                '{{$value->ts}}',
               @endforeach
            ],
        },
        yAxis: {
            title: {
                text: '人数：'
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
            name: '注册用户',
            data: [@foreach ($lifeTimes as  $value)
                    {{$value->new_reg_num}},
            
                        @endforeach]
            },{
                name: '游客',
                data: [@foreach ($lifeTimes as  $value)
                    {{$value->new_guest_num}},
            
                        @endforeach]
            },
        ]
    });
});

</script>
@endsection