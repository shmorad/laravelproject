@extends('layouts.app')
@section('title','Project')
@section('content') 
<div id="mainDivProject" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
        <button id="addNewProjectBtnId" class="btn btn-sm btn-danger m-0 mb-2">Add New</button>
        <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                
              <th class="th-sm">Image</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Description</th>
              <th class="th-sm">Project Link</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="project_table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="loaderDivProject" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <img class="loding_icon" src="{{asset('images/loder.gif')}}" alt="">
      </div>
    </div>
  </div>
  <div id="wrongDivProject" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3 class="wrongDivProject">Something Went Wrong !</h3>
      </div>
    </div>
  </div>
{{-- Add Course --}}
  <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <input id="projectNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                <input id="projectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                <input id="projectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                <input id="projectImageId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="projectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 
{{-- Update Course --}}
  <div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Project</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <h6 id="projectUpdateId" class=""></h6>
          <div id="projectEditForm" class="container d-none">
            <div class="row">
              <div class="col-md-12">
                <input id="projectUpdateNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                <input id="projectUpdateDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                <input id="projectUpdateLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                <input id="projectUpdateImageId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
              </div>
            </div>
          </div>
          <img id="projectEditLoader" class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
          <h5 id="projectEditeWrong" class="wrongDiv d-none">Something Went Wrong !</h5>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="projectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 

{{-- delete modal --}}
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6 class="mt-4">Do You Want To Delete.?</h6>
          <h6 id="projectDeleteId" class="mt-4 d-none"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id="" id="projectDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script type="text/javascript">
getProjectData();

// project table
function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');
                $('#projectDataTable').DataTable().destroy();
                $('#project_table').empty();
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'><img class='table-img' src=" + dataJSON[i].project_img + "></td>" +
                        "<td class='th-sm'>" + dataJSON[i].project_name + "</td>" +
                        "<td class='th-sm'>" + dataJSON[i].project_desc + "</td>" +
                        "<td class='th-sm'>" + dataJSON[i].project_link + "</td>" +
                        "<td class='th-sm'><a class='projectEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='projectDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#project_table');
                    // project table  delete icon click
                    $('.projectDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#projectDeleteId').html(id);
                        $('#deleteProjectModal').modal('show');
                    })
                    // project table  edit icon click
                    $('.projectEditBtn').click(function() {
                        var id = $(this).data('id');
                        projectUpdateDetails(id);
                        $('#projectUpdateId').html(id);
                        $('#updateProjectModal').modal('show');
                    })
                });


                $('#projectDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivProject').addClass('d-none');
                $('#wrongDivProject').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivProject').addClass('d-none');
            $('#wrongDivProject').removeClass('d-none');
        });
}
$('#addNewProjectBtnId').click(function() {
    $('#addProjectModal').modal('show');
})
$('#projectAddConfirmBtn').click(function() {
    var projectName = $('#projectNameId').val();
    var projectDes = $('#projectDesId').val();
    var projectLink = $('#projectLinkId').val();
    var projectImage = $('#projectImageId').val();
    projectAdd(projectName, projectDes, projectLink, projectImage)
})

//project Add Method
function projectAdd(projectName, projectDes, projectLink, projectImage) {
    if (projectName.length == 0) {
        toastr.error('Project Name is Empty !');
    } else if (projectDes.length == 0) {
        toastr.error('Project Description is Empty !');
    } else if (projectLink.length == 0) {
        toastr.error('Project Link is Empty !');
    } else if (projectImage.length == 0) {
        toastr.error('Project Image is Empty !');
    } else {
        $('#projectAddConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/projectAdd', {
                project_name: projectName,
                project_desc: projectDes,
                project_link: projectLink,
                project_img: projectImage,
            })
            .then(function(response) {
                $('#projectAddConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addProjectModal').modal('hide');
                        toastr.success('Add Success');
                        getProjectData();
                    } else {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Add Faild');
                        getProjectData();
                    }
                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#addProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}

$('#projectDeleteConfirmBtn').click(function() {
    var id = $('#projectDeleteId').html();
    projectDelete(id);
});
// project Delete
function projectDelete(deleteId) {
    $('#projectDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/projectDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#projectDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.success('Delete Success');
                    getProjectData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Delete Faild');
                    getProjectData();
                }
            } else {
                $('#deletePrejectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deletePrejectModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}
$('#projectUpdateConfirmBtn').click(function() {
    var projectId = $('#projectUpdateId').html();
    var projectName = $('#projectUpdateNameId').val();
    var projectDes = $('#projectUpdateDesId').val();
    var projectLink = $('#projectUpdateLinkId').val();
    var projectImg = $('#projectUpdateImageId').val();
    projectUpdate(projectId, projectName, projectDes, projectLink, projectImg);
})
// project Update
function projectUpdateDetails(detailsId) {
    axios.post('/projectDetails', {
            id: detailsId
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#projectEditForm').removeClass('d-none')
                $('#projectEditLoader').addClass('d-none')
                var dataJSON = response.data;
                $('#projectUpdateNameId').val(dataJSON[0].project_name)
                $('#projectUpdateDesId').val(dataJSON[0].project_desc)
                $('#projectUpdateLinkId').val(dataJSON[0].project_link)
                $('#projectUpdateImageId').val(dataJSON[0].project_img)
            } else {
                $('#projectEditLoader').addClass('d-none');
                $('#projectEditeWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#projectEditLoader').addClass('d-none');
            $('#projectEditeWrong').removeClass('d-none');
        })
}

function projectUpdate(projectId, projectName, projectDes, projectLink, projectImg) {
    if (projectName.length == 0) {
        toastr.error('Project Name is Empty !');
    } else if (projectDes.length == 0) {
        toastr.error('Project Description is Empty !');
    } else if (projectLink.length == 0) {
        toastr.error('Project Link is Empty !');
    } else if (projectImg.length == 0) {
        toastr.error('Project Image is Empty !');
    } else {
        $('#projectUpdateConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/projectUpdate', {
                id: projectId,
                project_name: projectName,
                project_desc: projectDes,
                project_link: projectLink,
                project_img: projectImg,
            })
            .then(function(response) {
                $('#projectUpdateConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateProjectModal').modal('hide');
                        toastr.success('Update Success');
                        getProjectData();
                    } else {
                        $('#updateProjectModal').modal('hide');
                        toastr.error('Update Faild');
                        getProjectData();
                    }
                } else {
                    $('#updateProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error) {
                $('#updateProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }
}
</script>
@endsection