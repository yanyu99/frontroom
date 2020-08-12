<ul>
	@if($roomUI->show_lesson)
	<li>
		<a class="dropdown-toggle my-pop-img" data-img="{{$roomUI->lesson_img}}" id="idLesson" data-logtype="1"> <i class="icon icon_lesson"></i>
			<span>课程安排</span>
		</a>
	</li>
	@endif
	@if($site->jf_opend && $roomUI->show_jc)
	<li>
		<a class="dropdown-toggle " id="js-bet-dialog" data-logtype="1"> <i class="icon icon_bet"></i>
			<span>有奖竞猜</span>
		</a>
	</li>
	@endif

	@if($roomUI->show_article)
	<li>
		<a class="dropdown-toggle" data-hover="dropdown" data-logtype="3"> <i class="icon icon_article"></i>
			<span>老师观点</span>
		</a>
		<div class="dropdown-menu sider-menu-content">
			<h4>
				<span class="text" style="color: #000;">老师观点</span>
			</h4>
			<div class="block">
				@if(!$user->role->f_article)
				<div style="color: #999; line-height:24px;">
					<div>暂无权限查看此内容，如有疑问，请联系客服。</div>
					@include('front.lives.qq')
				</div>
				@else
				<div id="idArticleWarp" class="option-list nice-scroll">
				</div>
				@endif
			</div>
		</div>
	</li>
	@endif
@if($roomUI->show_manual)
	<li>
		<a class="dropdown-toggle" data-hover="dropdown" data-logtype="3">
			<i class="icon icon_advice"></i>
			<span >操作建议</span>
		</a>
		<div class="dropdown-menu sider-menu-content">
		<h4>
				<span class="text" style="color: #000;">操作建议</span>
			</h4>
			@if($user->role->f_send_manual)
			<a href="javascript:;" class="btn btn-sm js-sshd-dialog" style="position: absolute;top: 23px;right: 16px;">发布</a>
			@endif
			<div class="block">
			<!--<span class="text " style="color: #000;font-size: 18px;font-weight: bold;cursor: pointer;">操作建议</span>-->
			
			@if(!$user->role->f_manual)
				<div style="color: #999; line-height:24px;">
					<div>暂无权限查看此内容，如有疑问，请联系客服。</div>
					@include('front.lives.qq')
				</div>
			@else
				<!--<div class="suggestion-menu line-menu">
					<ul role="tablist">
						<li class="active">
							<a href="#suggestion-tab-1" aria-controls="suggestion-tab-1" role="tab" data-toggle="tab">
								<span class="text">正在进行的交易</span>
								<span class="number"></span>
							</a>
						</li>
						<li>
							<a href="#suggestion-tab-2" aria-controls="suggestion-tab-2" role="tab" data-toggle="tab">
								<span class="text">历史交易记录</span>
								<span class="number"></span>
							</a>
						</li>
					</ul>
				</div>-->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="suggestion-tab-1">
						<div class="suggestion-table  nice-scroll" style="position: absolute; top: 60px; bottom:0; right: 15px; left:15px;">
							
						</div>
					</div>
					<!--
					<div role="tabpanel" class="tab-pane" id="suggestion-tab-2">
						<div class="suggestion-table nice-scroll" style="position: absolute; top: 80px; bottom:0; right: 15px; left:15px;">
							
						</div>
					</div>-->
				</div>
				@endif
			</div>
		</div>
	</li>
	@endif
	@if($roomUI->show_cjrl)
	<li >
		<a class="dropdown-toggle js-cjrl-dialog" data-hover="dropdown" data-logtype="4">
			<i class="icon icon-cjrl"></i>
			<span>财经日历</span>
		</a>
	</li>
	@endif

@if($roomUI->show_file)
	<li>
		<a class="dropdown-toggle" data-hover="dropdown" data-logtype="5">
			<i class="icon icon_wjxz"></i>
			<span>文件下载</span>
		</a>
		<div class="dropdown-menu sider-menu-content">

			<h4>
				<span class="text">文件下载</span>

			</h4>

			<div class="block filesListWraps">
			@if(!$user->role->f_download)
				<div style="color: #999; line-height:24px;">
					<div>暂无权限查看此内容，如有疑问，请联系客服。</div>
					@include('front.lives.qq')
				</div>
			@else
				<div class="nice-scroll filesList">
					<table id="idFileWarp" class="table table-condensed table-striped">
					</table>
				</div>
			@endif
		</div>
	</div>
</li>
@endif

@if($roomUI->show_zjtd)
<li>
	<a class="dropdown-toggle js-zjtd-dialog" data-hover="dropdown" data-logtype="9">
		<i class="icon icon_zjtd"></i>
		<span>专家团队</span>
	</a>
</li>
@endif
@if($roomUI->show_share)
<li>
	<a class="dropdown-toggle" data-hover="dropdown" data-logtype="9">
		<i class="icon icon_ewm"></i>
		<span>分享收藏</span>
	</a>
	<div class="dropdown-menu sider-menu-content">

		<div class="nice-scroll" style="position: absolute; top:0; bottom: 0;left:0;right:0;overflow: hidden; outline: none;" tabindex="5">
			<h4>
				<span class="text">分享</span>
			</h4>
			<div class="block">
				<ul class="list-inline">
					<li>
						<a href="#" class="share-btn share-weibo-btn" id="js-share-weibo-btn" target="_blank"></a>
					</li>
					<li>
						<a href="#" class="share-btn share-qq-btn" id="js-share-qq-btn" target="_blank"></a>
					</li>
					<li>
						<a href="#" class="share-btn share-qzone-btn" id="js-share-qzone-btn" target="_blank"></a>
					</li>
				</ul>
			</div>
			<h4>
    			<span class="text">微信公众号</span>
			</h4>
			<div class="block">
				<img src="{{$roomUI->wechat_img}}" class="qr-code-img">
			</div>
			<h4>
				<span class="text">其他操作</span>
			</h4>
			<div class="block">
				<ul>
					<li>
						<a class="js-favorite-link" href="javascript:void(0);" target="_blank">收藏到书签栏</a>
					</li>

					<li>
						<a href="/siteurl/{{$room->id}}?name={{$room->title}}" target="_blank">发送桌面快捷方式</a>
					</li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				showcount: '1',
				/*是否显示分享总数,显示：'1'，不显示：'0' */
				desc: '',
				/*默认分享理由(可选)*/
				summary: '',
				/*分享摘要(可选)*/
				title: window.D.INFO.title,
				/*分享标题(可选)*/
				site: '',
				/*分享来源 如：腾讯网(可选)*/
				pics: '',
				/*分享图片的路径(可选)*/
				style: '203',
				width: 98,
				height: 22
			};
			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			$('#js-share-qzone-btn').attr('href', 'http://connect.qq.com/widget/shareqq/index.html?' + s.join('&'));
		});
		//分享到QQ
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				/*获取URL，可加上来自分享到QQ标识，方便统计*/
				desc: '',
				/*分享理由(风格应模拟用户对话),支持多分享语随机展现（使用|分隔）*/
				title: window.D.INFO.title,
				/*分享标题(可选)*/
				summary: '',
				/*分享摘要(可选)*/
				pics: '',
				/*分享图片(可选)*/
				flash: '',
				/*视频地址(可选)*/
				site: '',
				/*分享来源(可选) 如：QQ分享*/
				style: '201',
				width: 32,
				height: 32
			};

			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			s.join('&');
			$('#js-share-qq-btn').attr('href', 'http://connect.qq.com/widget/shareqq/index.html?' + s.join('&'));
		});
		$(function() {
			$('.js-favorite-link').click(function() {
				try {
					window.external.addFavorite(sURL, sTitle);
				} catch (e) {
					try {
						window.sidebar.addPanel(sTitle, sURL, "");
					} catch (e) {
						alert("请使用Ctrl+D进行添加");
					}
				}
			});
		});
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				style: 'number',
				searchPic: 'false',
				language: 'zh_cn',
				style: 'button'
			};
			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			s.join('&');
			$('#js-share-weibo-btn').attr('href', 'http://service.weibo.com/share/share.php?'+s.join('&'));
		});
	</script>
	</div>
</li>
@endif
@if($roomUI->show_userlist && $user->role->f_userlist)
<li >
	<a class="dropdown-toggle" id="dropdownUserList" data-hover="dropdown" data-logtype="10">
		<i class="icon icon_userlist"></i>
		<span>在线用户</span>
	</a>
	<div class="dropdown-menu sider-menu-content">
		<h4 >
			<span class="text" style="border-bottom:none;">在线用户列表</span>
		</h4>

		<div  class=" user-list nice-scroll" style="padding: 10px 15px 0px 15px;top:60px;bottom:10px;">
		@if($user->role->f_search )
			<form class="user-list-search" onsubmit="return false;">
				<input type="text" class="search-input" id="search-input" placeholder="搜索"></form>
		@endif
		@if($user->role->f_ul_select)
			<select id="js-ul-type-list" style=" margin-top: 5px;color: #333;font-size:14px;width: 100%;background: rgba(232, 232, 232, 0.66);padding: 10px 10px;">
				<option value="all" >全部</option>
				<option value="mgr" data-name="管理员">管理员(0)</option>
				<option value="teacher" data-name="讲师">讲师(0)</option>
				<option value="reg" data-name="会员">会员(0)</option>
				<option value="guest" data-name="游客">游客(0)</option>
			</select>
		@endif
			<div class="user-list-wrap" >
				<ul id="idUserList">
				</ul>
				<div id="js-more-user" style="padding: 5px;text-align: center;cursor: pointer;">获取更多</div>
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
</li>
</ul>
@endif