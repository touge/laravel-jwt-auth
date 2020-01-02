
正常安装后，执行vendor:publish指令，选择相关需要同步到前端的项目。
然后在```app/Exceptions/Handler.php``` 文件 report 方法中加入以下代码：
```
new \Touge\JwtAuth\Exceptions\JwtExceptionHandle($exception);
```
使之变为
```
    public function report(Exception $exception)
    {
        new \Touge\JwtAuth\Exceptions\JwtExceptionHandle($exception);
        parent::report($exception);
    }
```
此目的捕获jwt的错误


依赖```fruitcake/laravel-cors```，安装说明见：https://www.jianshu.com/p/f8ba64aaca8d