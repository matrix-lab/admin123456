@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>任务管理</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal" data-method="offset" data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="task" lay-filter="task"></table>
    <div id="task_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-task" id="devops-task" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">团队</label>
                        <div class="layui-input-block">
                            <select name="team_id" lay-verify="required" id="team_id">
                                @foreach(\App\Models\Team::all() as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">产品</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="product"
                                   required
                                   lay-verify="required"
                                   placeholder="产品类型"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">来源</label>
                        <div class="layui-input-block">
                            <select name="come_from" id="come_from" lay-verify="required">
                                @foreach(\App\Models\Customer::all() as $customer)
                                    <option value="{{$customer->name}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">模块</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="category"
                                   name="category"
                                   required
                                   lay-verify="required"
                                   placeholder="所属业务模块"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">工程师</label>
                        <div class="layui-input-block">
                            <select name="type" lay-verify="required" id="type">
                                <option value="ui">前端工程师</option>
                                <option value="php">PHP工程师</option>
                                <option value="ios">IOS工程师</option>
                                <option value="android">Android工程师</option>
                                <option value="devops">运维工程师</option>
                                <option value="test">测试工程师</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上线时间</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="published_at"
                                   name="published_at"
                                   required
                                   lay-verify="date"
                                   placeholder="任务上线时间"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>

                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">开始时间</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="started_at"
                                   name="started_at"
                                   required
                                   lay-verify="date"
                                   placeholder="任务开始时间"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>

                <div class="layui-col-xs5">
                    <div class="layui-form-item">
                        <label class="layui-form-label">结束时间</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="ended_at"
                                   name="ended_at"
                                   required
                                   lay-verify="date"
                                   placeholder="任务结束时间"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>

                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">任务</label>
                        <div class="layui-input-block">
                            <textarea name="content" placeholder="任务详情" class="layui-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">备注</label>
                        <div class="layui-input-block">
                            <textarea name="note" placeholder="备注" class="layui-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <input type="button" lay-submit="" lay-filter="devops-task-submit"
                           id="devops-task-submit"
                           value="确认">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/html" id="operation">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        @{{#  if(d.progress == '待审批'){ }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="apply">审批</a>
        @{{#  } else if(d.progress == '待发布') { }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="publish">发布</a>
        @{{#  } }}
    </script>
    <script>
      layui.use(['table', 'laydate', 'flow'], function () {
        var $ = layui.jquery, table = layui.table, form = layui.form, laydate = layui.laydate;
        laydate.render({
          elem: '#published_at',
        });
        laydate.render({
          elem: '#started_at',
        });
        laydate.render({
          elem: '#ended_at',
        });
        // 添加
        $('.layui-btn-normal').on('click', function () {
          form.val("devops-task", {
            "team_id": "",
            "product": "",
            "come_from": "",
            "category": "",
            "content": "",
            "type": "",
            "note": "",
            "published_at": "",
            "started_at": "",
            "ended_at": ""
          })
          layer.open({
            type: 1,
            title: '创建发布',
            shade: false,
            anim: 6,
            area: ['640px', '550px'],
            content: $('#task_html'),
            moveType: 1,
            btn: ['保存', '关闭'],
            yes: function (index, layero) {
              form.on('submit(devops-task-submit)', function (data) {
                data.field.team_alias = $("#team_id option:selected").text()
                axios.post('/api/task', data.field).then(function () {
                  layer.msg('👍👍👍干的漂亮')
                }).then(function () {
                  table.reload('task');
                  layer.close(index)
                })
              });
              $('#devops-task-submit').trigger('click');
            },
            btn2: function (index, layero) {
              layer.close(index)
            }
          });
        });
        // 表格数据
        table.render({
          elem: '#task'
          , url: '/api/task/'
          , page: true
          , limit: 50
          , height: 'full-175'
          , title: '任务清单'
          , toolbar: true
          , cellMinWidth: 80
          , cols: [[
            {field: 'team_alias', width: 100, align: 'center', title: '团队'}
            , {field: 'product', width: 80, align: 'center', title: '产品'}
            , {field: 'come_from', width: 100, align: 'center', title: '来源'}
            , {field: 'category', width: 80, align: 'center', title: '模块'}
            , {field: 'content', maxWidth: 200, align: 'center', title: '任务'}
            , {field: 'ioser_alias', width: 80, align: 'center', title: 'IOS'}
            , {field: 'androider_alias', width: 80, align: 'center', title: 'Android'}
            , {field: 'uier_alias', width: 80, align: 'center', title: 'UI'}
            , {field: 'phper_alias', width: 80, align: 'center', title: 'PHP'}
            , {field: 'tester_alias', width: 80, align: 'center', title: 'TEST'}
            , {field: 'published_at', width: 105, title: '上线时间', align: 'center'}
            , {field: 'progress', width: 75, title: '进度'}
            , {field: 'status', width: 75, title: '状态'}
            , {field: 'note', maxWidth: 160, title: '备注'}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 115}
          ]]
        });
        table.on('tool(task)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/task/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-task", {
              "team_id": me.team_id,
              "product": me.product,
              "come_from": me.come_from,
              "category": me.category,
              "content": me.content,
              "type": me.type,
              "note": me.note,
              "published_at": me.published_at,
              "started_at": me[me.type + 'er_start_at'],
              "ended_at": me[me.type + 'er_end_at'],
            })
            layer.open({
              type: 1,
              title: '编辑发布',
              shade: false,
              anim: 6,
              area: ['640px', '550px'],
              content: $('#task_html'),
              moveType: 1,
              btn: ['保存', '关闭'],
              yes: function (index, layero) {
                form.on('submit(devops-task-submit)', function (data) {
                  data.field.team_alias = $("#team_id option:selected").text()
                  axios.put('/api/task/' + me.id, data.field).then(function () {
                    layer.msg('👍👍👍干的漂亮')
                  }).then(function () {
                    table.reload('task');
                    layer.close(index)
                  })
                });
                $('#devops-task-submit').trigger('click');
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
