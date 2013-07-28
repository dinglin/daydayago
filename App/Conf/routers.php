<?php

return array(
    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES' => array( //定义路由规则
            //'/'        => 'home/Index/',
            '/^home$/'        => 'home/Home/',
            '/^error_404$/'   => 'home/Error/',
            // '/^blog\/(\d+)\/(\d+)$/' => 'Blog/achive?year=:1&month=:2',
            // '/^blog\/(\d+)_(\d+)$/'  => 'blog.php?id=:1&page=:2',
            //index
            '/^post\/login$/'              => "home/Index/login",
            '/^post\/register$/'           => "home/Index/regist",
            '/^logout$/'                   => "home/Index/tologout",
            //memo
            '/^memo/'                      => "home/Memo/",
            //plan
            '/^plan$/'                      => "home/Plan/",
            '/^plan\/(\d+)/'               => "home/Plan/view?id=:1",
    )
);