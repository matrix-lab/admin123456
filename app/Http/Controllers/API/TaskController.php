<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        $data = [
            [
                '团队',
                '产品',
                '来源',
                '模块',
                '任务',
                'IOS负责人',
                'IOS开始时间',
                'IOS结束时间',
                'Android负责人',
                'Android开始时间',
                'Android结束时间',
                '前端负责人',
                '前端开始时间',
                '前端结束时间',
                '后端负责人',
                '后端开始时间',
                '后端结束时间',
                '测试负责人',
                '测试开始时间',
                '测试结束时间',
                '进度',
                '状态',
                '上线时间',
                '备注',
            ],
        ];

        foreach ($tasks as $task) {
            array_push($data, [
                $task->team_alias,
                $task->product,
                $task->come_from,
                $task->category,
                $task->content,
                $task->ioser_alias,
                $task->ioser_start_at,
                $task->ioser_end_at,
                $task->androider_alias,
                $task->androider_start_at,
                $task->androider_end_at,
                $task->uier_alias,
                $task->uier_start_at,
                $task->uier_end_at,
                $task->phper_alias,
                $task->phper_start_at,
                $task->phper_end_at,
                $task->tester_alias,
                $task->tester_start_at,
                $task->tester_end_at,
                $task->progress,
                $task->status,
                $task->published_at,
                $task->note,
            ]);
        }

        $fileName = '北京研发中心'.Carbon::now()->toDateString().'开发计划.csv';

        $fp = fopen($fileName, 'w');
        ob_start();
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        ob_get_clean();

        return response()->download($fileName, $fileName)->deleteFileAfterSend(true);
    }

    public function download()
    {
    }

    public function store(Request $request)
    {
        $type = $request->get('type');

        $request->offsetSet($type.'er_id', Auth::user()->id);
        $request->offsetSet($type.'er_alias', Auth::user()->name);
        $request->offsetSet($type.'er_start_at', $request->get('started_at'));
        $request->offsetSet($type.'er_end_at', $request->get('ended_at'));

        if ($type == 'ui') {
            $request->offsetSet('progress', '排版中');
        } elseif ($type == 'php') {
            $request->offsetSet('progress', '开发中');
        } elseif ($type == 'ios') {
            $request->offsetSet('progress', '排版中');
        } elseif ($type == 'android') {
            $request->offsetSet('progress', '排版中');
        } elseif ($type == 'test') {
            $request->offsetSet('progress', '测试中');
        } elseif ($type == 'devops') {
            $request->offsetSet('progress', '待发布');
        }
        $request->offsetSet('status', '未完成');

        return Task::create($request->all());
    }

    public function update(Request $request, Task $task)
    {
        $type = $request->get('type');

        $request->offsetSet($type.'er_id', Auth::user()->id);
        $request->offsetSet($type.'er_alias', Auth::user()->name);
        $request->offsetSet($type.'er_start_at', $request->get('started_at'));
        $request->offsetSet($type.'er_end_at', $request->get('ended_at'));

        $task->update($request->all());

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return $task;
    }
}
