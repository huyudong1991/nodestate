# notestate
脚本基于逗比的SSR检测脚本https://github.com/ToyoDAdoubi/SSRStatus 修改，用于构建SSR是否可用的自动检测，同时测试检测服务器到脚本服务器的延迟，搭建在国内服务器上可以检测是否被wall。

本引导基于Centos7，其他系统自行尝试。

### 实物图
![sample](https://raw.githubusercontent.com/huyudong1991/nodestate/master/screen.jpg)
<img src="https://raw.githubusercontent.com/huyudong1991/nodestate/master/screen.jpg" width="200px" />

### 下载并运行脚本
`wget -N --no-check-certificate https://raw.githubusercontent.com/huyudong1991/nodestate/master/ssrstatus.sh && chmod +x ssrstatus.sh && bash ssrstatus.sh`

### 安装依赖和服务端
选择1按照提示安装后，需给caddy配置php服务器

### 安装php
`yum install php php-fpm php-mysql php-curl php-gd php-mbstring php-mcrypt php-xml php-xmlrpc`

### 修改php配置文件
`vi /etc/php-fpm.d/www.conf`

原配置

; Unix user/group of processes

; Note: The user is mandatory. If the group is not set, the default user's group

;       will be used.

; RPM: apache Choosed to be able to access some dir as httpd

user = apache

; RPM: Keep a group allowed to write in log dir.

group = apache

修改后

; Unix user/group of processes

; Note: The user is mandatory. If the group is not set, the default user's group

;       will be used.

; RPM: apache Choosed to be able to access some dir as httpd

user = caddy

; RPM: Keep a group allowed to write in log dir.

group = caddy

### 添加新用户
`useradd caddy`
### 重启php和caddy
`systemctl start php-fpm`

`service caddy restart`

此时打开你的ip:端口应该可以访问监测网页

再次执行ssrstatus.sh脚本选择6添加你的ssr配置，之后执行./ssrstatus.sh t 即可批量监测脚本了

## 细节操作
更多细节操作例如修改网站目录，批量添加节点的操作，请参考逗比的说明文档 https://github.com/ToyoDAdoubi/SSRStatus

## 鸣谢
逗比的源码-挺好的html源码及延迟测试源码
