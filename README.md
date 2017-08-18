API 文档生成器
============================

随着现代应用越来越复杂，前后端开发进行分离变得越来越流行。

为什么呢？

因为分离之后，前端可以专心的去编写UI设计的漂亮界面和交互，功能上只需要调用后台开发好的一个个API即可；
后端呢，也只需要专注与应用的处理逻辑编写，数据库的设计等，最终把输入和输出封装成一个个清晰的API共前端人员调用。
还有一个好处是，前后端需求有变更的时候，各自不会互相影响，非常有利于后期的维护。

可是，前后端配合的愉快吗？呵呵……

既然前后端分离这么好，为什么很多开发人员，还是被沟通搞得焦头烂额呢？
我觉得主要原因是没有一个清晰的接口文档，更准确的说，是没有一个能够跟得上项目进度“及时更新的”“清晰的”接口文档！

本程序旨在方便快捷的编写api文档，同时提供一些有用的工具，让编写api文档成为一个轻松惬意的工作。


目录结构
-------------------

项目采用PHP的框架yii framework，目录结构如下：

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


安装说明
-------------------

  - clone到本地，配置虚拟主机
  - 如果之前你的composer没有安装过`composer-asset-plugin`，需要执行composer global require "fxp/composer-asset-plugin:~1.1.1"进行安装
  - 使用命令行，cd到项目根目录，执行 `composer install`。注意，首次执行此命令的可能需要添加github分配的token。token生成办法，登录github，按此顺序操作：settings -> Personal access tokens -> generate new token
  - 创建数据库api-doc，字符集选择utf-8，配置数据库`config/db.php`。
  - 使用命令行，在根目录执行`php yii migrate` ，选择yes。（需将php添加到系统环境变量）
  - 配置虚拟主机（如：http://demo.api-doc.com）到 web 目录下面。


必要条件
------------

该程序运行所需要的PHP版本为 5.5以上，因为5.4以下的composer会报错。


配置数据库
-------------
编辑文件 `config/db.php`：

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=api-doc',
    'username' => 'root',
    'password' => '1234', // 根据自己的环境填写
    'charset' => 'utf8',
];
```

Apache虚拟主机配置参考
-------------

```php
<VirtualHost *:80>
    ServerAdmin someone@example.com
    DocumentRoot "C:/www/api-doc/web"
    ServerName demo.api-doc.com
    ErrorLog "logs/api-doc.com-error.log"
    CustomLog "logs/api-doc.com-access.log" common

	<Directory "C:/www/api-doc/web">
		AllowOverride all
		Require all granted
	</Directory>
</VirtualHost>
```

**注意：** 数据库需要手动创建


待开发功能
-------------

[功能列表](todoTask.md)


License
-------------

api-doc is released under the BSD License. See the bundled [LICENSE](LICENSE.md) for details.
