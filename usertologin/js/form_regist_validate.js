//表单输出验证
   function formValidate(){
	   var inputNameObj =  document.getElementById("nameId");
	   var inputPasswordObj =  document.getElementById("passwordId");
	   var inputRepasswordObj =  document.getElementById("repasswordId");
	   var inputPhoneNumberObj =  document.getElementById("phonenumberId");
	     var inputEmailObj =  document.getElementById("emailId");
	   if(!isNameCorrected(inputNameObj)){
		 return false; 
	   }
	   if(!isPasswordCorrected(inputPasswordObj)){
		    return false; 
	   }
	   if(!isRepasswordCorrected(inputRepasswordObj)){
		    return false; 
	   }
	   if(!isPhoneNumCorrected(inputPhoneNumberObj)){
		    return false; 
	   }
	    if(!isEmailCorrected(inputEmailObj)){
		    return false; 
	   }
	   document.getElementById("regist_form").submit();
	   return true;
   }
    /*
	 *
	 *\x00-xff  GBK双字节编码范围
	 *\x20-\x7f ASCII
	 *\xa1-\xff gb2312 取出所有中文
	 *\x80-\xff gbk 取出所有中文
	 *
	 *\u4e00-\u9fa5  utf-8 取出所有中文
	 */
	 
	//用户名验证  
   function isNameCorrected(obj){
	  var name = obj.value;
	  var spanTips = document.getElementById("name_tips");   
	  //2~10个字符，不能以数字开头，不能使用数字、字母以外的特殊字符
	  //  /(^[a-zA-Z\u4e00-\u9fa5]+[0-9\-]*){2,10}$/
	  var str =/^[_a-zA-Z\u4e00-\u9fa5][_a-zA-Z0-9\u4e00-\u9fa5]{1,9}$/;
	  if(name.match(str)==null){
		  spanTips.style.color = "red";
		  spanTips.innerHTML = "2~10个字符，不能以数字开头，不能使用数字、字母以外的特殊字符";
		  
		  return false;
	  }
	   spanTips.color = "red";
	   spanTips.innerHTML = "";
	  return true;
   }
   //密码验证  
   function isPasswordCorrected(obj){
	    var password = obj.value;
		var spanTips = document.getElementById("password_tips");  		
	  //（3-18个字符）
	  var str =/^([\x20-\x7f]*){3,18}$/;
	  if(password.match(str)==null){
		    spanTips.style.color = "red";
		  spanTips.innerHTML = "（3-18个字符）!";
		  return false;
	  }
	  spanTips.style.color = "black";
	  spanTips.innerHTML ="";
	  return true; 
   }
   //重复密码验证
   function isRepasswordCorrected(obj){
	     var repassword = obj.value;
	     var password = document.getElementById("passwordId").value;  
		 var spanTips = document.getElementById("repassword_tips");  
	     if(repassword!=password){
	      spanTips.style.color = "red";
		  spanTips.innerHTML = "密码不一致!";
	  	  return false;
	     }
		 spanTips.style.color = "black";
		 spanTips.innerHTML="";
	     return true; 
       }
   //手机格式验证
	function  isPhoneNumCorrected(obj){
		  var repassword = obj.value;
		  var spanTips = document.getElementById("phonenumber_tips");  
		  //手机号码匹配模式串
		  var strReg = /^1[3|4|5|7|8][0-9]{9}$/; 
	     if(repassword.match(strReg)==null){	
		   spanTips.style.color = "red";
		  spanTips.innerHTML = "手机号码格式有误!";
	  	  return false;
	     }
		  spanTips.style.color = "black";
		  spanTips.innerHTML ="";
	     return true; 
	}  
	
	//邮箱验证
    function isEmailCorrected(obj){
		 var email = obj.value;
		  var spanTips = document.getElementById("email_tips");  
	    //邮箱正则表达式 
		  var strReg = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/ ;
	     if(email.match(strReg)==null){	
		   spanTips.style.color = "red";
		   spanTips.innerHTML = "邮箱格式不正确";
	  	  return false;
	     }
		  spanTips.style.color = "black";
		  spanTips.innerHTML ="";
	     return true; 
	}
	
   /*
    *字符串正则表达式统一验证
    *obj:被匹配的对象
	*reg:需要匹配的模式串 正则表达式
	*spanId:错误提示语id
	*msg:错误提示语
	*/
   function isStrValCorrected(obj,reg,spanId,msg){
	   var value = obj.value;
	   var spanTips = document.getElementById(spanId);  
	   if(value.match(reg)==null){
		  spanTips.style.color = "red";
   		  span.innerHTML =msg;
		  return false;
	  }
	  spanTips.style.color = "black";
	  spanTips.innerHTML="";
	  return true;
   }
