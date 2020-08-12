@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户访问</header>
      <div class="panel-body">
        <div class="adv-table">
          
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                   
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>日期</th>
                  <th>游客</th>
                  <th>注册用户</th>
                  <th>新用户</th>
                  <th>访问次数</th>
                  <td>IP数量</td>
                  <td>新增IP</td>
                  <th>平均停留时间(分钟)</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->ts}}</td>
                  <td>{{$list->guest_user_count}}</td>
                  <td>{{$list->reg_user_count}}</td>
                  <td>{{$list->new_reg_num}}</td>
                  <td>{{$list->reg_visit_num+$list->guest_visit_num}}</td>
                  <td>{{$list->ip_num}}</td>
                  <td>{{$list->new_ip_num}}</td>
                  <td>@if($list->reg_user_count+$list->guest_user_count > 0 ){{(int)( ($list->reg_life_time+$list->guest_life_time)/($list->reg_user_count+$list->guest_user_count)/60 )}} @endif </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">{{$lists->total()}}条记录</div>
              </div>
              <div class="span6">
                {!!$lists->render()!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection