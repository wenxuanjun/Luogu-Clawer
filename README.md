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

由于Luogu里的这种僵尸题有几十个，所以没有耐心的童鞋可以使用我已经修改好的Luogu源文件包，放在了GetLuogu文件夹下。

如果你不怕麻烦，那就继续往坑里跳吧。

### TODO

* A题，CF题的获取
* 自动修复题面（现在需要手动用fix.py修复）
* 链接转换
* 按相似度查找题目（虽然数据库索引都建好了，但还是没来的及实现）
* RemoteJudge ~~（大雾）~~

### 此爬虫的实现

爬虫用Shell和Python3实现，由两部分组成

* get.sh-->收集器（从Luogu上Get网页源代码，~~其实就是wget~~）
* go.py-->转换器（把源代码转换后传到数据库）

网页由PHP和Mysql实现，采用Bootstrap4做UI

* index.php （显示题面）
* list.php （生成列表）
* mysql.php (查询数据库并返回数据)
* head.php （index.php的head标签，因为嫌index.php太长所以就单独拿出来了）

### 最后

至于代码，不仅不美观而且很可能有问题，~~因为作者很制杖~~

若真的有问题，请提交issue
