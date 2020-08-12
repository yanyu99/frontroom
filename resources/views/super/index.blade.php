@extends('super.layouts.base')
@section('head')



@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <!--statistics start-->
    <div class="row state-overview">
      <div class="col-md-3 col-xs-12 col-sm-3">
        <div class="panel red">
          <div class="symbol"> <i class="fa fa-users"></i>
          </div>
          <div class="state-value">
            <div class="value">{{$regNum}}</div>
            <div class="title">注册用户数</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xs-12 col-sm-3">
        <div class="panel blue">
          <div class="symbol"> <i class="fa fa-eye"></i>
          </div>
          <div class="state-value">
            <div class="value">{{$onlineNum}}</div>
            <div class="title">在线人数</div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-xs-12 col-sm-3">
        <div class="panel green">
          <div class="symbol"> <i class="fa fa-home"></i>
          </div>
          <div class="state-value">
            <div class="value">{{$roomNum}}</div>
            <div class="title">房间数</div>
          </div>
        </div>
      </div>
      <!--
                        <div class="col-md-6 col-xs-12 col-sm-6">
      <div class="panel red">
        <div class="symbol">
          <i class="fa fa-tags"></i>
        </div>
        <div class="state-value">
          <div class="value">3490</div>
          <div class="title">Copy Sold</div>
        </div>
      </div>
    </div>
    -->
  </div>
  <!--
                    <div class="row state-overview">
  <div class="col-md-6 col-xs-12 col-sm-6">
    <div class="panel blue">
      <div class="symbol">
        <i class="fa fa-money"></i>
      </div>
      <div class="state-value">
        <div class="value">22014</div>
        <div class="title">Total Revenue</div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xs-12 col-sm-6">
    <div class="panel green">
      <div class="symbol">
        <i class="fa fa-eye"></i>
      </div>
      <div class="state-value">
        <div class="value">390</div>
        <div class="title">Unique Visitors</div>
      </div>
    </div>
  </div>
</div>
-->
<!--statistics end-->
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
<div class="row" style="margin-top: 10px;">
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

                <form method="get" class="form-inline" >
          
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

        <div >
            <div id="main-chart-day-container" class="main-chart"></div>
        </div>
         <div >
            <div id="main-chart-flow-container" class="main-chart"></div>
        </div>
        @if($flowNotifys && count($flowNotifys) > 0)
        <dir style="    text-align: center;font-size: 18px;font-weight: bold;">当前所需带宽{{$flowNotifysNum}}Mb</dir>
         <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead></thead>
              <tr>
                  <th>类型</th>
                  <th>带宽</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                </tr>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($flowNotifys as $list)
                <tr @if($list->color) style="color:{{$list->color}};" @endif>
                  <td>{{$list->type}}</td>
                  <td>{{$list->flow}}Mb</td>
                  <td>{{$list->s_at}}</td>
                  <td>{{$list->e_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
@section('script')
<script src="{{$common_cdn}}/js/highcharts/js/highcharts.js"></script>
<script src="{{$common_cdn}}/js/highcharts/js/modules/exporting.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

<script type="text/javascript">
 $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        minuteStep: 10
    });

    $("#main-chart-day-container").highcharts({
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
    @if($showFlow)

    $("#main-chart-flow-container").highcharts({
        title: {
            text: '带宽图',
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
                text: '带宽图：'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'Mbps',
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
            name: '带宽Mbps',
            data: [@foreach ($arrFlows as $value)
                    {{$value}},
               @endforeach]
            }
        ]
    });
    @endif
  	$("#main-chart-reg-container").highcharts({
        title: {
            text: '注册人数',
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
    
</script>
@endsection