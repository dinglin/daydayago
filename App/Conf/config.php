<?php
return array(
    'URL_MODEL'                 =>  2, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'daydayago',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  '',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'dda_',
    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
    'APP_GROUP_LIST'            =>  'Home,Admin',
    'DEFAULT_GROUP'             =>  'Home',
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  1,//显示调试信息
    'LOAD_EXT_CONFIG'           => "routers,routersAdmin",
    'URL_404_REDIRECT'          =>   '/error_404',
);
