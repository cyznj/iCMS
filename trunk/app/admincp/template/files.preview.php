<?php
/**
 * @package iCMS
 * @copyright 2007-2010, iDreamSoft
 * @license http://www.idreamsoft.com iDreamSoft
 * @author coolmoo <idreamsoft@qq.com>
 * @$Id: files.manage.php 179 2013-03-29 03:21:28Z coolmoo $
 */
defined('iCMS') OR exit('What are you doing?');
iACP::head(false);
?>
<div class="iCMS-container">
  <div class="pic">
    <img src="<?php echo $src;?>?<?php echo time();?>" alt="预览">
  </div>
</div>
<script type="text/javascript">
(function(){
  function iimgFix(im, x, y) {
      x = x || 99999
      y = y || 99999
      im.removeAttribute("width");
      im.removeAttribute("height");
      if (im.width / im.height > x / y && im.width > x) {
          im.height = im.height * (x / im.width)
          im.width = x
          im.parentNode.style.height = im.height * (x / im.width) + 'px'
      } else if (im.width / im.height <= x / y && im.height > y) {
          im.width = im.width * (y / im.height)
          im.height = y
          im.parentNode.style.height = y + 'px'
      }
  }  
  $(".pic img").each(function(i){iimgFix(this,0,600);});
})($);
</script>
<?php iACP::foot(); ?>
