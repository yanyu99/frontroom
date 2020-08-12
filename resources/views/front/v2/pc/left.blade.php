
@if($roomnavs->contains('pos',4))

<div class="sider-menu-content">
<ul>
	@foreach($roomnavs as $nav)
	@if($nav->pos == 4)
	<li>
	@if($nav->type == 4003)
	<a  href="{{$nav->url['url']}}"  target="_blank">
		<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
		@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
	</a>
	@elseif($nav->type == 4002)
	<a  href="javascript:;" @if(empty($nav->title)) style="line-height: 36px;font-size: 0px;display: block;" @endif @if(isset($nav->url['imgurl']))  data-img="{{$nav->url['imgurl']}}" @endif @if(isset($nav->url['qqtype']) && !empty($nav->url['qqtype'])) class="my-pop-img-qq"  data-qqtype="{{$nav->url['qqtype']}}" @else class="my-pop-img" @endif >
		<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
		@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
	</a>

	@elseif($nav->type == 4004)
	<a  href="javascript:;" class="nav-show-qq" >
		<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
		@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
	</a>
	@elseif($nav->type == 4017)
	<a  href="javascript:;" data-width="{{$nav->url['width']}}" data-height="{{$nav->url['height']}}" data-id="{{$nav->id}}" class="nav-show-banner" >
		<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
		@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
	</a>
	@elseif($nav->type == 4200)
		<a  id="dropdownUserList" data-hover="dropdown" data-logtype="10" href="javascript:;"  data-id="{{$nav->id}}" class="js-ui-dialog-{{$nav->type}} dropdown-toggle" data-title="{{$nav->title}}">
			<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
			@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
		</a>
		<style type="text/css">
			.left-user-popup{
				position: absolute;
				display: none;
				left: 63px;
				top:0px;
				padding:0;
				border-radius: 0.5333rem;
			}
			#left-userlist{
				background-color: rgba(0,23,32,0.3);
				width: 233px;
				z-index: 99;
			}
			#left-userlist-img{
				width: 28px;
				height: 28px;
				margin-left: 50px;
			}
			#idUserList{
				background-color: rgba(90, 93, 95,0.3);
			}
			#left-userlist-title{
				background-color: rgba(0,23,32,0.3);
			}
		</style>
		<div class="left-user-popup dropdown-menu">
			<div class="sider-userlist left-userlist" id="left-userlist">
				<div class="title" id="left-userlist-title"><img id="left-userlist-img" src="{{$cdn}}/assets/v2/img/v2/uselistico.png"><span style="margin-left: 5px;">{{$sysConfig->ul_title}}</span>@if($roomUI->show_user_num)(<span id="idUserTotal1"></span>)@endif</div>
				<div  class=" user-list nice-scroll">
					@if($user->role->f_search )
						<form class="user-list-search" onsubmit="return false;">
							<input type="text" class="search-input" id="search-input" placeholder="搜索"></form>
					@endif
					@if($user->role->f_ul_select)<select id="js-ul-type-list" class="user-list-typelist">
						<option value="all" >全部</option>
						<option value="mgr" data-name="管理员">管理员(0)</option>
						<option value="teacher" data-name="讲师">讲师(0)</option>
						<option value="reg" data-name="会员">会员(0)</option>
						<option value="guest" data-name="游客">游客(0)</option>
					</select>
					@endif
					@if( $user->role->f_userlist)
						<div class="user-list-wrap" >
							<ul id="idUserList" style="    margin-bottom: 0px;">
							</ul>
							<div id="js-more-user" style="padding: 5px;text-align: center;cursor: pointer;">获取更多</div>
						</div>
					@elseif($roomUI->ulimg)
						<div class="user-list-wrap" style="height: 100%;background-image: url({{$roomUI->ulimg}});" ></div>
					@endif
				</div>
			</div>
			<div id="listUserCard" class="dds-card">
				<span class="card-close">×</span>
				<div class="card-inner">
					<div class="card-info">
						<p class="tips">正在加载中...</p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function(){
				$('#dropdownUserList').mouseenter(function () {
					$('.left-userlist').height( $('.sider-menu-content').height() );
				});
			});
		</script>
	@elseif($nav->type == 4500)
		<a  href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$nav->url['qq']}}&amp;site=qq&amp;menu=yes" target="_blank" data-qq="{{$nav->url['qq']}}" data-id="{{$nav->id}}">
			<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
			@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
		</a>
	@else
		<a  href="javascript:;"  data-id="{{$nav->id}}" class="js-ui-dialog-{{$nav->type}}" data-title="{{$nav->title}}">
			<div style="text-align: center;padding-top: 10px;"><img   @if(!empty($nav->icon)) src="{{$nav->icon}}" @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif></div>
			@if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
		</a>
	@endif
	</li>
	@endif
	@endforeach
	</ul>
</div>
@endif



	