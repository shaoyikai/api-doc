API 文档生成器
============================

前后台分离，非常流行的开发方法，写接口就成了麻烦的事情。本程序旨在方便的写api文档，同时提供一些有用的工具，让编写api文档成为一个非常简单的工作。

安装说明
-------------------

  - clone到本地
  - composer install
  - 创建数据库api-doc，字符集选择utf-8
  - yii migrate ，选择yes，


目录结构
-------------------

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


必要条件
------------

该程序运行所需要的PHP版本为 5.4.0以上。


配置
-------------

### 数据库

编辑文件 `config/db.php`：

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=api-doc',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**注意：** 数据库需要手动创建