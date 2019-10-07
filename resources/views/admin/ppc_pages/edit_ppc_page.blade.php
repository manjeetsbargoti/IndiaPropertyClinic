@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit PPC Page</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit PPC Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/ppc/page/'.$ppcPageData->id.'/edit') }}"
                            id="add_ppc_page" name="add_ppc_page" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label for="PPC Title">Title</label>
                                            <input name="title" id="title" type="text" class="form-control" value="{{ $ppcPageData->title }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Url">Url</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $ppcPageData->url }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="PPC for">PPC for</label>
                                            <select name="ppc_type" id="ppc_type" class="form-control">
                                                <option value="" selected>Select PPC type</option>
                                                <option value="1" @if($ppcPageData->ppc_type == 1) selected @endif>Home Services</option>
                                                <!-- <option value="2">Property Area</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Banner Content">Banner Content</label>
                                    <textarea name="banner_content" id="banner_content" class="form-control my-editor">{{ $ppcPageData->banner_content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="description" id="description" class="form-control my-editor">{{ $ppcPageData->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Meta Title">Meta Title</label>
                                    <input type="text" name="meta_title" id="MetaTitle" class="form-control" placeholder="Meta Title" value="{{ $ppcPageData->meta_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="Meta Description">Meta Description</label>
                                    <textarea name="meta_description" id="MetaDescription" class="form-control">{{ $ppcPageData->meta_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Meta Keywords">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="MetaKeywords" class="form-control">{{ $ppcPageData->meta_keywords }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group" id="PhoneNumber">
                                    <label for="Phone no.">Phone no.</label>
                                    <input type="tel" name="phone" class="form-control" id="PpcPhone" placeholder="Phone no." value="{{ $ppcPageData->phone }}">
                                </div>

                                <div class="form-group" id="EmailAddress">
                                    <label for="Email Address">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="PpcEmail" placeholder="Email Address" value="{{ $ppcPageData->email }}">
                                </div>

                                <div class="form-group" id="PpcTemplate">
                                    <label for="Template">Template Design</label>
                                    <select name="template_design" id="template_design" class="form-control">
                                        <option value="1" @if($ppcPageData->template_design) selected @endif>Default (Basic)</option>
                                    </select>
                                </div>

                                <div class="form-group" id="MainServices">
                                    <label for="Main Service">Main Service</label>
                                    <select name="main_service" id="MainServiceList" class="form-control">
                                        <option value="" selected>Select Main Service</option>
                                        @foreach($homeServices as $hs)
                                        <option value="{{ $hs->id }}" @if($hs->id == $ppcPageData->main_service) selected @endif>{{ $hs->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group" id="SubsServiceOn">
                                    <label for="Sub Services">Sub Services(2nd Level)</label>
                                    <select name="sub_service" id="SubServiceList" class="form-control">
                                        
                                    </select>
                                </div>

                                <div class="form-group" id="SubsServiceOn">
                                    <label for="Sub Services">Sub Services (3rd Level)</label>
                                    <select name="subs_service" id="SubsServiceList" class="form-control">
                                        
                                    </select>
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" @if($ppcPageData->status == 1) selected @endif>Enable</option>
                                        <option value="2" @if($ppcPageData->status == 2) selected @endif>Disable</option>
                                    </select>
                                </div>
                                <div class="form-group" id="PpcPageCountry">
                                    <label for="Country">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="" selected>Select Country</option>
                                        @foreach($county_list as $cntry)
                                        <option value="{{ $cntry->iso2 }}" @if($cntry->iso2 == $ppcPageData->country) selected @endif>{{ $cntry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="PpcPageState">
                                    <label for="State">State</label>
                                    <select name="state" id="state" class="form-control" data-placeholder="-- Select State --">
                                        <?php echo $state_dropdown; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="PpcPageCity">
                                    <label for="City">City</label>
                                    <select name="city" id="city" class="form-control" data-placeholder="-- Select City --">
                                        <?php echo $city_dropdown; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Banner Image">Banner Image</label>
                                    <input type="hidden" name="current_image" id="BannerCurrentImage" value="{{ $ppcPageData->banner_image }}">
                                    <input type="file" class="form-control" name="banner_image" id="BannerImage">
                                    @if(!empty($ppcPageData->banner_image))
                                    <img class="img-responsive" width="200" src="{{ url('/images/backend_images/ppc_images/large/'.$ppcPageData->banner_image) }}" alt="{{ $ppcPageData->title }}" >
                                    @endif
                                </div>

                                <div class="form-group" id="IndexStatus">
                                    <label for="Index (yes=index, no=no-index)">Index (yes=index, no=no-index)</label>
                                    <select name="index_status" id="index_status" class="form-control">
                                        <option value="1" @if($ppcPageData->index_status == 1) selected @endif>Yes</option>
                                        <option value="0" @if($ppcPageData->index_status == 0) selected @endif>No</option>
                                    </select>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" id="UpdatePpcPage" class="btn btn-success btn-block btn-md">Update Page</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection