&nbsp;<span id="s_content">5</span><span>秒后自动跳转<a href="login.php">登陆界面</a>!!</span>
<script type='text/javascript'>
  //实现5秒跳转
      var timer = setInterval('tianzhuan()',1000);
	  var s = 5;
	  var content = document.getElementById('s_content');
	  alert(content);
      function tianzhuan(){
		if(s == 0){
			clearInterval(timer);
		}
		content.innerHTML = s;
		s--;
	  }
	    setTimeout(function(){
			window.location.assign('login.php');
		},5500);	
	
 </script>