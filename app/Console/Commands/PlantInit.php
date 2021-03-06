<?php

namespace App\Console\Commands;

use App\model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class plantInit extends Command
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
    protected $description = 'init plant dir and table';

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
        $this->call('migrate');
//        $this->call('db:seed');  //初始化管理员
        $this->initAdmin();
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
        $password = $this->secret('请输入管理员密码');
        $phone = $this->ask('请输入管理员联系电话');
        User::create([
            'username' => 'admin',
            'password' => bcrypt($password),
            'phone' => $phone,
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
