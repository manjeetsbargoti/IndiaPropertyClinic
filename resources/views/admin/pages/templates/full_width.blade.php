@extends('layouts.frontLayout.frontend_design2')
@section('content')

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
    /* margin: auto; */
    /* text-align: center; */
    background: #fff;
    width: 100%;
    vertical-align: middle;
    box-shadow: 2px 2px 10px #ccc;
}
.thankyou_box h2, .thankyou_box h3, .thankyou_box h4, .thankyou_box h5, .thankyou_box h6 {
    color: #171747;
}
.thankyou_box p {
    font-size: 14px;
    color: #000;
    font-weight: 400;
    text-align: justify;
}
.thankyou_box span {
    color: #F15A27;
    font-size: 12px;
}
</style>

<div class="smart_container">
    <div class="thank_you_page" id="ThankYou">
        <div class="container">
            <div class="row">
                <div class="thankyou_box">
                    <h2>Privacy Policy</h2> <span>Updated on: [July 29, 2019]</span>
                    <hr>
                        
                </div>
            </div>
        </div>
    </div>
</div>


@endsection