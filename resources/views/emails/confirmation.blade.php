<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr><td>Dear {{ $name }},<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Please click on the link below to activate your E-Pasal account:<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><a href="{{ url('/user/confirm/'.$code) }}">Confirm Account</a><br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards,<br></td></tr>
        <tr><td>E-Pasal</td></tr>
    </table>
</body>
</html>