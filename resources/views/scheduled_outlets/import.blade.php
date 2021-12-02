
@extends('layouts.app', ['activePage' => 'scheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __('Scheduled Timesheet')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('import_timesheet') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                 <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title">{{ __('Import Timesheet') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                   
                     <a href="{{ route('schedule-outlets.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Scheduled Timesheet') }}</a>
                    
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Excel / Csv') }}</label>
                  <div class="col-sm-7">
                   <input class="form-control{{ $errors->has('timesheet_import') ? ' is-invalid' : '' }}" type="file" name="timesheet_import"  >

                    <a  download href="{{URL::to('/')}}/import_formats/timsheet.xlsx"  rel="tooltip"
                   data-original-title="Download" >Download Sample Format</a>
                   
                    
                      @include('alerts.feedback', ['field' => 'timesheet_import'])
                      
                    </div>
                  </div>
                </div> 
               
              
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Import') }}</button>

               </div>
              
              </div> 
            </div>


                 @if ($message = Session::get('warning'))
                  <div class="alert alert-warning alert-block" style="margin:auto;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                  </div>
                  @endif
                

          </form>

        </div>
      </div>
    </div>
  </div>
@endsection


