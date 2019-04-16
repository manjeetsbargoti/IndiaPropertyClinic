<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/emails/confirmation.blade.php */ ?>
<html>
    <head>
        <title>Register Email</title>
    </head>
    <body>
        <table>
            <tr><td>Dear <?php echo e($name); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Please click on below link to activate account:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a href="<?php echo e(url('/verify/'.$code)); ?>">Verify Account</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html>