# 一、表格 #
## 1.基本样式 ##

	<table class="table></table>

## 2.条纹状表格 ##
让tbody里的行产生一行隔一行加单色背景效果

	<table class="table table-striped"></table>

## 3.带边框的表格 ##
给表格添加边框

	<table class="table table-bordered"></table>

## 4.悬停鼠标 ##
让tbody下的表格悬停鼠标实现背景效果

	<table class="table table-hover"></table>

## 5.状态类 ##
可以单独设置每一行的背景样式

	<tr class="success"></tr>

一共有5种不同的样式可供选择

	active   鼠标悬停的行或者单元格上
	success  标识成功或积极的动作
	info     标识普通的提示信息或动作
	warning  标识警告或需用户注意
	danger   危险或者潜在的负面影响的动作

## 6.隐藏某一行 ##

	<tr class="sr-only"></tr>

## 7.响应式表格 ##
表格父元素设置响应式，小于768px出现边框

	<body class="table-responsive"></body>

# 二、 按钮 #
## 1.可作为按钮使用的标签或者元素 ##
转化为普通按钮

	<a href="###" class="btn btn-default">link</a>
	<button class="btn btn-default">BUtton</button>
	<input type="button" class="btn btn-default" value="button">

注意事项</br>
（1）针对组件的注意事项</br>
虽然按钮类可以应用到a标签或者button上，但是，导航和导航组件只支持button元素</br>
（2）链接被作为按钮时的注意事项</br>
如果a标签被作为按钮使用，并用于在当前页面触发某些功能呢，而不是用于链接其他页面或者链接当前页面的其他部分，请务必设置role="button"属性
（3）跨浏览器展现</br>
强烈建议使用button元素来获得各个浏览器上的相匹配的绘制效果</br>
## 2.预定义样式 ##

	btn-default    默认样式
	btn-success    成功样式
	btn-info       一般信息样式
	btn-warning    警告样式
	btn-danger     危险样式
	btn-primary    首选项样式
	btn-link       链接样式

##  3.尺寸大小 ##

	尺寸从大到小的class 
	btn-lg  、 btn  、btn-sm    、btn-sx (extra-small)

## 4.块级按钮 ##

	btn-block

## 5.激活按钮 ##

	<button class="btn btn-active">button</button>

## 6.禁用按钮 ##

	<button calss="btn btn-disabled">button</button>

