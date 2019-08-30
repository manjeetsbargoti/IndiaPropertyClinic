<html>
    <head>
        <title>Generate your password and activate account</title>
    </head>
    <body>
        <table>
            <tr><td>Dear {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>Please click on below link to generate password and activate your account:</strong></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a class="btn btn-success btn-lg" href="{{ url('/password/reset?email='.$code) }}">Generate Password</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html>