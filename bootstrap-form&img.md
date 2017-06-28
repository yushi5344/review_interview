# 一、表单 #
## 1.基本格式 
<pre>
<code>
	<form action="#">
		<div class="form-group">
			<label>电子邮件</label>
			<input type="email" class="fomr-control" placeholder="请输入您的电子邮件">
		</div>
		<div class="form-group">
			<label>密码</label>
			<input type="password" class="form-control" placeholder="请输入您的密码>
		</div>
	</form>
</code>
</pre>

注意：只有正确设置了input框的type属性，才能被赋予正确的样式。支持的输入控件有：text、password、datetime、datetime-local、date,month,tiem,week,number,email,url,search,tel&color.
##2.内联表单
让表单左对齐浮动，表现为inline-block内联块结构
<pre>
<code>
	<form class="form-inline"></form>
</code>
</pre>  
当小于768px,会恢复到独占样式
## 3.表单合组 ##
<pre>
<code>
	<div class="input-group">
		<div class="input-group-addon">￥</div>
		<input type="text" class="form-control">
		<div class="input-group-addon">.00</div>
	</div>
</code>
</pre>
## 4.水平排列 ##
<pre>
<code>
	<form action="##" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">电子邮件</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" placeholder="请输入您的电子邮件">
			</div>
		</div>
	</form>
</code>
</pre>
## 5.复选框和单选框 ##
<pre>
<code>
	设置复选框 在一行
	<div class="checkbox">
		<label><input type="checkbox">体育</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox">音乐</label>
	</div>
	设置禁用的复选框
	<div class="checkbox">
		<label><input type="checkbox" disabled>音乐</label>
	</div>
    设置内联一行显示的复选框
	<label class="checkbox-inline"><input type="checkbox">体育</label>
    <label class="checkbox-inline disabled"><input type="checkbox" disabled></label>
	设置单选框
	<div class="radio disabled">
		<label>
			<input type="radio" name="sex" disabled>男
		</label>
     </div>
</code>
</pre>
## 6.下拉列表 ##
<pre>
<code>
	<select id="" class="form-control">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
   </select>
</code>
</pre>
## 7.校验状态 ##
设置为错误状态
<pre>
<code>
	<div class="form-group has-error"></div>
	has-error    错误状态
	has-success  成功状态
	has-warning  警告状态
</code>
</pre>
## 8.添加额外的图标 ##
<pre>
<code>
	文本框右侧内置文本图标
	<div class="form-group has-feedback">
	    <label>电子邮件</label>
	    <input type="email" class="form-control"/>
	    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
	</div>
	除了glyphicon-ok之外 还有其他
	glyphicon-OK  成功状态
	glyphicon-warning-sign   警告状态
	glyphicon-remove    错误状态
</code>
</pre>
## 9.控制尺寸 ##
<pre>
<code>
	从大到小
	<input type="password" class="form-control input-lg" />
	<input type="password" class="form-control"/>
	<input type="password" class="form-control input-sm"/>
</code>
</pre>
# 二、图片 #
## 1.图片形状 ##
<pre>
<code>
	<img src="img/1.jpg" alt="" class="img-rounded"/>
	<img src="img/1.jpg" alt="" class="img-circle" />
	<img src="img/1.jpg" alt="" class="img-thumbnail" />
</code>
</pre>
## 2.响应式图片 ##
<pre>
<code>
	<img src="img/1.jpg" alt="" class="img-responsive"/>
</code>
</pre>

