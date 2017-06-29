# 一、页面排版 #
## 1.页面主题 ##
bootstrap将全局font-size设置为14px,line-height行高设置为1.428（20px），p标签设置为1/2行高 颜色为#ccc.
## 2.标题 ##
从h1-h6大小分别是36px、30px,24px,18px,14px,12px.支持普通内联元素定义class=(h1-h6)来实现相同功能。
small标签  副标题
h1-h3下  small元素大小占父元素的65%   h4-h6下  small元素占父元素75%。
## 3.内联元素 ##
mark标签和mark类
del标签 删除的文本
s标签  无用的文本
ins 插入的文本
## 4.对齐 ##

	class  text-left 左对齐   text-center  居中  text-nowrap 不换行

## 5.大小写 ##

	class   text-lowercase  小写
	text-uppercase  大写
	text-capitalize  首字母大写

## 6.缩略语 

	Bootstrap<abbr title="bootstrap" class="initialism">框架</abbr>

## 7.地址文本 ##
设置地址 去掉了倾斜，设置了行高，底部20px
## 8.引用文本 ##
引用文本 增加了左边线，设定了字体大小和内外边距

	<blockquote>XXX</blockquote>

## 9.列表排版 ##
移除默认样式

	<ul class="list-unstyled"></ul>

设置内联

	<ul class="list-inline"></ul>

水平排列描述列表

	<dl class="dl-horizontal">
		<dt>bootstrap</dt>
		<dd>bootstrap是一个提供了常规的设计好的页面 排班样式供开发者使用</dd>
	</dl>

## 10.代码 ##

	<code>&lt;section&gt;</code>
