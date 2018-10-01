@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>人员管理</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal" data-method="offset" data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="user" lay-filter="user"></table>
    <div id="user_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-user" id="devops-user" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="name"
                                   required
                                   lay-verify="required"
                                   placeholder="姓名"
                                   autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">昵称</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="alias"
                                   required
                                   lay-verify="required"
                                   placeholder="昵称"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属团队</label>
                        <div class="layui-input-block">
                            <select name="team_id" lay-verify="required" id="team_id">
                                @foreach($teams as $k=>$v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">手机</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="mobile"
                                   required
                                   lay-verify="phone"
                                   placeholder="手机号码"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">生日</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="birthday"
                                   name="birthday"
                                   required
                                   lay-verify="date"
                                   placeholder="生日"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="email"
                                   required
                                   lay-verify="email"
                                   placeholder="登录邮箱"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-block">
                            <input type="password"
                                   name="password"
                                   lay-verify=""
                                   placeholder="初始密码必填"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-hide">
                        <input type="button" lay-submit="" lay-filter="devops-user-submit" id="devops-user-submit"
                               value="确认">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/html" id="operation">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
      layui.use(['table', 'laydate', 'flow'], function () {
        var $ = layui.jquery, table = layui.table, form = layui.form, laydate = layui.laydate, flow = layui.flow;

        laydate.render({
          elem: '#birthday'
        });
        // 添加
        $('.layui-btn-normal').on('click', function () {
          form.val("devops-user", {
            "name": "",
            "alias": "",
            "team_id": "",
            "mobile": "",
            "birthday": "",
            "email": "",
            "password": ""
          })
          layer.open({
            type: 1,
            title: '创建人员',
            shade: false,
            anim: 6,
            area: '480px',
            content: $('#user_html'),
            moveType: 1,
            btn: ['保存', '关闭'],
            yes: function (index, layero) {
              form.on('submit(devops-user-submit)', function (data) {
                data.field.team_alias = $("#team_id option:selected").text()
                axios.post('/api/user', data.field).then(function () {
                  layer.msg('👍👍👍干的漂亮')
                }).then(function () {
                  table.reload('user');
                  layer.close(index)
                })
              });
              $('#devops-user-submit').trigger('click');
            },
            btn2: function (index, layero) {
              layer.close(index)
            }
          });
        });
        // 表格数据
        table.render({
          elem: '#user'
          , url: '/api/user/'
          , page: true
          , limit: 50
          , height: 'full-175'
          , title: '人员清单'
          , toolbar: true
          , cellMinWidth: 80
          , cols: [[
            {field: 'name', width: 80, align: 'center', title: '姓名'}
            , {
              field: 'avatar',
              width: 80,
              align: 'center',
              title: '头像',
              templet: '<div><img lay-src="@{{d.avatar}}"  class="lay-img" style="width: 28px; height: 28px; border-radius: 14px;"></div>'
            }
            , {field: 'alias', minWidth: 100, title: '昵称'}
            , {field: 'team_alias', minWidth: 120, title: '团队'}
            , {field: 'email', minWidth: 120, title: '邮箱'}
            , {field: 'mobile', minWidth: 120, title: '手机'}
            , {field: 'birthday', minWidth: 120, title: '生日'}
            , {field: 'created_at', width: 170, align: 'center', title: '创建时间', sort: true}
            , {field: 'updated_at', width: 170, align: 'center', title: '更新时间', sort: true}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 120}
          ]]
          , done: function () {
            flow.lazyimg({
              elem: "img.lay-img",
              scrollElem: ".layui-table-body"
            });
          }
        });
        table.on('tool(user)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/user/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-user", {
              "name": me.name,
              "alias": me.alias,
              "team_id": me.team_id,
              "mobile": me.mobile,
              "birthday": me.birthday,
              "email": me.email,
            })
            layer.open({
              type: 1,
              title: '编辑人员',
              shade: false,
              anim: 6,
              area: '480px',
              content: $('#user_html'),
              moveType: 1,
              btn: ['保存', '关闭'],
              yes: function (index, layero) {
                form.on('submit(devops-user-submit)', function (data) {
                  data.field.team_alias = $("#team_id option:selected").text()
                  axios.put('/api/user/' + me.id, data.field).then(function () {
                    layer.msg('👍👍👍干的漂亮')
                  }).then(function () {
                    table.reload('user');
                    layer.close(index)
                  })
                });
                $('#devops-user-submit').trigger('click');
              },
              btn2: function (index, layero) {
                layer.close(index)
              }
            });
          }
        });
      });
    </script>
@endsection
