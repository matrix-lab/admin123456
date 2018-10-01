@extends('layouts.main')
@section('title', 'Super DevOps HomePage')
@section('content')
    <div class="layui-row">
        <div class="layui-col-xs11">
           <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a><cite>客户管理</cite></a>
            </span>
        </div>
        <div class="layui-col-xs1" style="text-align: right;">
            <button class="layui-btn layui-btn-sm layui-btn-normal" data-method="offset" data-type="t">
                <i class="layui-icon">&#xe608;</i> 添加
            </button>
        </div>
    </div>
    <table class="layui-hide" id="customer" lay-filter="customer"></table>
    <div id="customer_html" style="display: none;">
        <form class="layui-form" lay-filter="devops-customer" id="devops-customer" style="margin-top: 15px;">
            <div class="layui-row">
                <div class="layui-col-xs10">
                    <div class="layui-form-item">
                        <label class="layui-form-label">公司</label>
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
                        <label class="layui-form-label">城市</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="city"
                                   required
                                   lay-verify="required"
                                   placeholder="城市"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">负责人</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="master"
                                   required
                                   lay-verify="required"
                                   placeholder="负责人"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">联系方式</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="contact"
                                   required
                                   lay-verify="required"
                                   placeholder="联系方式"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">职务</label>
                        <div class="layui-input-block">
                            <input type="text"
                                   name="position"
                                   required
                                   lay-verify="required"
                                   placeholder="职务"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">备注</label>
                        <div class="layui-input-block">
                            <textarea name="note" placeholder="额外信息记录" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-hide">
                        <input type="button" lay-submit="" lay-filter="devops-customer-submit"
                               id="devops-customer-submit"
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
          form.val("devops-customer", {
            "name": "",
            "city": "",
            "master": "",
            "contact": "",
            "position": "",
            "note": ""
          })
          layer.open({
            type: 1,
            title: '创建客户',
            shade: false,
            anim: 6,
            area: '480px',
            content: $('#customer_html'),
            moveType: 1,
            btn: ['保存', '关闭'],
            yes: function (index, layero) {
              form.on('submit(devops-customer-submit)', function (data) {
                axios.post('/api/customer', data.field).then(function () {
                  layer.msg('👍👍👍干的漂亮')
                }).then(function () {
                  table.reload('customer');
                  layer.close(index)
                })
              });
              $('#devops-customer-submit').trigger('click');
            },
            btn2: function (index, layero) {
              layer.close(index)
            }
          });
        });
        // 表格数据
        table.render({
          elem: '#customer'
          , url: '/api/customer/'
          , page: true
          , limit: 50
          , height: 'full-175'
          , title: '客户清单'
          , toolbar: true
          , cellMinWidth: 80
          , cols: [[
            {field: 'name', width: 160, align: 'center', title: '公司名称'}
            , {field: 'city', minWidth: 100, align: 'center', title: '城市'}
            , {field: 'master', minWidth: 120, align: 'center', title: '负责人'}
            , {field: 'contact', minWidth: 120, align: 'center', title: '联系方式'}
            , {field: 'position', minWidth: 120, align: 'center', title: '职务'}
            , {field: 'note', minWidth: 120, title: '备注'}
            , {field: 'created_at', width: 170, align: 'center', title: '创建时间', sort: true}
            , {field: 'updated_at', width: 170, align: 'center', title: '更新时间', sort: true}
            , {fixed: 'right', title: '操作', align: 'center', toolbar: '#operation', width: 120}
          ]]
          , done: function () {
            flow.lazyimg();
          }
        });
        table.on('tool(customer)', function (obj) {
          var me = obj.data;
          if (obj.event === 'del') {
            layer.confirm('老铁，真的要永别吗？', function (index) {
              axios.delete('/api/customer/' + me.id).then(function () {
                layer.msg('👍👍👍干的漂亮')
                obj.del();
              }).then(function () {
                layer.close(index);
              })
            });
          } else if (obj.event === 'edit') {
            form.val("devops-customer", {
              "name": me.name,
              "city": me.city,
              "master": me.master,
              "contact": me.contact,
              "position": me.position,
              "note": me.note
            })
            layer.open({
              type: 1,
              title: '编辑客户',
              shade: false,
              anim: 6,
              area: '480px',
              content: $('#customer_html'),
              moveType: 1,
              btn: ['保存', '关闭'],
              yes: function (index, layero) {
                form.on('submit(devops-customer-submit)', function (data) {
                  data.field.team_alias = $("#team_id option:selected").text()
                  axios.put('/api/customer/' + me.id, data.field).then(function () {
                    layer.msg('👍👍👍干的漂亮')
                  }).then(function () {
                    table.reload('customer');
                    layer.close(index)
                  })
                });
                $('#devops-customer-submit').trigger('click');
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
