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



</style>

@extends('layouts.app', ['activePage' => 'promotion', 'menuParent' => 'Promotion', 'titlePage' => __('Promotion')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        
            <div class="card">
             
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-tag"></i>
                 </div>
                <h4 class="card-title">{{ __('Promotion') }}</h4>
               </div>
               
              <div class="card-body">
              
               @canany(['isHuman_Resource','isField_Manager'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('promotion.create') }}" class="btn btn-sm btn-rose">{{ __('Add Promotion') }}</a>
                    </div>
                  </div>
                @endcan
                
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" >
                  
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('S.No') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet') }}
                      </th>
                      
                      <th>
                          {{ __('Product') }}
                      </th>
                      
                      <th>
                          {{ __('From Date') }}
                     </th>

                     <th>
                          {{ __('To Date') }}
                     </th>

                     <th>
                          {{ __('Description') }}
                     </th>

                      <th>
                          {{ __('Action') }}
                     </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0

                      @endphp


                       @foreach($result as $promo)
                     
                        <tr>
                        
                          <td>
                            {{ ++$i }}
                          </td>
                          
                          <td>
                             
                              {{ $promo->store_code }} - {{ $promo->store_name  }} - {{ $promo->address }} - {{ $promo->outlet_city }}

                          </td>
                          
                          <td>
                            {{  $promo->product_name }}
                          </td>

                          <td>
                            {{ date('d-m-Y',strtotime($promo->from_date)) }}
                          </td>

                           <td>
                            {{ date('d-m-Y',strtotime($promo->to_date)) }}
                          </td>

                           <td>
                            {{  $promo->description }}
                          </td>
                          
                          
                            @canany(['isField_Manager'],App\User::class)
                             <td class="display-block">
                              <form action="{{ route('promotion.destroy', $promo->id) }}" method="post">
                                @csrf
                                @method('delete')
                                  <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('promotion.edit', 
                                  $promo->id) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                      
                                  <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title=""         onclick="confirm('{{ __("Are you sure you want to delete this promotion?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                                      
                               </form>
                             </td> 
                         @endcan
              
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
          searchPlaceholder: "Search..",
        }
      });
    });
    
   
     
  </script>
@endpush
