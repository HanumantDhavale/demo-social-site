<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<div id="app">
    @{{message}}
</div>
<body>
<script src="{{asset('js/app.js')}}"></script>
<script !src="">
    const app = new Vue({
        name: "Home page",
        el: "#app",
        data: {
            message: "Hello laravel from Vue app"
        }
    });
</script>
</body>
</html>
