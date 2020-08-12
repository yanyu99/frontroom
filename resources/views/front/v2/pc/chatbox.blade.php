
<div class="main-center">
	<div class="main-content-menu">
		@if($roomUI->show_user_num)
			<div  class="user-num-warp" >
				<a href="javascript:;" class="dropdown-toggle"  data-hover="dropdown">
					<span class="text " >
						<img src="{{$cdn}}/assets/v2/img/v2/onlineNub.png" height="29px;">
						<span style="line-height: 29px;vertical-align: -1px;display: inline-block;" id="idUserTotal">{{$roompower->base_user}}</span>
					</span>
				</a>
				@if($user->role->f_base_user)
				<div class="dropdown-menu " style="width:160px;">
					<input id="idChangeUserInput" style="width: 90px;display: inline;margin-left: 5px;"  class="form-control" type="text" name="title" >
					<span id="idChangeUserBase" style="vertical-align: 0.5px;" class="btn btn-success ">确定</span>
				</div>
				@endif
			</div>
			@endif
		<div class="chat-content-exFun">
				@if( $sysConfig->show_rank )
				<div style="display: inline-block;">
					<span class="dropdown-toggle btn-rank" data-hover="dropdown" >排行榜</span>
					<div class="dropdown-menu " style=" color: #fff;min-width: 50px;
					padding: 10px;background-color: #000;border: 1px solid #fff;border-radius: 3px;">
						@if( $containJC )
							<div id="js-betrank-btn" style="cursor: pointer;margin-bottom: 8px;">竞猜排行榜</div>
						@endif
						<div id="js-jfrank-btn" style="cursor: pointer;margin-bottom: 8px;">积分排行榜</div>
						<div id="js-giftrank-btn" style="cursor: pointer;margin-bottom: 8px;">送礼排行榜</div>
						<div id="js-gifgottrank-btn" style="cursor: pointer;">人气排行榜</div>
					</div>
				</div>
				@endif
				@if($roomUI->show_past)
				<div style="display: inline-block;position: relative;  ">
				<span id="idUserPast" class="btn-past" >签到</span>
				<div id="idUserPastRed" class ="past-pointer"></div>
				</div>
				@endif
				<div id="chat-lock-screen-btn"  class="chat-content-exFun-item">
					<i class="icon icon-unlock"></i>
					锁屏
				</div>
				<div id="chat-clean-screen-btn" class="chat-content-exFun-item">
					<i class="icon icon-trash"></i>
					清屏
				</div>
				<!--<span id="chat-notice-deskTop-btn" class="chat-content-exFun-item">
					<i class="icon icon-volume-down"></i>
					桌面通知
				</span>-->
			</div>
	</div>
	<div class="tab-content main-conent-panle">
		<div class="tab-pane chat-wrap active" id="chat">
			<div class="chat-wrap-content-top">
				<div class="chat-top-history"  style="display: list-item;">
					<i class="icon-bullhorn text-danger"></i>
					<span class="chat-notice-name">公告</span>：
					<div class="notice_wrap">
						<span id="js_notice_msg">{{$room->notice_msg}}</span>
					</div>
				</div>
			</div>
			<div id="gift_show" class="chat-gift-show"></div>
			<div class="chat-wrap-height">
				<div class="chat-wrap-content nice-scroll-h" @if($room->chat_top_msg) style="position:absolute; bottom:30px;" @endif>
				
				</div>
				@if($room->chat_top_msg)
				<div   class="chat-notify-msg-common  dropup" style="position: absolute;bottom: 0px;"><span style="cursor:pointer;color: rgb(249,219,77)" id="chat_tz_msg" class="dropdown-toggle"  data-hover="dropdown">{{$room->chat_top_msg}}</span>
					@if($user->role->f_notify)
					<div class="dropdown-menu " style="width:270px;">
					<input id="idNotifyInput" style="width: 200px;display: inline;margin-left: 5px;"  class="form-control" type="text" name="title" >
					<span id="idNotifyBtn" style="vertical-align: 0.5px;" class="btn btn-success ">确定</span>
					</div>
					@endif
				</div>
				@endif
			</div>

			<div class="chat-float-model" >
				@if($roomUI->show_phonewem)
					<div class="chat-float-model-item">
					<a  class="dropdown-toggle" data-hover="dropdown" data-logtype="30">
						<i class="icon icon_phone_ewm"></i>
					</a>
					<div>手机直播</div>
					<div class="dropdown-menu " style="left:-214px;top:0px;width:200px;height:200px;">
					@if($roomUI->wechat_img && $roomUI->replace_qrcode)
						<img src="{{$roomUI->wechat_img}}" class="qr-code-img">
					@else
						<p  class="qr-code-img" style="margin-top: 4px;" id="qrcode"></p>
					@endif
					</div>
				</div>
				@endif
				@if($user->role->f_luck_max_money)
					<div  class="chat-float-model-item">
					<i class="icon icon_luck_money" ></i>
					<div>发红包</div>
				</div>
				@endif
				@if($roomUI->show_gift)
					<div  class="chat-float-model-item" >
					<a class="dropdown-toggle" data-hover="dropdown" data-logtype="30">
						<i class="icon icon_send_gift"></i>
					</a>
					<div>送礼物</div>
					<div id="js-gift-warp" class="dropdown-menu " >
					</div>
				</div>
				@endif
				@if($site->jf_opend)
					<div class="treasure chat-float-model-item">
					<i class="close-treasure-box hidden"></i>
					<div class="treasure-box animate1"></div>
					<div class="treasure-count-down"><span>__:__</span></div>
				</div>
				@endif
				@foreach($roomnavs as $nav)
					@if($nav->pos == 2)
						@if($nav->type == 4017)
							<div data-id="{{$nav->id}}" data-width="{{$nav->url['width']}}" data-height="{{$nav->url['height']}}" class="chat-float-model-item js-ui-dialog-{{$nav->type}}" data-title="{{$nav->title}}">
								<i class="icon icon_chat_common" style="cursor: pointer;background-image: url('{{ !empty($nav->icon) ? $nav->icon : "{$cdn}/assets/img/ui_icon/{$nav->type}.png?v={$webver}"  }}')"></i>
								<div>{{$nav->title}}</div>
							</div>
						@else
							<div data-id="{{$nav->id}}"  class="chat-float-model-item js-ui-dialog-{{$nav->type}}" data-title="{{$nav->title}}">
								<i class="icon icon_chat_common" style="cursor: pointer;background-image: url(@if(!empty($nav->icon)) {{$nav->icon}} @else {{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png?v=1 @endif)"></i>
								<div>{{$nav->title}}</div>
							</div>
						@endif
					@endif
				@endforeach
			</div>
							
			<div class="chat-bottom" style="position: absolute;bottom: 0px;width:100%">
			@if($roomUI->show_guest_sub)
			<div class="chat-guest-sub" style="height: 30px;">
				<span>游客福利！免费获取操作建议，老师的实战课件</span>
				<div class="chat-guest-right">
					<input id="idGuestPhoneInput" type="text" name="title" placeholder="请输入手机号码" >
					<span style="cursor: pointer;line-height: 30px;" id="idGuestSubPhone">免费订阅</span>
				</div>
			</div>
			@endif
							
			<form class="chat-form" >
			@if($chat_qqs->count() > 0)
				<div class="chat-form-qqs">
					<div class="qq-title" >{{$sysConfig->qqtext}}</div>
					<div class="qq-item" >
						{{-- */ $qqIndex = 0; /* --}}
						@foreach($chat_qqs as $value)
						@if($qqIndex++ <= 3)
						<a href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank" >
							<img @if($sysConfig->qq_img) src="{{$sysConfig->qq_img}}" @else src="{{$cdn}}/assets/v2/img/v2/qq2.png" @endif height="26">
						</a>
						@endif
						@endforeach
					</div>
					<a href="javascript:;" class="qq-more" >更多助理></a>
				</div>
				@endif
				@if($user->role->f_caitiao)
				<div class="chat-form-caitiao">
					<span  data-name='[彩条-鲜花V2]'><i class="ct-xh"></i>送花</span>
					<span  data-name='[彩条-给力V2]'><i class="ct-gl"></i>给力</span>
					<span  data-name='[彩条-鼓掌V2]'><i class="ct-gz"></i>鼓掌</span>
					<span  data-name='[彩条-顶起V2]'><i class="ct-dq"></i>顶起</span>
					<span  data-name='[彩条-点赞V2]'><i class="ct-dz"></i>点赞</span>
				</div>	
				@endif

				<!-- 聊天输入区域  -->
				
				<!-- ttt {{$sysConfig->chatbox_style}} -->
				<div class="chat-send-box @if($sysConfig->chatbox_style) chat-view-new @endif">
				<!-- start 2017-12-06 -->
				<!-- <div class="chat-form-exFun " id="root_chatfunc">
				   <div id="root_chatul">	
					<span id="js-chat-faces-btn" class="itemfunc face chat-form-exFun-item icon-smile"></span>
					@if($user->role->f_img)
					<span id="js-chat-picture-btn" class="itemfunc chat-form-exFun-item icon-pic"></span>
					@endif
					@if($site->gift_opend)
					<span id="js-gift-btn" class="itemfunc chat-form-exFun-item icon-gift " style="text-indent: -9999px;">
					<div class="MR-gift" id="js-gift-panel">
					</div>
					</span>
					@endif
					@if($user->role->f_font_size)
					<div id="js-chat-color-btn" class="itemfunc dropup" data-color="#333">
						<div class="in " class="dropdown-toggle" data-toggle="dropdown" style="background-color:#333"></div>
						<ul class="dropdown-menu" style="min-width: 148px;">
						    <li><div id="colorpalette1"></div></li>
						</ul>
					</div>
					<span class="itemfunc"  style="vertical-align: 11px;">
						<select id="js-font-size-list" style="border: 1px solid #c4c4c4;color: #333; width: 40px;font-size:12px">
							@for($i=18;$i>=12;$i--)
							<option value="{{$i}}" @if($i==14) selected @endif data-size="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</span>
					<div class="itemfunc chat-font-bold-chose" style="">B</div>
					@endif
					@if($user->role->f_danmu)
					<div class= "itemfunc chat-danmu-chose">弹</div>
					@endif
					@if($user->role->f_tochat)
					@if($sysConfig->mgr_to_chat)
					<span class="itemfunc"  style=" vertical-align: 12px;">
						<select id="js-chat-mgr-list" style="border: 1px solid #c4c4c4;color: #333; width: 60px;font-size:12px">
							<option value="" selected>无</option>
							@if($roomLiveInfo->live_state && $roomLiveInfo->teacher )
							<option class="cur-teacher" value="{{$roomLiveInfo->teacher_uid}}" data-teacher="1" data-name="{{$roomLiveInfo->teacher->name}}">{{$roomLiveInfo->teacher->name}}</option>
							@endif
						</select>
					</span>
					@endif
					<div class="itemfunc to-chat-warp" style="display: inline-block;">
						<span style="vertical-align: 13px;font-size: 14px; ">对</span>
						<span id="js-chat-to-user" data-uid=""  class="to-chat-content" >大家</span>
						<span style="vertical-align: 13px;font-size: 14px;margin-right: 5px;">说</span>
						<i class="myclose" style="display:none;"></i>
					</div>
					@endif
					
					@if($user->role->f_robot_send)
					<div class="itemfunc chat-robot-warp">
						<select id="js-robot-num" style=" border: 1px solid #c4c4c4;color: #333; width: 40px;font-size: 12px;">
							<option value="0">无</option>
							<option value="1">1</option>
							<option value="3">3</option>
							<option value="5">5</option>
							<option value="7">7</option>
							<option value="10">10</option>
						</select>
						<select id="js-robot-list" style=" border: 1px solid #c4c4c4;color: #333; width: 60px;font-size: 12px;@if($user->role->f_turn_msg)margin-right: 18px;@endif">
							<option value="0">机器人</option>
						</select>
					</div>
					@endif
					
					 @if($user->role->f_turn_msg)
					 <span  class="btn  btn-default share-btn-chatbar" style="vertical-align: 2px;" id="js-chat-form-more-share-btn">转播消息</span
					@endif
					<span  class="itemfunc " id="turn-next"></span>
					
				  </div>
				</div>
				
				<style>
				    .chat-send-box{}
					#root_chatul{ width:100%; height:42px; position:absolute;}
				    .chat-send-box span{}
					.turnR{ right:300px;}
					#turn-next{ 
						float:right;  
						background-image: url('/assets/img/chatbar/arrowl.png?_v=2') !important;
						background-position: center;
						background-repeat: no-repeat;
						display: inline-block;
						width: 24px;
						height: 38px;
						z-index:9999;
					}
					.chat-robot-warp{ right:24px;}
					#js-chat-form-more-share-btn{ display:inline-block; 
						position:relative !important;
					    left: 0px !important;
						top: 0px !important;
						margin-left:42px;
					}
				</style>
				<script>
				   
					$(document).ready(function(){
						$("#turn-next").click(function (e) {
							var box = document.getElementById("root_chatfunc"); //外面的容器。
							var listBox = document.getElementById("root_chatul"); //ul列表。主要是移动它的left值
							// var list = document.getElementsByTagName("chat-form-exFun-item"); //所有列表元素
							var list = document.getElementsByClassName('itemfunc');///所有列表元素
							var width = box.clientWidth / 2; //为了判断是左滑还是右滑
							var totalWidth = 0;
							for (let i = 0; i < list.length; i++) {
							  totalWidth = totalWidth + list[i].offsetWidth; //所有列表元素的总宽度
							}

							console.log("totalWidth===",totalWidth);
							  var _offset = totalWidth - box.clientWidth; //右边的偏移量

							var offset =
								totalWidth - (Math.abs(listBox.offsetLeft) + box.clientWidth) + 100; //右边的偏移量 = 所有元素宽度之和 - （ul容器的左偏移量 + 父容器的宽度）
							
							$("#root_chatul").toggleClass('turnR')
							if($("#root_chatul").hasClass('turnR')){
								//listBox.style.width = totalWidth + box.clientWidth + 100+'px'
								console.log("offset============",offset);
								//listBox.style.left = -_offset + "px";
								listBox.style.left = _offset -160 + "px";
							}
							else{
								listBox.style.left = 6 +"px";
							}
						});
					})
				</script> -->




				<!-- 原版保留 -->
				<div class="chat-form-exFun">
					<span id="js-chat-faces-btn" class="face chat-form-exFun-item icon-smile"></span>
					@if($user->role->f_img)
					<span id="js-chat-picture-btn" class="chat-form-exFun-item icon-pic"></span>
					@endif
					@if($site->gift_opend)
					<span id="js-gift-btn" class="chat-form-exFun-item icon-gift " style="text-indent: -9999px;">
					<div class="MR-gift" id="js-gift-panel">
					</div>
					</span>
					@endif
					@if($user->role->f_font_size)
					<div id="js-chat-color-btn" class="dropup" data-color="#333">
						<div class="in " class="dropdown-toggle" data-toggle="dropdown" style="background-color:#333"></div>
						<ul class="dropdown-menu" style="min-width: 148px;">
						    <li><div id="colorpalette1"></div></li>
						  </ul>
					</div>
					<span  style="vertical-align: 11px;">
						<select id="js-font-size-list" style="border: 1px solid #c4c4c4;color: #333; width: 40px;font-size:12px">
							@for($i=18;$i>=12;$i--)
							<option value="{{$i}}" @if($i==14) selected @endif data-size="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</span>
					<div class="chat-font-bold-chose" style="">B</div>
					@endif
					@if($user->role->f_danmu)
					<div class= "chat-danmu-chose">弹</div>
					@endif
					@if($user->role->f_tochat)
					@if($sysConfig->mgr_to_chat)
					<span  style=" vertical-align: 12px;">
						<select id="js-chat-mgr-list" style="border: 1px solid #c4c4c4;color: #333; width: 60px;font-size:12px">
							<option value="" selected>无</option>
							@if($roomLiveInfo->live_state && $roomLiveInfo->teacher )
							<option class="cur-teacher" value="{{$roomLiveInfo->teacher_uid}}" data-teacher="1" data-name="{{$roomLiveInfo->teacher->name}}">{{$roomLiveInfo->teacher->name}}</option>
							@endif
						</select>
					</span>
					@endif
					<div class="to-chat-warp" style="display: inline-block; height:42px; z-index: 999; ">
						<span style="vertical-align: 13px;font-size: 14px; ">对</span>
						<div style="position:relative;display: inline-block;z-index:99">
							<span id="js-chat-to-user" data-uid=""  class="to-chat-content" >大家</span>
						    <i class="myclose" style="display:none;"></i>
						</div>
						
						<span style="vertical-align: 13px;font-size: 14px;margin-right: 5px;">说</span>
						<!-- <i class="myclose" style="display:none;"></i> -->
					</div>
					@endif
					
					@if($user->role->f_robot_send)
					<div class=" chat-robot-warp">
						<select id="js-robot-num" style=" border: 1px solid #c4c4c4;color: #333; width: 40px;font-size: 12px;">
							<option value="0">无</option>
							<option value="1">1</option>
							<option value="3">3</option>
							<option value="5">5</option>
							<option value="7">7</option>
							<option value="10">10</option>
						</select>
						<select id="js-robot-list" style=" border: 1px solid #c4c4c4;color: #333; width: 60px;font-size: 12px;@if($user->role->f_turn_msg)margin-right: 18px;@endif">
							<option value="0">机器人</option>
						</select>
					</div>
					@endif
					@if($user->role->f_turn_msg)
					<div id="js-chat-form-more" class="chat-form-more" style="z-index: 100;">
							<span id="js-expend-btn" style="vertical-align: 2px;" class="expend-btn"> 
							</span>
							<span  class="btn  btn-default share-btn-chatbar" style="vertical-align: 2px;" id="js-chat-form-more-share-btn">转播消息</span>
					</div>
					@endif
				</div>



				<div class="chat-bot">
					<div class="chat-form-input-wrap" >
						<textarea class="chat-form-input nice-scroll" id="js-chat-form-input"></textarea>
					</div>
					<div style="clear:both;"></div>
					<div class="chat-form-op">
						<button type="button" class="chat-form-btn send-btn" id="js-send-btn"> 	
							@if(!$sysConfig->chatbox_style) 
								 <font>发送</font> 
								@endif
							</button>
						@if($user->role->f_notice)
						<!-- <div style="clear:both;"></div> -->
						<button type="button" class="chat-form-btn notice-btn" id="js-notice-btn"></button>
						@endif
				   </div>
				</div>

				<style>
					.chat-bot{width:100%; height:80px;  
						display: -webkit-box;
						display: -webkit-flex;
						display: inline-flex;         /* 新版本语法: Opera 12.1, Firefox 22+ */  
						display: flex;

						/* flex-flow: column;   */
						/* position:relative; */
					}
					.chat-form-input-wrap{ 
						 @if($user->role->f_notice)
						 width:490px;
						 width:-moz-calc(100% - 155px);
						 width:-webkit-calc(100% - 155px);
						 /* width:calc(100% - 160px) ; */
						 width:calc(100% - 144px) ;

						 @else 
						 width:566px;
						 width:-moz-calc(100% - 82px);
						 width:-webkit-calc(100% - 82px);
						 width:calc(100% - 82px);
						 @endif 
						 /* -webkit-box-flex: 1;
						-webkit-flex: 1;
						flex: 1; */

						 
						}
						.chat-form-op{ 
							float:right;
							position: absolute;
							top: 44px;
							/* top:1px; */
							right: 0;
						
							display: -webkit-box;
							display: -webkit-flex;
							display: inline-flex; 
						}
						.send-btn{ margin-left:1px; }
						.notice-btn{ margin-left:2px; _margin-left:3px; *margin-left:3px; }
				
				</style>

<!-- 
               <div style=" width:100%; height:80px; position:relative;">
				<div class="chat-form-input-wrap" style="margin-right: @if($user->role->f_notice) 143px; @else 80px; @endif">
					<textarea class="chat-form-input nice-scroll" id="js-chat-form-input"></textarea>
				</div>
				<div class="chat-form-op" style="width: @if($user->role->f_notice) 143px; @else 80px; @endif">
					<button type="button" class="chat-form-btn send-btn" id="js-send-btn"></button>					
					@if($user->role->f_notice)					
					<button type="button" class="chat-form-btn notice-btn" id="js-notice-btn"></button>					
					@endif
				</div>
			  </div> -->
			  
				</div>

			</form>
			@if($room->chat_bottom_msg)
			<div id="chat_mzsm_msg"  class="chat-notify-msg-common chat-notify-bottom">{{$room->chat_bottom_msg}}</div>
			@endif
			</div>
		</div>
	</div>
</div>