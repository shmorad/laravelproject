@extends('layouts.app')
@section('title','Contact')
@section('content') 
<div id="mainDivContact" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
        <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
            
              <th class="th-sm">Name</th>
              <th class="th-sm">Mobile No.</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Message</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="contact_table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="loaderDivContact" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <img class="loding_icon" src="{{asset('images/loder.gif')}}" alt="">
      </div>
    </div>
  </div>
  <div id="wrongDivContact" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3 class="wrongDivContact">Something Went Wrong !</h3>
      </div>
    </div>
  </div>
{{-- delete modal --}}
<div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6 class="mt-4">Do You Want To Delete.?</h6>
          <h6 id="contactDeleteId" class="mt-4 d-none"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id="" id="contactDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script type="text/javascript">
    getContactData();

    // contact table
function getContactData() {
    axios.get('/getContactData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivContact').removeClass('d-none');
                $('#loaderDivContact').addClass('d-none');
                $('#contactDataTable').DataTable().destroy();
                $('#contact_table').empty();
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'>"+dataJSON[i].contact_name+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].contact_mobile+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].contact_email+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].contact_msg+"</td>"+
                        "<td><a class='contactDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#contact_table');
                    // project table  delete icon click
                    $('.contactDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#contactDeleteId').html(id);
                        $('#deleteContactModal').modal('show');
                    })
                });


                $('#contactDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivContact').addClass('d-none');
                $('#wrongDivContact').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivContact').addClass('d-none');
            $('#wrongDivContact').removeClass('d-none');
        });
}


$('#contactDeleteConfirmBtn').click(function(){
    var id = $('#contactDeleteId').html();
    contactDelete(id);
});
// project Delete
function contactDelete(deleteId) {
    $('#contactDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/contactDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#contactDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteContactModal').modal('hide');
                    toastr.success('Delete Success');
                    getContactData();
                } else {
                    $('#deleteContactModal').modal('hide');
                    toastr.error('Delete Faild');
                    getProjectData();
                }
            } else {
                $('#deleteContactModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteContactModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}

</script>

@endsection