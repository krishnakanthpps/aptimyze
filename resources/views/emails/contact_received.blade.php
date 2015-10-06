<!DOCTYPE html>
<!-- When user sign up, this is a verification email. -->
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Hello Admin</h2>
<h4>Contact Mail from {{$name}}</h4>
		<pre>
			<h4>Name: </h4>{{$name}}
			<h4>Email: </h4>{{$email}}
			<h4>Phone: </h4>{{$phone}}
			<h4>Organization: </h4>{{$organization}}
			<h4>Message: </h4>{{$messages}}
		</pre>
</body>
</html>