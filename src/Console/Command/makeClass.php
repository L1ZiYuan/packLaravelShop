<?php

namespace Packs\LaravelShops\Console\Command;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class makeClass extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lms-make:controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'lms快速创建一个类';

    /**
     * 创建类型
     * @var string
     */
    protected $type = 'class';

    /**
     * 替换指定保存路径
     * @var string
     */
    protected $packagePath = __DIR__.'/../../Http';

    /**
     * 更改命名空间
     * @return string
     */
    public function rootNamespace()
    {
        return 'Packs\LaravelShops\Http';
    }

    /**
     * 更改指定文件路径
     * @return string|void
     */
    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->packagePath.'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the stub file for the generator.
     * 指定模板
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/class.stub';
    }

}
