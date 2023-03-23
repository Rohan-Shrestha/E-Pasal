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
    <tr><td>Your Vendor Email has been confirmed. Please login and add your personal, business and bank details to add your products in the EPasal Store.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your Vendor Account details are below:<br></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Name: {{ $name }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email: {{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Mobile: {{ $mobile }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: ****** (as chosen by you)</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thank You and Regards,</td></tr>
    <tr><td>EPasal</td></tr>
</body>
</html>