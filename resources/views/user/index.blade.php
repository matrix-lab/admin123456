@extends('layout.main')
@section('title', 'Fangxin DevOps Developer')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">人员清单</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">创建人员</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="user" id="user">
                                        <div class="form-group row">
                                            <label for="uname"
                                                   class="col-sm-3 text-right control-label col-form-label">姓名</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="uname" name="name"
                                                       placeholder="一个自信的大名">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ualias"
                                                   class="col-sm-3 text-right control-label col-form-label">昵称</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ualias" name="alias"
                                                       placeholder="一个响亮的花名">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="uteam"
                                                   class="col-sm-3 text-right control-label col-form-label">所属团队</label>
                                            <div class="col-sm-8">
                                                <select name="uteam" name="team" class="form-control" id="uteam">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="umobile"
                                                   class="col-sm-3 text-right control-label col-form-label">手机</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="umobile" name="mobile"
                                                       placeholder="你的专属11尾数">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ubirthday"
                                                   class="col-sm-3 text-right control-label col-form-label">生日</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ubirthday"
                                                       name="birthday"
                                                       placeholder="生日">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="uemail"
                                                   class="col-sm-3 text-right control-label col-form-label">邮箱</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="uemail" name="email"
                                                       placeholder="登录邮箱">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="upassword"
                                                   class="col-sm-3 text-right control-label col-form-label">密码</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="upassword"
                                                       name="password"
                                                       placeholder="登录密码">
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
                                   data-team="{{$teams}}">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">姓名</th>
                                    <th style="width: 45px;">头像</th>
                                    <th>昵称</th>
                                    <th style="width: 100px;">所属团队</th>
                                    <th style="width: 90px;">邮箱</th>
                                    <th style="width: 100px;">手机</th>
                                    <th style="width: 100px;">生日</th>
                                    <th style="width: 130px;">创建时间</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td><img src="{{avatar($user->email)}}"
                                                 style="width: 36px; height: 36px; border-radius: 18px;"></td>
                                        <td>{{$user->alias}}</td>
                                        <td>{{$user->team_alias}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->birthday}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm user-update"
                                                    data-json="{{$user}}">
                                                编辑
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm user-delete"
                                                    data-json="{{$user}}">
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
          {"className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8]}
        ],
      });

      $.each($("#zero_config").data('team'), function (index, item) {
        $("#uteam").append(new Option(item, index));
      });

      //添加操作
      $("#save").click(function () {
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/user', {
            name: $("#uname").val(),
            alias: $("#ualias").val(),
            mobile: $("#umobile").val(),
            birthday: $("#ubirthday").val(),
            email: $("#uemail").val(),
            team_id: $("#uteam").val(),
            team_alias: $("#uteam option:selected").text(),
            password: $("#upassword").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/user/' + $(this).data('json').id, {
            name: $("#uname").val(),
            alias: $("#ualias").val(),
            team_id: $("#uteam").val(),
            team_alias: $("#uteam option:selected").text(),
            mobile: $("#umobile").val(),
            birthday: $("#ubirthday").val(),
            email: $("#uemail").val(),
            password: $("#upassword").val(),
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
        axios.delete('/api/user/' + $(this).data('json').id).then(function () {
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
        $("#storeModalLabel").html('编辑人员');
        $("#uname").val($(this).data('json').name);
        $("#ualias").val($(this).data('json').alias);
        $("#uteam").val($(this).data('json').team_id);
        $("#umobile").val($(this).data('json').mobile);
        $("#ubirthday").val($(this).data('json').birthday);
        $("#uemail").val($(this).data('json').email);
        $("#upassword").val($(this).data('json').password);
        $("#store").modal('show');
        $("#save").data('json', $(this).data('json'));
      });

      $('#store').on('hidden.bs.modal', function (e) {
        $("#storeModalLabel").html('创建人员');
        $("#user")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection

