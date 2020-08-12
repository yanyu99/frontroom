<script id="js-hot-li-tmpl" type="text/x-jsrender">
@{{for teachers}}
    <li data-id="@{{>id}}" id="hot-tid-@{{>id}}" class="ter-hot-li @{{if fired }} ter-fired @{{/if}}">
        <div class="ph-num"
            @{{if #getIndex() == 0}} style="background-color: red;"
            @{{else #getIndex() == 1 || #getIndex() == 2}} style='background-color:#FF9C00;'
            @{{else}} style="background-color:#3285ED"
            @{{/if}} >
            @{{:#getIndex() + 1}}
        </div>
            <span class="teacher-name" style="position: relative;">
                @{{if fired }}
                    <img src="{{$cdn}}/assets/img/fire.png" style="position: absolute;left: 2px;top: -5px;">
                @{{/if}}
                @{{if name_color=='#ffffff' || name_color=='#FFFFFF' }}
                <span>
                @{{else}}
                <span style="color:#fff">
                @{{/if}}
                    <b>@{{>name}}</b>
                </span>
                <span class="num">
                    （<span class="hot-rank-num">@{{:hot_got + hot_base}}</span>）
                </span>
            </span>
            @{{if !fired }}
                <a class="zan_teacher @{{if ~root.userTidMap[id] }} zan @{{/if}}" data-id="@{{>id}}" data-test=@{{> ~root.userTidMap[id] }}>{{ \app\Util::is_mobile_request() ? '' : '投票' }} </a>
            @{{/if}}
    </li>
@{{/for}}
</script>