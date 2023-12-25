# tp5book
基于thinkphp5.0.23的图书管理系统
项目保存在master分支里
搭建环境：
    apache2.4.54.2
    php8.0.26
    mysql8.0.31
~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─index              公共模块目录（可以更改）
│  ├─admin              管理员模块目录
│  ├─users              用户模块目录
│  ├─module_name        模块目录
│  │  ├─config.php      模块配置文件
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  ├─config             自定义配置目录
│  │  ├─config.php         公共配置文件
│  │  ├─route.php          路由配置文件
│  │  └─database.php       数据库配置文件
│  │
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  ├─static             静态资源目录
│  │  ├─bootstrap       bootstrap组件目录
│  │  ├─css             css样式目录
│  │  ├─img             图片目录
│  │  ├─js              js目录
│  │  └─font            字体资源目录
│  │
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
├─library.sql           数据库文件
~~~
