@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add category</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Category</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-9">

        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.categories.add') }}" novalidate="novalidate">
          <div class="box box-info">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
              <strong>{!! session('success') !!}</strong>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-error alert-dismissible">
              <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
              <strong>{!! session('error') !!}</strong>
            </div>
            @endif
            <!-- /.box-header -->
            {{ csrf_field() }}
            <div class="box-body">
              <div class="row">
                  <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                          <label for="Page Title">Title</label>
                          <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                          @if ($errors->has('title'))
                          <label class="error">{{ $errors->first('title') }}</label>
                          @endif
                      </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                          <label for="Url">Url</label>
                          <div class="input-group">
                              <span class="input-group-addon">Url</span>
                              <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                              @if ($errors->has('slug'))
                              <label class="error">{{ $errors->first('slug') }}</label>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" id="description" class="form-control my-editor">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <label class="error">{{ $errors->first('description') }}</label>
                @endif
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" value="1" name="status" id="status" class="minimal-red"> Enable
                </label>
              </div>
              <div class="form-group">
                <label for="Service Image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                @if ($errors->has('image'))
                <label class="error">{{ $errors->first('image') }}</label>
                @endif
              </div>
            </div>
            <!-- /.box-body -->
          </div>


          <!---->

          <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">

              <div class="form-group">
                <label for="Meta Title">Meta Title</label>
                <input name="meta_title" id="MetaTitle" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label for="Meta Description">Meta Description</label>
                <textarea name="meta_description" id="MetaDescription" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label for="Meta Keywords">Meta Keywords</label>
                <textarea name="meta_keywords" id="MetaKeywords" class="form-control"></textarea>
              </div>
              
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-md pull-right">Submit</button>
              </div>
            </div>
            <!-- /.box-body -->

          </div>
        </form>
        <!---->

      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $("input[name='title']").keyup(function(){
    var val = $(this).val();

    if(val != ''){
      $.ajax({
         type:'POST',
         url:'{{ route("admin.categories.get-slug") }}',
         data:{'_token': '<?php echo csrf_token() ?>', 'title': val},
         success:function(data) {
            if(data.status == true){
              $("input[name='slug']").val(data.slug);
            }
         }
      });
    }
  });
</script>

@endsection