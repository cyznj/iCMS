<?php
/**
 * @package iCMS
 * @copyright 2007-2010, iDreamSoft
 * @license http://www.idreamsoft.com iDreamSoft
 * @author coolmoo <idreamsoft@qq.com>
 * @$Id: index.app.php 2406 2014-04-28 02:24:46Z coolmoo $
 */
class indexApp {
	public $methods	= array('iCMS','index');
    public function __construct() {}
    public function do_iCMS($a = null) {
        return $this->index($a);
    }
    public function API_iCMS(){
        return $this->do_iCMS();
    }
    public function index($a = null){
        $index_name = $a[1]?$a[1]:iCMS::$config['template']['index_name'];
        $index_tpl  = $a[0]?$a[0]:iCMS::$config['template']['index'];
        $index_name OR $index_name = 'index';
        $iurl = iURL::get('index',array('urlRule'=>$index_name.iCMS::$config['router']['html_ext']));
        if(iCMS::$config['template']['index_mode'] && iPHP_DEVICE=="desktop"){
            iCMS::gotohtml($iurl->path,$iurl->href);
        }
        if(iPHP::$iTPL_MODE=="html" || iCMS::$config['template']['index_rewrite']){
            iCMS::set_html_url($iurl);
        }
        $siteCounter = self::countx();
        iPHP::assign('siteCounter',$siteCounter);
        $html = iPHP::view($index_tpl);
        if(iPHP::$iTPL_MODE=="html") return array($html,$iurl);
    }


    private static function countx($file = "count.dat")
    {
        if (file_exists(iPATH . $file)) {
            $fp = fopen($file, "r");
            $numx = fgets($fp, 10);
            fclose($fp);
            $numx = $numx + 1;
            //以上四行代码可以用一条表达式代替：$numx=file_get_contents($file)+1;
        } else {
            $numx = 1;
        }
        file_put_contents(iPATH . $file, $numx); //当文件不存在时，这函数会自动创建文件，而且会自动把参数转成字符串写入。
        return $numx;
    }
}
