# JavaScript是什么 #
JavaScript是一种运行在浏览器端的脚本语言，处理用户输入实现交互功能。  
   
普通变量(全局变量) 
  
定义的位置开始，直到下次被赋值或者被页面加载结束为止
局部变量

函数内部使用var定义的变量，只在函数内部使用。

注意：函数内部的局部变量必须使用var关键字来声明，若果不使用var声明则为全局变量。

事件驱动

    onload:页面加载事件，只有窗口有这个事件
    onmouseover：鼠标移入事件
    onmouseout:鼠标移出事件
    onmousemove:鼠标移动事件
    onclick:点击事件
    onblclick:鼠标双击事件
    onfoucus:得到焦点事件
    onblur：失去焦点事件
    onkeydown:键盘按下事件
    onkeypress:键盘被按住事件
    onkeyup：键盘谈起事件
    onsubmit:表单提交事件
    onreset：表单重置事件
    onselect：选择改变，文本框中的文字被选择时
    onchange：改变事件

动画控制

	var t=setinterval(函数，时间)  每隔多长时间执行一次，重复不断的执行
	clearintval(t)释放设置动画控制 

时间对象

	var d =new Date();
	d.getHours();
	d.getMinutes();
	d.getDay(); 获得星期的第几天
	d.getDate();

Math对象

	Math.abs();绝对值
	Math。random()随机返回（0,1）中的小数
	Math.round()对小数位第一位进行四舍五入
	ceil 进一法取整、
	floor舍去法取整
DOM操作

DOM  document object model

DOM文档结构

- DOM文档结构必须是一个树形的层次结构
- DOM文档有且只有一个根节点（<!doctype>）
- Dom文档结构从跟节点到某个子节点，有且只有一条最短路径
- DOM文档除了根节点外，有且只有一个直接的父节点
- 除了叶子结点，每个节点都有不少于一个的子节点

DOM中关键字

- 元素节点
- 属性节点
- 文本节点
- 注释节点

系统对象

window对象

	window.onload;
	window.confirm();
	location.href='http://www.baidiu.com';

open()打开一个新窗口

	window.open('http://www.baidu.com','baidu','width=500px,height=500px;');

close()关闭窗口

	window.close();

reload重新加载

	window.location.reload();