@extends('layouts.app') 
@section('title','Review')
@section('content') 
<div id="mainDivReview" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
        <button id="addNewReviewBtnId" class="btn btn-sm btn-danger m-0 mb-2">Add New</button>
        <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Image</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Description</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="review_table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="loaderDivReview" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <img class="loding_icon" src="{{asset('images/loder.gif')}}" alt="">
      </div>
    </div>
  </div>
  <div id="wrongDivReview" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3 class="wrongDivReview">Something Went Wrong !</h3>
      </div>
    </div>
  </div>
{{-- Add Review --}}
  <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <input id="reviewNameId" type="text" class="form-control mb-3" placeholder="Name">
                <input id="reviewDesId" type="text" class="form-control mb-3" placeholder="Description">
                <input id="reviewImgId" type="text" class="form-control mb-3" placeholder="Image">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="reviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 
{{-- Update Blog --}}
  <div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Review</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <h6 id="reviewUpdateId" class="d-none"></h6>
          <div id="reviewEditForm" class="container d-none">
            <div class="row">
              <div class="col-md-12">
                <input id="reviewUpdateNameId" type="text" id="" class="form-control mb-3" placeholder=" Name">
                <input id="reviewUpdateDesId" type="text" id="" class="form-control mb-3" placeholder="Description">
                <input id="reviewUpdateImgId" type="text" id="" class="form-control mb-3" placeholder="Image">
              </div>
            </div>
          </div>
          <img id="reviewEditLoader" class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
          <h5 id="reviewEditeWrong" class="wrongDiv d-none">Something Went Wrong !</h5>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="reviewUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 

{{-- delete modal --}}
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6 class="mt-4">Do You Want To Delete.?</h6>
          <h6 id="reviewDeleteId" class="mt-4 d-none"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id="" id="reviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection 

@section('script')
<script type="text/javascript">
getReviewData();

</script>
@endsection