@extends('layout.main')
@section('title', 'Fangxin DevOps Customer')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">客户清单</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">创建客户</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="cutomer" id="cutomer">
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-3 text-right control-label col-form-label">姓名</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="公司名称">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city"
                                                   class="col-sm-3 text-right control-label col-form-label">城市</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="city" name="city"
                                                       placeholder="城市">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="master"
                                                   class="col-sm-3 text-right control-label col-form-label">负责人</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="master" name="master"
                                                       placeholder="负责人">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contact"
                                                   class="col-sm-3 text-right control-label col-form-label">联系方式</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="contact" name="contact"
                                                       placeholder="联系方式">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="position"
                                                   class="col-sm-3 text-right control-label col-form-label">职务</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="position"
                                                       name="position"
                                                       placeholder="职务">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="note"
                                                   class="col-sm-3 text-right control-label col-form-label">备注</label>
                                            <div class="col-sm-8">
                                                   <textarea class="form-control"
                                                             id="note"
                                                             placeholder="客户详情"
                                                             name="note"></textarea>
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
                                    <th>公司名称</th>
                                    <th>城市</th>
                                    <th>负责人</th>
                                    <th>联系方式</th>
                                    <th>职务</th>
                                    <th>备注</th>
                                    <th>创建时间</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->city}}</td>
                                        <td>{{$customer->master}}</td>
                                        <td>{{$customer->contact}}</td>
                                        <td>{{$customer->position}}</td>
                                        <td>{{$customer->note}}</td>
                                        <td>{{$customer->created_at}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm user-update"
                                                    data-json="{{$customer}}">
                                                编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm user-delete"
                                                    data-json="{{$customer}}">
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
          {"className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7]}
        ],
      });

      //添加操作
      $("#save").click(function () {
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/customer', {
            name: $("#name").val(),
            city: $("#city").val(),
            master: $("#master").val(),
            contact: $("#contact").val(),
            position: $("#position").val(),
            note: $("#note").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/customer/' + $(this).data('json').id, {
            name: $("#name").val(),
            city: $("#city").val(),
            master: $("#master").val(),
            contact: $("#contact").val(),
            position: $("#position").val(),
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
          $("#cutomer")[0].reset();
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
        axios.delete('/api/customer/' + $(this).data('json').id).then(function () {
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
        $("#storeModalLabel").html('编辑客户');
        $("#name").val($(this).data('json').name);
        $("#city").val($(this).data('json').city);
        $("#master").val($(this).data('json').master);
        $("#contact").val($(this).data('json').contact);
        $("#position").val($(this).data('json').position);
        $("#note").val($(this).data('json').note);
        $("#store").modal('show');
        $("#save").data('json', $(this).data('json'));
      });
      $('#store').on('hidden.bs.modal', function (e) {
        $("#storeModalLabel").html('创建客户');
        $("#cutomer")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection

