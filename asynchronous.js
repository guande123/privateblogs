  var xmlHttp = getXMLHttpRequest();
  //var Form1="1001";
  //var Form2="1002";
  //不同的浏览器使用不同的方法创建XMLHttpRequest对象
    function getXMLHttpRequest(){
	 var XMLHTTP=null;
	   if(window.XMLHttpRequest){
		   //firefox,opera 8.0+,safari;
		   XMLHTTP  = new XMLHttpRequest();
	   }else if(window.ActiveXObject){
		   try{
			   //IE6 or above
			   XMLHTTP= new ActiveXObject("Msxml2.XMLHTTP");
		   }catch(e){
			      XMLHTTP = new ActiveXObject("Microsoft.XMLHTTP");
		   }
		  }
		return XMLHTTP;
	}
	function connectServer(url){
		xmlHttp.onreadystatechange=stateChanged ;//设置回调函数
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.open("GET",url,true) ;  //与服务器建立连接
		xmlHttp.send() ;// 发送请求    
	}
    function connectServer(url,req){
		xmlHttp.onreadystatechange=stateChanged ;//设置回调函数
		xmlHttp.open(req,url,true) ;  //与服务器建立连接
		xmlHttp.send() ;// 发送请求    
	}
	//override XMLHttp 
	//浏览器收到服务器响应后调用的函数
	/*function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
			if(txt==Form1){
				nextForm(1,txt);//回调，显示下一个表单，待修改
			}else if(txt==Form2){
				nextForm(2,txt);//回调，显示下一个表单，待修改
			}else{
			nextForm(3,txt);//回调，显示下一个表单，待修改
			}
		}
}  */
