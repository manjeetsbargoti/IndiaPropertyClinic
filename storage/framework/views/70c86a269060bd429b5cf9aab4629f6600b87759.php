<html>
    <head>
        <title>Generate your password and activate account</title>
    </head>
    <body>
        <table>
            <tr><td>Dear <?php echo e($name); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: <?php echo e($email); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>Please click on below link to Reset Password.</strong></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a class="btn btn-success btn-lg" href="<?php echo e(url('/password/reset?email='.$code)); ?>">Generate Password</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/emails/verify_email_for_reset_pass.blade.php ENDPATH**/ ?>