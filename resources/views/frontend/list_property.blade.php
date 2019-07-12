@extends('layouts.frontLayout.frontend_design2')
@section('content')

<div class="vender_formsec">
    <div class="vender_header">
        <a class="backtohome" href="{{ url('/') }}">Back To Home</a>
    </div>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-md-8 col-lg-8 col-xl-8 vender_formleft p-0">
                <div class="mainform">
                    <form id="regForm" action="#">
                        <div class="stepstrip">
                            <ul>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Personal Details</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Property Location</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Property Information</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Upload Images</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Submit</p>
                                </li>
                            </ul>
                        </div>
                        <div class="mainform_inn">
                            <!-- One "tab" for each step in the form: -->
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading">Personal Details</h6>
                                    <label>I am</label>
                                    <div class="radioblock">
                                        <ul>
                                            <li>
                                                <label class="radio_container">Owner
                                                    <input type="radio" id="UserType1" checked="checked"
                                                        name="user_type">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio_container"> Agent
                                                    <input type="radio" id="UserType2" name="user_type">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio_container"> Builder
                                                    <input type="radio" id="UserType3" name="user_type">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Mobile</label>
                                        <input type="tel" id="phone" name="phone" required class="form-control"
                                            placeholder="Enter mobile number">
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Email</label>
                                        <input type="email" id="email" name="email" required class="form-control"
                                            placeholder="Enter your email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                </div>
                                <div class="formboxed">
                                    <h6 class="formheading">About Property Details</h6>
                                    <label class="title_txt">For</label>
                                    <div class="radioblock">
                                        <ul>
                                            <li>
                                                <label class="radio_container">Sale
                                                    <input type="radio" checked="checked" name="property_for">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio_container"> Rent
                                                    <input type="radio" name="property_for">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Property Type</label>
                                        <select id="PropertyType" class="form-control">
                                            @foreach(\App\PropertyTypes::get() as $pt)
                                            <option value="{{ $pt->property_type_code }}">{{ $pt->property_type }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading">Property Location</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Country</label>
                                                <select id="country" name="country" class="form-control">
                                                    <option selected value="">Select Country</option>
                                                    @foreach(\App\Country::get() as $country)
                                                    <option value="{{ $country->iso2 }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">State</label>
                                                <select id="state" name="state" class="form-control">
                                                    <option selected value="">Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">City</label>
                                                <select id="city" name="city" class="form-control">
                                                    <option selected>Select City</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Zip Code</label>
                                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                                    placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Locality</label>
                                        <input type="text" class="form-control" name="locality" id="locality"
                                            placeholder="Enter locality">
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">House no./Flat no.</label>
                                        <input type="text" class="form-control" name="houseno" id="houseno"
                                            placeholder="Enter House no / Flat no">
                                    </div>
                                    <!-- <div class="formmap">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13998.63502405659!2d77.12001999999998!3d28.6998528!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1551258837470"
                                            width="600" height="250" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="checkbox_container"> I am posting this property 'exclusively' on
                                            IPC
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading">Property Details</h6>
                                    <div class="form-group">
                                        <label class="title_txt">Property Name</label>
                                        <input type="text" name="property_name" id="property_name" class="form-control"
                                            placeholder="Enter property name">
                                    </div>
                                    <div class="form-group d-none">
                                        <label class="title_txt">Property URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">URL</div>
                                            </div>
                                            <input type="text" name="slug" class="form-control" id="slug">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Transaction Type</label>
                                                <select id="TransectionType" name="transection_type"
                                                    class="form-control">
                                                    <option>New Booking</option>
                                                    <option>Resale</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Construction Status</label>
                                                <select id="PropertyFace" class="form-control">
                                                    <option>Ready to Move</option>
                                                    <option>Under Construction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-xl-3">
                                            <div class="form-group">
                                                <label class="title_txt">Bedrooms</label>
                                                <select id="PropertyFace" class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-xl-3">
                                            <div class="form-group">
                                                <label class="title_txt">Bathroom</label>
                                                <select id="PropertyFace" class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Furnish Type</label>
                                                <select id="PropertyFace" class="form-control">
                                                    <option>Fully Furnished</option>
                                                    <option>Semi Furnished</option>
                                                    <option>Unfurnished</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Property Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text select_padding">
                                                            <select class="select_custom" id="">
                                                                <option selected>$</option>
                                                                <option value="1">₹</option>
                                                                <option value="2">AED</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                        placeholder="Property price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Property Area</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">sq/ft.</div>
                                                    </div>
                                                    <input type="number" class="form-control" id="inlineFormInputGroup"
                                                        placeholder="15000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Property Code</label>
                                                <input type="number" class="form-control" id="inlineFormInputGroup"
                                                    placeholder="15000">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Facing</label>
                                                <select id="PropertyFace" class="form-control">
                                                    <option>East Facing</option>
                                                    <option selected>West Facing</option>
                                                    <option>South Facing</option>
                                                    <option>North Facing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Property Age</label>
                                                <select id="PropertyAge" class="form-control">
                                                    <option>Under Construction</option>
                                                    <option>Under Maintenance</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="formboxed">
                                    <h6 class="formheading">Share commercials for your property</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Plot Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text select_padding">
                                                            <select class="select_custom" id="">
                                                                <option selected>$</option>
                                                                <option value="1">₹</option>
                                                                <option value="2">AED</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                        placeholder="Property price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Maintenance Charges</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text select_padding">
                                                            <select class="select_custom" id="">
                                                                <option selected>$</option>
                                                                <option value="1">₹</option>
                                                                <option value="2">AED</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                        placeholder="Property price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Brokerage</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text select_padding">
                                                            <select class="select_custom" id="">
                                                                <option selected>$</option>
                                                                <option value="1">₹</option>
                                                                <option value="2">AED</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                        placeholder="Property price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading text-center">Upload Property Images</h6>
                                    <div class="upload_field ">
                                        <div class="upload_fieldinn">
                                            <input type="button" class="custom-file-input" id="add_more"
                                                value="add image" />
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <small class="mt-3" style="display:block;">(max limit 5 MB per image)</small>
                                    </div>
                                    <div class="uploaded_images">
                                        <ul class="add_image">
                                        </ul>
                                    </div>
                                    <div class="subtxtouter">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="subtxt">
                                                    <p><i class="far fa-check-circle"></i><span class="bold">Atleast 8
                                                            photos</span> will increase property quality score by 15%
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="subtxt">
                                                    <p><i class="far fa-check-circle"></i><span class="bold">Hall,
                                                            Bedroom, Kitchen and Bathroom</span> photos will get more
                                                        points in quality score</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vender_footer">
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 venderbanner">
                <div class="vender_right">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection