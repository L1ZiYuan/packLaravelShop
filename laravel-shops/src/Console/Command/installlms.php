<?php

namespace Pack\LaravelShops\Console\Command;

use Illuminate\Console\Command;

class installlms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:lms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is an integration command to install LMS project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * 命令执行的时候会触发这里
     * @return mixed
     */
    public function handle()
    {
        // 执行迁移文件
        $this->call('migrate');
        // 发布配置文件
        $this->call('vendor:publish',[
            '--provider' => 'Pack\LaravelShops\Provider\ServiceProvider',
        ]);
    }
}
