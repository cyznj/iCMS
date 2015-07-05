<?php
require dirname(__file__) . '/../iCMS.php';
require dirname(__file__) . '/resizeimage.php';
if (isset($_GET['file'])) {
    $path = trim($_GET['file']); //��ͼ·��
    $srcPath = substr($path, 0, strpos($path, "_")); //ԭͼ·��
    $afterUnderline = substr($path, strpos($path, "_") + 1);
    $size = substr($afterUnderline,0,strpos($afterUnderline,"."));
    if (strpos($path, "_")>0 && is_file(iPATH . $srcPath)) {
        $ext = strtolower(strrchr($srcPath, '.'));
        header('Cache-Control:max-age=604800');
        if ($ext == '.jpg' || $ext == '.jpeg') {
            header('content-type:image/jpg');
        } elseif ($ext == '.png') {
            header('content-type:image/png');
        } else {
            header('HTTP/1.1 404 Not Found');
        }
        if(!is_file(iPATH . $path)){
            //������������ͼ,����,Դ�ļ�������ͼ��ַ������ͬ,140,140�ֱ�����͸�
            $widthHeight = explode("x",$size);
            $resizeimage = new resizeimage(iPATH . $srcPath, $widthHeight[0], $widthHeight[1], "0", iPATH . $path);
        }
        echo file_get_contents(iPATH . $path);
        exit;
    }
}
