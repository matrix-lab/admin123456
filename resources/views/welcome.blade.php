@extends('layout.main')
@section('title', 'Fangxin DevOps')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">工作台</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-tree"></i></h1>
                        <h6 class="text-white">团队个数：{{App\Models\Team::count()}}</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
                        <h6 class="text-white">开发人数：{{App\User::count()}}</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-cash-usd"></i></h1>
                        <h6 class="text-white">活跃客户：{{App\Models\Customer::count()}}</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-list"></i></h1>
                        <h6 class="text-white">本周任务：20</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-inverse text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-list"></i></h1>
                        <h6 class="text-white">亟待发布：20</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-2">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-list"></i></h1>
                        <h6 class="text-white">每日一图：20</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-lg-6">
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0">发布清单</h4>
                        <div class="m-t-20">
                            <div class="d-flex no-block align-items-center">
                                <span>81% 郭富城</span>
                                <div class="ml-auto">
                                    <span>5</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 81%"
                                     aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center m-t-25">
                                <span>72% 周杰伦</span>
                                <div class="ml-auto">
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                     style="width: 72%" aria-valuenow="25" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center m-t-25">
                                <span>53% 刘德华</span>
                                <div class="ml-auto">
                                    <span>6</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                     style="width: 53%" aria-valuenow="50" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center m-t-25">
                                <span>3% 周星驰</span>
                                <div class="ml-auto">
                                    <span>8</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                     style="width: 3%" aria-valuenow="75" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">任务清单</h4>
                        <div class="todo-widget scrollable" style="height:385px;">
                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label todo-label" for="customCheck">
                                            <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                            <span class="badge badge-pill badge-danger float-right">Today</span>
                                        </label>
                                    </div>
                                    <ul class="list-style-none assignedto">
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/1.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Steave"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/2.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Jessica"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/3.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Priyanka"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/4.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label todo-label" for="customCheck1">
                                            <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing</span><span
                                                    class="badge badge-pill badge-primary float-right">1 week </span>
                                        </label>
                                    </div>
                                    <div class="item-date"> 26 jun 2017</div>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label todo-label" for="customCheck2">
                                            <span class="todo-desc">Give Purchase report to</span> <span
                                                    class="badge badge-pill badge-info float-right">Yesterday</span>
                                        </label>
                                    </div>
                                    <ul class="list-style-none assignedto">
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="../../assets/images/users/3.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Priyanka"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="../../assets/images/users/4.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label todo-label" for="customCheck1">
                                            <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing</span><span
                                                    class="badge badge-pill badge-primary float-right">1 week </span>
                                        </label>
                                    </div>
                                    <div class="item-date"> 26 jun 2017</div>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label todo-label" for="customCheck2">
                                            <span class="todo-desc">Give Purchase report to</span> <span
                                                    class="badge badge-pill badge-info float-right">Yesterday</span>
                                        </label>
                                    </div>
                                    <ul class="list-style-none assignedto">
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/3.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Priyanka"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/4.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label todo-label" for="customCheck3">
                                            <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing </span>
                                            <span class="badge badge-pill badge-warning float-right">2 weeks</span>
                                        </label>
                                    </div>
                                    <div class="item-date"> 26 jun 2017</div>
                                </li>
                                <li class="list-group-item todo-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label todo-label" for="customCheck4">
                                            <span class="todo-desc">Give Purchase report to</span> <span
                                                    class="badge badge-pill badge-info float-right">Yesterday</span>
                                        </label>
                                    </div>
                                    <ul class="list-style-none assignedto">
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/3.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Priyanka"></li>
                                        <li class="assignee"><img class="rounded-circle" width="40"
                                                                  src="/assets/images/users/4.jpg" alt="user"
                                                                  data-toggle="tooltip" data-placement="top"
                                                                  title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">每日一图</h4>
                    </div>
                    <div class="comment-widgets scrollable ps-container ps-theme-default"
                         data-ps-id="70684c89-6c35-b205-013f-1e1873d11d74">
                        @foreach($mottos as $motto)
                            <div class="d-flex flex-row comment-row">
                                <div class="p-2">
                                    <img src="{{avatar($motto->user_email)}}" alt="user" width="50"
                                         class="rounded-circle">
                                </div>
                                <div class="comment-text active w-100">
                                    <h6 class="font-medium">{{$motto->user_alias}}</h6>
                                    <span class="m-b-15 d-block">
                                     {{$motto->content}}
                                </span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">{{$motto->created_at}}</span>
                                        <a style=" cursor: pointer;"
                                           onclick="like('{{$motto->id}}',this)">👍 +<span>{{$motto->star}}</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

      function like(motto_id, e) {
        axios.put('/api/motto/' + motto_id + '/like').then(function (result) {
          $(e).find('span').html(result.data.star);
          toastr.success('👍👍👍', '干的漂亮');
        })

      }

    </script>
@endsection
