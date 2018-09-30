@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>每日一图</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal" data-method="offset" data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="motto" lay-filter="motto"></table>
    <div id="motto_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-motto" id="devops-motto" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">精彩分享</label>
                        <div class="layui-input-block">
                            <textarea name="content" placeholder="" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-hide">
                        <input type="button" lay-submit="" lay-filter="devops-motto-submit"
                               id="devops-motto-submit"
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
        @{{#  if(d.status == 0){ }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="push">投稿</a>
        @{{#  } else { }}
        <a class="layui-btn layui-btn-disabled layui-btn-xs" lay-event="none">已投稿</a>
        @{{#  } }}


    </script>
    <script>
      layui.use(['table', 'laydate', 'flow'], function () {
        var $ = layui.jquery, table = layui.table, form = layui.form;
        // 添加
        $('.layui-btn-normal').on('click', function () {
          form.val("devops-motto", {
            "content": ""
          })
          layer.open({
            type: 1,
            title: '创建每日一图',
            shade: false,
            anim: 6,
            area: '480px',
            content: $('#motto_html'),
            moveType: 1,
            btn: ['保存', '关闭'],
            yes: function (index, layero) {
              form.on('submit(devops-motto-submit)', function (data) {
                axios.post('/api/motto', data.field).then(function () {
                  layer.msg('👍👍👍干的漂亮')
                }).then(function () {
                  table.reload('motto');
                  layer.close(index)
                })
              });
              $('#devops-motto-submit').trigger('click');
            },
            btn2: function (index, layero) {
              layer.close(index)
            }
          });
        });
        // 表格数据
        table.render({
          elem: '#motto'
          , url: '/api/motto/'
          , cellMinWidth: 60
          , cols: [[
            {field: 'user_alias', width: 160, align: 'center', title: '发布人'}
            , {field: 'star', width: 60, align: 'center', title: '星星'}
            , {field: 'content', minWidth: 200, align: 'center', title: '内容'}
            , {field: 'created_at', width: 180, align: 'center', title: '创建时间'}
            , {field: 'updated_at', width: 180, align: 'center', title: '更新时间'}
            , {field: 'status', width: 80, align: 'center', title: '状态'}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 160}
          ]]
        });
        table.on('tool(motto)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/motto/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-motto", {
              "content": me.content
            })
            layer.open({
              type: 1,
              title: '编辑每日一图',
              shade: false,
              anim: 6,
              area: '480px',
              content: $('#motto_html'),
              moveType: 1,
              btn: ['保存', '关闭'],
              yes: function (index, layero) {
                form.on('submit(devops-motto-submit)', function (data) {
                  data.field.team_alias = $("#team_id option:selected").text()
                  axios.put('/api/motto/' + me.id, data.field).then(function () {
                    layer.msg('👍👍👍干的漂亮')
                  }).then(function () {
                    table.reload('motto');
                    layer.close(index)
                  })
                });
                $('#devops-motto-submit').trigger('click');
              },
              btn2: function (index, layero) {
                layer.close(index)
              }
            });
          } else if (obj.event === 'push') {
            layer.confirm('老铁，这样搞你会上头条的？', function (index) {
              axios.put('/api/motto/' + me.id + '/push').then(function () {
                layer.msg('👍👍👍干的漂亮')
              }).then(function () {
                table.reload('motto');
                layer.close(index);
              })
            });
          }
        });
      });
    </script>
@endsection
