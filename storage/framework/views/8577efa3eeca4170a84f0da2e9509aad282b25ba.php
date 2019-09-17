<?php $__env->startSection('content'); ?>

<style>
body {
    background-image: url('../../bg-tan.webp');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}

#ThankYou {
    padding: 2em 0em;
}

.thankyou_box {
    padding: 2em;
    margin: auto;
    text-align: center;
    background: #fff;
    width: 50em;
    vertical-align: middle;
    box-shadow: 2px 2px 10px #ccc;
}
.thankyou_box h2 {
    color: #171747;
}
.thankyou_box p {
    font-size: 14px;
    color: #f15a27;
    font-weight: 500;
}
</style>

<div class="smart_container">
    <div class="thank_you_page" id="ThankYou">
        <div class="container">
            <div class="row">
                <div class="thankyou_box">
                    <?php if(Session::has('flash_thanx_message')): ?>
                    <strong><?php echo session('flash_thanx_message'); ?></strong>
                    <?php endif; ?>
                    <!-- <h2>Thank you!</h2> -->
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br><br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,<br><br>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p> -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/frontend/templates/thank_you.blade.php ENDPATH**/ ?>