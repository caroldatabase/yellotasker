            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
             <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                   @include('packages::partials.breadcrumb')

                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET--> 
                        <div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-red"></i>
                                    <span class="caption-subject font-red sbold uppercase">{{ $heading }}</span>
                                </div>
                                <div class="col-md-2 pull-right">
                                        <div style="" class="input-group"> 
                                            <a href="{{ route('contact.create')}}">
                                                <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Contact</button> 
                                            </a>
                                        </div>

                                </div> 
                                <div class="col-md-2 pull-right">
                                    <div style="" class="input-group"> 
                                        <a href="{{ route('contact')}}">
                                            <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Group</button> 
                                        </a>
                                    </div> 
                                </div>
                                 <div class="col-md-3 pull-right">
                                    <div style="" class="input-group"> 
                                        <a href="{{url::to('admin/contactGroup?export=pdf')}}">
                                            <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Export Groups to pdf</button> 
                                        </a>
                                    </div> 
                                </div>  
                            </div>
                                  
                            @if(Session::has('flash_alert_notice'))
                                 <div class="alert alert-success alert-dismissable" style="margin:10px">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                  <i class="icon fa fa-check"></i>  
                                 {{ Session::get('flash_alert_notice') }} 
                                 </div>
                            @endif
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <form action="{{route('contactGroup')}}" method="get" id="filter_data">
                                         
                                            <div class="col-md-3">
                                                <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="Search by group name" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                       
                                        </form>
                                        <div class="col-md-2">
                                             <a href="{{ route('contactGroup') }}">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                    </div>
                                </div>  
                            </div>
                            <div class="portlet box  portlet-fit bordered"> 
                                <div class="portlet-body"> 
                                 
                                    @foreach($contactGroup as $key => $result) 
                                    <?php $i = ++$key; ?>
                                    <div class="panel-group accordion" id="accordion{{$i}}">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding: 10px">

                                                
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion{{$i}}" href="#collapse_{{$i}}" aria-expanded="false"> 
                                            {{ ucfirst($result->groupName)}} </a>  
                                             <a onclick="updateGroup('{{url("admin/createGroup")}}','{{$result->groupName}}')" class="red  pull-right red-outline sbold" data-toggle="modal" href="#responsive" id="{{ ucfirst($result->groupName)}}"> 
                                                <i class="fa fa-plus-circle"></i> 
                                            Add or Edit </a> 
                                                

                                            </div>
                                            <div id="collapse_{{$i}}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <table class="table table-striped table-hover table-bordered" id=""> 
                                                        <thead>
                                                            <tr>
                                                                <th>Sno</th>
                                                                <th> Name </th>
                                                                <th> Email </th> 
                                                                <th> Position </th> 
                                                                 <th> Phone </th> 
                                                                <th>Created date</th> 
                                                                <th>Action</th> 
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                                        @foreach($result->contactGroup as $key => $contact)
                                                            @if(isset($contact->contact))
                                                            <tr>
                                                                <td>{{ ++$key }}</td>
                                                                <td> {{$contact->contact->firstName.' '.$contact->contact->lastName}} </td>
                                                                <td> {{$contact->contact->email}} </td>
                                                                <td> {{$contact->contact->position}} </td>
                                                                <td> {{$contact->contact->phone}} </td>
                                                                <td>
                                                                    {!! Carbon\Carbon::parse($contact->created_at)->format('Y-m-d'); !!}
                                                                </td>
                                                                <td> 
                                                                       <!--  <a href="{{ route('contactGroup.edit',$result->id)}}">
                                                                            <i class="fa fa-edit" title="edit"></i> 
                                                                        </a> -->

                                                                    {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$contact->id, 'route' => array('contactGroup.destroy', $contact->id))) !!}
                                                                    <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$contact->id}}"><i class="fa fa-fw fa-trash" title="Delete"></i></button> 
                                                                    {!! Form::close()  !!}
                                                                </td> 
                                                            </tr>
                                                            @endif
                                                           @endforeach 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    @endforeach
                                </div>
                             <div class="center" align="center">  
                             {{ $contactGroupPag->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() }}</div>
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
        
<form id="import_contact" action="" method="post" encytype="multipart/form-data">
 <div id="responsive" class="modal fade" tabindex="-1" data-width="300"  style="height: 500px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #efeb10 !important">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Import Contact Name</h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll">
            
                <div class="row">
                    <div class="col-md-12">
                        <h4>Group Name</h4>
                        
                        
                         <div class="form-group {{ $errors->first('categoryName', ' has-error') }}">
                            <input type="text" class="form-control" name="contact_group" id="contact_group"> 
                             <h4>Select contact from list</h4>
                             <span id="error_msg_grp"></span>
                            <div class="portlet-body" >   
                                <table class="table table-striped table-hover table-bordered" id="contact">
                                        <thead>
                                            <tr>
                                             <th>  
                                                
                                              <input type="checkbox" onchange="checkAllContact(this)" name="chk[]" />  
                                               </th>
                                            
                                                <th> Name </th>
                                                <th> Email </th> 
                                                <th> Phone </th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contacts as $key => $result)
                                        <?php $chk = $helper->contactName($result->id);   ?>
                                            <tr>
                                             <th> 
                                                <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="{{$result->id }}" name="checkAll" class="checkAll contactChk" @if($chk==1){{'checked'}}@endif > 
                                                    <span></span>
                                                </label>

                                             </th> 
                                                <td> 
                                                    {{$result->firstName.' '.$result->lastName}}
                                                 </td>
                                                 <td> {{$result->email}} </td>
                                                 <td> {{$result->phone}} </td> 
                                                    
                                            </tr>
                                           @endforeach
                                            
                                        </tbody>
                                    </table>
                                                                 
                            </div> 
                        </div> 
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn red" id="save"  onclick="updateGroup('{{url("admin/createGroup")}}','update')" >Update</button>
            </div>
        </div>
    </div>
</div>
</form>