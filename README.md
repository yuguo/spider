spider
======

抓取服务器上的符合特定规则的html，作为一个入口页展示出来

## 需求背景 ##
项目组有一个公共服务区，上面丢了一些HTML和CSS。我希望统计出所有的组件HTML，并且聚合出来，方便成员浏览组件，所以写了这么一个PHP丢到服务器上。

## 配置 ##
把文件夹放在服务器或者你本地，配置config.php，That's it!

## 规则 ##
- 有意义的英文文件名qz_ficon.html（请在config中配置正则表达式）
- 简短有意义的&lt;title&gt;标题&lt;/title&gt;
- &lt;meta name="author" content="Yuguo" /&gt;
- &lt;meta name="description" content="CSS3 @font-face 图标字体" /&gt;
- 在同级文件夹下的同名png图片——缩略图


## 鸣谢 ##
样式参考自 [http://twitter.github.com/](http://twitter.github.com/)

## 截图 ##
![](https://github.com/yuguo/spider/raw/master/screenshots/spider.png)