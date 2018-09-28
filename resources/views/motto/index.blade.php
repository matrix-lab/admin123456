@extends('layout.main')
@section('title', 'Fangxin DevOps Motto')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">每日一图</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">新建每日一图</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="motto" id="motto">
                                        <div class="form-group row">
                                            <label for="content"
                                                   class="col-sm-3 text-center control-label col-form-label">内容</label>
                                            <div class="col-sm-8">
                                                   <textarea class="form-control"
                                                             style="height:120px;"
                                                             id="content"
                                                             placeholder="..."
                                                             name="content"></textarea>
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
                                    <th>发布人</th>
                                    <th>爱心</th>
                                    <th>内容</th>
                                    <th>创建时间</th>
                                    <td>状态</td>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($mottos as $motto)
                                    <tr>
                                        <td>{{$motto->user_alias}}</td>
                                        <td>{{$motto->star}}</td>
                                        <td>{{$motto->content}}</td>
                                        <td>{{$motto->created_at}}</td>
                                        <td>{{$motto->status ? '已使用':'未使用'}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm user-update"
                                                    data-json="{{$motto}}">
                                                编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm user-delete"
                                                    data-json="{{$motto}}">
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
      $('#zero_config').DataTable({
        "columnDefs": [
          {"className": "text-center", "targets": [0, 1, 2, 3, 4]}
        ],
      });

      //添加操作
      $("#save").click(function () {
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/motto', {
            content: $("#content").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/motto/' + $(this).data('json').id, {
            content: $("#content").val(),
            _token: "{{ csrf_token() }}"
          })
        }
        promise.then(function () {
          toastr.success('👍👍👍', '干的漂亮');
          $("#store").modal('hide');
        }).catch(function () {
          toastr.error('👎👎👎', '姿势不对');
        }).then(function () {
          $("#motto")[0].reset();
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
        axios.delete('/api/motto/' + $(this).data('json').id).then(function () {
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
        $("#storeModalLabel").html('编辑每日一图');
        $("#content").val($(this).data('json').content);
        $("#store").modal('show');
        $("#save").data('json', $(this).data('json'));
      });
      $('#store').on('hidden.bs.modal', function (e) {
        $("#storeModalLabel").html('新建每日一图');
        $("#motto")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection

