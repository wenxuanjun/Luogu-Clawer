# Luogu离线题库

**目前只爬了P题**，好像没什么用（不过你可以自己改），而且我也不知道我做这个干什么（为了装逼？），还有UI特别丑陋......~~相比起其他写爬虫的人，我实在太弱了~~

### 离线题库使用说明

这个章节适合那些只想用(wu)用(liao)题(tou)库(ding)的童鞋食用

首先，你需要准备一个服务器（或者自家电脑），已经安装好这些东西

* Apache或Nginx
* Mysql（5.6版本最佳，因为我用的是5.6的）
* PHP（最好是PHP7,因为旧版本没有测试过，可能有不可预知的错误）

如果没有安装好，可以通过宝塔面板或者LAMP或者LNMP或者......自己编译？（我真的没有打广告）

然后，你需要把仓库Clone下来

```shell
git clone https://github.com/wenxuanjun/Luogu-Clawer.git
```

此离线题库所有的文件都放在了Web目录下，所以没有其他需求的童鞋可以把其他文件夹删了~~（因为我不会单独Clone一个文件夹）~~

Web/luogu目录下有一个luogu.sql.gz文件，需要把它导入Mysql数据库（**建议新建一个数据库，因为我没试过导入原有数据库会不会覆盖所有内容**），里面包含了所有的题面（别问我为什么要用Mysql，~~因为它又小又快速还支持索引~~）

然后修改Web/mysql.php，把里面的数据库信息修改一下，就算弄好了！

访问index.html就可以看到题目列表（界面丑陋，大神勿喷）

### 爬虫使用说明

这个章节适合那些想要自(hui)我(huo)创(shi)造(jian)的童鞋食用

如果你想用我的爬虫，那么恭喜，你真的入大坑了

此爬虫爬取Luogu分两步走战略：

1. 使用get.sh从Luogu上Get网页源代码，~~其实就是wget~~
2. 使用go.py把源代码转换后传到数据库

爬虫Clawer放在了Web目录下，所以......

```shell
cd Clawer
```

由于你谷貌似没有反爬虫的骚操作，所以不需要延迟，直接下载便是

运行get.sh来get所有页面

```shell
bash get.sh
```

然后就会在当前目录下生成一个名为Luogu的文件夹，里面有一堆的htm文件

修改go.py里面的Luogu源文件目录和数据库设置（这个go.py可以直接往数据库导入题目，前提是你已经建立好了表，至于什么是表，请阅读[MySQL 创建数据表](http://www.runoob.com/mysql/mysql-create-tables.html)）

修改完就可以安装go.py的依赖了

先安装好Python3（自带pip3）

运行以下指令（若发生错误可给予root权限后重试）

```shell
pip3 install beautifulsoup4
pip3 install bs4
pip3 install mysql-connector
```

然后就可以运行go.py了

```shell
python3 go.py
```

由于你谷有些题有各种各样的问题，如重题，过水，被删除等，会导致没有权限访问该题，因此之前Get下来的便是指向<https://www.luogu.org/app/info>的错误源代码，这会让go.py报错（请原谅我代码能力差，没有自动修复功能）。因此，需要使用fix.py和temp.htm来修复这个题的源代码，让它变成包含标题的不会报错的空文件。

Luogu里的这种僵尸题有几十个，所以没有耐心的童鞋可以使用我已经修改好的Luogu源文件包，放在了GetLuogu文件夹下。

如果你不怕麻烦，那就继续往坑里跳吧。

首先修改fix.py里面的Luogu源文件目录和模板文件的地址。

如果有一个题是僵尸题，go.py会报错然后停止，这时，你需要根据go.py显示的题号，到Luogu上复制该题的标题，然后运行python 3 fix.py，输入题号和标题（用回车隔开）。接着清空表（注意是把它清空TRUNCATE而不是删除DROP，否则就重新建表吧），以免造成id不对应引起查询出错误结果。你也可以把写入数据库的那部分代码注释掉，把Luogu僵尸题都处理完后，再把注释去掉，完整跑一遍go.py，这样就不用每次都清空表了。

就这么循环，循环，直到出现"Done"，表示数据库已经写入完毕。然后修改一下Web/mysql.php就算完成了（是不是有直接导入数据库的冲动๑乛◡乛๑）

### TODO

* AT题，CF题的获取
* 自动修复题面（现在需要手动用fix.py修复）
* 链接转换
* 按相似度查找题目（虽然数据库索引都建好了，但还是没来的及实现）
* RemoteJudge ~~（大雾）~~

### 所有文件的用途解释

>Clawer/get.sh #获取Luogu题目的htm源代码
>
>Clawer/go.py #转换源代码并写入数据库的主程序
>
>Clawer/fix.py #修复僵尸题的程序
>
>Clawer/tmp.htm #修复僵尸题的模板
>
>GetLuogu/Luogu.tar.gz #修改好僵尸题的Luogu题目的htm源代码
>
>Web/index.html #题目列表的前端
>
>Web/list.php #题目列表的后端
>
>Web/index.php #题目主体的前端
>
>Web/mysql.php #连接Mysql的程序
>
>Web/head.php #为了缩短index.php的产物
>
>Web/luogu.sql.gz #打包好的题目，导入数据库用
>
>Web/luogu.css #为了**稍微**好看一点而写的CSS
>
>Web/prism.css #高亮所用的CSS
>
>Web/prism.js #高亮所用的JavaScript

### 最后

请不要问为什么index.html不用PHP写，因为作者的网站使用这个index.html的方式很特别，PHP用不了。~~还有这个index.html是临时制造的~~

至于代码，不仅不美观而且很可能有问题，~~因为作者很制杖~~

若真的有问题，请提交issue

这个爬虫是MIT协议的，~~只要你谷不找麻烦的话~~，你们随便处理都没事呵