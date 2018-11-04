# Luogu小爬虫

只爬了P题，好像没什么用（不过你可以自己改）~~相比起其他写爬虫的人，我实在太弱了~~

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
