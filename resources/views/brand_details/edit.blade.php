@extends('layouts.app', ['activePage' => 'brand_details', 'menuParent' => 'Products', 'titlePage' => __('Brand Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          
          <form method="post" action="{{ route('brand_details.update',$branddetails[0]->id) }}" autocomplete="off" class="form-horizontal">
          
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-copyright"></i>
                </div>
                <h4 class="card-title">{{ __('Edit Brand') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                      <a href="{{ route('brand_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Brand') }}</a>
                     @endcan
                  </div>
                </div>
                
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" id="input-brand_name" type="text" placeholder="{{ __('Brand') }}" value="{{ old('brand_name',$branddetails[0]->brand_name) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'brand_name'])
                    </div>
                  </div>
                </div>
                
               <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Client') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
             
                     <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="{{ old('client_id') }}" aria-required="true" >
 		                   	
    
                       @foreach ($employ_client as $employ1)
                	 
                       <option value="{{ $employ1->employee_id }}" @if ( $employ1->employee_id == $branddetails[0]->client_id ) {{ 'selected' }} @endif>
                         
                       {{  $employ1->first_name  }}{{  $employ1->middle_name  }}{{  $employ1->surname  }}
                       
                   	({{ $employ1->employee_id}}) </option> 
      
 		
    			@endforeach
    			
			</select>
			
                      @include('alerts.feedback', ['field' => 'client_id'])
                    </div>
                  </div>
                </div> -->
             
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Field Manager') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('field_manager_id') ? ' has-danger' : '' }}">
                    
 
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Field Manager" data-size="7" name="field_manager_id" id="input-field_manager_id" 
                     value="{{ old('field_manager_id') }}" aria-required="true" >

                       
                       @foreach ($employ_field as $employ2)
                   	<option value="{{ $employ2->employee_id  }}" @if ( $employ2->employee_id == $branddetails[0]->field_manager_id ) 
                   	{{ 'selected' }} @endif> {{  $employ2->first_name  }}{{  $employ2->middle_name  }}{{  $employ2->surname  }}
                   	({{ $employ2->employee_id}})</option>
    			@endforeach
    			
			</select>
                      @include('alerts.feedback', ['field' => 'field_manager_id'])
                    </div>
                  </div>
                </div>
                
               
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Sales Manager') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('sales_manager_id') ? ' has-danger' : '' }}">
                    
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="sales_manager_id" id="input-sales_manager_id" 
                     value="{{ old('sales_manager_id') }}" aria-required="true" >
 
                      
                       @foreach ($employ_sales as $employ3)
                   	<option value="{{ $employ3->employee_id }}" @if ( $employ3->employee_id == $branddetails[0]->sales_manager_id) 
                   	{{ 'selected' }} @endif>
                   	 {{  $employ3->first_name  }}{{  $employ3->middle_name  }}{{  $employ3->surname  }}
                   	({{ $employ3->employee_id}})</option>
    			@endforeach
    			
			</select>
                      @include('alerts.feedback', ['field' => 'sales_manager_id'])
                    </div>
                  </div>
                </div>
          
             
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('update') }}</button>
              </div>
              
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
 <script>
 $(function () {
                  
        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY',
            
        });
  });
  
 
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 
  </script>
  
 
@endpush
