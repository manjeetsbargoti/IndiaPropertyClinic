<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/emails/register.blade.php */ ?>
<html>
    <head>
        <title>Register Email</title>
    </head>
    <body>
        <table>
            <tr><td>Dear <?php echo e($name); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your account has been Successfully Created.<br>
            Your account information is as below:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: <?php echo e($email); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Password: ****** (as chosen by you)</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html>