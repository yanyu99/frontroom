
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
<script>
  if(parent.window.{{$parentCallback}}){
		parent.window.{{$parentCallback}}();
	} else {
		if(parent.window != window){
			parent.window.location.reload();
		}
		
	}
</script>
</body>
</html>