<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=UTF-8">
    <title>Reset link</title>
</head>
<body>
Hi {{$account->first_name}},
<br>
Your password reset link is :
<br>
<a href="{{route('auth.reset.password', ['a' => encrypt($account->id), 't' => encrypt($token)])}}">Click here to reset password</a>
<br>
Regards, <br>
Social Site
</body>
</html>
