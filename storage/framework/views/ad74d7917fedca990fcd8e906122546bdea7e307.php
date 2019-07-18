<html>
    <head>
        <title>IPC | Generate your password for Login</title>
    </head>
    <body>
        <table>
            <tr><td>Dear <?php echo e($name); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: <?php echo e($email); ?></td></tr>
            <tr><td>Phone: <?php echo e($phonecode); ?>-<?php echo e($phone); ?></td></tr>
            <tr><td>Listed Property: <a href="<?php echo e(url('/properties/'.$property_url)); ?>"><?php echo e($property_name); ?></a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>Please click on below link to generate password and activate your account:</strong></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a class="btn btn-success btn-lg" href="<?php echo e(url('/password/reset?email='.$code)); ?>">Generate Password</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>India Property Clinic</td></tr>
        </table>
    </body>
</html><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/emails/user_register_list_property.blade.php ENDPATH**/ ?>