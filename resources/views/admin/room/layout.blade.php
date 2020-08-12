@extends('admin.layouts.base')
@section('head')
    <link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet">
    <link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading">手机样式配置</header>
                <div class="panel-body">
                    <form id="myForm" class="form-horizontal" method="post">
                        {{ $ctrl->csrf_field() }}
                        <input type="hidden" name="tag" value="{{$tag}}">

                        <div class="form-group">
                            <span class="col-sm-4 col-sm-4 control-label">配置项：</span>
                            <div class="col-sm-6">
                                <select id="tag-select" class="form-control" onchange="changeTag(this.value);">
                                    @foreach($layout as $lk=>$lv)
                                        <option value="{{$lk}}"
                                                data-tag="{{$lk}}">{{ !empty($tagTitle["{$PRE}.{$lk}"]) ? $tagTitle["{$PRE}.{$lk}"] : $lk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @foreach($layout as $lk=>$lv)
                            <div class="form-layout form-{{$lk}}" style="display: none;">
                                @foreach($lv as $tk=>$tv)
                                    <div class="form-group form-type form-{{$lk}}-{{$tk}}">
                                        <span class="col-sm-4 col-sm-4 control-label">{{ !empty($tv['title']) ? $tv['title'] : $tk  }}
                                            ：</span>
                                        @if($tv['type']=='color')
                                            <div class="col-sm-4 col-{{$lk}}-{{$tk}}">
                                                <input name="config[{{$PRE}}.{{$lk}}.{{$tk}}]"
                                                       class="form-control dropdown-toggle"
                                                       id="selected-{{$lk}}-{{$tk}}" data-toggle="dropdown"
                                                       value="{{$tv['val']}}" data-default="{{$tv['default']}}">
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div id="colorpalette-{{$lk}}-{{$tk}}"></div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <button type="button" class="btn btn-danger js-clear" id="reset-{{$lk}}-{{$tk}}">重置</button>
                                            @push('scripts')
                                                <script type="text/javascript">
                                                    $("#colorpalette-{{$lk}}-{{$tk}}").colorPalette().on('selectColor', function (e) {
                                                        $("#selected-{{$lk}}-{{$tk}}").val(e.color);
                                                        syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", e.color);
                                                    });
                                                    $("#reset-{{$lk}}-{{$tk}}").click(function () {
                                                        var val = $("#selected-{{$lk}}-{{$tk}}").data('default');
                                                        $("#selected-{{$lk}}-{{$tk}}").val(val);
                                                        syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", val);
                                                    });
                                                </script>
                                            @endpush
                                        @elseif($tv['type']=='image')
                                            <div class="col-sm-6 col-{{$lk}}-{{$tk}}  layoutimg">
                                                <div class="img-upload">
                                                    <div id="id-{{$lk}}-{{$tk}}-Img"></div>
                                                    <p id="id-{{$lk}}-{{$tk}}-ImgTip" class="webuploader-tip"></p>
                                                    <p>
                                                        <input class="form-control" type="hidden"
                                                               name="config[{{$PRE}}.{{$lk}}.{{$tk}}]"
                                                               id="id-{{$lk}}-{{$tk}}-ImgInput" value="{{$tv['val']}}"
                                                               data-default="{{$tv['default']}}"/>
                                                        <img id="id-{{$lk}}-{{$tk}}-ImgShow" src="{{$tv['val']}}" alt=""
                                                             height="100" width="100"/>
                                                    </p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger js-clear" id="reset-{{$lk}}-{{$tk}}">重置</button>
                                            @push('scripts')
                                                <script type="text/javascript">
                                                    doUpload({
                                                        id: "id-{{$lk}}-{{$tk}}-Img",
                                                        intputId: "id-{{$lk}}-{{$tk}}-ImgInput",
                                                        showId: "id-{{$lk}}-{{$tk}}-ImgShow",
                                                        descId: "id-{{$lk}}-{{$tk}}-ImgTip",
                                                        csrf_token: '{{ $ctrl->csrf_token() }}',
                                                        fileSize: 200 * 1024,
                                                        callback: function (response) {
                                                            $("#id-{{$lk}}-{{$tk}}-ImgInput").val(response.img);
                                                            $("#id-{{$lk}}-{{$tk}}-ImgShow").attr('src', response.img);
                                                            $("#id-{{$lk}}-{{$tk}}-ImgTip").text('');
                                                            syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", response.img);
                                                        }
                                                    });
                                                    $("#reset-{{$lk}}-{{$tk}}").click(function () {
                                                        var val = $("#id-{{$lk}}-{{$tk}}-ImgInput").data('default');
                                                        $("#id-{{$lk}}-{{$tk}}-ImgInput").val(val);
                                                        $("#id-{{$lk}}-{{$tk}}-ImgShow").attr('src', val);
                                                        syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", val);
                                                    });
                                                </script>
                                            @endpush
                                        @elseif($tv['type']=='text')
                                            <div class="col-sm-4 col-{{$lk}}-{{$tk}}">
                                                <input class="form-control" type="text" id="text-{{$lk}}-{{$tk}}"
                                                       name="config[{{$PRE}}.{{$lk}}.{{$tk}}]" value="{{$tv['val']}}"
                                                       data-default="{{$tv['default']}}">
                                            </div>
                                            <button type="button" class="btn btn-danger js-clear" id="reset-{{$lk}}-{{$tk}}">重置</button>
                                            @push('scripts')
                                                <script type="text/javascript">
                                                    $("#text-{{$lk}}-{{$tk}}").change(function () {
                                                        syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", $(this).val());
                                                    });
                                                    $("#reset-{{$lk}}-{{$tk}}").click(function () {
                                                        var val = $("#text-{{$lk}}-{{$tk}}").data('default');
                                                        $("#text-{{$lk}}-{{$tk}}").val(val);
                                                        syncLayout("{{$PRE}}", "{{$lk}}", "{{$tk}}", val);
                                                    });
                                                </script>
                                            @endpush
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        @if($curRoom->parent == 0)
                            <div class="form-group">
                                <span class="col-sm-4  control-label" style="color: red;">是否将以上配置同步到所有代理房间：</span>
                                <div class="col-sm-6">
                                    <input type="checkbox" class="js-switch" name="sync_child"/></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="controls text-center">
                                <button type="submit" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-primary" onclick="resetInput()">重置</button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
        <div class="col-sm-4">

            <div class="mobile-iframe">
                <iframe id="demo-iframe" src="{{$demoUrl}}" style="width: 375px;height: 667px;border: 0px;"></iframe>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
            src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
    <script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
    <script type="text/javascript">
        var DATA_LAYOUT = {!! !empty($layout) ? json_encode($layout) : '{}'  !!};

        function changeTag(tag) {
            $('.form-layout').hide();
            $('.form-' + tag).show();
        }
        function resetInput(){
            //循环触发button
            var tag = $("#tag-select").val();
            $(".form-" + tag+"  button").each(function(index,item){
                $(item).click();
            })
        }

        function syncLayout(pre, tag, type, val) {
            var demo = document.getElementById('demo-iframe');
            if (demo && demo.contentWindow && demo.contentWindow.postMessage) {
                var data = {
                    pre: pre, tag: tag, type: type, val: val
                };
                console.warn && console.warn('syncLayout', data);
                demo.contentWindow.postMessage(data, "*");
            }
        }

        $(function () {
            changeTag($('#tag-select').val());
            setTimeout(() => {
               $("#js-video-player-wrap") && $("#js-video-player-wrap").addClass("hideflash");
            }, 3000);
        })

    </script>
    <style>
     /* .index-video-wrap{ overflow: hidden !important;}   */
     .hideflash{overflow: hidden !important;}
     .phone-wrapper{
        width: 418px;
        height: 907px;
        padding-top: 98px;
        background: url(/assets/backend/images/phone_bg.png) no-repeat;
        background-size: 100%;
        box-sizing: border-box;
        transition-delay: .1s;
        transition: right .7s cubic-bezier(.77,0,.175,1)
     }
     .mobile-iframe{  overflow: hidden !important;}
     .layoutimg .webuploader-container>div{ width:86px; height:40px;}
    </style>
@endsection