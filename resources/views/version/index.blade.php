@extends('layout.main')
@section('title', 'Fangxin DevOps Release')
<link rel="stylesheet" type="text/css" href="/assets/libs/select2/dist/css/select2.min.css">
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">发布清单</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">创建发布</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="version" id="version">
                                        <div class="form-group row">
                                            <label for="issue"
                                                   class="col-sm-3 text-right control-label col-form-label">修复问题</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="issue" name="issue"
                                                       placeholder="您要修复的问题">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="branch"
                                                   class="col-sm-3 text-right control-label col-form-label">发布分支</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="branch" name="branch"
                                                       placeholder="您要发布的分支">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customer"
                                                   class="col-sm-3 text-right control-label col-form-label">目标客户</label>
                                            <div class="col-sm-8">
                                                <select class="select2 form-control" multiple="multiple"
                                                        name="customer" id="customer" style="height: 36px;width:
                                                    100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="appointed_at"
                                                   class="col-sm-3 text-right control-label col-form-label">发布时间</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control appointed_at" id="appointed_at"
                                                       name="appointed_at">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="reason"
                                                   class="col-sm-3 text-right control-label col-form-label">导致原因</label>
                                            <div class="col-sm-8">
                                                <textarea name="reason" id="reason" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary" id="save">保存</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-responsive-md table-bordered"
                                   data-customers="{{$customers}}">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">问题</th>
                                    <th style="width: 45px;">分支</th>
                                    <th>客户</th>
                                    <th style="width: 90px;">预约时间</th>
                                    <th style="width: 80px;">申请人</th>
                                    <th style="width: 80px;">审批人</th>
                                    <th style="width: 80px;">发布人</th>
                                    <th style="width: 60px;">进度</th>
                                    <th style="width: 60px;">状态</th>
                                    <th style="width: 90px;">创建时间</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--&#10;--}}
                                @foreach ($versions as $version)
                                    <tr>
                                        <td title="故障原因:{{$version->reason}}"
                                            style="color: blue;">{{$version->issue}}</td>
                                        <td>{{$version->branch}}</td>
                                        <td>{{$version->customer_alias}}</td>
                                        <td>{{$version->appointed_at}}</td>
                                        <td title="申请时间:{{$version->applyed_at}}"
                                            style="color: blue;">{{$version->applyer_alias}}</td>
                                        <td title="审核时间:{{$version->approved_at}}"
                                            style="color: blue;">{{$version->approver_alias}}</td>
                                        <td title="完成时间:{{$version->published_at}}"
                                            style="color: blue;">{{$version->publisher_alias}}</td>
                                        <td>{{$version->progress}}</td>
                                        <td style="color: {{$version->status == '未完成'?'red;':'green; font-weight:bold;'}}">{{$version->status}}</td>
                                        <td>{{$version->created_at}}</td>
                                        <td>
                                            <a class="user-delete" data-json="{{$version}}"
                                               style="display: inline-block; cursor: pointer; color: red;">
                                                删除
                                            </a>
                                            <a class="user-update" data-json="{{$version}}"
                                               style="display: inline-block; cursor: pointer; color: blue;">
                                                编辑
                                            </a>
                                            @if($version->progress === '待审核')
                                                <a class="user-approve" data-json="{{$version}}"
                                                   style="display: inline-block; cursor: pointer; color: #ff0084;">
                                                    审核
                                                </a>
                                            @endif
                                            @if($version->progress === '待发布')
                                                <a class="user-finish" data-json="{{$version}}"
                                                   style="display: inline-block; cursor: pointer; color: green;">
                                                    发布
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--DELETE MODAL--}}
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">来自上帝的忠告</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        此去一别，应是今生最后一面！
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" id="say-good-bye">永别</button>
                    </div>
                </div>
            </div>
        </div>
        {{--DELETE MODAL--}}

    </div>
@endsection
@section('scripts')
    <script src="/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="/assets/libs/select2/dist/js/select2.min.js"></script>
    <script>

      $(function (e) {
        $(".appointed_at").inputmask("yyyy-mm-dd hh:mm:ss");
        $.each($("#zero_config").data('customers'), function (index, item) {
          $("#customer").append(new Option(item, index));
        });
        $(".select2").select2();
      });

      $('#zero_config').DataTable({
        "columnDefs": [
          {"className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}
        ],
      });

      //添加操作
      $("#save").click(function () {
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/version', {
            issue: $("#issue").val(),
            branch: $("#branch").val(),
            customer_ids: $("#customer").val().join(','),
            customer_alias: $("#customer option:selected").text(),
            appointed_at: $("#appointed_at").val(),
            reason: $("#reason").val(),
            note: $("#note").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/version/' + $(this).data('json').id, {
            issue: $("#issue").val(),
            branch: $("#branch").val(),
            customer_ids: $("#customer").val().join(','),
            customer_alias: $("#customer option:selected").text(),
            appointed_at: $("#appointed_at").val(),
            reason: $("#reason").val(),
            note: $("#note").val(),
            _token: "{{ csrf_token() }}"
          })
        }
        promise.then(function () {
          toastr.success('👍👍👍', '干的漂亮');
          $("#store").modal('hide');
        }).catch(function () {
          toastr.error('👎👎👎', '姿势不对');
        }).then(function () {
          $("#user")[0].reset();
        }).then(function () {
          window.location.reload();
        })
      });

      // 删除操作 //
      $(".user-delete").on('click', function () {
        $("#delete").modal('show');
        $("#say-good-bye").data('json', $(this).data('json'));
      });
      $("#say-good-bye").click(function () {
        axios.delete('/api/version/' + $(this).data('json').id).then(function () {
          toastr.success('👍👍👍', '干的漂亮');
          $("#store").modal('hide');
        }).catch(function () {
          toastr.error('👎👎👎', '姿势不对');
        }).then(function () {
          $("#delete").modal('hide')
        }).then(function () {
          window.location.reload();
        })
      });
      // 删除操作 //

      // 编辑操作 //
      $(".user-update").on('click', function () {
        var customer_ids = $(this).data('json').customer_ids;
        $("#customer").html("");
        $.each($("#zero_config").data('customers'), function (index, item) {
          if ($.inArray(index, customer_ids.split(',')) >= 0) {
            $("#customer").append(new Option(item, index, index, true));
          } else {
            $("#customer").append(new Option(item, index));
          }
        });
        $("#storeModalLabel").html('编辑发布');
        $("#issue").val($(this).data('json').issue);
        $("#branch").val($(this).data('json').branch);
        $("#customer_ids").val($(this).data('json').customer_ids);
        $("#appointed_at").val($(this).data('json').appointed_at);
        $("#reason").val($(this).data('json').reason);
        $("#note").val($(this).data('json').birtnotehday);
        $("#store").modal('show');
        $("#save").data('json', $(this).data('json'));
      });

      // 审核 //
      $(".user-approve").on('click', function () {
        axios.put('/api/version-approve/' + $(this).data('json').id).then(function () {
          toastr.success('👍👍👍', '干的漂亮');
        }).then(function () {
          window.location.reload();
        })
      });

      // 完成 //
      $(".user-finish").on('click', function () {
        axios.put('/api/version-finish/' + $(this).data('json').id).then(function () {
          toastr.success('👍👍👍', '干的漂亮');
        }).then(function () {
          window.location.reload();
        })

      });


      $('#store').on('hidden.bs.modal', function (e) {
        $("#storeModalLabel").html('创建发布');
        $("#version")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection

