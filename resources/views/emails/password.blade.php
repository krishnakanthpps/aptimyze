<!DOCTYPE html>
<html lang="en-US"
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Password Reset</h2>

        <div>
            To reset your password, complete this form:  {{ url('password/reset/'.$token) }}.<br/>
            This link will expire in 12 hours.
        </div>
    </body>
</html>
