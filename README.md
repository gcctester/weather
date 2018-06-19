﻿# weather

sudo apt-get install apache2 php5 libapache2-mod-php5 php5-curl
sudo /etc/init.d/apache2 restart
Web Root: /etc/www/html/
sudo chmod 666 weather.log

JSON格式：
1） 并列的数据之间用逗号（", "）分隔。
2） 映射用冒号（": "）表示。
3） 并列数据的集合（数组）用方括号("[]")表示。
4） 映射的集合（对象）用大括号（"{}"）表示。

查看Web服务器连接数
netstat -na|grep ESTABLISHED|wc -l
netstat -nat|grep -i "80"|wc -l

Linux使用netstat命令查看并发连接数 
netstat -n | awk '/^tcp/ {++S[$NF]} END {for(a in S) print a, S[a]}'
