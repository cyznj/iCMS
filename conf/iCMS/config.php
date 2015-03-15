<?php
defined('iPHP') OR exit('Access Denied');
return array (
  'site' => 
  array (
    'name' => 'iCMS',
    'seotitle' => '高效简洁的开源内容管理系统',
    'keywords' => 'iCMS,idreamsoft,艾梦软件',
    'description' => 'iCMS 是一套采用 PHP 和 MySQL 构建的高效简洁的内容管理系统,为您的网站提供一个完美的开源解决方案',
    'icp' => '',
  ),
  'debug' => 
  array (
    'php' => '0',
    'tpl' => '1',
    'sql' => '0',
  ),
  'template' => 
  array (
    'index_mode' => '0',
    'index_rewrite' => '0',
    'index' => '{iTPL}/index.htm',
    'index_name' => 'index',
    'desktop' => 
    array (
      'tpl' => 'huati',
    ),
    'mobile' => 
    array (
      'agent' => 'WAP,Smartphone,Mobile,UCWEB,Opera Mini,Windows CE,Symbian,SAMSUNG,iPhone,Android,BlackBerry,HTC,Mini,LG,SonyEricsson,J2ME,MOT',
      'domain' => 'http://localhost',
      'tpl' => 'mobile',
    ),
    'device' => 
    array (
      0 => 
      array (
        'name' => 'weixin',
        'ua' => 'MicroMessenger',
        'domain' => 'http://localhost',
        'tpl' => 'weixin',
      ),
    ),
  ),
  'router' => 
  array (
    'URL' => 'http://localhost',
    'DIR' => '/',
    404 => 'http://localhost/public/404.htm',
    'public_url' => 'http://localhost/public',
    'user_url' => 'http://localhost/usercp',
    'html_dir' => 'html/',
    'html_ext' => '.html',
    'speed' => '50',
    'rewrite' => '0',
    'tag_url' => 'http://localhost',
    'tag_rule' => '{PHP}',
    'tag_dir' => '/',
  ),
  'cache' => 
  array (
    'enable' => '1',
    'engine' => 'file',
    'host' => '',
    'time' => '300',
    'compress' => '1',
  ),
  'FS' => 
  array (
    'url' => 'http://localhost/res/',
    'dir' => 'res',
    'dir_format' => 'Y/m-d/H',
    'allow_ext' => 'gif,jpg,rar,swf,jpeg,png',
    'yun' => 
    array (
      'enable' => '0',
      'local' => '0',
      'QiNiu' => 
      array (
        'Bucket' => '',
        'AccessKey' => '',
        'SecretKey' => '',
      ),
    ),
  ),
  'watermark' => 
  array (
    'enable' => '1',
    'width' => '140',
    'height' => '140',
    'pos' => '0',
    'x' => '0',
    'y' => '0',
    'img' => 'watermark.png',
    'text' => 'iCMS',
    'font' => '',
    'fontsize' => '12',
    'color' => '#000000',
    'transparent' => '80',
  ),
  'user' => 
  array (
    'register' => '1',
    'regseccode' => '1',
    'login' => '1',
    'loginseccode' => '1',
    'agreement' => '',
    'coverpic' => '/ui/coverpic.jpg',
  ),
  'open' => 
  array (
    'WX' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
    'QQ' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
    'WB' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
    'TB' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
  ),
  'publish' => 
  array (
    'autoformat' => '0',
    'catch_remote' => '0',
    'remote' => '0',
    'autopic' => '1',
    'autodesc' => '1',
    'descLen' => '100',
    'autoPage' => '0',
    'AutoPageLen' => '1000',
    'repeatitle' => '0',
    'showpic' => '1',
  ),
  'comment' => 
  array (
    'enable' => '1',
    'examine' => '1',
    'seccode' => '1',
  ),
  'time' => 
  array (
    'zone' => 'Asia/Shanghai',
    'cvtime' => '0',
    'dateformat' => 'Y-m-d H:i:s',
  ),
  'other' => 
  array (
    'py_split' => '',
    'keyword_limit' => '-1',
    'sidebar_enable' => '1',
    'sidebar' => '1',
  ),
  'article' => 
  array (
    'pic_next' => '0',
    'pageno_incr' => '',
    'prev_next' => '0',
  ),
  'api' => 
  array (
    'weixin' => 
    array (
      'token' => '',
    ),
    'baidu' => 
    array (
      'sitemap' => 
      array (
        'site' => '',
        'resource_name' => 'sitemap',
        'access_token' => '',
        'sync' => '0',
      ),
    ),
  ),
  'system' => 
  array (
    'patch' => '2',
  ),
  'sphinx' => 
  array (
    'host' => '',
    'index' => 'iCMS_article iCMS_article_delta',
  ),
  'mail' => 
  array (
    'host' => '',
    'secure' => '',
    'port' => '25',
    'username' => '',
    'password' => '',
    'setfrom' => '',
    'replyto' => '',
  ),
  'apps' => 
  array (
    0 => 'index',
    1 => 'article',
    2 => 'tag',
    3 => 'search',
    4 => 'usercp',
    5 => 'category',
    6 => 'comment',
    7 => 'favorite',
    8 => 'public',
    9 => 'user',
  ),
);