@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>发布管理</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal layui-anim layui-anim-scale" data-method="offset" data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="version" lay-filter="version"></table>
    <div id="version_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-version" id="devops-version" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">修复问题</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="issue"
                                   required
                                   lay-verify="required"
                                   placeholder="描述问题"
                                   autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分支</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="branch"
                                   required
                                   lay-verify="required"
                                   placeholder="发布分支"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">目标客户</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="customer_alias"
                                   required
                                   lay-verify="required"
                                   placeholder="客户用逗号分割"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">发布时间</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   id="appointed_at"
                                   name="appointed_at"
                                   required
                                   lay-verify="datetime"
                                   placeholder="预订发布时间"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">原因</label>
                        <div class="layui-input-block">
                            <textarea name="reason" placeholder="引起原因" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">执行脚本</label>
                        <div class="layui-input-block">
                            <textarea name="note" placeholder="执行脚本" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-hide">
                        <input type="button" lay-submit="" lay-filter="devops-version-submit"
                               id="devops-version-submit"
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
        @{{#  if(d.progress == '待审核'){ }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="apply">审批</a>
        @{{#  } else if(d.progress == '待发布') { }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="publish">发布</a>
        @{{#  } }}
    </script>
    <script>
      layui.use(['table', 'laydate', 'flow'], function () {
        var $ = layui.jquery, table = layui.table, form = layui.form, laydate = layui.laydate;
        laydate.render({
          elem: '#appointed_at',
          type: 'datetime'
        });
        // 添加
        $('.layui-btn-normal').on('click', function () {
          form.val("devops-version", {
            "issue": "",
            "branch": "",
            "customer_alias": "",
            "appointed_at": "",
            "reason": "",
            "note": ""
          })
          layer.open({
            type: 1,
            title: '创建发布',
            shade: false,
            anim: 5,
            area: '480px',
            content: $('#version_html'),
            moveType: 1,
            btn: ['保存', '关闭'],
            yes: function (index, layero) {
              form.on('submit(devops-version-submit)', function (data) {
                axios.post('/api/version', data.field).then(function () {
                  layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                }).then(function () {
                  table.reload('version');
                  layer.close(index)
                })
              });
              $('#devops-version-submit').trigger('click');
            },
            btn2: function (index, layero) {
              layer.close(index)
            }
          });
        });
        // 表格数据
        table.render({
          elem: '#version'
          , url: '/api/version/'
          , page: true
          , limit: 50
          , height: 'full-175'
          , title: '发布清单'
          , toolbar: true
          , cellMinWidth: 80
          , cols: [[
            {field: 'issue', minWidth: 180, align: 'center', title: '问题'}
            , {field: 'branch', minWidth: 80, align: 'center', title: '分支'}
            , {field: 'customer_alias', minWidth: 80, align: 'center', title: '目标客户'}
            , {field: 'appointed_at', width: 165, align: 'center', title: '预约时间'}
            , {field: 'applyer_alias', width: 80, align: 'center', title: '申请人'}
            , {field: 'approver_alias', width: 80, align: 'center', title: '审批人'}
            , {field: 'publisher_alias', width: 80, align: 'center', title: '发布人'}
            , {field: 'progress', width: 75, title: '进度'}
            , {field: 'status', width: 75, title: '状态'}
            , {field: 'created_at', width: 165, align: 'center', title: '创建时间', sort: true}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 160}
          ]]
        });
        table.on('tool(version)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/version/' + me.id).then(function () {
                layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-version", {
              "issue": me.issue,
              "branch": me.branch,
              "customer_alias": me.customer_alias,
              "appointed_at": me.appointed_at,
              "reason": me.reason,
              "note": me.note,
            })
            layer.open({
              type: 1,
              title: '编辑发布',
              shade: false,
              anim: 5,
              area: '480px',
              content: $('#version_html'),
              moveType: 1,
              btn: ['保存', '关闭'],
              yes: function (index, layero) {
                form.on('submit(devops-version-submit)', function (data) {
                  data.field.team_alias = $("#team_id option:selected").text()
                  axios.put('/api/version/' + me.id, data.field).then(function () {
                    layer.msg('老铁，干的漂亮！👍', {icon: 6, offset: 'rt', anim: 2});
                  }).then(function () {
                    table.reload('version');
                    layer.close(index)
                  })
                });
                $('#devops-version-submit').trigger('click');
              },
              btn2: function (index, layero) {
                layer.close(index)
              }
            });
          } else if (obj.event === 'apply') {
            layer.confirm('老铁，真的要给Pass吗？', function (index) {
              axios.put('/api/version-approve/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                table.reload('version');
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'publish') {
            layer.confirm('老铁，确定发布成功了吗？', function (index) {
              axios.put('/api/version-finish/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                table.reload('version');
              }).then(function () {
                layer.close(index);
              })
            });
          }
        });
      });
    </script>
@endsection
