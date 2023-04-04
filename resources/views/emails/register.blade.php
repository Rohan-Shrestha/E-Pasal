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
        <tr><td>Dear {{ $name }}<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Welcome to E-Pasal. Your account has been successfully created with the information below:<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Name: {{ $name }}<br></td></tr>
        <tr><td>Mobile: {{ $mobile }}<br></td></tr>
        <tr><td>Email: {{ $email }}<br></td></tr>
        <tr><td>Password: ****** (as chosen by you)<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards,<br></td></tr>
        <tr><td>E-Pasal</td></tr>
    </table>
</body>
</html>