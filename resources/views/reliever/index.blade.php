<style>
/*.sorting_disabled {
    display:block !important;
}*/
.display-block{
     display:table-cell !important;
}
.btn-action{
     padding: 0px 0px !important;
}
.view-edit{
  padding: 10px 15px !important;
  margin: 0.3125rem 1px !important;
}

 .borderless tr, .borderless td, .borderless th {
    border: none !important;
   }

</style>

@extends('layouts.app', ['activePage' => 'reliever', 'menuParent' => 'Reliever', 'titlePage' => __('Employee Relieving')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title">{{ __('Relieving Employee') }}</h4>
              </div>	
              <div class="card-body">

         <!--        <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a>
                    </div>
                  </div>-->
             
                 @canany(['isHuman_Resource'],App\User::class) @endcan
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('reliever.create') }}" class="btn btn-sm btn-rose">{{ __('Add Relieve') }}</a>
                    </div>
                  </div>
               
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('Employee') }}
                      </th>
                    
                      <th>
                          {{ __('Employee Reliever') }}
                      </th>
                     
                      <th>
                          {{ __('From Date') }}
                      </th>
                       <th>
                          {{ __('To Date') }}
                      </th>

                      <th>
                          {{ __('Reason') }}
                      </th>
                     
                      
                     
                      <!-- <th class="display-block">
                            {{ __('Action') }}
                      </th> -->

                     
                    </thead>
                    <tbody>

                      @php

                        $i=0

                      @endphp


                    
                      @foreach($employee as $emp)
                     
                        <tr>
                         
                          <td>
                          {{ $emp->employee->first_name.' '.$emp->employee->surname }}
                          ({{$emp->employee->employee_id}})
                          </td>

                          <td>
                            {{ $emp->reliever->first_name.'  '.$emp->reliever->surname }}
                            ({{$emp->reliever_id}})
                          </td>

                          <td>
                            {{ date('d-m-Y', strtotime($emp->from_date)) }} 
                          </td>
                          <td>
                            {{ date('d-m-Y', strtotime($emp->to_date)) }} 
                          </td>
                          <td>
                            {{ $emp->reason}}
                          </td>
                          
        <!-- @canany(['isHuman_Resource'],App\User::class)

     <td class="display-block">
        <form action="{{ route('reliever.destroy', $emp->id ) }}" method="post">
              @csrf
              @method('delete')
              
             
                <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this reliever?") }}') ? this.parentElement.submit() : ''">
                    <i class="material-icons">close</i>
                    <div class="ripple-container"></div>
                </button>
            
          </form>
      </td> 
      @endcan -->


                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<!--Filter for employee Reporting To -->

  <div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form method="post" action="{{ url('filter_emp_reporting_to') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
                <div class="col-lg-4">
                    
                          <select class="form-control selectpicker"  data-style="select-with-transition" title="Select Employee" data-size="7" name="employee_id" id="input-employee_id"  value="{{ old('employee_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select Employee</option>
                   
                        @foreach ($employee as $emp)
                            <option value="{{$emp->employee_id}}" >   
                              {{$emp->employee->first_name }}
                              {{$emp->employee->middle_name }} 
                              {{$emp->employee->surname }} 
                              ({{$emp->employee_id}})</option>
                        @endforeach
                         
                      </select>
                   
                     
                   </div>
                     <div class="col-lg-4">
                    
                          <select class="form-control selectpicker"  data-style="select-with-transition" title="Select Employee Reporting To" data-size="7" name="reporting_to_emp_id" id="input-reporting_to_emp_id"  value="{{ old('reporting_to_emp_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select Employee Reporting To</option>
                   
                       
                         
                      </select>
                   
                     
                   </div>

                 
                    <b><button type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                   
                 </div> 
              </form>
    
      <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



  <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form>

          <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
                <tr>
                  <th>Passport Number </th>
                  <td id="passport_no"></td>
                </tr>
                 <tr>
                  <th>Nationality </th>
                  <td id="nationality"></td>
                </tr>
                 <tr>
                  <th>Joining Date  </th>
                  <td id="joining_date"></td>
                </tr>
                 <tr>
                  <th>Passport Expiry Date  </th>
                  <td id="passport_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Expiry Date  </th>
                  <td id="visa_exp_date"></td>
                </tr>
               
              </table>

            </div>

             <div class="col-lg-6">
              <table class="table table-responsive borderless">
                <tr>
                  <th>Medical Insurance No. </th>
                  <td id="medical_ins_no"></td>
                </tr>
                <tr>
                  <th>Medical Insurance Expiry Date </th>
                  <td id="medical_ins_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Company Name </th>
                  <td id="visa_campany_name"></td>
                </tr>
                 <tr>
                  <th>Employee Score  </th>
                  <td id="employee_score"></td>
                </tr>
               
               
              </table>
            </div>
          </div>


          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Passport Number:</label> <span for="recipient-name" class="col-form-label"></span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nationality:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Joining Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Passport Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance No.:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Company Name:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Employee Score:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> -->

@endsection

@push('js')
  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search employees",
        },
        "columnDefs": [
          { "orderable": false, "targets": 4 },
        ],

      });
    });

    function view_employee(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_employee',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);

             // alert(JSON.stringify(data[0]['id']));

            $("#passport_no").html(': '+data[0]['passport_number']);
            $("#nationality").html(': '+data[0]['nationality']);
            $("#joining_date").html(': '+data[0]['joining_date'])
            $("#visa_exp_date").html(': '+data[0]['visa_exp_date'])
            $("#passport_exp_date").html(': '+data[0]['passport_exp_date'])
            $("#medical_ins_no").html(': '+data[0]['medical_ins_no'])
            $("#medical_ins_exp_date").html(': '+data[0]['medical_ins_exp_date'])
            $("#visa_campany_name").html(': '+data[0]['visa_company_name'])
            $("#employee_score").html(': '+data[0]['employee_score'])

          }       
      })

    }


  </script>
@endpush
