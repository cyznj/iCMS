<?php /**
 * @package iCMS
 * @copyright 2007-2010, iDreamSoft
 * @license http://www.idreamsoft.com iDreamSoft
 * @author coolmoo <idreamsoft@qq.com>
 * @$Id: setting.php 2412 2014-05-04 09:52:07Z coolmoo $
 */
defined('iPHP') OR exit('What are you doing?');
iACP::head();
?>
<style>
.iCMS-setting h3{
  display: inline-block;
  height: 35px;
  margin-bottom: 5px;
  background-color: #DFDFDF;
  margin-top: 5px;
  padding-left: 10px;
  font-weight: bold;
  color: #696969;
  text-shadow: 0 1px 0 #FFF;
  border-radius: 4px 4px 0px 0px;width: 330px;
  font-size: 16px;
}
</style>
<script type="text/javascript">

$(function(){
	iCMS.select('cache_engine',"<?php echo $config['cache']['engine'] ; ?>");
	iCMS.select('watermark_pos',"<?php echo (int)$config['watermark']['pos'] ; ?>");
	iCMS.select('time_zone',"<?php echo $config['time']['zone'] ; ?>");
	iCMS.select('system_patch',"<?php echo (int)$config['system']['patch'] ; ?>");

  $(document).on("click",".del_device",function(){
      $(this).parent().parent().remove();
  });
  $(".add_template_device").click(function(){
    var TD  = $("#template_device"),count = $('.device',TD).length;
    var tdc = $(".template_device_clone").clone(true).removeClass("hide template_device_clone").addClass('device');
    $('input',tdc).removeAttr("disabled").each(function(){
      this.id   = this.id.replace("{key}",count);
      this.name = this.name.replace("{key}",count);
    });
    var fmhref  = $('.files_modal',tdc).attr("href").replace("{key}",count);
    $('.files_modal',tdc).attr("href",fmhref);
    tdc.appendTo(TD);
    return false;
  });

});
function modal_tplfile(el,a){

  if(!el) return;
  if(!a.checked) return;

  var e   = $('#'+el)||$('.'+el);
  var def = $("#template_desktop_tpl").val();
  var val = a.value.replace(def+'/', "{iTPL}/");
  e.val(val);
  return 'off';
}
</script>

<div class="iCMS-container">
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="fa fa-cog"></i> </span>
      <ul class="nav nav-tabs" id="setting-tab">
        <li class="active"><a href="#setting-base" data-toggle="tab">基本信息</a></li>
        <li><a href="#setting-tpl" data-toggle="tab">模板</a></li>
        <li><a href="#setting-url" data-toggle="tab">URL</a></li>
        <li><a href="#setting-tag" data-toggle="tab">标签</a></li>
        <li><a href="#setting-cache" data-toggle="tab">缓存</a></li>
        <li><a href="#setting-file" data-toggle="tab">附件</a></li>
        <!-- <li><a href="#setting-thumb" data-toggle="tab">缩略图</a></li> -->
        <li><a href="#setting-watermark" data-toggle="tab">水印</a></li>
        <li><a href="#setting-user" data-toggle="tab">用户</a></li>
        <li><a href="#setting-publish" data-toggle="tab">发布</a></li>
        <li><a href="#setting-comment" data-toggle="tab">评论</a></li>
        <li><a href="#setting-time" data-toggle="tab">时间</a></li>
        <li><a href="#setting-other" data-toggle="tab">其它</a></li>
        <li><a href="#setting-patch" data-toggle="tab">更新</a></li>
        <li><a href="#setting-grade" data-toggle="tab">高级</a></li>
        <li><a href="#setting-mail" data-toggle="tab">邮件</a></li>
      </ul>
    </div>
    <div class="widget-content nopadding iCMS-setting">
      <form action="<?php echo APP_FURI; ?>&do=save" method="post" class="form-inline" id="iCMS-setting" target="iPHP_FRAME">
        <div id="setting" class="tab-content">
          <div id="setting-base" class="tab-pane active">
            <div class="input-prepend"> <span class="add-on">网站名称</span>
              <input type="text" name="config[site][name]" class="span6" id="name" value="<?php echo $config['site']['name'] ; ?>"/>
            </div>
            <span class="help-inline">网站名称</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">网站标题</span>
              <input type="text" name="config[site][seotitle]" class="span6" id="seotitle" value="<?php echo $config['site']['seotitle'] ; ?>"/>
            </div>
            <span class="help-inline">网站标题通常是搜索引擎关注的重点，本设置将出现在标题中网站名称的后面，如果有多个关键字，建议用 "|"、","(不含引号) 等符号分隔</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"><span class="add-on">关 键 字</span>
              <textarea name="config[site][keywords]" id="keywords" class="span6" style="height: 90px;"><?php echo $config['site']['keywords'] ; ?></textarea>
            </div>
            <span class="help-inline">网站关键字 用","号隔开</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"><span class="add-on">网站描述</span>
              <textarea name="config[site][description]" id="description" class="span6" style="height: 90px;"><?php echo $config['site']['description'] ; ?></textarea>
            </div>
            <span class="help-inline">将被搜索引擎用来说明您网站的主要内容</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">备 案 号</span>
              <input type="text" name="config[site][icp]" class="span3" id="title" value="<?php echo $config['site']['icp'] ; ?>"/>
            </div>
            <span class="help-inline">页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的授权码，它将显示在页面底部，如果没有请留空</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">程序提示</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[debug][php]" id="debug_php" <?php echo $config['debug']['php']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">程序错误提示!如果网站显示空白或者不完整,可开启此项,方便排除错误</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">模板提示</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[debug][tpl]" id="debug_tpl" <?php echo $config['debug']['tpl']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">模板错误提示!如果网站显示空白或者不完整,可开启此项,方便排除错误!模板调整时也可开启,开启此项也要开"程序提示"</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">mysql调试</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[debug][sql]" id="debug_sql" <?php echo $config['debug']['sql']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后将显示 EXPLAIN 信息</span>
          </div>
            <div id="setting-tpl" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">首页静态跳转</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[template][index_mode]" id="index_mode" <?php echo $config['template']['index_mode']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">只对桌面端有效.首页生成静态后自动跳转.如果出现循环跳转请关闭此项</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">首页REWRITE</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[template][index_rewrite]" id="index_rewrite" <?php echo $config['template']['index_rewrite']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">如果栏目不是动态访问模式,且网站首页有分页 请开启此项</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">首页模板</span>
              <input type="text" name="config[template][index]" class="span3" id="template_index" value="<?php echo $config['template']['index'] ; ?>"/>
              <input type="hidden" name="config[template][index_name]" class="span3" id="index_name" value="<?php echo $config['template']['index_name'] ; ?>"/>
              <?php iACP::files_modal_btn('模板','file','template_index','tplfile');?></div>
            <span class="help-inline">首页默认模板，注：最好使用<span class="label label-inverse">{iTPL}</span>代替模板目录,程序将会自行切换PC端或者移动端</span>
            <div class="clearfloat mb10 solid"></div>
            <div class="input-prepend"> <span class="add-on">桌面端域名</span>
              <input type="text" name="config[router][URL]" class="span3" value="<?php echo $config['router']['URL'] ; ?>"/>
            </div>
            <span class="help-inline">例:<span class="label label-info">http://www.idreamsoft.com</span></span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">桌面端模板</span>
              <input type="text" name="config[template][desktop][tpl]" class="span3" id="template_desktop_tpl" value="<?php echo $config['template']['desktop']['tpl'] ; ?>"/>
              <?php iACP::files_modal_btn('模板','dir','template_desktop_tpl');?></div>
            <span class="help-inline">网站桌面端模板默认模板</span>
            <div class="clearfloat mb10 solid"></div>
            <div class="input-prepend"> <span class="add-on">移动端识别</span>
              <input type="text" name="config[template][mobile][agent]" class="span3" id="template_mobile_agent" value="<?php echo $config['template']['mobile']['agent'] ; ?>"/>
            </div>
            <span class="help-inline">请用<span class="label label-info">,</span>分隔 如不启用自动识别请留空</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">移动端域名</span>
              <input type="text" name="config[template][mobile][domain]" class="span3" id="template_mobile_domain" value="<?php echo $config['template']['mobile']['domain'] ; ?>"/>
            </div>
            <span class="help-inline">例:<span class="label label-info">http://m.idreamsoft.com</span></span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">移动端模板</span>
              <input type="text" name="config[template][mobile][tpl]" class="span3" id="template_mobile_tpl" value="<?php echo $config['template']['mobile']['tpl'] ; ?>"/>
              <?php iACP::files_modal_btn('模板','dir','template_mobile_tpl');?></div>
            <span class="help-inline">网站移动端模板默认模板,如果不想让程序自行切换请留空</span>
            <div class="clearfloat mb10"></div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th style="text-align:left"><span class="label label-important">模板优先级为:设备模板 &gt; 移动端模板 &gt; PC端模板</span> <span class="label label-inverse"><i class="icon-warning-sign icon-white"></i> 设备模板和移动端模板 暂时不支持生成静态模式</span></th>
                </tr>
              </thead>
              <tbody id="template_device">
                <?php foreach ((array)$config['template']['device'] as $key => $device) {?>
                <tr class="device">
                  <td>
                    <div class="input-prepend input-append"> <span class="add-on">设备名称</span>
                      <input type="text" name="config[template][device][<?php echo $key;?>][name]" class="span3" id="device_name_<?php echo $key;?>" value="<?php echo $device['name'];?>"/>
                      <a class="btn del_device"><i class="fa fa-trash-o"></i> 删除</a>
                    </div>
                    <span class="help-inline"></span>
                    <div class="clearfloat mb10"></div>
                    <div class="input-prepend"> <span class="add-on">设备识别符</span>
                      <input type="text" name="config[template][device][<?php echo $key;?>][ua]" class="span3" id="device_ua_<?php echo $key;?>" value="<?php echo $device['ua'];?>"/>
                    </div>
                    <span class="help-inline">设备唯一识别符,识别设备的User agent,如果多个请用<span class="label label-info">,</span>分隔.</span>
                    <div class="clearfloat mb10"></div>
                    <div class="input-prepend"> <span class="add-on">访问域名</span>
                      <input type="text" name="config[template][device][<?php echo $key;?>][domain]" class="span3" id="device_domain_<?php echo $key;?>" value="<?php echo $device['domain'];?>"/>
                    </div>
                    <span class="help-inline"></span>
                    <div class="clearfloat mb10"></div>
                    <div class="input-prepend input-append"> <span class="add-on">设备模板</span>
                      <input type="text" name="config[template][device][<?php echo $key;?>][tpl]" class="span3" id="device_tpl_<?php echo $key;?>" value="<?php echo $device['tpl'];?>"/>
                      <?php iACP::files_modal_btn('模板','dir','device_tpl_'.$key);?>
                    </div>
                    <span class="help-inline">识别到的设备会使用这个模板设置</span>
                  </td>
                </tr>
                <?php }?>
              </tbody>
              <tfoot>
              <tr class="hide template_device_clone">
                <td>
                  <div class="input-prepend input-append"> <span class="add-on">设备名称</span>
                    <input type="text" name="config[template][device][{key}][name]" class="span3" id="device_name_{key}" value="" disabled="disabled"/>
                    <a class="btn del_device"><i class="fa fa-trash-o"></i> 删除</a>
                  </div>
                  <span class="help-inline"><span class="label label-info">例:iPad</span></span>
                  <div class="clearfloat mb10"></div>
                  <div class="input-prepend"> <span class="add-on">设备识别符</span>
                    <input type="text" name="config[template][device][{key}][ua]" class="span3" id="device_ua_{key}" value="" disabled="disabled"/>
                  </div>
                  <span class="help-inline">设备唯一识别符,识别设备的User agent<span class="label label-info">例:iPad</span>,如果多个请用<span class="label label-info">,</span>分隔.</span>
                  <div class="clearfloat mb10"></div>
                  <div class="input-prepend"> <span class="add-on">访问域名</span>
                    <input type="text" name="config[template][device][{key}][domain]" class="span3" id="device_domain_{key}" value="" disabled="disabled"/>
                  </div>
                  <span class="help-inline"><span class="label label-info">例:http://ipad.idreamsoft.com</span></span>
                  <div class="clearfloat mb10"></div>
                  <div class="input-prepend input-append"> <span class="add-on">设备模板</span>
                    <input type="text" name="config[template][device][{key}][tpl]" class="span3" id="device_tpl_{key}" value="" disabled="disabled"/>
                    <?php iACP::files_modal_btn('模板','dir','device_tpl_{key}');?>
                  </div>
                  <span class="help-inline">识别到的设备会使用这个模板设置</span>
                </td>
              </tr>
              <tr>
                <td colspan="2"><a href="#template_device" class="btn add_template_device btn-success"/><i class="fa fa-tablet"></i> 增加设备模板</a></td>
              </tr>
              </tfoot>
            </table>
          </div>
          <div id="setting-url" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">CMS安装目录</span>
              <input type="text" name="config[router][DIR]" class="span4" id="router_dir" value="<?php echo $config['router']['DIR'] ; ?>"/>
            </div>
            <span class="help-inline">CMS安装目录，如：http：//www.idreamsoft.com/iCMS/ 则安装目录为:iCMS/ 根目录请输入<span class="label label-info">/</span></span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">404页面</span>
              <input type="text" name="config[router][404]" class="span4" id="router_404" value="<?php echo $config['router']['404'] ; ?>"/>
            </div>
            <span class="help-inline">404时跳转到的页面</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">公共资源URL</span>
              <input type="text" name="config[router][public_url]" class="span4" id="router_public_url" value="<?php echo $config['router']['public_url'] ; ?>"/>
            </div>
            <span class="help-inline">公共资源访问URL 如果访问出错请修改public/config.php文件</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">用户URL</span>
              <input type="text" name="config[router][user_url]" class="span4" id="router_user_url" value="<?php echo $config['router']['user_url'] ; ?>"/>
            </div>
            <span class="help-inline">用户URL</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">静态目录</span>
              <input type="text" name="config[router][html_dir]" class="span4" id="router_html_dir" value="<?php echo $config['router']['html_dir'] ; ?>"/>
            </div>
            <span class="help-inline">存放静态页面目录，相对于admin目录。可用../表示上级目录</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">文件后缀</span>
              <input type="text" name="config[router][html_ext]" class="span4" id="router_html_ext" value="<?php echo $config['router']['html_ext'] ; ?>"/>
            </div>
            <span class="help-inline">推荐使用.html</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">生成速度</span>
              <input type="text" name="config[router][speed]" class="span4" id="router_speed" value="<?php echo $config['router']['speed'] ; ?>"/>
            </div>
            <span class="help-inline">一次性生成多少静态页，可根据服务器IO性能调整</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">REWRITE</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[router][rewrite]" id="router_rewrite" <?php echo $config['router']['rewrite']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">此选项只对 conf 目录下 router.config.php 里的配置有效</span>
          </div>
          <div id="setting-tag" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">标签URL</span>
              <input type="text" name="config[router][tag_url]" class="span4" id="router_tag_url" value="<?php echo $config['router']['tag_url'] ; ?>"/>
            </div>
            <span class="help-inline">标签目录访问URL 可绑定域名</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">标签URL规则</span>
              <input type="text" name="config[router][tag_rule]" class="span4" id="router_tag_rule" value="<?php echo $config['router']['tag_rule'] ; ?>"/>
              <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-question-circle"></i> 帮助</a>
                <ul class="dropdown-menu">
                  <li><a href="{ID}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-important">{ID}</span> 标签ID</a></li>
                  <li><a href="{TKEY}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-important">{TKEY}</span> 标签标识</a></li>
                  <li><a href="{ZH_CN}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-important">{ZH_CN}</span> 标签名(中文)</a></li>
                  <li><a href="{NAME}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-important">{NAME}</span> 标签名</a></li>
                  <li class="divider"></li>
                  <li><a href="{TCID}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{TCID}</span> 分类ID</a></li>
                  <li><a href="{TCDIR}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{TCDIR}</span> 分类目录</a></li>
                  <li><a href="{CDIR}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{CDIR}</span> 栏目目录</a></li>
                  <li class="divider"></li>
                  <li><a href="{P}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{P}</span> 分页数</a></li>
                  <li><a href="{EXT}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{EXT}</span> 后缀</a></li>
                  <li class="divider"></li>
                  <li><a href="{PHP}" data-toggle="insertContent" data-target="#router_tag_rule"><span class="label label-inverse">{PHP}</span> 动态程序</a></li>
                </ul>
              </div>
            </div>
            <span class="help-inline">伪静态模式时规则一定要包含<span class="label label-important">{ID}</span>或<span class="label label-important">{NAME}</span>或<span class="label label-important">{ZH_CN}</span></span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">标签目录</span>
              <input type="text" name="config[router][tag_dir]" class="span4" id="router_tag_dir" value="<?php echo $config['router']['tag_dir'] ; ?>"/>
            </div>
            <span class="help-inline">存放标签静态页面目录，相对于app目录。可用../表示上级目录</span> </div>
          <div id="setting-cache" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">启用缓存</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[cache][enable]" id="cache_enable" <?php echo $config['cache']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">启用缓存可减轻数据库压力</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">缓存引擎</span>
              <select name="config[cache][engine]" id="cache_engine" class="chosen-select">
                <option value="file">文件缓存 FileCache</option>
                <option value="memcached">分布式缓存 memcached</option>
                <option value="redis">分布式缓存 Redis</option>
              </select>
            </div>
            <span class="help-inline">Memcache,Redis 需要服务器支持,如果不清楚请询问管理员,iCMS推荐使用Redis</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">缓存配置</span>
              <textarea name="config[cache][host]" id="cache_host" class="span6" style="height: 150px;"><?php echo $config['cache']['host'] ; ?></textarea>
            </div>
            <span class="help-inline">
            文件缓存目录:文件层级(data:1) 默认为空<hr />
            memcached服务器IP:每行一个,带端口. <br />
            例:127.0.0.1:11211<br />
            127.0.0.2:11211<hr />
            Redis UNIX SOCK<br />
            unix:///tmp/redis.sock@db:1 <br />
            127.0.0.1:6379@db:1</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">缓存时间</span>
              <input type="text" name="config[cache][time]" class="span1" id="cache_time" value="<?php echo $config['cache']['time'] ; ?>"/>
              <span class="add-on" style="width:24px;">秒</span>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">数据压缩</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[cache][compress]" id="cache_compress" <?php echo $config['cache']['compress']?'checked':''; ?>/>
              </div>
            </div>
          </div>
          <div id="setting-file" class="tab-pane hide">
            <!--
            <div class="input-prepend"> <span class="add-on">附件接口</span>
              <input type="text" name="config[FS][API]" class="span4" id="FS_API" value="<?php echo $config['FS']['API'] ; ?>"/>
            </div>
            <span class="help-inline">附件接口URL</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">Token</span>
              <input type="text" name="config[FS][token]" class="span4" id="FS_token" value="<?php echo $config['FS']['token'] ; ?>"/>
              <a class="btn" onclick="$('#FS_token').val(iCMS.random(32));"><i class="fa fa-random"></i> 生成随机码</a>
            </div>
            <span class="help-inline">该Token会和接口URL中包含的Token进行比对，从而验证安全性</span>
            <div class="clearfloat mb10"></div>
            -->
            <div class="input-prepend"> <span class="add-on">附件URL</span>
              <input type="text" name="config[FS][url]" class="span4" id="FS_url" value="<?php echo $config['FS']['url'] ; ?>"/>
            </div>
            <span class="help-inline">如果访问不到,请自行调整</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">文件保存目录</span>
              <input type="text" name="config[FS][dir]" class="span4" id="FS_dir" value="<?php echo $config['FS']['dir'] ; ?>"/>
            </div>
            <span class="help-inline">相对于程序根目录</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">目录结构</span>
              <input type="text" name="config[FS][dir_format]" class="span4" id="FS_dir_format" value="<?php echo $config['FS']['dir_format'] ; ?>"/>
              <div class="btn-group" to="#FS_dir_format"> <a class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-question-circle"></i> 帮助</a>
                <ul class="dropdown-menu">
                  <li><a href="#Y"><span class="label label-inverse">Y</span> 4位数年份</a></li>
                  <li><a href="#y"><span class="label label-inverse">y</span> 2位数年份</a></li>
                  <li><a href="#m"><span class="label label-inverse">m</span> 月份01-12</a></li>
                  <li><a href="#n"><span class="label label-inverse">n</span> 月份1-12</a></li>
                  <li><a href="#d"><span class="label label-inverse">n</span> 日期01-31</a></li>
                  <li><a href="#j"><span class="label label-inverse">j</span> 日期1-31</a></li>
                  <li class="divider"></li>
                  <li><a href="#EXT"><span class="label label-inverse">EXT</span> 文件类型</a></li>
                </ul>
              </div>
            </div>
            <span class="help-inline">为空全部存入同一目录</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">允许上传类型</span>
              <input type="text" name="config[FS][allow_ext]" class="span4" id="FS_allow_ext" value="<?php echo $config['FS']['allow_ext'] ; ?>"/>
            </div>
            <hr />
            <div class="input-prepend"> <span class="add-on">使用云存储</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[FS][yun][enable]" id="yun_enable" <?php echo $config['FS']['yun']['enable']?'checked':''; ?>/>
              </div>
              <span class="help-inline">使用云存储后,相关管理请到云存储管理</span>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">不保留本地</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[FS][yun][local]" id="yun_local" <?php echo $config['FS']['yun']['local']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">默认保留本地资源,权当备份用</span>
            <div class="clearfloat mb10"></div>
            <h3>七牛云存储</h3>
            <span class="help-inline">申请地址:https://portal.qiniu.com/signup</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on">Bucket</span>
              <input type="text" name="config[FS][yun][QiNiu][Bucket]" class="span4" id="yun_QiNiu_Bucket" value="<?php echo $config['FS']['yun']['QiNiu']['Bucket'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">AccessKey</span>
              <input type="text" name="config[FS][yun][QiNiu][AccessKey]" class="span4" id="yun_QiNiu_AccessKey" value="<?php echo $config['FS']['yun']['QiNiu']['AccessKey'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">SecretKey</span>
              <input type="text" name="config[FS][yun][QiNiu][SecretKey]" class="span4" id="yun_QiNiu_SecretKey" value="<?php echo $config['FS']['yun']['QiNiu']['SecretKey'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
          </div>
          <!--
          <div id="setting-thumb" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">缩略图</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[thumb][enable]" id="thumb_enable" <?php echo $config['thumb']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">缩略图尺寸</span><span class="add-on" style="width:24px;">宽度</span>
              <input type="text" name="config[thumb][width]" class="span1" id="thumb_width" value="<?php echo $config['thumb']['width'] ; ?>"/>
              <span class="add-on" style="width:24px;">高度</span>
              <input type="text" name="config[thumb][height]" class="span1" id="thumb_height" value="<?php echo $config['thumb']['height'] ; ?>"/>
            </div>
            <span class="help-inline">px</span>
          </div>
          -->
          <div id="setting-watermark" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">水印</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[watermark][enable]" id="watermark_enable" <?php echo $config['watermark']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">将在上传的图片附件中加上您在下面设置的图片或文字水印</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">图片尺寸</span><span class="add-on" style="width:24px;">宽度</span>
              <input type="text" name="config[watermark][width]" class="span1" id="watermark_width" value="<?php echo $config['watermark']['width'] ; ?>"/>
              <span class="add-on" style="width:24px;">高度</span>
              <input type="text" name="config[watermark][height]" class="span1" id="watermark_height" value="<?php echo $config['watermark']['height'] ; ?>"/>
            </div>
            <span class="help-inline">单位:像素(px) 只对超过程序设置的大小的附件图片才加上水印图片或文字(设置为0不限制)</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印位置</span>
              <select name="config[watermark][pos]" id="watermark_pos" class="span3 chosen-select">
                <option value="0">随机位置</option>
                <option value="1">顶部居左</option>
                <option value="2">顶部居中</option>
                <option value="3">顶部居右</option>
                <option value="4">中部居左</option>
                <option value="5">中部居中</option>
                <option value="6">中部居右</option>
                <option value="7">底部居左</option>
                <option value="8">底部居中</option>
                <option value="9">底部居右</option>
                <option value="-1">自定义</option>
              </select>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">水印位置偏移</span><span class="add-on" style="width:24px;">X</span>
              <input type="text" name="config[watermark][x]" class="span1" id="watermark_x" value="<?php echo $config['watermark']['x'] ; ?>"/>
              <span class="add-on" style="width:24px;">Y</span>
              <input type="text" name="config[watermark][y]" class="span1" id="watermark_y" value="<?php echo $config['watermark']['y'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印图片文件</span>
              <input type="text" name="config[watermark][img]" class="span3" id="watermark_img" value="<?php echo $config['watermark']['img'] ; ?>"/>
            </div>
            <span class="help-inline">水印图片存放路径：conf/iCMS/watermark.png， 如果水印图片不存在，则使用文字水印</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印文字</span>
              <input type="text" name="config[watermark][text]" class="span3" id="watermark_text" value="<?php echo $config['watermark']['text'] ; ?>"/>
            </div>
            <span class="help-inline">如果设置为中文,字体文件必需要支持中文字体 ,存放路径：conf/iCMS/</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">文字字体</span>
              <input type="text" name="config[watermark][font]" class="span3" id="watermark_font" value="<?php echo $config['watermark']['font'] ; ?>"/>
            </div>
            <span class="help-inline">字体文件</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印文字字体大小</span>
              <input type="text" name="config[watermark][fontsize]" class="span3" id="watermark_fontsize" value="<?php echo $config['watermark']['fontsize'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印文字颜色</span>
              <input type="text" name="config[watermark][color]" class="span3" id="watermark_color" value="<?php echo $config['watermark']['color'] ; ?>"/>
            </div>
            <span class="help-inline">例#000000 长度必须7位</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">水印透明度</span>
              <input type="text" name="config[watermark][transparent]" class="span3" id="watermark_transparent" value="<?php echo $config['watermark']['transparent'] ; ?>"/>
            </div>
            <!--
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">缩略图水印</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[watermark][thumb]" id="watermark_thumb" <?php echo $config['watermark']['thumb']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启时缩略图也会打上水印</span>
            -->
          </div>
          <div id="setting-user" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">用户注册</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[user][register][enable]" id="user_register_enable" <?php echo @$config['user']['register']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">注册验证码</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[user][register][seccode]" id="user_register_seccode" <?php echo @$config['user']['register']['seccode']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">注册间隔</span>
              <input type="text" name="config[user][register][interval]" class="span1" id="user_register_interval" value="<?php echo @(int)$config['user']['register']['interval'] ; ?>"/>
              <span class="add-on" style="width:24px;">秒</span>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">用户登陆</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[user][login][enable]" id="user_login_enable" <?php echo @$config['user']['login']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">登陆验证码</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[user][login][seccode]" id="user_login_seccode" <?php echo @$config['user']['login']['seccode']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">登陆间隔</span>
              <input type="text" name="config[user][login][interval]" class="span1" id="user_login_interval" value="<?php echo @(int)$config['user']['login']['interval'] ; ?>"/>
              <span class="add-on" style="width:24px;">秒</span>
            </div>
            <span class="help-inline">登陆错误5次后,重试间隔</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">发贴验证码</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[user][post][seccode]" id="user_post_seccode" <?php echo $config['user']['post']['seccode']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">发贴间隔</span>
              <input type="text" name="config[user][post][interval]" class="span1" id="user_post_interval" value="<?php echo (int)$config['user']['post']['interval'] ; ?>"/>
              <span class="add-on" style="width:24px;">秒</span>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">注册条款</span>
              <textarea name="config[user][agreement]" id="user_agreement" class="span6" style="height: 150px;"><?php echo $config['user']['agreement'] ; ?></textarea>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">默认封面</span>
              <input type="text" name="config[user][coverpic]" class="span4" id="user_coverpic" value="<?php echo $config['user']['coverpic'] ; ?>"/>
            </div>
            <span class="help-inline">请将图片放在public目录下</span>
            <div class="clearfloat mb10"></div>
            <hr />
            <h3>微信开放平台</h3>
            <span class="help-inline">申请地址:https://open.weixin.qq.com/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on" style="width:60px;">APPID:</span>
              <input type="text" name="config[open][WX][appid]" class="span3" id="wx_appid" value="<?php echo $config['open']['WX']['appid'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on"style="width:60px;">APPKEY:</span>
              <input type="text" name="config[open][WX][appkey]" class="span3" id="wx_appkey" value="<?php echo $config['open']['WX']['appkey'] ; ?>"/>
            </div>
            <hr />
            <h3>QQ开放平台</h3>
            <span class="help-inline">申请地址:http://connect.qq.com/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on" style="width:60px;">APPID:</span>
              <input type="text" name="config[open][QQ][appid]" class="span3" id="qq_appid" value="<?php echo $config['open']['QQ']['appid'] ; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on"style="width:60px;">APPKEY:</span>
              <input type="text" name="config[open][QQ][appkey]" class="span3" id="qq_appkey" value="<?php echo $config['open']['QQ']['appkey'] ; ?>"/>
            </div>
            <hr />
            <h3>微博开放平台</h3>
            <span class="help-inline">申请地址:http://open.weibo.com/authentication/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on" style="width:60px;">APPID:</span>
              <input type="text" name="config[open][WB][appid]" class="span3" id="WB_appid" value="<?php echo $config['open']['WB']['appid']; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on"style="width:60px;">APPKEY:</span>
              <input type="text" name="config[open][WB][appkey]" class="span3" id="WB_appkey" value="<?php echo $config['open']['WB']['appkey'] ; ?>"/>
            </div>
            <hr />
            <h3>淘宝开放平台</h3>
            <span class="help-inline">申请地址:http://open.taobao.com/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on" style="width:60px;">APPID:</span>
              <input type="text" name="config[open][TB][appid]" class="span3" id="TB_appid" value="<?php echo $config['open']['TB']['appid']; ?>"/>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on"style="width:60px;">APPKEY:</span>
              <input type="text" name="config[open][TB][appkey]" class="span3" id="TB_appkey" value="<?php echo $config['open']['TB']['appkey'] ; ?>"/>
            </div>
          </div>
          <div id="setting-publish" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">自动排版</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][autoformat]" id="publish_autoformat" <?php echo $config['publish']['autoformat']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发布文章时,程序会自动对内容进行清理无用代码.采集时推荐开启.如果内容格式丢失 请关闭此项</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">编辑器图片</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][catch_remote]" id="publish_catch_remote" <?php echo $config['publish']['catch_remote']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表文章时只要有图片 就会自动下载</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">下载远程图片</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][remote]" id="publish_remote" <?php echo $config['publish']['remote']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表文章时该选项默认为选中状态</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">提取缩略图</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][autopic]" id="publish_autopic" <?php echo $config['publish']['autopic']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表文章时该选项默认为选中状态</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">提取摘要</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][autodesc]" id="publish_autodesc" <?php echo $config['publish']['autodesc']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表文章时程序会自动提取文章部分内容为文章摘要</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">提取摘要字数</span>
              <input type="text" name="config[publish][descLen]" class="span3" id="publish_descLen" value="<?php echo $config['publish']['descLen'] ; ?>"/>
            </div>
            <span class="help-inline">设置自动提取内容摘要字数</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">内容自动分页</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][autoPage]" id="publish_autoPage" <?php echo $config['publish']['autoPage']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表文章时程序会分页</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">内容分页字数</span>
              <input type="text" name="config[publish][AutoPageLen]" class="span3" id="publish_AutoPageLen" value="<?php echo $config['publish']['AutoPageLen'] ; ?>"/>
            </div>
            <span class="help-inline">设置自动内容分页字数</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">检查标题重复</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][repeatitle]" id="publish_repeatitle" <?php echo $config['publish']['repeatitle']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后不能发表相同标题的文章</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">列表显示图片</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[publish][showpic]" id="publish_showpic" <?php echo $config['publish']['showpic']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后文章列表将会显示缩略图</span> </div>
          <div id="setting-comment" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">评论</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[comment][enable]" id="comment_enable" <?php echo $config['comment']['enable']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">审核评论</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[comment][examine]" id="comment_examine" <?php echo $config['comment']['examine']?'checked':''; ?>/>
              </div>
            </div>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">验证码</span>
              <div class="switch">
                <input type="checkbox" data-type="switch" name="config[comment][seccode]" id="comment_seccode" <?php echo $config['comment']['seccode']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">开启后发表评论需要验证码</span> </div>
          <div id="setting-time" class="tab-pane hide">
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">服务器时区</span>
              <select name="config[time][zone]" id="time_zone" class="span4 chosen-select">
                <option value="Pacific/Kwajalein">(标准时-12：00) 日界线西 </option>
                <option value="Pacific/Samoa">(标准时-11：00) 中途岛、萨摩亚群岛 </option>
                <option value="Pacific/Honolulu">(标准时-10：00) 夏威夷 </option>
                <option value="America/Juneau">(标准时-9：00) 阿拉斯加 </option>
                <option value="America/Los_Angeles">(标准时-8：00) 太平洋时间(美国和加拿大) </option>
                <option value="America/Denver">(标准时-7：00) 山地时间(美国和加拿大) </option>
                <option value="America/Mexico_City">(标准时-6：00) 中部时间(美国和加拿大)、墨西哥城 </option>
                <option value="America/New_York">(标准时-5：00) 东部时间(美国和加拿大)、波哥大 </option>
                <option value="America/Caracas">(标准时-4：00) 大西洋时间(加拿大)、加拉加斯 </option>
                <option value="America/St_Johns">(标准时-3：30) 纽芬兰 </option>
                <option value="America/Argentina/Buenos_Aires">(标准时-3：00) 巴西、布宜诺斯艾利斯、乔治敦 </option>
                <option value="Atlantic/Azores">(标准时-2：00) 中大西洋 </option>
                <option value="Atlantic/Azores">(标准时-1：00) 亚速尔群岛、佛得角群岛 </option>
                <option value="Europe/London">(格林尼治标准时) 西欧时间、伦敦、卡萨布兰卡 </option>
                <option value="Europe/Paris">(标准时+1：00) 中欧时间、安哥拉、利比亚 </option>
                <option value="Europe/Helsinki">(标准时+2：00) 东欧时间、开罗，雅典 </option>
                <option value="Europe/Moscow">(标准时+3：00) 巴格达、科威特、莫斯科 </option>
                <option value="Asia/Tehran">(标准时+3：30) 德黑兰 </option>
                <option value="Asia/Baku">(标准时+4：00) 阿布扎比、马斯喀特、巴库 </option>
                <option value="Asia/Kabul">(标准时+4：30) 喀布尔 </option>
                <option value="Asia/Karachi">(标准时+5：00) 叶卡捷琳堡、伊斯兰堡、卡拉奇 </option>
                <option value="Asia/Calcutta">(标准时+5：30) 孟买、加尔各答、新德里 </option>
                <option value="Asia/Colombo">(标准时+6：00) 阿拉木图、 达卡、新亚伯利亚 </option>
                <option value="Asia/Bangkok">(标准时+7：00) 曼谷、河内、雅加达 </option>
                <option value="Asia/Shanghai">(北京时间) 北京、重庆、香港、新加坡 </option>
                <option value="Asia/Tokyo">(标准时+9：00) 东京、汉城、大阪、雅库茨克 </option>
                <option value="Australia/Darwin">(标准时+9：30) 阿德莱德、达尔文 </option>
                <option value="Pacific/Guam">(标准时+10：00) 悉尼、关岛 </option>
                <option value="Asia/Magadan">(标准时+11：00) 马加丹、索罗门群岛 </option>
                <option value="Asia/Kamchatka">(标准时+12：00) 奥克兰、惠灵顿、堪察加半岛 </option>
              </select>
            </div>
            <span class="help-inline">服务器所在时区</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">服务器时间校正</span>
              <input type="text" name="config[time][cvtime]" class="span3" id="time_cvtime" value="<?php echo $config['time']['cvtime'] ; ?>"/>
            </div>
            <span class="help-inline">单位:分钟</span>
            <div class="clearfloat"></div>
            <span class="help-inline">此功能用于校正服务器操作系统时间设置错误的问题
            当确认程序默认时区设置正确后，程序显示时间仍有错误，请使用此功能校正</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend input-append"> <span class="add-on">默认时间格式</span>
              <input type="text" name="config[time][dateformat]" class="span3" id="time_dateformat" value="<?php echo $config['time']['dateformat'] ; ?>"/>
              <div class="btn-group" to="#FS_dir_format"> <a class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-question-circle"></i> 帮助</a>
                <ul class="dropdown-menu">
                  <li><a href="#Y"><span class="label label-inverse">Y</span> 4位数年份</a></li>
                  <li><a href="#y"><span class="label label-inverse">y</span> 2位数年份</a></li>
                  <li><a href="#m"><span class="label label-inverse">m</span> 月份01-12</a></li>
                  <li><a href="#n"><span class="label label-inverse">n</span> 月份1-12</a></li>
                  <li><a href="#d"><span class="label label-inverse">n</span> 日期01-31</a></li>
                  <li><a href="#j"><span class="label label-inverse">j</span> 日期1-31</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="setting-other" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">拼音分割符</span>
              <input type="text" name="config[other][py_split]" class="span3" id="py_split" value="<?php echo $config['other']['py_split'] ; ?>"/>
            </div>
            <span class="help-inline">留空，按紧凑型生成(pinyin)</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">关键字替换</span>
              <input type="text" name="config[other][keyword_limit]" class="span3" id="keyword_limit" value="<?php echo $config['other']['keyword_limit'] ; ?>"/>
            </div>
            <span class="help-inline">内链关键字替换次数 0为不替换，-1全部替换</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">侧边栏</span>
              <div class="switch" data-on-label="启用" data-off-label="关闭">
                <input type="checkbox" data-type="switch" name="config[other][sidebar_enable]" id="other_sidebar_enable" <?php echo $config['other']['sidebar_enable']?'checked':''; ?>/>
              </div>
            </div>
            <div class="switch" data-on-label="打开" data-off-label="最小化">
              <input type="checkbox" data-type="switch" name="config[other][sidebar]" id="other_sidebar" <?php echo $config['other']['sidebar']?'checked':''; ?>/>
            </div>
            <span class="help-inline">后台侧边栏默认开启,启用后可选择打开或者最小化</span>
            <hr />
            <h3>文章显示相关设置</h3>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on">文章图片链接</span>
              <div class="switch" data-on-label="启用" data-off-label="关闭">
                <input type="checkbox" data-type="switch" name="config[article][pic_next]" id="article_pic_next" <?php echo $config['article']['pic_next']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">启用后文章内的图片都会带上下一页的链接和点击图片进入下一页的链接</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">文章分页+N</span>
              <input type="text" name="config[article][pageno_incr]" class="span3" id="article_pageno_incr" value="<?php echo $config['article']['pageno_incr'] ; ?>"/>
            </div>
            <span class="help-inline">设置此项后,内容分页数比实际页数+N页,不增加请设置为0</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">文章上下文</span>
              <div class="switch" data-on-label="启用" data-off-label="关闭">
                <input type="checkbox" data-type="switch" name="config[article][prev_next]" id="article_prev_next" <?php echo $config['article']['prev_next']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">启用文章上下文(内容页的上一篇/下一篇) 这个比较耗性能 如果访问量较大 建议关闭</span>
            <hr />
            <h3>微信公众平台</h3>
            <span class="help-inline">申请地址:https://mp.weixin.qq.com/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on">Token(令牌)</span>
              <input type="text" name="config[api][weixin][token]" class="span3" id="weixin_token" value="<?php echo $config['api']['weixin']['token'] ; ?>"/>
            </div>
            <span class="help-inline">公共平台接口URL:<?php echo $config['router']['public_url'] ; ?>/api.php?app=public&do=weixin&api_token=Token(令牌)</span>
            <hr />
            <h3>百度站长平台 Sitemap 实时推送</h3>
            <span class="help-inline">申请地址:http://zhanzhang.baidu.com/ (需要权限)</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on">站点</span>
              <input type="text" name="config[api][baidu][sitemap][site]" class="span3" id="baidu_sitemap_site" value="<?php echo $config['api']['baidu']['sitemap']['site'] ; ?>"/>
            </div>
            <span class="help-inline">在站长平台验证的站点，比如www.example.com</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">数据名称</span>
              <input type="text" name="config[api][baidu][sitemap][resource_name]" class="span3" id="baidu_sitemap_resource_name" value="<?php echo $config['api']['baidu']['sitemap']['resource_name']?$config['api']['baidu']['sitemap']['resource_name']:'sitemap'; ?>"/>
            </div>
            <span class="help-inline">你被允许推送的数据名称，比如sitemap</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">准入密钥</span>
              <input type="text" name="config[api][baidu][sitemap][access_token]" class="span3" id="baidu_sitemap_access_token" value="<?php echo $config['api']['baidu']['sitemap']['access_token'] ; ?>"/>
            </div>
            <span class="help-inline">在站长平台申请的推送用的准入密钥</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">同步推送</span>
              <div class="switch" data-on-label="启用" data-off-label="关闭">
                <input type="checkbox" data-type="switch" name="config[api][baidu][sitemap][sync]" id="baidu_sitemap_sync" <?php echo $config['api']['baidu']['sitemap']['sync']?'checked':''; ?>/>
              </div>
            </div>
            <span class="help-inline">启用文章发布时同步推送 如果发布文章无法正常返回 建议关闭</span>


            <!--
            <hr />
            <h3>淘宝联盟</h3>
            <span class="help-inline">申请地址:https://www.alimama.com/</span>
            <div class="clearfloat"></div>
            <div class="input-prepend"> <span class="add-on">广告位PID</span>
              <input type="text" name="config[api][taoke][pid]" class="span3" id="taoke_pid" value="<?php echo $config['api']['taoke']['pid'] ; ?>"/>
            </div>
            <span class="help-inline">广告位PID/推广单元PID,例:mm_xxxxxxxx_xxxxxxx_xxxxxxxx</span>
            -->
          </div>
          <div id="setting-patch" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">系统更新</span>
              <select name="config[system][patch]" id="system_patch" class="span3 chosen-select">
                <option value="1">自动下载,安装时询问(推荐)</option>
                <option value="2">不自动下载更新,有更新时提示</option>
                <option value="0">关闭自动更新</option>
              </select>
            </div>
          </div>
          <div id="setting-grade" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">sphinx服务器</span>
              <input type="text" name="config[sphinx][host]" class="span3" id="sphinx_host" value="<?php echo $config['sphinx']['host'] ; ?>"/>
            </div>
            <span class="help-inline">UNIX SOCK:unix:///tmp/sphinx.sock<br />
            HOST:127.0.0.1:9312</span>
            <div class="clearfloat mb10"></div>
            <div class="input-prepend"> <span class="add-on">sphinx 索引</span>
              <input type="text" name="config[sphinx][index]" class="span3" id="sphinx_index" value="<?php echo $config['sphinx']['index'] ; ?>"/>
            </div>
            <span class="help-inline"></span>
            <div class="clearfloat mb10"></div>
            <h3>sphinx 配置示例</h3>
            <pre>
source iCMS_article
{
	type		= mysql
	sql_host	= localhost
	sql_user	= root
	sql_pass	= 123456
	sql_db		= iCMS
	sql_port	= 3306	# optional, default is 3306
	sql_query_pre	=  SET NAMES utf8
	sql_query_pre 	= REPLACE INTO icms_sph_counter SELECT 1, MAX(id) FROM icms_article

  sql_query = SELECT a.id, a.cid,a.userid, a.comments, a.pubdate,a.hits_today, a.hits_yday, a.hits_week, a.hits_month,a.hits, a.haspic, a.title, a.keywords, a.tags, a.status FROM icms_article a,icms_category c WHERE a.cid=c.cid AND a.status ='1' AND a.id<=( SELECT max_doc_id FROM icms_sph_counter WHERE counter_id=1 )
  sql_attr_uint   = cid
  sql_attr_uint   = userid
  sql_attr_uint   = comments
  sql_attr_uint   = hits
  sql_attr_uint   = hits_week
  sql_attr_uint   = hits_month
  sql_attr_uint   = status
  sql_attr_timestamp  = pubdate
  sql_attr_bool   = haspic

  sql_ranged_throttle = 0
  sql_query_info    = SELECT * FROM icms_article WHERE id=$id

}
source iCMS_article_delta : iCMS_article
{
	sql_query_pre	=  SET NAMES utf8
  sql_query = SELECT a.id, a.cid,a.userid, a.comments, a.pubdate,a.hits_today, a.hits_yday, a.hits_week, a.hits_month,a.hits, a.haspic, a.title, a.keywords, a.tags, a.status FROM icms_article a,icms_category c WHERE a.cid=c.cid AND a.status ='1' AND a.id>( SELECT max_doc_id FROM icms_sph_counter WHERE counter_id=1 )
}
index iCMS_article
{
	source			= iCMS_article
	path			= /var/sphinx/iCMS_article
        docinfo                 = extern
        mlock                   = 0
        morphology              = none
        min_word_len            = 1
        charset_type            = utf-8
        min_prefix_len          = 0
        html_strip              = 1
        charset_table           = 0..9, A..Z->a..z, _, a..z, U+410..U+42F->U+430..U+44F, U+430..U+44F
        ngram_len               = 1
        ngram_chars             = U+3000..U+2FA1F
}
index iCMS_article_delta : iCMS_article
{
	source	= iCMS_article_delta
	path	= /var/sphinx/iCMS_article_delta
}
##sphinx使用问题,请自行Google上百度一下
          </pre>
          </div>
          <div id="setting-mail" class="tab-pane hide">
            <div class="input-prepend"> <span class="add-on">SMTP 主机</span>
              <input type="text" name="config[mail][host]" class="span3" id="mail_host" value="<?php echo $config['mail']['host']; ?>"/>
            </div>
            <span class="help-inline">发送邮件的服务器.例如:smtp.qq.com</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">安全协议</span>
              <input type="text" name="config[mail][secure]" class="span3" id="mail_secure" value="<?php echo $config['mail']['secure']; ?>"/>
            </div>
            <span class="help-inline">发送邮件的服务器使用的安全协议.默认为空.可选项"ssl" 或者 "tls"</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">SMTP 端口</span>
              <input type="text" name="config[mail][port]" class="span3" id="mail_port" value="<?php echo $config['mail']['port']?$config['mail']['port']:'25'; ?>"/>
            </div>
            <span class="help-inline">发送邮件的服务器的端口,默认:25</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">SMTP 账号</span>
              <input type="text" name="config[mail][username]" class="span3" id="mail_username" value="<?php echo $config['mail']['username']; ?>"/>
            </div>
            <span class="help-inline">登陆邮件的服务器的账号</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">账号密码</span>
              <input type="text" name="config[mail][password]" class="span3" id="mail_password" value="<?php echo $config['mail']['password']; ?>"/>
            </div>
            <span class="help-inline">登陆邮件的服务器的账号密码</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">发送账号</span>
              <input type="text" name="config[mail][setfrom]" class="span3" id="mail_setfrom" value="<?php echo $config['mail']['setfrom']; ?>"/>
            </div>
            <span class="help-inline">用于发送邮件的账号</span>
            <div class="clearfloat mt10"></div>
            <div class="input-prepend"> <span class="add-on">联系Email</span>
              <input type="text" name="config[mail][replyto]" class="span3" id="mail_replyto" value="<?php echo $config['mail']['replyto']; ?>"/>
            </div>
            <span class="help-inline">用于邮件中回复Email的账号</span>
            <div class="clearfloat mt10"></div>

          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> 提交</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php iACP::foot();?>
