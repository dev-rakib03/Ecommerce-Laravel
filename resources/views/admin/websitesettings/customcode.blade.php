@extends('admin/layout')
@section('page_title','Custom Code')
@section('custom_code','active')
@section('container')


@error('image')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div>
@enderror
    <h1 class="mb10">Custom Code</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('customcodesetting.update')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Facebook Pixel</label>
                                            <textarea name="fb_pixel" class="form-control" aria-required="true" aria-invalid="false" style="min-height: 300px;">{{ $fb_pixel??'<!--add facebook pixel code-->' }}</textarea>
                                            @error('fb_pixel')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Custom CSS</label>
                                            <textarea name="custom_css" class="form-control" aria-required="true" aria-invalid="false" style="min-height: 300px;">{{ $css??'/'.'*add custom css*/' }}</textarea>
                                            @error('custom_css')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Custom JS</label>
                                            <textarea name="custom_js" class="form-control" aria-required="true" aria-invalid="false" style="min-height: 300px;">{{ $js??'//add custom JS' }}</textarea>
                                            @error('custom_js')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        update
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
