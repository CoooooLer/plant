<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class initPlant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plant:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init plant dir';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $this->initDirectory();
    }

    /*
     * 初始化数据库
     * */
    public function initDatabase()
    {
        $this->call('migrate');
    }

    /**
     * 初始化admin账号
     */
    public function initAdmin()
    {
        $password = $this->ask('What is the admin password?');
        User::create([
            'username' => 'admin',
            'password' => bcrypt($password),
            'email' => 'admin@admin.com',
        ]);

    }

    /*
     * 创建文件夹、创建link
     * */
    public function initDirectory()
    {
        Storage::makeDirectory('public/jianjie');
        Storage::makeDirectory('public/yanghu');
        $this->call('storage:link');
    }





}
