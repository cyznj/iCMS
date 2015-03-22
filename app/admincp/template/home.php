<?php /**
 * @package iCMS
 * @copyright 2007-2010, iDreamSoft
 * @license http://www.idreamsoft.com iDreamSoft
 * @author coolmoo <idreamsoft@qq.com>
 * @$Id: home.php 2393 2014-04-09 13:14:23Z coolmoo $
 */
defined('iPHP') OR exit('What are you doing?');
iACP::head();
?>
<div class="iCMS-container">
  <div class="row-fluid">
    <div class="span12 center" style="text-align: center;">
      <ul class="quick-actions">
        <li><a href="javascript:;" class="tip" title="开发中..."><i class="icon-calendar"></i>日程管理</a></li>
        <li><a href="<?php echo __ADMINCP__; ?>=article"><i class="icon-survey"></i>文章管理</a></li>
        <li><a href="<?php echo __ADMINCP__; ?>=tags"><i class="icon-tag"></i>标签管理</a></li>
        <li><a href="<?php echo __ADMINCP__; ?>=spider&do=project"><i class="icon-download"></i>采集管理</a></li>
        <li><a href="<?php echo __ADMINCP__; ?>=user"><i class="icon-people"></i>用户管理</a></li>
        <li><a href="<?php echo __ADMINCP__; ?>=database&do=backup"><i class="icon-database"></i>数据库管理</a></li>
      </ul>
    </div>
  </div>
  <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    欢迎使用cyznj内容管理系统！<strong><?php echo iMember::$data->username;?></strong>。您最后一次登陆时间:<strong><?php echo get_date(iMember::$data->lastlogintime,"Y-n-j H:i:s") ; ?></strong>，IP地址为:<strong><?php echo iMember::$data->lastip; ?></strong>。如有异常请及时排查！ </div>
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="fa fa-signal"></i> </span>
      <h5>站点数据统计</h5>
    </div>
    <div class="widget-content">
      <div class="row-fluid">
        <div class="span3">
          <ul class="site-stats">
            <li><i class="fa fa-sitemap"></i> <strong><?php echo $acc ; ?></strong> <small>文章栏目</small></li>
            <li><i class="fa fa-sitemap"></i> <strong><?php echo $tac ; ?></strong> <small>标签分类</small></li>
            <li><i class="fa fa-sitemap"></i> <strong><?php echo $pac ; ?></strong> <small>推送分类</small></li>
            <li class="divider"></li>
            <li><i class="fa fa-user"></i> <strong><?php echo $uc ; ?></strong> <small>用户</small></li>
          </ul>
        </div>
        <div class="span3">
          <ul class="site-stats">
            <li><i class="fa fa-file-text"></i> <strong><?php echo $ac ; ?></strong> <small>文章总数</small></li>
            <li><i class="fa fa-file"></i> <strong><?php echo $ac0 ; ?></strong> <small>草稿</small></li>
            <li><i class="fa fa-file-o"></i> <strong><?php echo $ac2 ; ?></strong> <small>回收站</small></li>
            <li class="divider"></li>
            <li><i class="fa fa-tag"></i> <strong><?php echo $tc ; ?></strong> <small>标签</small></li>
          </ul>
        </div>
        <div class="span3">
          <ul class="site-stats">
            <li><i class="fa fa-comment"></i> <strong><?php echo $ctc ; ?></strong> <small>评论</small></li>
            <li><i class="fa fa-paperclip"></i> <strong><?php echo $kc ; ?></strong> <small>内链</small></li>
            <li><i class="fa fa-thumb-tack"></i> <strong><?php echo $pc ; ?></strong> <small>推送</small></li>
            <li class="divider"></li>
            <li><i class="fa fa-heart"></i> <strong><?php echo $lc ; ?></strong> <small>友链</small></li>
          </ul>
        </div>
        <div class="span3">
          <ul class="site-stats">
            <li><i class="fa fa-database"></i> <strong><?php echo iFS::sizeUnit($datasize+$indexsize) ; ?></strong> <small>数据库</small></li>
            <li><i class="fa fa-puzzle-piece"></i> <strong><?php echo count($iTable) ; ?></strong><small>iCMS表</small></li>
            <li><i class="fa fa-puzzle-piece"></i> <strong><?php echo count($oTable) ; ?></strong> <small>其它表</small></li>
            <li class="divider"></li>
            <li><i class="fa fa-files-o"></i> <strong><?php echo $fdc ; ?></strong> <small>文件</small></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="fa fa-tachometer"></i> </span>
      <h5>系统信息</h5>
    </div>
    <div class="widget-content">
      <table class="table table-bordered">
        <tr>
          <td>当前程序版本</td>
          <td>iCMS <?php echo iCMS_VER ; ?>[<?php echo iCMS_RELEASE ; ?>]</td>
          <td><a href="<?php echo __ADMINCP__;?>=patch&do=check&force=1&frame=iPHP" target="iPHP_FRAME" id="home_patch">最新版本</a></td>
        </tr>
        <tr>
          <td>服务器操作系统</td>
          <td><?php echo PHP_OS ; ?></td>
          <td>服务器端口</td>
          <td><?php echo getenv(SERVER_PORT) ; ?></td>
        </tr>
        <tr>
          <td>服务器剩余空间</td>
          <td><?php echo intval(diskfreespace(".") / (1024 * 1024))."M" ; ?></td>
          <td>服务器时间</td>
          <td><?php echo get_date(0,"Y-n-j H:i:s"); ?></td>
        </tr>
        <tr>
          <td>WEB服务器版本</td>
          <td><?php echo $_SERVER['SERVER_SOFTWARE'] ; ?></td>
          <td>服务器语种</td>
          <td><?php echo getenv("HTTP_ACCEPT_LANGUAGE") ; ?></td>
        </tr>
        <tr>
          <td>PHP版本</td>
          <td><?php echo PHP_VERSION ; ?></td>
          <td>ZEND版本</td>
          <td><?php echo zend_version() ; ?></td>
        </tr>
        <tr>
          <td>MySQL 数据库</td>
          <td><?php echo $this->okorno(function_exists("mysql_close")) ; ?></td>
          <td>MySQL 版本</td>
          <td><?php echo iDB::version() ; ?></td>
        </tr>
        <tr>
          <td>图像函数库</td>
          <td><?php echo function_exists("imageline")==1?$this->okorno(function_exists("imageline")):$this->okorno(function_exists("imageline")) ; ?></td>
          <td>Session支持</td>
          <td><?php echo $this->okorno(function_exists("session_start")) ; ?></td>
        </tr>
        <tr>
          <td>脚本运行可占最大内存</td>
          <td><?php echo get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无" ; ?></td>
          <td>脚本上传文件大小限制</td>
          <td><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件" ; ?></td>
        </tr>
        <tr>
          <td>POST方法提交限制</td>
          <td><?php echo get_cfg_var("post_max_size") ; ?></td>
          <td>脚本超时时间</td>
          <td><?php echo get_cfg_var("max_execution_time") ; ?></td>
        </tr>
        <tr>
          <td>被屏蔽的函数</td>
          <td><?php echo get_cfg_var("disable_functions")?'<a class="tip" href="javascript:;" title="'.get_cfg_var("disable_functions").'">查看</a>':"无" ; ?></td>
          <td>安全模式</td>
          <td><?php echo $this->okorno(ini_get('safe_mode')); ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php iACP::foot();?>
