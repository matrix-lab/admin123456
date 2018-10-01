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
        <div class="layui-logo">Running DevOps</div>
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
            <li class="layui-nav-item">
                <a href="">个人中心<span class="layui-badge-dot"></span></a>
            </li>
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
                <li class="layui-nav-item  {{\Request::is('/') ? 'layui-this' :''}}"><a
                            href="/">控制中心</a></li>
                <li class="layui-nav-item  {{\Request::is('team') ? 'layui-this' :''}}"><a
                            href="{{route('devops.team')}}">团队管理</a></li>
                <li class="layui-nav-item {{\Request::is('user') ? 'layui-this' :''}}"><a
                            href="{{route('devops.user')}}">人员管理</a></li>
                <li class="layui-nav-item {{\Request::is('customer') ? 'layui-this' :''}}"><a
                            href="{{route('devops.customer')}}">客户管理</a></li>
                <li class="layui-nav-item {{\Request::is('task') ? 'layui-this' :''}}"><a
                            href="{{route('devops.task')}}">任务管理</a></li>
                <li class="layui-nav-item {{\Request::is('version') ? 'layui-this' :''}}"><a
                            href="{{route('devops.version')}}">发布管理</a></li>
                <li class="layui-nav-item {{\Request::is('motto') ? 'layui-this' :''}}"><a
                            href="{{route('devops.motto')}}">每日一图</a></li>
            </ul>
        </div>
    </div>
    <div class="layui-body">
        <div style="margin: 15px;">
            @yield('content')
        </div>
    </div>
    <div class="layui-footer">
        © Running DevOps - Admin123456
    </div>
</div>
<script src="/js/layui.all.js"></script>
<script src="/assets/libs/axios/axios.min.js"></script>
@yield('scripts')
</body>
</html>