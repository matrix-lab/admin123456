@extends('layout.main')
@section('title', 'Fangxin DevOps Task')
<link rel="stylesheet" type="text/css" href="/assets/libs/select2/dist/css/select2.min.css">
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">任务清单</h4>
                <div class="ml-auto text-right">
                    <button type="button" class="btn btn-primary" onclick="download()"><i class="fa fa-download"></i> 下载
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store"><i
                                class="fa fa-plus"></i> 新建
                    </button>
                    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storeModalLabel">创建任务</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" name="task" id="task">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="team_id"
                                                           class="col-sm-4 text-right control-label col-form-label">团队</label>
                                                    <div class="col-sm-7">
                                                        <select name="team_id" id="team_id" class="form-control">
                                                            @foreach(\App\Models\Team::all() as $team)
                                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="product"
                                                           class="col-sm-4 text-right control-label col-form-label">产品</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" id="product"
                                                               name="product" placeholder="ERP">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="come_from"
                                                           class="col-sm-4 text-right control-label col-form-label">来源</label>
                                                    <div class="col-sm-7">
                                                        <select name="come_from" id="come_from" class="form-control">
                                                            @foreach(\App\Models\Customer::all() as $customer)
                                                                <option value="{{$customer->name}}">{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="category"
                                                           class="col-sm-4 text-right control-label col-form-label">模块</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control category"
                                                               id="category"
                                                               name="category"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="come_from"
                                                           class="col-sm-4 text-right control-label col-form-label">工程师</label>
                                                    <div class="col-sm-7">
                                                        <select name="type" id="type" class="form-control">
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
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="category"
                                                           class="col-sm-4 text-right control-label col-form-label">上线时间</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control published_at"
                                                               id="published_at"
                                                               name="published_at"
                                                               placeholder=""
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="started_at"
                                                           class="col-sm-4 text-right control-label col-form-label">开始时间</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" id="started_at"
                                                               name="started_at" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="ended_at"
                                                           class="col-sm-4 text-right control-label col-form-label">结束时间</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control ended_at"
                                                               id="ended_at"
                                                               name="ended_at"
                                                               placeholder=""
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="content"
                                                           class="col-sm-2 text-center control-label col-form-label">任务</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="content" id="content" class="form-control"
                                                                  style="width: 365px;height: 90px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="note"
                                                           class="col-sm-2 text-center control-label col-form-label">备注</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="note" id="note" class="form-control"
                                                                  style="width: 365px;height: 60px;"></textarea>
                                                    </div>
                                                </div>
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
                                   data-users="{{$users}}">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">团队</th>
                                    <th style="width: 45px;">产品</th>
                                    <th style="width: 60px;">来源</th>
                                    <th style="width: 60px;">模块</th>
                                    <th style="width: 200px;">任务</th>
                                    <th style="width: 80px;">苹果工程师</th>
                                    <th style="width: 80px;">安卓工程师</th>
                                    <th style="width: 80px;">前端工程师</th>
                                    <th style="width: 80px;">后端工程师</th>
                                    <th style="width: 90px;">测试工程师</th>
                                    <th style="width: 80px;">运维工程师</th>
                                    <th style="width: 80px;">上线时间</th>
                                    <th style="width: 200px;">备注</th>
                                    <th style="width: 80px;">进度</th>
                                    <th style="width: 80px;">状态</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--&#10;--}}
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{$task->team_alias}}</td>
                                        <td>{{$task->product}}</td>
                                        <td>{{$task->come_from}}</td>
                                        <td>{{$task->category}}</td>
                                        <td>{{$task->content}}</td>
                                        <td>
                                            {{$task->ioser_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->ioser_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->ioser_end_at}}</span>
                                        </td>
                                        <td>
                                            {{$task->androider_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->androider_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->androider_end_at}}</span>
                                        </td>
                                        <td>
                                            {{$task->uier_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->uier_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->uier_end_at}}</span>
                                        </td>
                                        <td>
                                            {{$task->phper_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->phper_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->phper_end_at}}</span>
                                        </td>
                                        <td>
                                            {{$task->tester_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->tester_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->tester_end_at}}</span>
                                        </td>
                                        <td>
                                            {{$task->devopser_alias}}<br>
                                            <span style="color: green;font-weight: bold;">{{$task->devopser_start_at}}</span><br>
                                            <span style="color: red;font-weight: bold;">{{$task->devopser_end_at}}</span>
                                        </td>
                                        <td>{{$task->published_at}}</td>
                                        <td>{{$task->note}}</td>
                                        <td>{{$task->progress}}</td>
                                        <td>{{$task->status}}</td>
                                        <td>
                                            <a class="user-delete" data-json="{{$task}}"
                                               style="display: inline-block; cursor: pointer; color: red;">
                                                删除
                                            </a>
                                            <a class="user-update" data-json="{{$task}}"
                                               style="display: inline-block; cursor: pointer; color: blue;">
                                                编辑
                                            </a>
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
        $("#published_at").inputmask("yyyy-mm-dd");
        $("#started_at").inputmask("yyyy-mm-dd");
        $("#ended_at").inputmask("yyyy-mm-dd");
      });

      $('#zero_config').DataTable({
        "scrollX": true,
        'fixedHeader': true,
        "pageLength": 100,
        "columnDefs": [
          {
            "className": "text-center",
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
          }
        ],
      });

      function download() {
        window.location.href = '/api/task'
      }

      //添加操作
      $("#save").click(function () {
        if ($(this).data('json') == undefined) {
          var promise = axios.post('/api/task', {
            team_id: $("#team_id").val(),
            team_alias: $("#team_id option:selected").text(),
            product: $("#product").val(),
            come_from: $("#come_from").val(),
            category: $("#category").val(),
            type: $("#type").val(),
            published_at: $("#published_at").val(),
            started_at: $("#started_at").val(),
            ended_at: $("#ended_at").val(),
            content: $("#content").val(),
            note: $("#note").val(),
            _token: "{{ csrf_token() }}"
          })
        } else {
          var promise = axios.put('/api/task/' + $(this).data('json').id, {
            team_id: $("#team_id").val(),
            team_alias: $("#team_id option:selected").text(),
            product: $("#product").val(),
            come_from: $("#come_from").val(),
            category: $("#category").val(),
            type: $("#type").val(),
            published_at: $("#published_at").val(),
            started_at: $("#started_at").val(),
            ended_at: $("#ended_at").val(),
            content: $("#content").val(),
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
          $("#task")[0].reset();
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
        axios.delete('/api/task/' + $(this).data('json').id).then(function () {
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
        if ($(this).data('json').type === 'ui') {
          $("#started_at").val($(this).data('json').uier_start_at);
          $("#ended_at").val($(this).data('json').uier_end_at);
        } else if ($(this).data('json').type === 'app') {
          $("#started_at").val($(this).data('json').apper_start_at);
          $("#ended_at").val($(this).data('json').apper_end_at);
        } else if ($(this).data('json').type === 'php') {
          $("#started_at").val($(this).data('json').phper_start_at);
          $("#ended_at").val($(this).data('json').phper_end_at);
        } else if ($(this).data('json').type === 'test') {
          $("#started_at").val($(this).data('json').tester_start_at);
          $("#ended_at").val($(this).data('json').tester_end_at);
        } else if ($(this).data('json').type === 'devops') {
          $("#started_at").val($(this).data('json').devopser_start_at);
          $("#ended_at").val($(this).data('json').devopser_end_at);
        }


        $("#storeModalLabel").html('编辑任务');
        $("#team_id").val($(this).data('json').team_id);
        $("#product").val($(this).data('json').product);
        $("#come_from").val($(this).data('json').come_from);
        $("#category").val($(this).data('json').category);
        $("#type").val($(this).data('json').type);
        $("#published_at").val($(this).data('json').published_at);
        $("#content").val($(this).data('json').content);
        $("#note").val($(this).data('json').note);
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
        $("#task")[0].reset();
        $("#save").data('json', null);
      })
      // 编辑操作 //
    </script>
@endsection

