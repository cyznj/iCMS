<?php
/**
 * @package iCMS
 * @copyright 2007-2010, iDreamSoft
 * @license http://www.idreamsoft.com iDreamSoft
 * @author coolmoo <idreamsoft@qq.com>
 * @$Id: category.app.php 2412 2014-05-04 09:52:07Z coolmoo $
 */
class categoryApp{
	public $methods	= array('iCMS','category');
    public function __construct($appid = iCMS_APP_ARTICLE) {
    	$this->appid = iCMS_APP_ARTICLE;
    	$appid && $this->appid = $appid;
    	$_GET['appid'] && $this->appid	= (int)$_GET['appid'];
    }
    public function do_iCMS($tpl = 'index') {
        $cid = (int)$_GET['cid'];
        $dir = iS::escapeStr($_GET['dir']);
		if(empty($cid) && $dir){
			$cid = iCache::get('iCMS/category/dir2cid',$dir);
            $cid OR iPHP::throw404('运行出错！找不到该栏目<b>dir:'.$dir.'</b> 请更新栏目缓存或者确认栏目是否存在', 20002);
		}
    	return $this->category($cid,$tpl);
    }
    public function API_iCMS(){
        return $this->do_iCMS();
    }

    public function category($id,$tpl='index') {
        $category = iCache::get('iCMS/category/'.$id);
        if(empty($category) && $tpl){
            iPHP::throw404('运行出错！找不到该栏目<b>cid:'. $id.'</b> 请更新栏目缓存或者确认栏目是否存在', 20001);
        }
        if($category['status']==0) return false;

        $iurl = iURL::get('category',$category);

        if($tpl){
            if(iPHP::$iTPL_MODE=="html" &&
                (strstr($category['contentRule'],'{PHP}')
                ||$category['outurl']
                ||empty($category['mode']))
            ) {return false;}

            $category['url'] && iPHP::gotourl($category['url']);
            $category['mode']=='1' && iCMS::gotohtml($iurl->path,$iurl->href);
        }
        $category['iurl']   = (array)$iurl;
        $category['url']    = $iurl->href;
        $category['link']   = "<a href='{$category['url']}' target='_blank'>{$category['name']}</a>";
        $category['nav']    = $this->get_nav($category);
        $category['subid']  = iCache::get('iCMS/category/rootid',$id);
        $category['subids'] = implode(',',(array)$category['subid']);
        $category['parent'] = array();

        if($category['rootid']){
            $_parent            = iCache::get('iCMS/category/'.$category['rootid']);
            $category['parent'] = $this->get_lite($_parent);
            unset($_parent);
        }
        if($category['password']){
            $category_auth        = iPHP::get_cookie('category_auth_'.$id);
            list($ca_cid,$ca_psw) = explode('#=iCMS!=#',authcode($category_auth,'DECODE'));
        	if($ca_psw!=md5($category['password'])){
        		iPHP::assign('forward',__REF__);
	        	iPHP::view('{iTPL}/category.password.htm','category.password');
	        	exit;
        	}
        }
        if($category['hasbody']){
           $category['body'] = iCache::get('iCMS/category/'.$category['cid'].'.body');
           $category['body'] && $category['body'] = stripslashes($category['body']);
        }
        $category['appid']  = iCMS_APP_CATEGORY;
        $category['pic']  = get_pic($category['pic']);
        $category['mpic'] = get_pic($category['mpic']);
        $category['spic'] = get_pic($category['spic']);

        if($tpl) {
            $category['mode'] && iCMS::set_html_url($iurl);
            iCMS::hooks('enable_comment',true);
            iPHP::assign('category',$category);
            if(strstr($tpl,'.htm')){
            	return iPHP::view($tpl,'category');
            }
            $GLOBALS['page']>1 && $tpl='list';
            $html	= iPHP::view($category[$tpl.'TPL'],'category.'.$tpl);
            if(iPHP::$iTPL_MODE=="html") return array($html,$category);
        }else{
        	return $category;
        }
    }
    public function get_nav($C) {
        if($C) {
            $iurl = (array)$C['iurl'];
            $link = "<li><a href='{$iurl['href']}'>{$C['name']}</a><span class=\"divider\">".iPHP::lang('iCMS:navTag')."</span></li>";
            if($C['rootid']){
                $rc = iCache::get('iCMS/category/'.$C['rootid']);
                $rc['iurl'] = (array)iURL::get('category',$rc);
                $nav.= $this->get_nav($rc);
            }
            $nav.= $link;
        }
        return $nav;
    }
    public function get_lite($C){
        $category                = array();
        $C['iurl'] OR $C['iurl'] = (array)iURL::get('category',$C);
        $category['name']        = $C['name'];
        $category['description'] = $C['description'];
        $category['subname']     = $C['subname'];
        $category['sname']       = $C['subname'];
        $category['pic']         = $C['pic'];
        $category['nav']         = $this->get_nav($C);;
        $category['url']         = $C['iurl']['href'];
        $category['link']        = "<a href='{$category['url']}'>{$C['name']}</a>";
        if($C['rootid']){
            $_parent            = iCache::get('iCMS/category/'.$C['rootid']);
            $category['parent'] = $this->get_lite($_parent);
            unset($_parent);
        }
        return $category;
    }
}
