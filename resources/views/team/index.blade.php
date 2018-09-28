@extends('layout.main')
@section('title', 'Fangxin DevOps Team')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">团队清单</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">创建团队</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="team" id="team">
                                        <div class="form-group row">
                                            <label for="tname"
                                                   class="col-sm-2 text-right control-label col-form-label">名称</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="tname" name="name"
                                                       placeholder="团队负责人(必填)" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="talias"
                                                   class="col-sm-2 text-right control-label col-form-label">别名</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="talias" name="alias"
                                                       placeholder="团队别名(必填)" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tnote"
                                                   class="col-sm-2 text-right control-label col-form-label">备注</label>
                                            <div class="col-sm-9">
                                                    <textarea class="form-control"
                                                              id="tnote"
                                                              placeholder="团队宣言"
                                                              name="tnote"></textarea>
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
                            <table id="zero_config" class="table table-responsive-md table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">团队负责人</th>
                                    <th style="width: 120px;">团队别名</th>
                                    <th>团队宣言</th>
                                    <th style="width: 130px;">创建时间</th>
                                    <th style="width: 130px;">更新时间</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->alias}}</td>
                                        <td>{{$team->note}}</td>
                                        <td>{{$team->created_at}}</td>
                                        <td>{{$team->updated_at}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm team-update"
                                                    data-json="{{$team}}">
                                                编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm team-delete"
                                                    data-json="{{$team}}">
                                                删除
                                            </button>
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
    <script>
        $.team = {
          valid:function () {
            if($("#tname").val() === ''){
              toastr.warning('👎👎👎', '名称为必填项');
              return false;
            }else if($("#talias").val() === ''){
              toastr.warning('👎👎👎', '别名为必填项');
              return false;
            }
          }
        }

      $('#zero_config').DataTable({
        "columnDefs": [
          {"className": "text-center", "targets": [0, 1, 2, 3, 4, 5]}
        ],
      });
      //添加操作
      $("#save").click(function () {
        if($.team.valid() === false) return;
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/team', {
            name: $("#tname").val(),
            alias: $("#talias").val(),
            note: $("#tnote").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/team/' + $(this).data('json').id, {
            name: $("#tname").val(),
            alias: $("#talias").val(),
            note: $("#tnote").val(),
            _token: "{{ csrf_token() }}"
          })
        }
        promise.then(function () {
          toastr.success('👍👍👍', '干的漂亮');
          $("#store").modal('hide');
        }).catch(function () {
          toastr.error('👎👎👎', '姿势不对');
        }).then(function () {
          $("#team")[0].reset();
        }).then(function () {
          window.location.reload();
        })
      });

      // 删除操作 //
      $(".team-delete").on('click', function () {
        $("#delete").modal('show');
        $("#say-good-bye").data('json', $(this).data('json'));
      });
      $("#say-good-bye").click(function () {
        axios.delete('/api/team/' + $(this).data('json').id).then(function () {
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
      $(".team-update").on('click', function () {
        $("#storeModalLabel").html('编辑团队');
        $("#tname").val($(this).data('json').name);
        $("#talias").val($(this).data('json').alias);
        $("#tnote").val($(this).data('json').note);
        $("#store").modal('show');
        $("#save").data('json', $(this).data('json'));
      });

      $('#store').on('hidden.bs.modal', function (e) {
        $("#storeModalLabel").html('创建团队');
        $("#team")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection
