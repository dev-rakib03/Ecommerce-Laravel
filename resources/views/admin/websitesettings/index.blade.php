@extends('admin/layout')
@section('page_title','Website Settings')
@section('website_settings','active')
@section('container')


@error('image')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror
    <h1 class="mb10">Website Settings</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('websitesetting.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Website Name *</label>
                                            <input value="{{env('SITE_NAME')}}" name="site_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('site_name')
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
                                            <label for="color" class="control-label mb-1">Site Logo(PNG) </label>
                                            <input name="site_logo" type="file" accept="image/png" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('site_logo')
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
                                            <label for="color" class="control-label mb-1">Logo For Invoice(JPG)</label>
                                            <input name="logo_invoice" type="file" accept="image/jpg" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('logo_invoice')
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
                                            <label for="color" class="control-label mb-1">Site Favicon(PNG) </label>
                                            <input name="favicon" type="file" accept="image/png" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('favicon')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}		
                                            </div>
                                            @enderror 
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <br>
                                <h3>Contact Info</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Contact Email *</label>
                                            <input value="{{env('SITE_EMAIL')}}" name="contact_email" type="email" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('contact_email')
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
                                            <label for="color" class="control-label mb-1">Contact Phone *</label>
                                            <input value="{{env('SITE_PHONE')}}" name="contact_phone" type="tel" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('contact_phone')
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
                                            <label for="color" class="control-label mb-1">Contact Address *</label>
                                            <input value="{{env('SITE_ADDRESS')}}" name="contact_address" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('contact_address')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}		
                                            </div>
                                            @enderror 
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <br>
                                <h3>Social Link</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Facebook Link </label>
                                            <input value="{{env('SITE_FACEBOOK')}}" name="site_facebook" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('site_facebook')
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
                                            <label for="color" class="control-label mb-1">Twitter Link </label>
                                            <input value="{{env('SITE_TWITTER')}}" name="site_twitter" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('site_twitter')
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
                                            <label for="color" class="control-label mb-1">Instagram Link </label>
                                            <input value="{{env('SITE_INSTAGRAM')}}" name="site_instagram" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('site_instagram')
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
                                            <label for="color" class="control-label mb-1">Youtube Link </label>
                                            <input value="{{env('SITE_YOUTUBE')}}" name="site_youtube" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('site_youtube')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}		
                                            </div>
                                            @enderror 
                                        </div>
                                        
                                    </div>
                                </div>
                                <br>
                                <h3>Shipping Charge</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label mb-1">Inside Dhaka* </label>
                                            <input value="{{env('IN_DHAKA')}}" name="in_dhaka" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('in_dhaka')
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
                                            <label for="color" class="control-label mb-1">Outside Dhaka* </label>
                                            <input value="{{env('OUT_DHAKA')}}" name="out_dhaka" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('out_dhaka')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}		
                                            </div>
                                            @enderror 
                                        </div>
                                        
                                    </div>
                                </div>
                                

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
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