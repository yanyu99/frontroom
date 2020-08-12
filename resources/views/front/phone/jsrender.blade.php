
<script id="js-chat-message-tmpl" type="text/x-jsrender">
  <div class="dms-message-info"  id="js-chat-messages-@{{>id}}" data-msgid="@{{>id}}">
    <span class="dms-date">@{{>time}}</span>
    <span class="chat-message-role-@{{>userType}}"></span>
    <span data-uid="@{{>uid}}" data-name="@{{>name}}" class="dms-nick @if($user->role->f_tochat) select-to-chat @endif" title="@{{>uid}}" >@{{>name}}</span>
    @{{if to_uid }}
    <span class="dms-date" style="background-color: rgb(238, 120, 0);" >对</span>
    <span data-uid="@{{>to_uid}}" data-name="@{{>to_name}}" class="dms-nick  @if($user->role->f_tochat) select-to-chat @endif" >@{{>to_name}}</span>
    @{{/if}}
    @if($sysConfig->show_root_room && $isManager)
    @{{if from_room_name}}
    <span class="chat-message-from-room" style="">转播：@{{>from_room_name}}</span>
    @{{/if}}
    @endif
    <div class="chat-content-warp" >
    <span style="@{{if userType == 500 }} background-color: {{$sysConfig->mgr_color}}; @{{/if}} @{{if font_weight }} font-weight:bold; @{{/if}}  @{{if font_color }} color:@{{>font_color}};@{{else}} color: #333; @{{/if}}" class="dms-content chat-message-context">@{{:message}}</span>
      @{{if hasFilter}} <span style="color:red"> (异常消息，请留意) </span> @{{/if}}
      @{{if vtype == 1}} <span style="color:red"> ({{$sysConfig->video_name1}}) </span> @{{/if}}
      @{{if vtype == 2}} <span style="color:red"> ({{$sysConfig->video_name2}}) </span> @{{/if}}
    </div>
  </div>
</script>



<script id="js-prichat-message-tmpl" type="text/x-jsrender">
  <div class="dms-message-info"  >
    <span class="dms-date">@{{>time}}</span>
    
    <span data-uid="@{{>uid}}" data-name="@{{>name}}" class="dms-nick select-pri-chat" title="@{{>uid}}" >@{{>name}}</span>
    <span class="dms-date" style="background-color: rgb(238, 120, 0);" >对您私聊</span>
   
    <div class="chat-content-warp">
    <span style=" color: #333;" class="dms-content chat-message-context">@{{:message}}</span>
    </div>
  </div>
</script>



<script id="js-prichat-my-message-tmpl" type="text/x-jsrender">
  <div class="dms-message-info"  >
    <span class="dms-date">@{{>time}}</span>
    <span class="dms-date" style="background-color: rgb(238, 120, 0);" >对</span>
    <span data-uid="@{{>uid}}" data-name="@{{>name}}" class="dms-nick select-pri-chat" title="@{{>uid}}" >@{{>name}}</span>
    <span class="dms-date" style="background-color: rgb(238, 120, 0);" >私聊</span>
   
    <div class="chat-content-warp">
    <span style=" color: #333;" class="dms-content chat-message-context">@{{:message}}</span>
    </div>
  </div>
</script>



<script id="js-chat-system-tmpl" type="text/x-jsrender">
  <div class="dms-message-info" >
    <span class="dms-date">@{{>time}}</span>
    <span data-uid="@{{>uid}}" data-name="@{{>name}}" class="dms-nick" title="@{{>uid}}" >系统消息</span>
    <div class="chat-content-warp"><span style="font-weight: bold;  color:red;" class="dms-content chat-message-context">@{{:text}}</span></div>
  </div>
</script>



<script id="js-chat-user-item-tmpl" type="text/x-jsrender">
 <li class="user-item online select-role-@{{>type}} @{{if  role && role.f_privatechat}} has-prichat @{{/if}}"  id="user_@{{>uid}}_@{{>plat}}"  data-type="@{{>type}}" data-id="@{{>uid}}" data-name="@{{>name}}">
  <a >
    <img src='@{{>pic}}' alt='user'/>
    <span class='text'>@{{>name}}</span>
    @{{if referrerId > 0}}
    （<span class='number'>@{{>referrerId}}</span>）
    @{{/if}}
  </a>
  @if($user->role->f_privatechat)
  @{{if  role && !role.f_privatechat}}
  <span class="rolebtn rolebtn-prichat" data-plat="@{{>plat}}" data-uid="@{{>uid}}" data-name="@{{>name}}" data-pic="@{{>pic}}"> 私 </span>
  @{{/if}}
  @else
  @{{if role && role.f_privatechat}}
  <span class="rolebtn rolebtn-prichat" data-plat="@{{>plat}}" data-uid="@{{>uid}}" data-name="@{{>name}}" data-pic="@{{>pic}}"> 私 </span>
  @{{/if}}
  @endif
  <span class="icon icon-@{{>type}}"></span>
 </li>
</script>



<script id="js-robot-item-tmpl" type="text/x-jsrender">
 <li class="user-item online select-role-robot"  id="user_@{{>uid}}_@{{>plat}}"  data-type="@{{>type}}" data-id="@{{>uid}}" data-name="@{{>name}}">
  <a >
    <img src='@{{>pic}}' alt='user'/>
    <span class='text'>@{{>name}}</span>
  </a>
  <span class="icon icon-@{{>type}}"></span>
 </li>
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
              <div class="scroll" style="">
                <div class="clearfix gift-page active" data-page="0">
                  @{{for ~root.giftV2s}}
                 
                  @{{if #parent.parent.data.id == cate_id}}
                  <a style="cursor: pointer;" class="gift" data-locked="0" data-title="@{{>name}}" data-name="@{{>name}}" data-id="@{{>id}}" data-credit="@{{>price}}" data-path="@{{>pic}}" >
                    <div  style="cursor: pointer;" class="gift-pic">
                      <img style="cursor: pointer;width: 60px;height: 60px;" src="@{{>pic}}">
                      
                    </div>
                  </a>
                  @{{/if}}
                  @{{/for}}
                  <div class="clearfix"></div>
                </div>
                
              </div>
            </div>
          </div>
        
      </div>
      @{{/for}}
    </div>
  </div>
</div>
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