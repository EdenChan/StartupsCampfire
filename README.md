# 基于Laravel5.1的创业者社区Demo

### 安装说明

1) 通过git clone获得本项目源码：

运行命令
```
git clone https://github.com/EdenChan/StartupsCampfire.git
```

2) 安装composer依赖
在clone下来的`StartupsCampfire`文件夹中运行命令
```
composer install
```
为提升composer包安装速度建议使用composer中国全量镜像，相关信息如下：
http://pkg.phpcomposer.com/

上述命令执行完成后,
请在`StartupsCampfire`文件夹中使用命令
```
cp .env.example .env
```
创建项目.env文件（如果处于windows环境下可利用git bash执行上述命令）

随后编辑.env文件进行环境配置
示例结果如下
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=SomeRandomString

DB_HOST=localhost
DB_DATABASE=startupscampfire
DB_USERNAME=root
DB_PASSWORD=root
DB_PREFIX=scamp_(如果通过sql导入方式建立数据库请勿更改表前缀)

CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_COOKIENAME=startupscampfire_session
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
然后运行命令
```
php artisan key:generate
```
设定laravel应用所需的key

运行
```
php artisan vendor:publish
```
导出composer包配置到本项目中

3) 安装npm模块
本项目初步尝试使用gulp工具进行前端构建，如有需要可运行命令
```
npm install
```
安装相关模块，需要确保已安装nodejs和已全局安装gulp模块，相关信息请见：
http://www.gulpjs.com.cn/docs/getting-started/

4）建立数据库
默认使用mysql数据库，请先建立数据库`startupscampfire`

如需安装示例数据，请将根目录下的`startupscampfire.sql`文件导入

如仅需表结构，可在composer依赖安装完毕后运行命令
```
php artisan migrate
```
进行数据库初始化

5）运行应用
根目录下执行命令
```
php artisan serve
```
然后通过浏览器访问地址`http://localhost:8000`即可

### 页面预览

#### 前台
访问 http://115.28.40.237/
目前项目暂时部署在阿里云上
前台主要使用bootstrap+flatui构建
![](http://i13.tietuku.com/d259da2c268ddd85.png)

![](http://i13.tietuku.com/068c80fc9fc759ff.png)

![](http://i13.tietuku.com/9117cd456c445d86.png)

![](http://i13.tietuku.com/00aebb4f31f48e43.png)
#### 后台
访问 http://115.28.40.237/admin
```
初始管理员 账号admin 密码123456 请尽量不要更改线上数据哈
```
后台ui采用的是AmazeUI
![](http://i13.tietuku.com/c156f5744143186d.png)

### 本项目实现的主要功能
1)**前后台分离用户验证**

2)**前台主要功能**：
注册登录、忘记密码、发布动态、申请活动、发布评论、回复评论、
收藏动态、收藏活动、动态/活动/评论点赞
编辑个人信息、关注用户、@提醒、即时消息提示、站内检索、分类导航..

3)**后台主要功能**：
活动/评论/分类/用户动态管理、活动审核、发布平台活动、
导航管理、首页幻灯片管理、用户管理、站点公告管理..

***TODO:***
将来考虑加入的功能：
用户分组、私信发送、活动报名、站内信、用户推荐、举报..

另外由于项目时间等等问题，本来考虑使用vuejs完成部分前端内容，但最终还是保持最简单的前端写法，后续会考虑引入一些新的前端技术和利用ajax等方式优化一下前端部分的交互。

### 项目参考
本项目在实现过程中参考了目前基于laravel的部分项目源码，主要项目有：

https://github.com/summerblue/phphub （phphub网站的源码）

https://github.com/douyasi/yascmf

https://github.com/BootstrapCMS （代码规范，推荐阅读）

本项目使用的部分composer包：

https://github.com/lazychaser/laravel-nestedset 
(处理树形结构数据：如无限级分类、导航等)

https://github.com/Sarav-S/Laravel-Multiauth 
(用户分表验证，可将不同角色用户存到不同的user表中 ，分别进行管理)

https://github.com/andersao/l5-repository
(用于Laravel5的Repository抽象包，支持实现Repository层逻辑)

https://github.com/stevenyangecho/laravel-u-editor
(百度ueditor富文本编辑器，
如果遇到无法上传图片的问题可以参考这个issue:
https://github.com/stevenyangecho/laravel-u-editor/issues/6)

###一些题外话
很早之前就听说了Laravel的大名，最近有空的时候学习了一下这个框架的一些基本用法，利用空余时间断断续续地做了一个月多点的时间，基本把这个项目做成了现在这个样子，主要定位于给Laravel的初学者提供一些使用框架的思路。

和之前接触的一些框架（tp、ci等等）相比，laravel无疑在构建一个更规范的工作流方面做得更加出色，composer支持、好用的Eloquent ORM、好用的Blade模板、好用的Restful路由、方便的Form Request..这些都能减少开发过程中的很多思考时间，使开发者更专注于项目功能的实现。

当然由于我自己的各种经验欠缺问题（今年应届），在这个项目许多实现上还是非常simple和naive的，接下来的时间还是需要更多的思考如何能够更好地解决部件解耦、减少重复和提高代码质量等问题，希望能够和大家交流，向大家好好学习:)

###联系作者

Email:2301016897@qq.com
