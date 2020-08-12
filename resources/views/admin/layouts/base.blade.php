
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>后台管理</title>

    <!--icheck
  <link href="{{$cdn}}/assets/backend/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="{{$cdn}}/assets/backend/js/iCheck/skins/square/square.css" rel="stylesheet">
    <link href="{{$cdn}}/assets/backend/js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="{{$cdn}}/assets/backend/js/iCheck/skins/square/blue.css" rel="stylesheet">
    -->
    <!--dashboard calendar
  <link href="{{$cdn}}/assets/backend/css/clndr.css" rel="stylesheet">
    -->
    <!--Morris Chart CSS
  <link rel="stylesheet" href="{{$cdn}}/assets/backend/js/morris-chart/morris.css">
    -->
    <!--common-->
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css?v={{$webver}}">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/fonts/css/font-awesome.min.css?v={{$webver}}">
    <link href="{{$common_cdn}}/js/webuploader/webuploader.css?v={{$webver}}" rel="stylesheet" type="text/css">
    <link href="{{$cdn}}/assets/backend/css/style.css?v={{$webver}}" rel="stylesheet">
    <link href="{{$cdn}}/assets/backend/css/style-responsive.css?v={{$webver}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{$common_cdn}}/js/html5shiv.js"></script>
    <script src="{{$common_cdn}}/js/respond.min.js"></script>
    <![endif]-->

    @yield('head')
    @stack('styles')
    </head>

<body class="sticky-header">

    <section>
        <!-- left side start-->
        <div class="left-side sticky-left-side">

            <!--logo and iconic logo start-->
            <div class="logo">
                <a href="/admin">
                    <img height="40px" @if(!$site->show_ws )  src="{{$cdn}}/assets/backend/images/logo4.png?v=2" @else src="{{$cdn}}/assets/backend/images/logo.png?v=2" @endif alt=""></a>
            </div>

            <div class="logo-icon text-center">
                <a href="/admin">
                    <img src="{{$cdn}}/assets/backend/images/logo_icon.png" alt=""></a>
            </div>
            <!--logo and iconic logo end-->

            <div class="left-side-inner">

                <!-- visible to small devices only
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="{{$cdn}}/assets/backend/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4>
                            <a href="#">John Doe</a>
                        </h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li>
                        <a href="#"> <i class="fa fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-sign-out"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
            -->
            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                @if($user->type == App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                <li>
                    <a href="/super">
                        <i class="fa fa-arrow-circle-o-right"></i>
                        <span>进入超管后台</span>
                    </a>
                </li>
                @endif
                <!--  <li @if($ctrl->path() == "admin"||$ctrl->path() == "admin/index") class="active" @endif>
                <a href="/admin">
                    <i class="fa fa-home"></i>
                    <span>首页</span>
                </a>
            </li>
            -->
                @foreach($menus as $category => $childs)
                 @if( (!isset($childs['parent']) || $childs['parent'] == 0 ) || empty($curRoom->parent))
                @if(isset($childs['childs']))
            <li class="menu-list @if( isset( $childs['childs']['/'.$ctrl->path()]) ) nav-active @endif">
                <a href="">
                    <i class="fa fa-{{$childs['icon']}}"></i>
                    <span>{{$childs['name']}}</span>
                </a>
                <ul class="sub-menu-list">
                    @foreach($childs['childs'] as $key => $child)
                    @if( ( (!isset($child['parent']) || $child['parent'] == 0 ) || empty($curRoom->parent) ) 
                    || ( isset($child['alone_video']) && !empty($curRoom->alone_video) ))
                    <li @if( '/'.$ctrl->path() == $key) class="active" @endif>
                        <a href="{{$key}}">{{$child['name']}}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </li>
            @else
            <li @if(strstr('/'.$ctrl->path(),$category)) class="active" @endif>
                <a href="{{$category}}">
                    <i class="fa fa-{{$childs['icon']}}"></i>
                    <span>{{$childs['name']}}</span>
                </a>
            </li>
            @endif
             @endif
                @endforeach
            <!-- <li>
            <a href="login.html">
                <i class="fa fa-sign-in"></i>
                <span>Login Page</span>
            </a>
        </li>
        -->
    </ul>
    <!--sidebar nav end-->
</div>
</div>
<!-- left side end-->

<!-- main content start-->
<div class="main-content" >

<!-- header section start-->
<div class="header-section">

    <!--toggle button start-->
    <a class="toggle-btn">
        <i class="fa fa-bars"></i>
    </a>
    <form class="searchform" style="float:left;margin-top:10px;margin-right:4px;" action="/admin/changeroom" >
        {{$ctrl->csrf_field()}}
        <select name="room_id" style="width:150px;" onchange="this.form.submit();" class="form-control">
            @foreach($rooms as $room)
            <option value="{{$room->
                id}}"  @if($room->id == $curRoomId) selected  @endif >{{$room->name}} 
                @if(!$room->parent) 
                    @if(!$room->istest)-主 @else -试音 @endif
                @elseif($room->alone_video)
                    -视
                @endif
            </option>
            @endforeach
        </select>
    </form>
    <form class="searchform" style="float:left;margin-top:10px;margin-right:4px;" action="/admin/changepagenum" >
        {{$ctrl->csrf_field()}}
        <select name="page_num" style="width:150px;" onchange="this.form.submit();" class="form-control">
            @foreach($pageNums as $num)
            <option value="{{$num}}"  @if($num == $curPageNum) selected  @endif >每页{{$num}}条记录
            </option>
            @endforeach
        </select>
    </form>
    <!--search end-->
    @if(isset($curDoMain))
    <a class="btn btn-default " style="float:left;margin-top:10px;margin-left:10px" target="_blank" href="http://{{$curDoMain}}/v/{{$curRoomName}}">
        <i class="fa fa-arrow-right"></i>
    </a>
    @else
    <a class="btn btn-default " style="float:left;margin-top:10px;margin-left:10px" target="_blank"href="/v/{{$curRoomName}}">
        <i class="fa fa-arrow-right"></i>
    </a>
    @endif
    <!--notification menu start -->
    <div class="menu-right">
        <ul class="notification-menu">
            <li>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <img src="{{$user->
                    pic}}" alt="" />
                            {{$user->name}}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li>
                        <a href="/admin/setpwd">
                            <i class="fa fa-sign-out"></i>
                            修改密码
                        </a>
                    </li>
                    <li>
                        <a href="/auth/logout">
                            <i class="fa fa-sign-out"></i>
                            登出
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!--notification menu end -->

</div>
<!-- header section end-->

<!-- page heading start-->
@if(isset($pageHeading))
<div class="page-heading">
    <h3>{{$pageHeading['name']}}</h3>
    <ul class="breadcrumb">
        <li>
            <a href="/admin">首页</a>
        </li>
        <li class="active">$pageHeading['cur']</li>
    </ul>
</div>
@endif
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">@yield('content')</div>
<!--body wrapper end-->

<!--footer section start-->
<footer>2017 &copy;@if($site->show_ws ) 稳顺@endif管理后台</footer>
<!--footer section end-->

</div>
<!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="{{$common_cdn}}/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="{{$common_cdn}}/js/jquery-migrate-1.2.1.min.js"></script>
<script src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
<script src="{{$common_cdn}}/js/modernizr.min.js"></script>
<script src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script src="{{$common_cdn}}/js/webuploader/webuploader.js"></script>
<!--common scripts for all pages-->
<script src="{{$cdn}}/assets/backend/js/scripts.js?v=2.1.4"></script>

<!--Dashboard Charts-->@yield('script')</body>
@stack('scripts')
</html>