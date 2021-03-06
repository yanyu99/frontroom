﻿
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

  <title>超管后台</title>

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
  <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/fonts/css/font-awesome.min.css">
    <link href="{{$common_cdn}}/js/webuploader/webuploader.css" rel="stylesheet" type="text/css">
    <link href="{{$cdn}}/assets/backend/css/style.css" rel="stylesheet">
    <link href="{{$cdn}}/assets/backend/css/style-responsive.css" rel="stylesheet">
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
            <a href="/"><img height="40px" @if(!$site->show_ws ) src="{{$cdn}}/assets/backend/images/logo4.png?v=2" @else src="{{$cdn}}/assets/backend/images/logo.png?v=2" @endif  alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="/"><img src="{{$cdn}}/assets/backend/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="{{$cdn}}/assets/backend/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div> -->

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                @if($user->type == App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                <li><a href="/admin"><i class="fa fa-arrow-circle-o-left"></i> <span>进入房间后台</span></a></li>
                @endif   
                <li @if($ctrl->path() == "super"||$ctrl->path() == "super/index") class="active" @endif><a href="/super"><i class="fa fa-home"></i> <span>首页</span></a></li>
                @foreach($menus as $category => $childs)
                @if(isset($childs['childs']))
                <li class="menu-list @if( isset( $childs['childs']['/'.$ctrl->path()]) ) nav-active @endif"><a href=""><i class="fa fa-{{$childs['icon']}}"></i> <span>{{$childs['name']}}</span></a>
                    <ul class="sub-menu-list">
                    	@foreach($childs['childs'] as $key => $child)
                        <li @if( '/'.$ctrl->path() == $key) class="active" @endif>
                        	<a href="{{$key}}"> {{$child['name']}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li @if(strstr('/'.$ctrl->path(),$category)) class="active" @endif><a href="{{$category}}"><i class="fa fa-{{$childs['icon']}}"></i> <span>{{$childs['name']}}</span></a></li>
                @endif
				@endforeach
               <!-- <li><a href="login.html"><i class="fa fa-sign-in"></i> <span>Login Page</span></a></li>-->

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
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
          <!--  <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>-->
            <!--search end-->
            <form class="searchform" style="float:left;margin-top:10px;margin-right:4px;" action="/admin/changepagenum" >
        {{$ctrl->csrf_field()}}
        <select name="page_num" style="width:150px;"  onchange="this.form.submit();" class="form-control">
            @foreach($pageNums as $num)
            <option value="{{$num}}"  @if($num == $curPageNum) selected  @endif >每页{{$num}}条记录
            </option>
            @endforeach
        </select>
    </form>
            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <!--<li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">8</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 8 pending task</h5>
                            <ul class="dropdown-list user-list">
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Database update</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Dashboard done</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                                <span class="">90%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Web Development</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info">
                                                <span class="">66% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Mobile App</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="33" role="progressbar" class="progress-bar progress-bar-danger">
                                                <span class="">33% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Issues fixed</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
                                                <span class="">80% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Pending Task</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 5 Mails </h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="thumb"><img src="{{$cdn}}/assets/backend/images/photos/user1.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">John Doe <span class="badge badge-success">new</span></span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="{{$cdn}}/assets/backend/images/photos/user2.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jonathan Smith</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="{{$cdn}}/assets/backend/images/photos/user3.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jane Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="{{$cdn}}/assets/backend/images/photos/user4.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Mark Henry</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="{{$cdn}}/assets/backend/images/photos/user5.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jim Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="new"><a href="">Read All Mails</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">Notifications</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #1 overloaded.  </span>
                                        <em class="small">34 mins</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #3 overloaded.  </span>
                                        <em class="small">1 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #5 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #31 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Notifications</a></li>
                            </ul>
                        </div>
                    </li>-->
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                           <img src="{{$user->pic}}" alt="" />
                            {{$user->name}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <!--<li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li>-->
                            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i>登出</a></li>
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
            <h3>
                {{$pageHeading['name']}}
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="/">首页</a>
                </li>
                <li class="active"> $pageHeading['cur'] </li>
            </ul>
        </div>
        @endif
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
        @yield('content')
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>2017 &copy; @if($site->show_ws ) 稳顺@endif管理后台</footer>
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

<!--Dashboard Charts-->
@yield('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });
</script>
@stack('scripts')
</body>
</html>
