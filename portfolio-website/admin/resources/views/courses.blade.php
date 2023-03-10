@extends('layouts.app') 
@section('title','Course')
@section('content') 
<div id="mainDivCourse" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
        <button id="addNewCourseBtnId" class="btn btn-sm btn-danger m-0 mb-2">Add New</button>
        <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Name</th>
              <th class="th-sm">Fee</th>
              <th class="th-sm">Class</th>
              <th class="th-sm">Enroll</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="course_table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="loaderDivCourse" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <img class="loding_icon" src="{{asset('images/loder.gif')}}" alt="">
      </div>
    </div>
  </div>
  <div id="wrongDivCourse" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3 class="wrongDivCourse">Something Went Wrong !</h3>
      </div>
    </div>
  </div>
{{-- Add Course --}}
  <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <div class="col-md-6">
                <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                <input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                <input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
              </div>
              <div class="col-md-6">
                <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 
{{-- Update Course --}}
  <div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Course</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <h6 id="courseUpdateId" class="d-none"></h6>
          <div id="courseEditForm" class="container d-none">
            <div class="row">
              <div class="col-md-6">
                <input id="CourseUpdateNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                <input id="CourseUpdateDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                <input id="CourseUpdateFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                <input id="CourseUpdateEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
              </div>
              <div class="col-md-6">
                <input id="CourseUpdateClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                <input id="CourseUpdateLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                <input id="CourseUpdateImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
              </div>
            </div>
          </div>
          <img id="courseEditLoader" class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
          <h5 id="courseEditeWrong" class="wrongDiv d-none">Something Went Wrong !</h5>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 

{{-- delete modal --}}
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6 class="mt-4">Do You Want To Delete.?</h6>
          <h6 id="courseDeleteId" class="mt-4 d-none"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id="" id="courseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>
  @endsection 
  @section('script') 
  <script type="text/javascript">
    getCourseData();

// course table
function getCourseData() {
    axios.get('/getCourseData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'>"+dataJSON[i].course_name+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].course_fee+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].course_totalClass+"</td>"+
                        "<td class='th-sm'>"+dataJSON[i].course_totalEncroll+"</td>"+
                        "<td class='th-sm'><a class='courseEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>"+
                        "<td><a class='courseDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#course_table');
                    // course table  delete icon click
                    $('.courseDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#courseDeleteId').html(id);
                        $('#deleteCourseModal').modal('show');
                    })
                    // course table  edit icon click
                    $('.courseEditBtn').click(function() {
                        var id = $(this).data('id');
                        CourseUpdateDetails(id);
                        $('#courseUpdateId').html(id);
                        $('#updateCourseModal').modal('show');
                    })
                });


                $('#courseDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        });
}
$('#addNewCourseBtnId').click(function(){
    $('#addCourseModal').modal('show');
})
$('#CourseAddConfirmBtn').click(function(){
   var CourseName = $('#CourseNameId').val();
   var CourseDes = $('#CourseDesId').val();
   var CourseFee = $('#CourseFeeId').val();
   var CourseEnroll = $('#CourseEnrollId').val();
   var CourseClass = $('#CourseClassId').val();
   var CourseLink = $('#CourseLinkId').val();
   var CourseImg = $('#CourseImgId').val();
   CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg)
})

//Course Add Method
function CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course Name is Empty !');
    } else if (CourseDes.length == 0) {
        toastr.error('Course Description is Empty !');
    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is Empty !');
    }else if (CourseEnroll.length == 0) {
        toastr.error('Course Encroll is Empty !');
    }else if (CourseClass.length == 0) {
        toastr.error('Course Class is Empty !');
    }else if (CourseLink.length == 0) {
        toastr.error('Course Link is Empty !');
    }else if (CourseImg.length == 0) {
        toastr.error('Course Image is Empty !');
    }else {
        $('#CourseAddConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/courseAdd', {
            course_name: CourseName,
            course_desc: CourseDes,
            course_fee: CourseFee,
            course_totalEncroll: CourseEnroll,
            course_totalClass: CourseClass,
            course_link: CourseLink,
            course_img: CourseImg
            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Add Success');
                        getCourseData();
                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Add Faild');
                        getCourseData();
                    }
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}

$('#courseDeleteConfirmBtn').click(function(){
    var id = $('#courseDeleteId').html();
    CourseDelete(id);
});
// course Delete
function CourseDelete(deleteId) {
    $('#courseDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/courseDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#courseDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Success');
                    getCourseData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Faild');
                    getCourseData();
                }
            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}
$('#CourseUpdateConfirmBtn').click(function(){
    var courseId = $('#courseUpdateId').html();
    var CourseName = $('#CourseUpdateNameId').val();
    var CourseDes = $('#CourseUpdateDesId').val();
    var CourseFee = $('#CourseUpdateFeeId').val();
    var CourseEnroll = $('#CourseUpdateEnrollId').val();
    var CourseClass = $('#CourseUpdateClassId').val();
    var CourseLink = $('#CourseUpdateLinkId').val();
    var CourseImg = $('#CourseUpdateImgId').val();
    courseUpdate(courseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
 })
// Course Update
function CourseUpdateDetails(detailsId) {
    axios.post('/courseDetails',{
            id: detailsId
        })
        .then(function(response){
            if (response.status==200){
                $('#courseEditForm').removeClass('d-none')
                $('#courseEditLoader').addClass('d-none')
                var dataJSON = response.data;
                $('#CourseUpdateNameId').val(dataJSON[0].course_name)
                $('#CourseUpdateDesId').val(dataJSON[0].course_desc)
                $('#CourseUpdateFeeId').val(dataJSON[0].course_fee)
                $('#CourseUpdateEnrollId').val(dataJSON[0].course_totalEncroll)
                $('#CourseUpdateClassId').val(dataJSON[0].course_totalClass)
                $('#CourseUpdateLinkId').val(dataJSON[0].course_link)
                $('#CourseUpdateImgId').val(dataJSON[0].course_img)
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditeWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditeWrong').removeClass('d-none');
        })
}
function courseUpdate(courseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){
    if(CourseName.length == 0){
        toastr.error('Course Name is Empty !');
    } else if (CourseDes.length == 0){
        toastr.error('Course Description is Empty !');
    } else if (CourseFee.length == 0){
        toastr.error('Course Fee is Empty !');
    }else if (CourseEnroll.length == 0){
        toastr.error('Course Encroll is Empty !');
    }else if (CourseClass.length == 0){
        toastr.error('Course Class is Empty !');
    }else if (CourseLink.length == 0){
        toastr.error('Course Link is Empty !');
    }else if (CourseImg.length == 0){
        toastr.error('Course Image is Empty !');
    } else{
        $('#CourseUpdateConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/courseUpdate', {
            id: courseId,
            course_name: CourseName,
            course_desc: CourseDes,
            course_fee: CourseFee,
            course_totalEncroll: CourseEnroll,
            course_totalClass: CourseClass,
            course_link: CourseLink,
            course_img: CourseImg,
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save")
                if(response.status == 200) {
                    if(response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Success');
                        getCourseData();
                    }else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update Faild');
                        getCourseData();
                    }
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error){
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }
}

  </script> 
  @endsection