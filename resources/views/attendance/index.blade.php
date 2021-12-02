<style>
.sorting_disabled {
    display:block !important;
}
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
  /*.table.dataTable thead {
    background-color:green;
    color: #fff;
  }*/
  .dt-buttons {
      float: right;
      margin-left: 20px;
      border-radius: 5px;
    }
</style>

@extends('layouts.app', ['activePage' => 'attendance-report', 'menuParent' => 'Attendance', 'titlePage' => __('Attendance Report')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">{{ __('Attendance Report') }}</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a>
                    </div>
                  </div>
               <!--  <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-rose" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Export') }}</a>
                    </div>
                  </div>
                -->
              
                <a  id="BtnExcel" class="btn btn-primary text-white pull-right"> Send to Approval</a>
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('Employee Id') }}
                      </th>
                      <th>
                          {{ __('Employee Name') }}
                      </th>
                       <th>
                          {{ __('Total days') }}
                      </th>
                       <!-- <th>
                          {{ __('Working days') }}
                      </th> -->
                      <th>
                          {{ __('Present days') }}
                      </th>
                      <th>
                          {{ __('Absent days') }}
                      </th>
                      <th>
                           {{ __('Start On Time') }}
                      </th>
                      <th>
                           {{ __('Late') }}
                      </th>
                      <th>
                           {{ __('Over Time') }}
                      </th>
                       <th>
                           {{ __('Attendance %') }}
                      </th>
                     <!--  <th>
                          {{ __('Remarks') }}
                      </th> -->
                    </thead>
                    <tbody>
                      @php
                        $i=0

                       
                      @endphp
                      @foreach($attendance as $leave)
                        <tr>
                          <td>
                            {{ $leave->employee_id }}
                          </td>
                          <td>
                            {{ $leave->first_name }} {{ $leave->middle_name }} {{ $leave->surname }}
                          </td>
                          <td>
                           {{ date('t') }}
                          </td>
                         
                          <td>
                            {{ $leave->present }}
                          </td>
                           <td>
                            {{ $leave->absent }}
                           </td>
                          <td>
                            {{ $leave->present }}
                          </td>
                          <td>
                              {{ __('0') }}
                          </td>
                           <td>
                              {{ __('0') }}
                          </td>
                          <td>
                              {{ number_format($leave->present / 26  * 100,2) }}
                          </td>
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
           <form method="post" action="{{ url('filter-attn-report') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
               <div class="col-lg-4">
                 <input type="text" class="form-control"  value="{{ $employee_id }}" id="Txtemployee_id" placeholder="Employee Id" name="employee_id">
               </div>
               <div class="col-lg-4">
                 <input type="text" class="form-control datepicker" value="{{ $specific_month }}" id="Txtspecific_month" placeholder="Month" name="specific_month">
               </div>
               <div class="col-lg-4">
                 <input type="text" class="form-control datepicker_year" value="{{ $year }}" id="Txtyear" placeholder="Year" name="year">
               </div><br><br>
               <!--  <div class="col-lg-3">
                 <input type="text" class="form-control datepicker" id="end_month" placeholder="End Month" name="end_month">
               </div><br><br> -->
                 <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd mx-auto d-block" name="Filter" value="Filter">{{ __('Filter') }}</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script>
     $('.datepicker').datetimepicker({
          viewMode : 'months',
          format : 'MM-YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
    });
     $('.datepicker_year').datetimepicker({
          viewMode : 'years',
          format : 'YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
    });
    $.ajaxSetup({
        headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#BtnExcel').click(function() {   //alert('v');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var base_url = window.location.origin;
    $readValue = $(this).attr('data-value');
    $token     = $('meta[name=csrf-token]').attr("content");
    
    $employee_id = $('#Txtemployee_id').val();
    $specific_month = $('#Txtspecific_month').val();
   // alert($employee_id);
    $year = $('#Txtyear').val();
        $.ajax({
        type: "POST",
        url: "/exportnew", 
        data: {employee_id: $employee_id,specific_month: $specific_month,year: $year, _token:"{{csrf_token()}}"},
       dataType: 'JSON',
        success: function (data) {
          if(data.status == true)
          {
              Swal.fire(
              'Attendance Report Send to approval successfully!',
              //'You clicked the button!',
            //  'success'
              );

          }
          else
          {
            Swal.fire(
              'You can not send approvel before add reporting to!',
              //'You clicked the button!',
           //   'error'
              );
            
          }
        
        }
    });
});
   

    $(document).ready(function() {

    $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        targets: [10,11],
        dom: 'lBfrtip',
        // buttons: [
        //             'excel'
        //         ],
        searching: false,
        buttons: [
        {  
            extend: 'excelHtml5',
            className: 'btn-info',
            text: 'Export',
            filename: function(){
                var dt = new Date();
                dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                return 'attn-report-' + dt;
            },
            //title: 'alpin_excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                },
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            }
        }
      ],
        responsive: true,
      });
  });
//   $(document).ready(function() {
//     $(".dt-buttons").click(function(){
//         $.ajax({
//           url: '/excel_approval',
//           type: 'GET',
//           //data: {'_token': csrf},
//           dataType: 'json',
//           success: function( data ) {
//             //alert(data);
//           }
//     });
//  });
// });
   // $("#datatables").table2excel({
   //      filename: "Students.xls"
   //  });
  </script>
  
@endpush