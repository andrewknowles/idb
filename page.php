<html>
<head>
<script type="text/javascript">
function andrew()
{
	alert('Hello');
document.myform.submit();
}
</script>
</head>
<body>

<form name = 'myform' action = '' method = 'get'>
<select name = 'mylist' onchange="andrew()">
<option value="">Select combo</option>
<option value="Value1">Text1</option>
<option value="Value2">Text2</option>
<option value="Value3">Text3</option>
</select>

</form>
<?php
if(isset($_GET['mylist']))
{
$ak = $_GET['mylist'];
echo 'xxx'.$ak;
}
?>
</body>
</html>