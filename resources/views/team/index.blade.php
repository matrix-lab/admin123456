@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>团队管理</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal layui-anim layui-anim-scale" data-method="offset"
                    data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="team" lay-filter="team"></table>
    <div id="team_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-team" id="devops-team" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="name"
                                   required
                                   lay-verify="required"
                                   placeholder="团队负责人"
                                   autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">别名</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="alias"
                                   required
                                   lay-verify="required"
                                   placeholder="团队昵称"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">备注</label>
                        <div class="layui-input-block">
                            <textarea name="note"
                                      placeholder="团队宣言"
                                      class="layui-textarea"
                                      lay-verify="required"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-hide">
                        <input type="button" lay-submit="" lay-filter="devops-team-submit" id="devops-team-submit"
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
      layui.use('table', function () {
        var $ = layui.jquery, table = layui.table, form = layui.form;
        // 添加
        $('.layui-btn-normal').on('click', function () {
          form.val("devops-team", {
            "name": "",
            "alias": "",
            "note": ""
          })
          layer.open({
            type: 1, //引入DOM模式
            title: '创建团队',
            shade: false, // 移除遮罩
            anim: 1, //动画效果
            area: '480px',
            content: $('#team_html'),
            moveType: 1,//支持拖动
            btn: ['保存', '关闭'],
            yes: function (index, layero) { // 第一个回掉
              //监听保存
              form.on('submit(devops-team-submit)', function (data) {
                axios.post('/api/team', data.field).then(function () {
                  layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                }).then(function () {
                  table.reload('team');
                  layer.close(index)
                })
              });
              //委托表单提交到保存按钮
              $('#devops-team-submit').trigger('click');
            },
            btn2: function (index, layero) { //第二个回掉
              layer.close(index)
            }
          });
        });

        // 表格数据
        table.render({
          elem: '#team'
          , url: '/api/team/'
          , page: true
          , limit: 50
          , height: 'full-175'
          , title: '团队清单'
          , toolbar: true
          , cellMinWidth: 50
          , cols: [[
            // {type: 'checkbox', fixed: 'left'},
            {field: 'id', width: 60, title: 'ID', align: 'center', sort: true}
            , {field: 'name', width: 100, align: 'center', title: '团队名称'}
            , {field: 'alias', width: 150, align: 'center', title: '团队别名'}
            , {field: 'note', minWidth: 120, title: '团队宣言'}
            , {field: 'created_at', width: 170, align: 'center', title: '创建时间', sort: true}
            , {field: 'updated_at', width: 170, align: 'center', title: '更新时间', sort: true}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 120}
          ]]
        });
        table.on('tool(team)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/team/' + me.id).then(function () {
                layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-team", {
              "name": me.name,
              "alias": me.alias,
              "note": me.note
            })
            layer.open({
              type: 1, //引入DOM模式
              title: '编辑团队',
              shade: false, // 移除遮罩
              anim: 1, //动画效果
              area: '480px',
              content: $('#team_html'),
              moveType: 1,//支持拖动
              btn: ['保存', '关闭'],
              yes: function (index, layero) { // 第一个回掉
                //监听保存
                form.on('submit(devops-team-submit)', function (data) {
                  axios.put('/api/team/' + me.id, data.field).then(function () {
                    layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                  }).then(function () {
                    table.reload('team');
                    layer.close(index)
                  })
                });
                //委托表单提交到保存按钮
                $('#devops-team-submit').trigger('click');
              },
              btn2: function (index, layero) { //第二个回掉
                layer.close(index)
              }
            });
          }
        });
      });
    </script>
@endsection
