<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <h4 class="header-title">Ongoing Tasks</h4>

    <div class="table-responsive">
      <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Search">      
      </div>

      <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th >SL</th>
              <th >TaskId</th>
              <th >Title</th>
              <th >Project</th>
              <th >Assigned To</th>
              <th >Assigned By</th>
              <th >Assigned Date</th>
              <th >Submission Time</th>
              <th >Latest Status Time</th>
              <th >Type</th>
              <th >Status</th>
              <th >View</th>
            </tr>
          </thead>

          <tbody id="table" >
            
          
         
          </tbody>
      </table>
    </div>

    </div> <!-- end card-box-->
  </div> <!-- end col-->
</div>

@push('scripts')
<script type="text/javascript">
  $( document ).ready(function() {

    GetOnGoingTaskDataTable();

    window.setInterval(function(){
      GetOnGoingTaskDataTable();
    }, 10000);

    function GetOnGoingTaskDataTable() {
        let TableList = $('#table');
        $.ajax({
            type:'get',
            url:"{{ url('ajax/ongoing/tasks') }}",
            data:{},
            success:function(data){
                TableList.empty();
                $.each(data.TaskList, function(key, value) {
                    TableList.append(`<tr>
                        <td>${++key}</td>
                        <td>${ value.task_id }</td>
                        <td>${ value.title }</td>
                        <td>${ value.projectName }</td>  
                        <td>${ value.developer }</td>  
                        <td>${ value.createdBy }</td>  
                        <td>${ value.assignedDate }</td>  
                        <td>${ value.submissionDate } ${ value.submissionTime }</td>  
                        <td>${ value.latestStatusTime }</td>  
                        <td>${ value.task_type }</td>  
                        <td>
                          <span class="badge 
                            ${value.status == 'Submitted' ? 'badge-success':'badge-secondary' }                           
                            ">${ value.status }</span>                        
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ url('project') }}/${value.project_id}/member/${value.user_id}/task/${value.task_id}">View</a>
                        </td>                      
                      </tr>`);
                });
            }
        });
    }
      
    var $rows = $('#table tr');
    $('#search').keyup(function() {
      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
      
      $rows.show().filter(function() {
          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
          return !~text.indexOf(val);
      }).hide();
    });        
      
  });
</script>

@endpush