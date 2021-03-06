
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <button  type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addProject">Add Project</button>

                  @if(session('message'))
                      <div class="alert alert-success" role="alert">
                          {{session('message')}}
                      </div>                    
                  @endif

                  <!-- Long Content Scroll Modal -->
                  <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('projects') }}">
                          <div class="modal-header">
                              <h5 class="modal-title" id="scrollableModalTitle">Add Project</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">

                            @csrf
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-4 col-form-label">Title</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="inputEmail3" name="title" placeholder="Title" required>
                                </div>
                            </div>
    
                            <div class="form-group row mb-3">
                                <label for="designation" class="col-4 col-form-label">Client Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="client_name" id="designation" placeholder="Client Name" required>
                                </div>
                            </div>
    
                            <div class="form-group row mb-3">
                                <label for="start" class="col-4 col-form-label">Start Date</label>
                                <div class="col-8">
                                    <input type="date" class="form-control" name="start_date" id="start" required>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label for="end" class="col-4 col-form-label">End Date</label>
                                <div class="col-8">
                                    <input type="date" class="form-control" id="end" name="end_date" required>
                                </div>
                            </div>         
                            
                            <div class="form-group row mb-3">
                                <label for="deadline" class="col-4 col-form-label">Deadline</label>
                                <div class="col-8">
                                    <input type="date" class="form-control" id="deadline" name="deadline" required>
                                </div>
                            </div>
    
                            <div class="form-group  mb-3">
                                <label for="image">Project Image</label>
                                <input type="file" id="image" name="image" class="form-control-file" required>
                            </div>
    
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                             
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-info waves-effect waves-light">Add Project</button>
                          </div>
                        </form>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->  

                    

                  

                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->





        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-3 header-title">Project List</h4>
                    <div class="form-group">
                        <input type="text" id="search" class="form-control" placeholder="Search">          
                    </div>
                   
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Client</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Deadline</th>
                                    <th>Status</th>                                
                                    <th>Action</th>                                
                                </tr>
                            </thead>
                        
                        
                            <tbody id="table">
                                @foreach ($ProjectList as $index=>$project)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{$project->project_id}}</td>
                                        <td>{{$project->title}}</td>
                                        <td>{{$project->client_name}}</td>
                                        <td>{{ date('d/m/Y ', strtotime($project->start_date)) }}</td>
                                        <td>{{ date('d/m/Y ', strtotime($project->end_date)) }}</td>
                                        <td>{{ date('d/m/Y ', strtotime($project->deadline)) }}</td>
                                        <td>{{ $project->status }}</td>                                 
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ url('project/details').'/'.$project->id }}">View</a>
                                        
                                        </td>                                 
                                                                    
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   

                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->

        
        
        

    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $( document ).ready(function() {

        
    $("#search").on("keyup", function() {
        var value = $(this).val().toUpperCase();
        $("#table tr").each(function(index) {
            if (index !== 0) {
                $row = $(this);
                var id = $row.text().toUpperCase();
                if (id.indexOf(value) !== -1) {
                    $row.show();
                }
                else {
                    $row.hide();
                }
            }
        });
    });

 });
</script>
@endpush