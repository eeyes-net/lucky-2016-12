# 微信大屏幕抽奖 - e瞳网

获取wxscreen的用户数据，抽奖

<http://lucky.eeyes.net/>

## 安装

1. 要求`php >= 5.4`，打开`PDO mysql`拓展

2. 执行`composer install`

3. 根据需要修改`install.sample.sql`，并在数据库中执行，然后删除即可

4. 将`application/`目录中的`config.sample.php`改名为`config.php`，`database.sample.php`改名为`database.php`，并根据需要修改配置参数及数据库配置

5. Nginx重写

    ```text
    server {
        listen       80;
        server_name  lucky.eeyes.net;
        root         /www/lucky-2016-12/public;
        index        index.php index.html index.htm;

        location / {
            if (!-e $request_filename) {
                rewrite ^(.*)$ /index.php/$1 last;
                break;
            }
        }

        location ~ [^/]\.php(/|$) {
            fastcgi_pass             127.0.0.1:9000;
            fastcgi_index            index.php;
            fastcgi_split_path_info  ^(.+\.php)(/.*)$;
            fastcgi_param            PATH_INFO $fastcgi_path_info;
            include                  fastcgi.conf;
        }
    }
    ```

6. 访问主页并新建一个指向`http://p.wxscreen.com/wxscreen/message/`

## Author

Ganlv

## LICENSE

[AGPL-3.0](https://www.gnu.org/licenses/agpl-3.0.html)
