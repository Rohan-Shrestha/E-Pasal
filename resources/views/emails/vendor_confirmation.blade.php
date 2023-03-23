<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <tr><td>Dear {{ $name }},</td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Please click on the link below to confirm your account.</td></tr>
    <tr><td><a href="{{ url('vendor/confirm/'.$code) }}">{{ url('vendor/confirm/'.$code) }}</a></td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Thank You and Regards,</td></tr>
    <tr><td>EPasal</td></tr>
</body>
</html>