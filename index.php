<?php
/**
 * Created by IntelliJ IDEA.
 * User: chandleryu
 * Date: 12-7-19
 * Time: 上午9:51
 * To change this template use File | Settings | File Templates.
 */

include('config.php');
include('models/directory.php');
include('models/file.php');

//初始化
$dirProc=new DirectoryProcessor(FILE_PATH,HTML_FILE_NAME_PREG);
$htmlMetaList = $dirProc->fetchHtmlMetaList();
$authorList = $dirProc->fetchAuthorList();

?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="UTF-8" />
        <title>QZ组件</title>
        <link rel="stylesheet" type="text/css" href="assets/reset.css">
        <link rel="stylesheet" type="text/css" href="assets/grid.css">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        </head>
<body>
<div id="wrapper">
    <div class="grid clearfix">
        <div id="main" class="grid-1">
            <div id="logo"><h1>Twitter Open Source</h1></div>
                <h1>Qzone组件</h1>
                <p>Qzone组件是被Qzone页面或者项目引入的复用代码。</p>
                <p>Want to help? <a href="http://os.oa.com/cat/wr">前端开发组规范</a></p>
              </div>

<div class="grid grid-3">
        <div id="statistics" class="grid-1 alpha header">
          <h1>数据统计</h1>
          <p>
            <span><?php echo sizeof($htmlMetaList);?></span> 个组件
            <br>
            <span><?php echo sizeof($authorList);?></span>个成员
          </p>

        </div>

        <div id="recently-updated" class="grid-2 omega header">
          <h1>参数说明 </h1>
              <ol id="recently-updated-repos">
                  <li>author ： RTX英文名（请统一，否则会统计出两个作者，大小写不敏感）</li>
                  <li>description ： 说明组件用途，中文，一段文字适宜</li>
              </ol>
            <p>Sample：&lt;meta name="author" content="Chandleryu" /&gt;</p>
            </div>
          </div>

            <ol id="repos">
            <?php
                foreach($htmlMetaList as $htmlMeta){
                    ?>
                <li class="repo grid-1"><a href="<?php echo HTML_PATH.$htmlMeta['fileName'];?>" target="_blank"><div  class="thumbnail"><img
                    src="<?php echo $htmlMeta['thumbUrl'];?>" alt=""/></div><h2><?php echo $htmlMeta['fileTitle'];?></h2><h3><?php echo $htmlMeta['fileName'];?> - <?php echo $htmlMeta['author'];?></h3><p><?php echo $htmlMeta['fileDescription'];?></p>
                    <p><?php echo $htmlMeta['fileUpdateData'] ?></p>
                </a></li>
                    <?php
                }

            ?>
            </ol>
    </div><!-- .grid -->
</div><!-- .id="wrapper" -->
</body>
</html>