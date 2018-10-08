<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Super DevOps Task Tracking</title>
    <link rel="stylesheet" href="/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">
            <img src="/images/logo.png"
                 class="layui-nav-img layui-anim layui-anim-rotate"> Running DevOps
        </div>
        <ul class="layui-nav layui-layout-right ">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="{{avatar(Auth::user()->email)}}" class="layui-nav-img"> {{ Auth::user()->alias }}
                </a>
                {{--<dl class="layui-nav-child">--}}
                {{--<dd><a href="">我的任务</a></dd>--}}
                {{--<dd><a href="">安全设置</a></dd>--}}
                {{--</dl>--}}
            </li>
            <li class="layui-nav-item">
                <a href="">我的任务<span class="layui-badge">9</span></a>
            </li>
            {{--<li class="layui-nav-item">--}}
            {{--<a href="">个人中心<span class="layui-badge-dot"></span></a>--}}
            {{--</li>--}}
            <li class="layui-nav-item">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item  {{\Request::is('/') ? 'layui-this' :''}}">
                    <a href="/"><i class="layui-icon layui-icon-console"></i> 控制中心</a></li>
                <li class="layui-nav-item  {{\Request::is('team') ? 'layui-this' :''}}">
                    <a href="{{route('devops.team')}}"><i class="layui-icon layui-icon-group"></i> 团队管理</a></li>
                <li class="layui-nav-item {{\Request::is('user') ? 'layui-this' :''}}">
                    <a href="{{route('devops.user')}}"><i class="layui-icon layui-icon-user"></i> 人员管理</a></li>
                <li class="layui-nav-item {{\Request::is('customer') ? 'layui-this' :''}}">
                    <a href="{{route('devops.customer')}}"><i class="layui-icon layui-icon-face-smile-fine"></i>
                        客户管理</a></li>
                <li class="layui-nav-item {{\Request::is('task') ? 'layui-this' :''}}">
                    <a href="{{route('devops.task')}}"><i class="layui-icon layui-icon-tabs"></i> 任务管理</a></li>
                <li class="layui-nav-item {{\Request::is('version') ? 'layui-this' :''}}">
                    <a href="{{route('devops.version')}}"><i class="layui-icon layui-icon-fonts-code"></i> 发布管理</a></li>
                <li class="layui-nav-item {{\Request::is('motto') ? 'layui-this' :''}}">
                    <a href="{{route('devops.motto')}}"><i class="layui-icon layui-icon-picture"></i> 每日一图</a></li>
            </ul>
        </div>
    </div>
    <div class="layui-body">
        <div style="margin: 15px;">
            @yield('content')
        </div>
    </div>
    <div class="layui-footer">
        <div class="layui-row">
            <div class="layui-col-md10">
                © Running DevOps - {{Carbon\Carbon::now()->year}}
            </div>
            <div class="layui-col-md2">
                <div style="text-align: right;">
                    当前在线:<span id="online" style="color: red;">1</span>人
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/layui.all.js"></script>
<script src="/assets/libs/axios/axios.min.js"></script>
<script>
  var online = document.getElementById('online');
  var websocket = new WebSocket("ws://0.0.0.0:8090");
  websocket.onopen = function (event) {
    console.log("欢迎您，{{Auth::user()->name}} to DevOps Club.");
    websocket.send(
      JSON.stringify(
        {
          id: "{{Auth::user()->id}}",
          name: "{{Auth::user()->name}}"
        }
      ));
  };
  websocket.onmessage = function (event) {
    // if (JSON.parse(event.data).data !== undefined) {
    //   var info = JSON.parse(JSON.parse(event.data).data);
    //   layer.msg('老铁们，' + info.name + ' 来了 👏👏', {icon: 6, offset: 'rt', anim: 2});
    // }
    online.innerText = JSON.parse(event.data).count;
  };

  websocket.onclose = function (event) {
    online.innerText = event.data;
  };

  websocket.onerror = function (event, e) {
    console.error("老铁，您的服务异常了.");
  };
</script>
@yield('scripts')
</body>
</html>