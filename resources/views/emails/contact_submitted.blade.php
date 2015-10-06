<!DOCTYPE html>
<!-- When user sign up, this is a verification email. -->
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Hello,</h2>
<h4>This is an auto-generated mail from  <a href="{{URL::to('/')}}">{{URL::to('/')}}</a>
    to {{$email}}</h4>
If you have received this email by mistake, please inform by replying to this email.

<div>
    Our team will work on your feedback and get back to you soon.
    Till then feel free to explore site.
</div>
</body>
</html>
