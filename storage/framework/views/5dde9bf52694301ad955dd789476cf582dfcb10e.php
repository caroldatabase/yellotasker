
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
             <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                   <?php echo $__env->make('packages::partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase"><?php echo e($heading); ?></span>
                                    </div>
                                     
                                     
                                </div>
                                  
                                    <?php if(Session::has('flash_alert_notice')): ?>
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         <?php echo e(Session::get('flash_alert_notice')); ?> 
                                         </div>
                                    <?php endif; ?>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                         
                                         <div class="col-md-2 pull-right">
                                             <a href="<?php echo e(route('comment')); ?>">   <input type="button" value="Back" class="btn btn-primary form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>

                                    <?php if(isset($result->commentReply) && count($result->commentReply)==0): ?>
                                        Record Not found!
                                    <?php endif; ?>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                             <th> Id </th>
                                                <th> Task Title </th>
                                                <th> Posted By </th>  
                                                <th> Comment </th> 
                                                <th>Created Date</th>  
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($comments as $key => $result): ?>
                                        <?php foreach($result->commentReply as $key => $result): ?>
                                            <tr>
                                             <td><?php echo e(++$key); ?></td>
                                                <td> 
                                                <td><?php echo e($result->taskDetail->title); ?></td>
                                                <td> 

                                                <?php if(isset($result->userDetail->first_name)): ?>
                                                    <?php echo e($result->userDetail->first_name.' '. $result->userDetail->last_name); ?>

                                                <?php endif; ?>

                                               </td>
                                                <td><?php echo e($result->commentDescription); ?></td>
                                                <td><?php echo e($result->created_at); ?></td>
                                                
                                                <td> 
                                                    <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('comment.destroy', $result->id))); ?>

                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                    <?php echo Form::close(); ?> 
                                                </td> 
                                            </tr>
                                             <?php endforeach; ?> 
                                           <?php endforeach; ?> 
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            
            
            <!-- END QUICK SIDEBAR -->
        </div>
        