<?php
/**
 * Created by IntelliJ IDEA.
 * User: chandleryu
 * Date: 12-7-19
 * Time: 上午9:51
 * To change this template use File | Settings | File Templates.
 */

include('simple_html_dom.php');

class FileProcessor{
    private $dirPath;

    /**
     * 构造函数，打开文件夹路径，如果失败则抛出异常
     *@throws 非法文件夹路径
     */
    public function __construct(){
    }

    /**
     * 读取文件夹下的所有文件名
     *
     * @param
     * @return
     */
    public function readHtml($html_path,$filenmae){

        $meta = array(
            'author'=> DEFAULT_AUTHOR_NAME,
            'description'=> '',
            'metatitle'=> ''
        );

        // get DOM from URL or file
        $html = file_get_html($html_path.$filenmae);

       // find title
        if($e = $html->find('title',0)){
           $meta['metatitle'] = $e->innertext;
        }

       // find author
        if($e = $html->find('meta[name=author]',0)){
           $meta['author'] = $e->content;
        }

        //find desc
        if($e = $html->find('meta[name=description]',0)){
            $meta['description'] = $e->content;
        }
        return $meta;
    }

}