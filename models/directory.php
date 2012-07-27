<?php
/**
 * Created by IntelliJ IDEA.
 * User: chandleryu
 * Date: 12-7-19
 * Time: 上午9:51
 * To change this template use File | Settings | File Templates.
 */


class DirectoryProcessor{
    private $dirPath; //当前目录处理器所对应的目录
    private $htmlMetaList; //当前目录处理器对应的html元数据的列表
    private $authorList; //当前目录处理器对应的作者数据的列表

    /**
     * 构造函数，打开文件夹路径，如果失败则抛出异常
     *@throws String 非法文件夹路径
     */
    public function __construct($dirPath,$html_file_name_preg){
        if(!is_dir($dirPath)){
            throw new Exception('Invalid directory path!');
        }
        $this->dirPath=$dirPath;
        $this->htmlMetaList=array();
        $this->authorList=array();

        date_default_timezone_set('Asia/Shanghai');

        $this->fetchHtmlFileContent($html_file_name_preg);
    }

    /**
     * 读取文件夹下的所有文件名
     *
     * @param String 正则表达式
     * @return Array 符合正则表达式的文件名列表
     */
    private function fetchHtmlList($html_file_name_preg){
        $contentArray=array();
        $dp=opendir($this->dirPath);
        while(false !== ($file = readdir($dp))){
            array_push($contentArray,$file);
        }
        $htmlArray = preg_grep($html_file_name_preg, $contentArray);
        closedir($dp);
        sort($htmlArray);
        return $htmlArray;
    }

    /**
     * 读取数组中对应的所有文件数据
     *
     * @param Array，包含文件名列表
     * @return Array，对应的二维数组，包括文件名、作者信息等
     */
    private function fetchHtmlFileContent($html_file_name_preg){
        $htmlArray = $this->fetchHtmlList($html_file_name_preg);

        foreach($htmlArray as $htmName)
        {
            if (file_exists($this->dirPath.$htmName)) {
                //创建一个数组保存meta信息
                $singleHTMLMeta = array();

                $fileProc=new FileProcessor();
                $fileMeta = $fileProc->readHtml($this->dirPath,$htmName);

                //文件名
                $singleHTMLMeta['fileName'] = $htmName;

                //作者
                $singleHTMLMeta['author'] = strtolower($fileMeta['author']);

                    if(!in_array($singleHTMLMeta['author'],$this->authorList)){
                          array_push($this->authorList,$singleHTMLMeta['author']);
                      };

                //缩略图
                $thumb_url = "http://getimg.in/220x150s".preg_replace('/.html?/','',$htmName);
                $pngName = preg_replace('/html?/','png',$htmName);
                $pngName = $this->dirPath.$pngName;
                if (file_exists($pngName)) {
                    $thumb_url = $pngName;
                }
                $singleHTMLMeta['thumbUrl'] = $thumb_url;

               //最后修改时间
                $fileUpdateData = date ("Y/m/d", filemtime($this->dirPath.$htmName));
                $singleHTMLMeta['fileUpdateData'] = $fileUpdateData;

                //简介
                $fileDescription = $fileMeta['description'];
                $singleHTMLMeta['fileDescription'] = $fileDescription;

                //标题
                $fileTitle = $fileMeta['metatitle'];
                $singleHTMLMeta['fileTitle'] = $fileTitle;

                array_push($this->htmlMetaList,$singleHTMLMeta);
            }

        }
    }

    /**
     * 输出HTML元数据的数组
     *
     * @return Array HTML元数据的数组
     */
    public function fetchHtmlMetaList(){
        return $this->htmlMetaList;
    }

    /**
     * 输出作者数组
     *
     * @return Array 作者数组
     */
    public function fetchAuthorList(){
        return $this->authorList;
    }


}

