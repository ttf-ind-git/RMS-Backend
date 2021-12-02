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



<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><?php echo e(__('CDE Reporting')); ?></h4>
              </div>	
              <div class="card-body">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="<?php echo e(route('cde_reporting.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Reporting')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                       <th>
                          <?php echo e(__('#')); ?>

                      </th> 
                      <th>
                          <?php echo e(__('Employee')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Reporting_To')); ?>

                      </th>
                     
                       <th>
                          <?php echo e(__('Reporting Date')); ?>

                      </th>
                       <th>
                          <?php echo e(__('Reporting End Date')); ?>

                      </th>
                      
                     
                      <th class="display-block">
                            <?php echo e(__('Action')); ?>

                        </th>

                     
                    </thead>
                    <tbody>

                      <?php

                        $i=0

                      ?>

                       <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     
                        <tr>

                        <td>
                            <?php echo e(++$i); ?>

                        </td>
                         
                          <td>
                          <?php echo e($emp->merchandiser->first_name); ?> <?php echo e($emp->merchandiser->middle_name ? $emp->merchandiser->middle_name : ''); ?> <?php echo e($emp->merchandiser->surname ? $emp->merchandiser->surname : ''); ?> (<?php echo e($emp->merchandiser->employee_id); ?>) 
                          </td>
                          <td>
                            <?php echo e($emp->cde_reporting->first_name); ?> <?php echo e($emp->cde_reporting->middle_name ? $emp->cde_reporting->middle_name : ''); ?> <?php echo e($emp->cde_reporting->surname ? $emp->cde_reporting->surname : ''); ?>

                          </td>
                        
                          <td>
                            <?php echo e(date('d-m-Y', strtotime($emp->reporting_date))); ?> 
                          </td>
                          <td>
                            <?php echo e(date('d-m-Y', strtotime($emp->reporting_end_date))); ?> 
                          </td>
                          
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>

                            <td class="display-block">
                                <form action="<?php echo e(route('cde_reporting.destroy', $emp->id )); ?>" method="post">
                                      <?php echo csrf_field(); ?>
                                      <?php echo method_field('delete'); ?>
                                      
                                    <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="<?php echo e(route('cde_reporting.edit', 
                                      $emp->id )); ?>" data-original-title="" title="">
                                          <i class="material-icons">edit</i>
                                          <div class="ripple-container"></div>
                                        </a>
                                    
                                        <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm('<?php echo e(__("Are you sure you want to delete this cde reporting?")); ?>') ? this.parentElement.submit() : ''">
                                            <i class="material-icons">close</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    
                                  </form>
                                  </td> 
                             <?php endif; ?>


                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
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
        }

      });
    });

   


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'cde_reporting', 'menuParent' => 'Cde_Reporting', 'titlePage' => __('CDE Reporting')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/cde_reporting/index.blade.php ENDPATH**/ ?>