{{-- */$i=1/* --}}
@foreach($teachers as $key =>$teacher)
    @if($teacher)
    <li data-id="{{$teacher['id']}}" id="hot-tid-{{$teacher['id']}}" class="ter-hot-li {{ $teacher['fired'] ? "ter-fired" : ""  }}">
        <div class="ph-num"
             @if($i ==0 ) style="background-color: red;"
             @elseif($i ==1 || $i==2) style="background-color:#FF9C00;"
             @else style="background-color:#3285ED;"
             @endif >
            {{$i++}}
        </div>
        <span class="teacher-name" style="position: relative;">
            @if($teacher['fired'])
                <img src="{{$cdn}}/assets/img/fire.png" style="position: absolute;left: 2px;top: -5px;">
            @endif{{$teacher['name']}}
            <span class="num">
                （<span class="hot-rank-num">{{$teacher['hot_got'] + $teacher['hot_base']}}</span>）
            </span>
        </span>
        @if(!$teacher['fired'])
            <a class="zan_teacher @if(!empty( $userTidMap[ $teacher['id'] ] )) zan @endif " data-id="{{$teacher['id']}}">{{ \app\Util::is_mobile_request() ? '' : '投票' }} </a>
        @endif
    </li>
    @endif
@endforeach