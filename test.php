<!DOCTYPE html>
<html>
<body>
<select id="pid" onchange="OnValChange()">
    <option value="a">选项一</option>
    <option value="b">选项二</option>
</select>
</body>
<script type="text/javascript">
var select = document.getElementById("pid");
      function OnValChange(){
		  alert("value:"+select.value);
	  }
</script>
</html>