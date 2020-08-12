<!-- 判断是否显示 侧边栏 菜单 如果所有元素都不存在 自动隐藏侧边菜单 并增大聊天区域和视频区域  控制 div 为 main-sider-menu  -->
@if( $site->hot_opend || $roomnavs->filter(function ($value, $key) {return $value->pos == 3;})->count() > 0 || $sysConfig->stock_code || $roomUI->show_siderewm || $roomUI->show_siderlist )

    <div class="main-sider-menu">

        @if($site->hot_opend)
            <div class="sider-hot-rank">
                <div class="hot-rank-head"><img @if($sysConfig->hot_img) src="{{$sysConfig->hot_img}}"
                                                @else src="{{$cdn}}/assets/img/renqi.png" @endif style="width: 212px;">
                </div>
                <div class="hot-rank-body">
                    <ul id="idHotRank" class="nice-scroll-h">

                    </ul>
                </div>
            </div>
        @endif

        @if($roomnavs->filter(function ($value, $key) {return $value->pos == 3;})->count() > 0)
            <div class="sider-top-new">
                <ul>
                    @foreach($roomnavs as $nav)
                        @if($nav->pos == 3)
                            <li>
                                @if($nav->type == 4003)
                                    <a href="{{$nav->url['url']}}" target="_blank">
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>
                                @elseif($nav->type == 4002)
                                    <a href="javascript:;"
                                       @if(empty($nav->title)) style="line-height: 36px;font-size: 0px;display: block;"
                                       @endif @if(isset($nav->url['imgurl']))  data-img="{{$nav->url['imgurl']}}"
                                       @endif @if(isset($nav->url['qqtype']) && !empty($nav->url['qqtype'])) class="my-pop-img-qq"
                                       data-qqtype="{{$nav->url['qqtype']}}" @else class="my-pop-img" @endif >
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>

                                @elseif($nav->type == 4004)
                                    <a href="javascript:;" class="nav-show-qq">
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>
                                @elseif($nav->type == 4017)
                                    <a href="javascript:;" data-width="{{$nav->url['width']}}"
                                       data-height="{{$nav->url['height']}}" data-id="{{$nav->id}}"
                                       class="nav-show-banner">
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>
                                @elseif($nav->type == 4500)
                                    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$nav->url['qq']}}&amp;site=qq&amp;menu=yes"
                                       target="_blank" data-qq="{{$nav->url['qq']}}" data-id="{{$nav->id}}"
                                       class="nav-show-banner">
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>
                                @else
                                    <a href="javascript:;" data-id="{{$nav->id}}" class="js-ui-dialog-{{$nav->type}}"
                                       data-title="{{$nav->title}}">
                                        <div style="text-align: center;padding-top: 10px;"><img style="width: 32px;"
                                                                                                @if(!empty($nav->icon)) src="{{$nav->icon}}"
                                                                                                @else src="{{$cdn}}/assets/img/ui_icon/{{$nav->type}}.png" @endif>
                                        </div>
                                        @if(!empty($nav->title))<span>{{$nav->title}}</span>@endif
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        @if($sysConfig->stock_code)
            {{-- */$arr = explode(',',$sysConfig->stock_code);/* --}}

            <div class="sider-top">
                <div class="title"><img src="{{$cdn}}/assets/v2/img/v2/stockIco.png"><span style="margin-left: 5px;">行情动态</span>
                </div>
                {{--<div style="width:100%;height:50px"></div>--}}
                <div class="body">
                    @foreach($arr as $key=> $value)
                        <div class="guzhi-item" id="idStock{{$key}}" data-code="{{$value}}">
                            <span class="name">加载中</span>
                            <div style="float: right;">
                                <span class="num"></span>
                                <span class="per-num"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(count($arr)>3)
                    <div class="bottom bottom_down">
                        <img src="{{$cdn}}/assets/v2/img/arrow_down.png" alt="">
                    </div>
                @endif
            </div>
            <script type="text/javascript">
                //点击下拉出现列表
                $(function () {
                    var stock_h = 34;
                    var stock_len = $('.guzhi-item').length;
                    var length = stock_h * stock_len + 'px';

                    $(".bottom ").click(function () {
                        $(this).toggleClass("bottom_down") // change
                    });
                    $(".bottom ").click(function () {
                        if (stock_len <= 3) {
                            return;
                        }
                        var that = this;
                        if ($(that).hasClass('bottom_down')) {
                            $(that).prev().css('max-height', '102px');
                            $('.bottom img').css('transform', 'rotate(360deg)');
                        }
                        else {
                            $(that).prev().css('max-height', length);
                            $('.bottom img').css('transform', 'rotate(180deg)');
                        }
                        typeof resizeSiderUl === 'function' && resizeSiderUl();
                    })
                });
            </script>
        @endif

        @if($roomUI->show_siderewm)
            <div class="sider-ewm">
                @if($roomUI->wechat_img)
                    <img src="{{$roomUI->wechat_img}}">
                @else
                    <p style="margin: auto;padding: 10px;padding-bottom: 7px; background-color: #fff;" id="qrcode1"></p>
                @endif
            </div>
        @endif

        @if($roomUI->show_siderlist)
            <div class="sider-userlist">
                <div class="title"><img src="{{$cdn}}/assets/v2/img/v2/uselistico.png"><span
                            style="margin-left: 5px;">{{$sysConfig->ul_title}}</span>@if($roomUI->show_user_num)(<span
                            id="idUserTotal1"></span>)@endif</div>
                <div class=" user-list nice-scroll">
                    @if($user->role->f_search )
                        <form class="user-list-search" onsubmit="return false;">
                            <input type="text" class="search-input" id="search-input" placeholder="搜索"></form>
                    @endif
                    @if($user->role->f_ul_select)<select id="js-ul-type-list" class="user-list-typelist">
                        <option value="all">全部</option>
                        <option value="mgr" data-name="管理员">管理员(0)</option>
                        <option value="teacher" data-name="讲师">讲师(0)</option>
                        <option value="reg" data-name="会员">会员(0)</option>
                        <option value="guest" data-name="游客">游客(0)</option>
                    </select>
                    @endif
                    @if( $user->role->f_userlist)
                        <div class="user-list-wrap">
                            <ul id="idUserList" style="    margin-bottom: 0px;">
                            </ul>
                            <div id="js-more-user" style="padding: 5px;text-align: center;cursor: pointer;">获取更多</div>
                        </div>
                    @elseif($roomUI->ulimg)
                        <div class="user-list-wrap"
                             style="height: 100%;background-image: url({{$roomUI->ulimg}});"></div>
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
        @endif

        @if( $roomUI->show_siderteacher)
            <style type="text/css">
                .sider-teacher {
                    position: relative;
                    height: 100px;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                }
                .st-title {
                    background-color: rgba(0, 0, 0, 0.7);
                    height: 30px;
                    line-height: 30px;
                    font-size: 14px;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                }
                .st-title-main {
                    font-size: 15px;
                    float: left;
                    margin-left: 10px;
                }
                .st-title-btn {
                    font-size: 12px;
                    float: right;
                    margin-right: 12px;
                    cursor: pointer;
                }
                .st-list {
                    height: 70px;
                    padding: 5px 0;
                    background-color: rgba(0, 0, 0, 0.5);
                }
                .st-list .overflow ul {
                    margin-left: 0;
                    height: 100%;
                    white-space: nowrap;
                }
                .st-list .overflow ul > li {
                    display: inline-block;
                    width: 42px;
                    height: 100%;
                    margin-left: 7px;
                    margin-right: 6px;
                }
                .st-item img {
                    width: 42px;
                    height: 42px;
                    border-radius: 20px;
                    border: 2px solid #fff;
                }
                .st-item p {
                    margin-top: 3px;
                    font-size: 12px;
                }
                .ts-info {
                    width: 233px;
                    height: 200px;
                    position: absolute;
                    z-index: 100;
                    left: 0;
                    bottom: 103px;
                    background: url({{$cdn}}/assets/v2/img/intrbg.jpg) center -25px no-repeat;
                    background-size: cover;
                    display: none;
                }
                .ts-info h1 {
                    width: 100%;
                    height: 22px;
                    text-align: center;
                    font-size: 20px;
                    margin-top: 15px;
                }
                .ts-info > span {
                    display: block;
                    width: 90%;
                    margin: 0 auto;
                    height: 120px;
                    font-size: 14px;
                    overflow-y:;
                }
                .ts-info .ts-zan p {
                    width: 100%;
                    height: 35px;
                    line-height: 30px;
                    color: yellow;
                    position: absolute;
                    bottom: -10px;
                    font-size: 14px;
                }
                .ts-info .ts-zan p span {
                    font-size: 18px;
                }
                .overflow {
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }
            </style>
            <div class="sider-teacher">
                <div class="st-title">
                    <span class="st-title-main">{{$sysConfig->ter_title}}</span>
                    <span class="st-title-btn">换一换</span>
                </div>
                <div class="st-list">
                    <div class="overflow">
                        <ul>
                            @foreach($teachers as $ter)
                                <li class="st-item teacher_{{$ter['id']}}"
                                    data-total="{{$ter['total']}}"
                                    data-today="{{$ter['today']}}">
                                    <a href="#">
                                        <img src="{{ !empty($ter['imgurl']) ? $ter['imgurl'] : "{$cdn}/assets/icon/ter_default.png"  }}">
                                        <p style="color:#fff;">{{$ter['name']}}</p>
                                    </a>
                                    <div class="ts-info ">
                                        <h1>{{$ter['name']}}</h1>
                                        <span class="nice-scroll" style="white-space: pre-wrap">{!! $ter['introduction'] !!}</span>
                                        <div class="ts-zan">
                                            <p>今日点赞数：<span class="data-today"></span>
                                                &nbsp;&nbsp;累计：<span class="data-total"></span></p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function contains(root, el) {//compareDocumentPosition
                    if (root.compareDocumentPosition)
                        return root === el || !!(root.compareDocumentPosition(el) & 16);
                    if (root.contains && el.nodeType === 1) {
                        return root.contains(el) && root !== el;
                    }
                    while ((el = el.parentNode))
                        if (el === root) return true;
                    return false;
                }

                $(document).ready(function () {
                    var tipsTimer = null;
                    $('.st-item').mouseover(function () {
                        var dom = $(this);
                        $('.ts-info').each(function () {
                            var obj = $(this);
                            if (!contains(dom, obj) && obj.is(':visible')) {
                                obj.hide();
                                if (tipsTimer) {
                                    clearTimeout(tipsTimer);
                                    tipsTimer = null;
                                }
                            }
                        });
                        dom.find('.ts-info').css('display', 'block');
                        $('.data-today').text(dom.data('today'));
                        $('.data-total').text(dom.data('total'));
                    });
                    $('.st-item').mouseout(function () {
                        var dom = $(this);
                        var obj = dom.find('.ts-info');
                        if(obj.is(':visible')){
                            tipsTimer = setTimeout(function () {
                                obj.css('display', 'none');
                            }, 500);
                        }
                    });
                    $('.ts-info').mouseout(function () {
                        var obj = $(this);
                        obj.parent().find('.ts-info').css('display', 'none');
                    });
                    $('.ts-info').mouseover(function () {
                        if (tipsTimer) {
                            clearTimeout(tipsTimer);
                            tipsTimer = null;
                        }
                    });
                    //换一换
                    var _click = true;
                    $('.st-title-btn').click(function () {
                        var linum = $('.overflow >ul').find('li').length;
                        var ul_len = linum * 59;
                        var m1 = parseInt($('.overflow ul').css('marginLeft'));
                        var offset = 236;

                        if (!_click || linum <= 4) {
                            return;
                        }
                        _click = false; //阻止连续点击
                        if (m1 + ul_len <= offset) {
                            $('.overflow ul').animate({marginLeft: 0 + 'px'}, 5, function () {
                                _click = true;
                            });
                        } else {
                            var tmp = m1 + ul_len - offset;
                            offset = tmp < offset ? tmp : offset;
                            $('.overflow ul').animate({marginLeft: m1 - offset + 'px'}, 400, function () {
                                _click = true;
                            });
                        }
                    });
                })

            </script>
        @endif

    </div>
@endif