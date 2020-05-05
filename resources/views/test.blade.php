<!DOCTYPE html>
<html>
<head>
	<title>Teste Vue</title>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
<div id="app">
  @{{ message }}
</div>
<script type="text/javascript">
	var app = new Vue({
	  el: '#app',
	  data: {
	    message: 'Olá Vue!'
	  }
	});
</script>
</body>
</html>