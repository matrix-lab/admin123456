@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row layui-col-space15" style="color: #fff;">
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #009688; border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                团队总数
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\Models\Team::count()}}
            </h2>
        </div>
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #5FB878;border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                人员总数
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\User::count()}}
            </h2>
        </div>
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #1E9FFF;border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                客户总数
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\Models\Customer::count()}}
            </h2>
        </div>
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #FFB800;border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                任务总数
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\Models\Task::count()}}
            </h2>
        </div>
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #FF5722;border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                发布次数
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\Models\Version::count()}}
            </h2>
        </div>
        <div class="layui-col-md2 layui-col-xs2 layui-anim layui-anim-scale"
             style="text-align: center;background: #2F4056;border: 8px solid #fff;">
            <h3 style="height: 50px;line-height: 50px;">
                每日一图
            </h3>
            <h2 style="height: 30px;line-height: 30px;">
                {{\App\Models\Motto::count()}}
            </h2>
        </div>
    </div>
    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs9 layui-col-sm9 layui-col-md9">
            <div class="layui-card" style="background: #eee;">
                <div class="layui-card-header">
                    <h3>最新任务 <span style="color: red;font-weight: bolder;">【🙏求带走🙏】</span></h3>
                </div>
                <div class="layui-card-body">
                    <dl class="layuiadmin-card-status">
                        @foreach($tasks as $task)
                            <dd style="display: flex;padding: 15px;">
                                <div style="width: 48px;">
                                    <img src="/images/logo.png"
                                         style="width:48px; border-radius: 24px;">
                                </div>
                                <div style="margin-left: 8px;">
                                    <div><span style="color: #FF5722;">{{$task->come_from}}</span> - {{$task->content}}
                                    </div>
                                    <p>{{$task->created_at}}</p>
                                </div>
                            </dd>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
        <div class="layui-col-xs3 layui-col-sm3 layui-col-md3">
            <div class="layui-card" style="background: #eee;">
                <div class="layui-card-header">
                    <h3>每日一图</h3>
                </div>
                <div class="layui-card-body">
                    <ul class="layui-timeline">
                        @foreach($mottos as $motto)
                            <li class="layui-timeline-item">
                                <img src="{{avatar($motto->user_email)}}" alt="user" width="64"
                                     class="rounded-circle layui-timeline-axis">
                                <div class="layui-timeline-content layui-text">
                                    <h4 class="layui-timeline-title"
                                        style="color: #1E9FFF;font-weight: bolder;">{{$motto->user_alias}}</h4>
                                    <p>{{$motto->content}}</p>
                                    <p style=" cursor: pointer;"
                                       onclick="like('{{$motto->id}}')">👍
                                        +<span id="motto_{{$motto->id}}">{{$motto->star}}</span></p>
                                    <p class="layui-layout-right" style="color: #FF5722;">{{$motto->created_at}}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
      function like(motto_id) {
        axios.put('/api/motto/' + motto_id + '/like').then(function (result) {
          document.getElementById("motto_" + motto_id).innerHTML = result.data.star;
          layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
        })
      }
    </script>
@endsection

