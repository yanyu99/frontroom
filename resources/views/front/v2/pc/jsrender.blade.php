<script id="js-start-lesson-tmpl" type="text/x-jsrender">
	<li>
		<a href="javascript:;" data-id="@{{>id}}" class="js-teacher-list">@{{>name}}</a>
	</li>
</script>
<script id="js-my-robot-tmpl" type="text/x-jsrender">
	<option value="@{{>name}}" data-avatar="@{{>pic}}" data-type="@{{>type}}" data-uid="@{{>uid}}" ">@{{>name}}</option>
</script>
<script id="js-mgr-tochat-tmpl" type="text/x-jsrender">
	<option value="@{{>uid}}" class="mgr-option-@{{>uid}}" data-name="@{{>name}}">@{{>name}}</option>
</script>
<script id="js-teacher-agree-tmpl" type="text/x-jsrender">

	<li class="item-@{{>index}}" style="">@{{>name}}获得@{{>(total+total_base)}}个点赞</li>
</script>

<script id="js-question-message-tmpl" type="text/x-jsrender">
<div id="js-question-messages-@{{>id}}" class='chat-message-type-2'>
	<div class="chat-message clearfix">
		<div class="chat-message-content" >
			<div class="chat-message-meta" style="display:block;">
				<span class="chat-message-time">@{{>ask_time}}</span>
				<span class="chat-message-role-@{{>ask_utype}}"></span>
				<span class="chat-message-name">@{{>ask_name}}</span>
				
				@if($user->role->f_question_answer)
				@{{if ask_uid != {!!$user->uid!!} }}
 				<a class="question-message-delete-btn" data-id="@{{>id}}">删</a>
 				@{{/if}}
 				@endif
 				@if($user->role->f_question_answer )
				@{{if !is_answerd && ask_uid != {!!$user->uid!!} }}
					<a class="question-message-audit-btn" data-id="@{{>id}}">答</a>
				@{{/if}}
				@endif
				<img src="{{$cdn}}/assets/img/question.png" style="width: 18px;" />
			</div>
			<div class="chat-message-context" style="display:block;float: left;"> <i class="chat-message-context-caret"></i>
					<span>@{{>ask}}</span>
			</div>
		</div>
	</div>
	@{{if is_answerd}}
	<div class="chat-message chat-me chat-message-@{{>answer_utype}} clearfix">
		<div class="chat-message-content " >
			<div class="chat-message-meta"  style="display:block;" >
				<span class="chat-message-name">@{{>answer_name}}</span>
				<span class="chat-message-role-@{{>answer_utype}}"></span>
				<span class="chat-message-time">@{{>answer_time}}</span>
			</div>
			<div class="chat-message-context"  style="display:block;"> <i class="chat-message-context-caret"></i>
					<span>@{{>answer}}</span>
			</div>
		</div>
	</div>
	@{{/if}}
</div>
</script>
<script id="js-chat-message-tmpl" type="text/x-jsrender">
@if(!$user->role->f_audit_boardcast)
@{{if is_audited || room_id == {!!$room->id!!}}}
@endif
<div class="chat-message  @{{>luckyMoneyCalss}} chat-message-type-@{{>type}} clearfix" data-time="@{{>time}}" data-msgid="@{{>id}}" id="js-chat-messages-@{{>id}}" >

	<div class="chat-message-content" data-luckymoneyid="@{{> luckyMoneyId }}">
		<div class="chat-message-meta" @if($sysConfig->chat_br) style="display:block;" @endif>
				@if($user->role->f_turn_msg )
				@{{if !hasFilter && ( selfShow || is_audited) }}
				<input @{{if selfShow }} style="display:none;" @{{/if}} type="checkbox" class="js-chat-checkbox chat-checkbox" name="messageId" value="@{{>id}}">
				@{{/if}}
				@endif
				<span class="chat-message-time">@{{>time}}</span>
				<span class="chat-message-role-@{{>userType}}"></span>
				<span data-uid="@{{>uid}}" data-name="@{{>name}}"  class="chat-message-name js-chat-select-name" >@{{>name}}</span>
				@if($sysConfig->show_root_room && $isManager)
				@{{if from_room_name}}
				<span class="chat-message-from-room" style="">转播：@{{>from_room_name}}</span>
				@{{/if}}
				@endif
				@{{if to_uid }}
				<span class="chat-message-to-user" >对</span>
				<span data-uid="@{{>to_uid}}" data-name="@{{>to_name}}" class="chat-message-name js-chat-select-name" >@{{>to_name}}</span>
				@{{/if}}
				@{{if !from_room_name}}
				@if($user->role->f_look )
					@{{if uid != {!!$user->uid!!}}}
 					<a class="chat-message-look-btn" data-uid="@{{>uid}}">看</a>
 					@{{/if}}
				@endif
				@{{/if}}
 				@if($user->role->f_deletechat  )
 				<a @{{if selfShow || hasFilter}} style="display:none;" @{{/if}} class="chat-message-delete-btn" data-id="@{{>id}}">删</a>
 				@endif
 				@if($user->role->f_audit )
					@{{if selfShow || !is_audited }}
						<a @{{if selfShow || hasFilter }} style="display:none;" @{{/if}} @{{if  send_roomid != {!!$room->id!!}}} @{{if room_id == 0}} style="background-color:#FF02E0;" @{{else}} style="background-color:red;" @{{/if}} @{{/if}} class="chat-message-audit-btn" data-id="@{{>id}}">审</a>
					@{{/if}}
				@endif
				
				
				@{{if type && type == 100 }} <img src="{{$cdn}}/assets/img/question.png" style="width: 18px;" />  @{{/if}}
		</div>
		<div class="chat-message-context" @{{if userType == 500 }} style="background-color: {{$sysConfig->mgr_color}};" @if($sysConfig->def_color) @{{else}} style="background-color: {{$sysConfig->def_color}};" @endif @{{/if}}>
			
				<span style="@{{if font_size }} font-size:@{{>font_size}}px; @{{/if}} @{{if font_weight }} font-weight:bold; @{{/if}} @{{if font_color }} color:@{{>font_color}}; @{{/if}}">@{{>message}}</span>
				@{{if hasFilter}} <span style="color:red"> (异常消息，请留意) </span> @{{/if}}
				@{{if vtype == 1}} <span style="color:red"> ({{$sysConfig->video_name1}}) </span> @{{/if}}
				@{{if vtype == 2}} <span style="color:red"> ({{$sysConfig->video_name2}}) </span> @{{/if}}
		</div>
		@if(!$sysConfig->hide_plat)
		@{{if plat && plat != 'pc' && plat != "phone"}}
		<span class="chat-message-plat" >来自:@{{>plat}}</span>
		@{{/if}}
		@endif
	</div>
</div>
@if(!$user->role->f_audit_boardcast)
@{{/if}}
@endif
</script>
<script id="js-chat-tips-history-tmpl" type="text/x-jsrender">
<div class="chat-tips-history">
	<span class="text">以上为历史消息</span>
</div>
</script>
<script id="js-chat-system-tmpl" type="text/x-jsrender">
<div class="chat-message   clearfix" id="js-chat-messages-@{{>id}}" >
	<div class="chat-message-content" data-luckymoneyid="@{{> luckyMoneyId }}">
		<div class="chat-message-meta">
			<span class="chat-message-time">@{{>time}}</span>
			<span  class="chat-message-name " >系统消息</span>
		</div>
		<div class="chat-message-context" style="pointer-events:none;">
				<span style="@{{if font_size }} font-size:@{{>font_size}}px; @{{else}} font-size:14px; @{{/if}} @{{if font_color }}  color:@{{>font_color}}; @{{else}}  color:red; @{{/if}}">@{{:text}}</span>
		</div>
	</div>
</div>
</script>
<script id="js-chat-robot-item-tmpl" type="text/x-jsrender">
<li class="user-item online select-role-robot" id="robot_user_@{{>uid}}"  data-type="@{{>type}}" data-name="@{{>name}}">
	<a class="dropdown-toggle" data-hover="dropdown11">
		<img src='@{{>pic}}' alt='user'/>
		<span @if($isManager) style="color:red;" @endif class='text'>@{{>name}}</span>
	</a>
	<div style="position:absolute;right:28px;top:0px;">
		@if($user->role->f_tochat && empty($sysConfig->hide_to_user))
		<span class="rolebtn rolebtn-tochat js-chat-select-name" data-uid="@{{>uid}}" data-name="@{{>name}}"> 说</span>
		@endif
		@if($user->role->f_look)
		<span class="rolebtn rolebtn-look" data-uid="@{{>uid}}" data-name="@{{>name}}"> 看</span>
		@endif
	</div>
	<span class="icon icon-@{{>type}}"></span>
</li>
</script>
<script id="js-chat-user-item-tmpl" type="text/x-jsrender">
 <li class="user-item online select-role-@{{>type}} @{{if type >= 500}} select-role-mgr @{{else type == 400}} select-role-teacher @{{else type == 100}} select-role-guest @{{else}} select-role-reg @{{/if}} @{{if  role && role.f_privatechat}} has-prichat @{{/if}}" id="user_@{{>uid}}_@{{>plat}}"  data-type="@{{>type}}" data-id="@{{>uid}}" data-name="@{{>name}}" >
 	<a class="dropdown-toggle" data-hover="dropdown11">
 		<img src='@{{>pic}}' alt='user'/>
 		<span class='text'>@{{>name}}</span>
		@{{if referrerId > 0}}
 		（<span class='number'>@{{>referrerId}}</span>）
		@{{/if}}
 	</a>
 	<div style="position:absolute;right:28px;top:0px;">
 	@if($user->role->f_privatechat)
 	@{{if  uid != {!!$user->uid!!} }}
 	<span class="rolebtn rolebtn-prichat" data-plat="@{{>plat}}" data-uid="@{{>uid}}" data-name="@{{>name}}" data-pic="@{{>pic}}"> 私 </span>
 	@{{/if}}
 	@else
 	@{{if role && role.f_privatechat}}
 	<span class="rolebtn rolebtn-prichat" data-plat="@{{>plat}}" data-uid="@{{>uid}}" data-name="@{{>name}}" data-pic="@{{>pic}}"> 私 </span>
 	@{{/if}}
 	@endif
 	@if($user->role->f_tochat && empty($sysConfig->hide_to_user))
	<span class="rolebtn rolebtn-tochat js-chat-select-name" data-uid="@{{>uid}}" data-name="@{{>name}}"> 说 </span>
	@endif
	@if($user->role->f_look)
	<span class="rolebtn rolebtn-look " data-uid="@{{>uid}}" data-name="@{{>name}}"> 看 </span>
	@endif
	</div>
 	<span class="icon icon-@{{>type}}"></span>
 </li>
</script>
<script id="js-common-status-tmpl" type="text/x-jsrender">
<div class="chat-message-status">
	<span class="chat-message-time">@{{>time}}</span>
	 <span class="chat-message-name">@{{>name}}</span> @{{>desc}}
</div>
</script>
<script id="js-chat-status-tmpl" type="text/x-jsrender">
<div class="chat-message-status">
	<span class="chat-message-time">@{{>time}}</span>
	欢迎 <span class="chat-message-name">@{{>name}}</span> 进入频道
</div>
</script>

<script id="js-recv-luckmoney-tmpl" type="text/x-jsrender">
<div class="chat-message-luckmoney" style="padding-left: 10px;">
	<div style="display: inline-block;">
		<span class="chat-message-time">@{{>time}}</span>
		<span class="chat-message-role-@{{>user.role_id}}"></span>
		<span class="chat-message-name">@{{>user.name}}</span>
	</div>
	<div class="lm-got-bg">
		<div style="margin-left: 82px;">
			<p style="color: #c92b2a;padding-top: 6px;margin: 0;">@{{>text}}</p>
			<p style="color: #fff;padding: 5px 0px;margin: 0;font-size: 12px;">@{{>user.name}}发送了一个现金红包</p>
			<span class="btn-got" data-id="@{{>lm_id}}"></span>
		</div>
	</div>
</div>
</script>

<script id="js-gotsuc-luckmoney-tmpl" type="text/x-jsrender">
<div class="lm-gotsuc">
<h1  style="font-size: 21px;font-weight:bold;text-align: center;color: #fff;">恭喜您(@{{>selfUid}})获得@{{>name}}的红包(@{{>lm_id}})，@{{>money}}元</h1>
<p style="color: #fff;width: 267px;margin: auto;padding-top: 25px;">!提示：请将此页面截图保存并发给客服人员领取奖励。</p>
<a class="btn-ok" href="javascript:;" onclick="window._lmSucDlg.remove();"></a>
</div>
</script>
<script id="js-gotfail-luckmoney-tmpl" type="text/x-jsrender">
<div class="lm-gotsuc">
<h1  style="font-size: 21px;font-weight:bold;text-align: center;color: #fff;">抱歉红包已经被抢完啦！</h1>
<p style="color: #fff;width: 267px;margin: auto;padding-top: 25px;">请坐等下次机会哦。</p>
<a class="btn-ok" href="javascript:;" onclick="window._lmFailDlg.remove();"></a>
</div>
</script>
<script id="js-luckmoney-phone-tmpl" type="text/x-jsrender">
	<div class='lm-phone-check form-horizontal' data-captcha="@{{>captcha}}" data-id="@{{>id}}">
	<div style="padding-top: 85px;">
		<div class="form-group">
			<label  class="col-xs-3 control-label">
				手机号
			</label>
			<div class="col-xs-9">
				<input class="js-phone form-control" onkeyup='this.value=this.value.replace(/\D/gi,"")' name="phone" placeholder1="输入手机号码" value="" />
			</div>
		</div>
		<div class="form-group" >
			<label for="code"  class="col-xs-3 control-label">
				短信码
			</label>
			<div class="col-xs-5">
				<input type="text"  name="smsCode" class="js-smsCode form-control" onkeyup='this.value=this.value.replace(/\D/gi,"")' placeholder1="短信验证码" required ></div>
			<div class="col-xs-4" style="padding-left:0px">
				<button type="button" style="cursor:pointer;background-color: #ff6600;border: none;" class=" btn btn-primary js-send-code">发送验证码</button>
			</div>
		</div>
		<a class="lm-btn-suc" href="javascript:;" ></a>
	</div>
	</div>
</script>
<script id="js-user-tmpl" type="text/x-jsrender">
<div class="card-info">
    <div class="clearfix" style="zoom: 1;">
      <div class="photo-con">
        <img width="64" height="64" src="@{{>pic}}">
      </div>
      <div class="user-info">
        <p>
        <span title="@{{>name}}" style="display: inline-block;white-space: nowrap;max-width: 100px;overflow: hidden;font-size: 14px;">@{{>name}}</span>
        </p>
        @{{if ip}}
        <p style="display: inline-block;">IP：@{{>ip}}</p>
        @{{/if}}
        @{{if ip_location}}
        <p style="display: inline-block;">地域：@{{>ip_location}}</p>
        @{{/if}}
        @if($site_name != "shengdacj")
	        @if($isManager && $user->room_id == 0)
	        @{{if phone}}
	        <p style="display: block;">电话：@{{>phone}}</p>
	        @{{/if}}
	        @endif

	        @if($isManager && $user->room_id != 0)
	        @{{if phone && {!!$user->room_id!!} == room_id }}
	        <p style="display: block;">电话：@{{>phone}}</p>
	        @{{/if}}
        	@endif
        @endif
      </div>
    </div>
  </div>
  <div class="user-opt clearfix">
 @{{if !robot }}
  	@if($user->role->f_gag)
  	@{{if ( room_id != 0 && ({!!$user->room_id!!} == 0 || {!!$user->room_id!!} == room_id ) ) }}
		<span  data-gag='@{{>gag}}' data-uid="@{{>uid}}" class="user-gag-btn">@{{if gag == 0 }}禁言@{{else}}解除禁言@{{/if}}</span>
  	@{{/if}}
	@endif

	@if($user->role->f_kick)
	@{{if ( room_id != 0 && ( {!!$user->room_id!!} == 0 || {!!$user->room_id!!} == room_id ) ) }}
		<span  data-kick='@{{>kick}}' data-uid="@{{>uid}}" class="user-kick-btn">@{{if kick == 0 }}踢出@{{else}}解除踢出@{{/if}}</span>
	@{{/if}}
	@endif

	@if($user->role->f_kick)
	@{{if ( room_id != 0 && ( {!!$user->room_id!!} == 0 || {!!$user->room_id!!} == room_id ) ) }}
		<span  data-lookvideo='@{{>lookvideo}}' data-uid="@{{>uid}}" class="user-lookvideo-btn">@{{if lookvideo == 0 }}看视频@{{else}}禁视频@{{/if}}</span>
	@{{/if}}
	@endif

	@if($user->role->f_ip)
	@{{if ( room_id != 0 && ( {!!$user->room_id!!} == 0 || {!!$user->room_id!!} == room_id ) )}}
	<span  data-uid="@{{>uid}}" class="user-ip-btn">封杀IP</span>
	@{{/if}}
	@endif
@{{/if}}

 </div>
</script>
<script  id="js-manual-tmpl" type="text/x-jsrender">
<div class="calendar-item">
	<table style="width:100%">
		<tr>
			<td class="f-value" colspan="3" >
				<span class="text-muted">标题:</span>
				@{{>title}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				@{{if mr_mc==1}}
				<span class="btn-success btn btn-sm">买入</span>
				@{{else}}
				<span class="btn-success btn btn-sm">卖出</span>
				@{{/if}}
			</td>
			<td class="f-value" colspan="2" >
				<span class="text-muted">建仓时间:</span>
				@{{>time}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				<div class="text-muted">分析师:</div>
				@{{if teacher}}
				@{{>teacher.name}}
				@{{/if}}
			</td>
			<td class="f-value">
				<div class="text-muted">类型:</div>
				@{{>typeDesc}}
			</td>
			<td class="f-value">
				<div class="text-muted">产品:</div>
				@{{>variety}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				<div class="text-muted">成本价:</div>
				<span class="value">@{{>cb_price}}</span>
			</td>
			<td class="f-value">
				<div class="text-muted">止损价:</div>
				<span class="value">@{{>zs_price}}</span>
			</td>
			<td class="f-value">
				<div class="text-muted">目标价:</div>
				<span class="value">@{{>mb_price}}</span>
			</td>
		</tr>
	</table>
</div>
</script>
<script id="js-publishbuyadvice-tmpl" type="text/x-jsrender">
<div class="suggestion-table">
<div class="calendar-item" style=" border:none;margin:0 0;border-radius: none;">
<table style="width:100%; font-size: 14px;">
@if($user->role->f_manual)
<tr>
			<td class="f-value" colspan="3" >
				<span class="text-muted">标题:</span>
				@{{>title}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				@{{if mr_mc==1}}
				<span class="btn-success btn btn-sm">买入</span>
				@{{else}}
				<span class="btn-success btn btn-sm">卖出</span>
				@{{/if}}
			</td>
			<td class="f-value" colspan="2" >
				<span class="text-muted">建仓时间:</span>
				@{{>time}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				<div class="text-muted">分析师:</div>
				@{{if teacher}}
				@{{>teacher.name}}
				@{{/if}}
			</td>
			<td class="f-value">
				<div class="text-muted">类型:</div>
				@{{>typeDesc}}
			</td>
			<td class="f-value">
				<div class="text-muted">产品:</div>
				@{{>variety}}
			</td>
		</tr>
		<tr>
			<td class="f-value">
				<div class="text-muted">成本价:</div>
				<span class="value">@{{>cb_price}}</span>
			</td>
			<td class="f-value">
				<div class="text-muted">止损价:</div>
				<span class="value">@{{>zs_price}}</span>
			</td>
			<td class="f-value">
				<div class="text-muted">目标价:</div>
				<span class="value">@{{>mb_price}}</span>
			</td>
		</tr>
		@else
		<tr>
	<td class="text-muted">
	暂无权限查看此内容，如有疑问，请联系客服。
</td>
</tr>
@endif

	</table>
</div>

</div>
</script>
<script id="js-video-yy-tmpl" type="text/x-jsrender">
<object id="videoE" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="100%">
	<param name="movie" value="http://yy.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yyscene.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<embed class="videoEmB" width="100%" height="100%" align="middle"
			id="videolive" src="http://yy.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yyscene.swf"
		type="application/x-shockwave-flash" autostart="false"
		wmode="transparent" allowfullscreen="true"
	allowscriptaccess="always" quality="high" />
</object>
</script>

<script id="js-video-letv-tmpl" type="text/x-jsrender">
<object type="application/x-shockwave-flash" id="videoplayer" name="videoplayer" align="middle" data="http://sdk.lecloud.com/live.swf" width="100%" height="100%">
	<param name="wmode" value="direct">
	<param name="quality" value="high">
	<param name="bgcolor" value="#000000">
	<param name="allowscriptaccess" value="always">
	<param name="allowfullscreen" value="true">
	<param name="flashvars" value="activityId=@{{>channelNumber}}">
	<param name="wmode" value="transparent" />
	<param name="quality" value="high" />
</object>
</script>
<script id="js-article-tmpl" type="text/x-jsrender">
<div class="media" id="article_@{{>id}}">
		<div class="media-body">
			<h5 class="media-heading" style="line-height: 1.3em;">@{{>title}}</h5>
			<ul class="media-meta list-inline text-muted" style="font-size:12px;">
				<li>
					<span class="text">@{{>time}}</span>
				</li>
				<li>
					<span class="text">阅读:</span>
					<span class="js-article-reader-num">@{{>count}}</span>
				</li>
				<li class="pull-right">ss
					<span class="text">作者:</span>
					<span>@{{if teacher}}@{{>teacher.name}}@{{/if}}</span>
				</li>
			</ul>
			<div class="media-summay clearfixed">@{{:text}}</div>
		</div>
		<ul class="media-meta list-inline text-muted"  style="font-size:12px;margin-top: 5px;">
			<li class="pull-right">
				<a class="btn btn-info btn-xs js-article-reader-btn" data-id="@{{>id}}" data-display="collapse" style="color: #fff">查看全文</a>
			</li>
		</ul>
	</div>

	</script>
<script id="js-file-tmpl" type="text/x-jsrender">
<tr>
	<td style="vertical-align: middle; ">
		<a href="/live/downloadfile/@{{>room_id}}?id=@{{>id}}" target="_blank" >
			<img src="{{$cdn}}/assets/img/filelist.png">
		</a>
	</td>
	<td>
		<div>

			<a href="/live/downloadfile/@{{>room_id}}?id=@{{>id}}" target="_blank">@{{>filename}}
			</a>
		</div>
		<ul class="list-inline text-muted">
			<li>
				<small>
					<i class="icon-download"></i>
					@{{>count}}次下载
				</small>
			</li>
			<li>
				<small>
					<i class="icon-user"></i>
					@{{>time}}
				</small>
			</li>
		</ul>
	</td>
</tr>
</script>

<script  id="js-gift-item-tmpl" type="text/x-jsrender">
	<div class="js-send-gift" data-id="@{{>id}}" title="@{{>name}}每@{{>ts}}分钟增加1@{{>dw}}，最多获取@{{>max}}@{{>dw}}" style="cursor:pointer;float: left;margin: 0px 5px;min-width: 68px;text-align: center;">
		<img src="@{{>imgurl}}">
		<div style="color:#111;">@{{>name}}(<span id="js-gift-num-@{{>id}}">@{{>gift_num}}</span>)</div>
	</div>
</script>

<script  id="js-gift-show-tmpl" type="text/x-jsrender">
	<span></span><img src="">
</script>


<script  id="js-fxts-show-tmpl" type="text/x-jsrender">
	<div class="js-fxts-first">
		<span class="title">风险提示</span>
		<div class="content">
			你的休闲鞋手动阀胜多负少
		</div>
	</div>
</script>

<script  id="js-fxts-teacher-tmpl" type="text/x-jsrender">
	<div class="js-fxts-first">
		<span class="title">请选择讲师</span>
		<div></div>
	</div>
</script>

<script  id="js-chose-video-tmpl" type="text/x-jsrender">
<form id="choseVideoForm" action="/live/chosevideo/{{$room->id}}" class="form-horizontal">
	<div class="form-group">
	<div class="input-group">
	<label class="checkbox-inline" style="margin-left: 10px;">
	<input type="radio" name="tname" value="{{$sysConfig->video_name1}}">{{$sysConfig->video_name1}}
	</label><label class="checkbox-inline" style="margin-left: 10px;">
	<input type="radio" name="tname" value="{{$sysConfig->video_name2}}">{{$sysConfig->video_name2}}
	</label><label class="checkbox-inline" style="margin-left: 10px;">
	<input type="radio" name="tname" value=""> 无
	</label>
	</div></div>
	<div class="form-group">
	<div class="controls text-center">
			<button type="submit" class="btn btn-primary">确定</button>
	</div>
	</div>
	</form>

</script>
<script id="js-chat-status-leave-tmpl" type="text/x-jsrender">
@if($isManager)
<div class="chat-message-status">
	<span class="chat-message-time">@{{>time}}</span>
	<span class="chat-message-name">@{{>name}}</span> 离开频道
</div>
@endif
</script>
<script  id="js-giftv2s-tmpl" type="text/x-jsrender">

<div class="gift-panel">
	<ul class="gift-tab">
	@{{for giftCates}}
		<li data-target="@{{>id}}" @{{if id == 1}} class="on" @{{/if}}>@{{>name}}<!-- <i class="dot-new"></i> --></li>
	@{{/for}}
	</ul>

	<div class="gift-con">
		<div class="gift-group">
		@{{for giftCates}}
			<div id="js-gift-group-@{{>id}}" class="gift-wrap @{{if id != 1}} hidden @{{/if}}">
				
					<div class="M-arrow-scroll">
						<div class="con">
							<div class="gift-scroll" style="padding:1px;overflow-x: hidden; height: 132px;">
								<ul class="clearfix gift-page active" style="margin: 0px 0px;" data-page="0">
									@{{for ~root.giftV2s}}
									@{{if #parent.parent.data.id == cate_id}}
									<li class="gift" data-locked="0" data-title="@{{>name}}" data-name="@{{>name}}" data-id="@{{>id}}" data-credit="@{{>price}}" data-path="@{{>pic}}" >
										<div class="gift-pic">
											<img src="@{{>pic}}">
											<i class="luck-mark gold-mark"></i>
											<i class="is-event"></i>
										</div>
									</li>
									@{{/if}}
									@{{/for}}
									
								</ul>
								
							</div>
						</div>
					</div>
				
			</div>
			@{{/for}}
		</div>
	</div>
</div>
</script>

<script id="js-gift-tips-tmpl" type="text/x-jsrender" >
<div class="MR-gift-tip" style="left: @{{>left}}px; top: @{{>top}}px; ">
	<div class="tip-content">
		<img class="tip-img" src="@{{>path}}">
		<div class="gift-tip-con">
			<span class="gift-tip-name">@{{>name}}</span>
			<span class="gift-tip-price">@{{>credit}}积分</span>
		</div>
		<div class="gift-tip-desc">&nbsp;</div>
	</div>
</div>
</script>

<script id="js-pro-ryPopGift-tmpl" type="text/x-jsrender">
        <i class="icon-avatar" style="background-image:url(@{{>avatar}}) !important;"></i>
        <div class="nickname">@{{>user}}</div>
        <div class="giftname">@{{>giftName}}</div>
        <i class="icon-gift" style="background-image:url(@{{>giftPath}}) !important;"></i>
        <div class="giftNum active" data-num="1">x1</div>
</script>
<script id="js-video-yynew-tmpl" type="text/x-jsrender">
<object id="videoE" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="100%">
	<param name="movie"  value="http://weblbs.yystatic.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yycomscene.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<embed class="videoEmB" width="100%" height="100%" align="middle"
			id="videolive" src="http://weblbs.yystatic.com/s/@{{>channelNumber}}/@{{>channelNumber}}/yycomscene.swf"
		type="application/x-shockwave-flash" autostart="false"
		wmode="transparent" allowfullscreen="true"
	allowscriptaccess="always" flashvars="sceneType=5&danmu=true&volume=0.5&source=http%3A%2F%2Fwww.yy.com%2F@{{>channelNumber}}f%3D0%26cpuid%3D0&anchorId=0&livedelay=1&coop=0&topSid=@{{>channelNumber}}&subSid=@{{>channelNumber}}" quality="high" />
</object>
</script>


<script id="js-hot-question-tmpl" type="text/x-jsrender">
<div><ul id="js-hot-dialog" style="font-family: 微软雅黑">
@{{for questions}}
<li data-id="@{{>id}}">
	<div>问题：@{{>ask}}</div>
	<div><input type="radio" name="hot__@{{>id}}" value="1">@{{>answer1}}
	<input type="radio" name="hot__@{{>id}}" value="2">@{{>answer2}}
	<input type="radio" name="hot__@{{>id}}" value="3">@{{>answer3}} </div>
</li>
@{{/for}}
</ul></div>
</script>