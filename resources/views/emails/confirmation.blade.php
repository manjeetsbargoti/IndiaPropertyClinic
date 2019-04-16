<html>
    <head>
        <title>Register Email</title>
    </head>
    <body>
        <table>
            <tr><td>Dear {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Please click on below link to activate account:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a href="{{ url('/verify/'.$code) }}">Verify Account</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html>