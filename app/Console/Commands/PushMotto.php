<?php

namespace App\Console\Commands;

use App\Mail\MottoShipped;
use App\Models\Motto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PushMotto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:motto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日一图，下午三点自动推送给雷胜涛';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $motto = Motto::where('status', 0)->orderBy('star', 'DESC')->first();
        if ($motto) {
            Mail::to('1436650793@qq.com')->send(new MottoShipped($motto));

            $motto->update([
                'status' => true,
            ]);
        }
    }
}
