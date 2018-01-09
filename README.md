### 这个项目是什么？

这是一个基于Docker构建的PHP开发环境，基于小型Linux发型版本alpine构建，特点是小、快、稳定,使用全部使用国内镜像，加快下载速度。完全构建后，全部镜像约360M左右。

构建后镜像大小如下:

![构建后的大小](http://oxx8i41ho.bkt.clouddn.com/WX20180109-125136.png)

### 如何使用?

第一步 克隆或者下载这个库

```she
git clone https://github.com/cutephp/lnmp-docker.git
```

第二步 启动(假设你已经安装好了docker和docker-compose)

```she
docker-compose up -d
```

然后使用

```she
docker ps
```

查看服务器是否启动



### 目录说明

alpine   构建alpine目录

data   MySQL数据库存储目录

mysql   构建MySQL目录

nginx 构建nginx目录

​	-conf nginx配置目录

php 构建PHP目录

​	-app 网站程序根目录



### 版本

MySQL:5.6.21 （来源于daocloud镜像）

PHP:7.1(基于Alipne构建)

Nginx:1.12（来源于daocloud）

Alpine:lastest

### PHP扩展

- core
- Opacahe
- Session
- Xml
- Ctype
- GD
- json
- Posix
- Curl
- Dom
- PDO
- PDO_mysql
- Sockects
- zlib
- mcrypt
- mysqli
- sqlite3
- bz2
- phar
- posxi
- zip
- calendar
- iconv
- imap
- soap
- pear
- redis
- mbstring
- xdebug
- exif
- memcached
- xsl
- ldap
- openssl
- bcmath



### 如何增加一个扩展

打开https://mirrors.aliyun.com/alpine/edge/community/x86_64/

搜索php7- 即可查到所有扩展

以安装gettext为例

![](http://oxx8i41ho.bkt.clouddn.com/WX20180109-130822.png)

我们可以看到阿里云的镜像中有这个扩展，接下来打开/php/Dockerfile,添加一行

```
php7-gettext@community
```

需要注意的是别忘了在上一行加上反斜线

![](http://oxx8i41ho.bkt.clouddn.com/WX20180109-131107.png)

### 如何增加一个虚拟站点

参照/nginx/conf/default.conf 监听不同的端口即可

代码会自动映射到/php/app目录下

默认网站路径/php/app/host1

### ThinkPHP Laravel等框架如何使用

目前主流的框架 都是将入口文件放在public目录下面

修改/nginx/conf/conf.d/default.conf

将root指令改为root   /app/host1/public;



### 如何连接数据库

以mysqli为例(PDO类似)

$con = mysqli_connect('mysql','root','root');

这些镜像全部在同一网络下 你可以直接使用mysql替代传统的127或者localhost



##### 如何远程调试

####php容器的dockerfile修改
目前在dockerfile中是写死了本机的ip作为remote_host的，包括php5和php7，而且是加了xdebug的log文件的，不需要的话各位按自己情况进行修改。

![php5](http://ww2.sinaimg.cn/large/62b80425gw1f9b7q5y3wuj20r806pac7.jpg)

#### PHPStorm配置
phpstorm的默认xdebug端口是9000，这个不用修改，在DBgp proxy里面将ide key、ip，端口填一下即可。
![phpstorm](http://ww2.sinaimg.cn/large/62b80425gw1f9b7tqrz91g20sf0l3tcw.gif)

#### chrome插件
我主要使用chrome浏览器，所以调试时使用的是xdebug的chrome插件[xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc)，其他浏览器的插件请参考xdebug官网介绍(https://xdebug.org/docs/remote) ,这篇介绍还是比较有用的，可以仔细看看。

#### 使用
在phpstorm中点击电话样子图标，start listening for php debug connection
![](http://ww3.sinaimg.cn/large/62b80425gw1f9b80w0005j2068022jr8.jpg)，当图标变成连接状态则表示能正常监听debug的连接了，
然后回到chrome浏览器中，点击xdebug helper，选择debug，然后刷新浏览器，正常情况下应该就会跳转到phpstorm中去，然后就可以进行调试了。



## 感谢

- Docker
- [gunlife/dphp](https://github.com/gnulife/dphp)
- alpine

