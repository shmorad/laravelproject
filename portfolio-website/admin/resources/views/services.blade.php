@extends('layouts.app')
@section('title','Service')
@section('content')
<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <button id="addNewBtnId" class="btn btn-sm btn-danger m-0 mb-2">Add New</button>
        <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Image</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Description</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="service_table">

          </tbody>
        </table>
    
    </div>
  </div>
</div>


<div id="loaderDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
    
    </div>
  </div>
</div>


<div id="wrongDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3 class="wrongDiv">Something Went Wrong !</h3>
    
    </div>
  </div>
</div>


{{-- delete modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h6 class="mt-4">Do You Want To Delete.?</h6>
        <h6 id="serviceDeleteId" class="mt-4 d-none"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button data-id="" id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
          <h6 id="serviceEditId" class="mt-4 d-none"></h6>
        <div id="serviceEditForm" class="d-none w-100">
          <input id="serviceNameId" type="text" id="" class="form-control mb-4" placeholder="Service Name" />
          <input id="serviceDescriptionId" type="text" id="" class="form-control mb-4" placeholder="Service Description" />
          <input id="serviceImageLinkId" type="text" id="" class="form-control mb-4" placeholder="Service Image Link" />
        </div>
        
        <img id="serviceEditLoader" class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
        <h5 id="serviceEditeWrong" class="wrongDiv d-none">Something Went Wrong !</h5>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancle</button>
        <button data-id="" id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

{{-- add New --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
        <div id="serviceAddForm" class="w-100">
          <h6 class="mb-4">Add New Service</h6>
          <input id="serviceNameAddId" type="text" id="" class="form-control mb-4" placeholder="Service Name" />
          <input id="serviceDescriptionAddId" type="text" id="" class="form-control mb-4" placeholder="Service Description" />
          <input id="serviceImageLinkAddId" type="text" id="" class="form-control" placeholder="Service Image Link" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancle</button>
        <button data-id="" id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection




@section('script')
<script type="text/javascript">
getServicesData();


// services table
function getServicesData() {
    axios.get('/getServiceData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
                $('#serviceDataTable').DataTable().destroy();
                $('#service_table').empty();
                
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + dataJSON[i].service_img + "></td><td>" + dataJSON[i].service_name + "</td><td>" + dataJSON[i].service_des +
                        "</td><td class='th-sm'><a class='serviceEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
                });
                // services table  delete icon click
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })

                // services table edit icon click
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    ServiceUpdateDetails(id)
                    $('#editModal').modal('show');
                })

                $('#serviceDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');





            } else {

                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });
}

// services delete table modal yes btn
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    ServiceDelete(id);
})
// service Delete
function ServiceDelete(deleteId) {
    $('#serviceDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/serviceDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {

                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('Delete Success');
                    getServicesData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Faild');
                    getServicesData();
                }
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }

        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}

// services edit table modal save btn
$('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#serviceNameId').val();
    var des = $('#serviceDescriptionId').val();
    var img = $('#serviceImageLinkId').val();
    ServiceUpdate(id, name, des, img);
})

//Each services Update Details
function ServiceUpdateDetails(detailsId) {
    axios.post('/serviceDetails', {
            id: detailsId
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none')
                $('#serviceEditLoader').addClass('d-none')
                var dataJSON = response.data;
                $('#serviceNameId').val(dataJSON[0].service_name)
                $('#serviceDescriptionId').val(dataJSON[0].service_des)
                $('#serviceImageLinkId').val(dataJSON[0].service_img)
            } else {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditeWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditeWrong').removeClass('d-none');
        })
}

function ServiceUpdate(serviceId, serviceName, serviceDsc, serviceImg) {
    if (serviceName.length == 0) {
        toastr.error('Service Name is Empty !');
    } else if (serviceDsc.length == 0) {
        toastr.error('Service Description is Empty !');
    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is Empty !');
    } else {
        $('#serviceEditConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/serviceUpdate', {
                id: serviceId,
                name: serviceName,
                des: serviceDsc,
                img: serviceImg
            })
            .then(function(response) {
                $('#serviceEditConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('Update Success');
                        getServicesData();
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('Update Faild');
                        getServicesData();
                    }
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}




// service Add Modal click

$('#addNewBtnId').click(function() {
    $('#addModal').modal('show')
})
// services Add table modal save btn
$('#serviceAddConfirmBtn').click(function() {
    var name = $('#serviceNameAddId').val();
    var des = $('#serviceDescriptionAddId').val();
    var img = $('#serviceImageLinkAddId').val();
    ServiceAdd(name, des, img);
})
// Service Add Method
function ServiceAdd(serviceName, serviceDsc, serviceImg) {
    if (serviceName.length == 0) {
        toastr.error('Service Name is Empty !');
    } else if (serviceDsc.length == 0) {
        toastr.error('Service Description is Empty !');
    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is Empty !');
    } else {
        $('#serviceAddConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/serviceAdd', {
                name: serviceName,
                des: serviceDsc,
                img: serviceImg
            })
            .then(function(response) {
                $('#serviceAddConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('Add Success');
                        getServicesData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('Add Faild');
                        getServicesData();
                    }
                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}
</script>


@endsection