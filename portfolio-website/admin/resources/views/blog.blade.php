@extends('layouts.app') 
@section('title','Blog')
@section('content') 
<div id="mainDivBlog" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
        <button id="addNewBlogBtnId" class="btn btn-sm btn-danger m-0 mb-2">Add New</button>
        <table id="blogDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Image</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Description</th>
              <th class="th-sm">Link</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="blog_table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="loaderDivBlog" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <img class="loding_icon" src="{{asset('images/loder.gif')}}" alt="">
      </div>
    </div>
  </div>
  <div id="wrongDivBlog" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3 class="wrongDivBlog">Something Went Wrong !</h3>
      </div>
    </div>
  </div>
{{-- Add Course --}}
  <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Blog</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <input id="blogNameId" type="text" id="" class="form-control mb-3" placeholder="Blog Name">
                <input id="blogDesId" type="text" id="" class="form-control mb-3" placeholder="Blog Description">
                <input id="blogLinkId" type="text" id="" class="form-control mb-3" placeholder="Blog Link">
                <input id="blogImgId" type="text" id="" class="form-control mb-3" placeholder="Blog Image">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="blogAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 
{{-- Update Blog --}}
  <div class="modal fade" id="updateBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Blog</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body  text-center">
          <h6 id="blogUpdateId" class="d-none"></h6>
          <div id="blogEditForm" class="container d-none">
            <div class="row">
              <div class="col-md-12">
                <input id="blogUpdateNameId" type="text" id="" class="form-control mb-3" placeholder="Blog Name">
                <input id="blogUpdateDesId" type="text" id="" class="form-control mb-3" placeholder="Blog Description">
                <input id="blogUpdateLinkId" type="text" id="" class="form-control mb-3" placeholder="Blog Link">
                <input id="blogUpdateImgId" type="text" id="" class="form-control mb-3" placeholder="Blog Image">
              </div>
            </div>
          </div>
          <img id="blogEditLoader" class="loding_icon"src="{{asset('images/loder.gif')}}" alt="">
          <h5 id="blogEditeWrong" class="wrongDiv d-none">Something Went Wrong !</h5>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="blogUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div> 

{{-- delete modal --}}
<div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6 class="mt-4">Do You Want To Delete.?</h6>
          <h6 id="blogDeleteId" class="mt-4 d-none"></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button data-id="" id="blogDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection 

@section('script')
<script type="text/javascript">
getBlogData();


// blog table
function getBlogData() {
    axios.get('/getBlogData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivBlog').removeClass('d-none');
                $('#loaderDivBlog').addClass('d-none');
                $('#blogDataTable').DataTable().destroy();
                $('#blog_table').empty();
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'><img class='table-img' src=" + dataJSON[i].blog_img + "></td>" +
                        "<td class='th-sm'>" + dataJSON[i].blog_name + "</td>" +
                        "<td class='th-sm'>" + dataJSON[i].blog_desc + "</td>" +
                        "<td class='th-sm'>" + dataJSON[i].blog_link + "</td>" +
                        "<td class='th-sm'><a class='blogEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='blogDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#blog_table');
                    // blog table  delete icon click
                    $('.blogDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#blogDeleteId').html(id);
                        $('#deleteBlogModal').modal('show');
                    })
                    // Blog table  edit icon click
                    $('.blogEditBtn').click(function() {
                        var id = $(this).data('id');
                        blogUpdateDetails(id);
                        $('#blogUpdateId').html(id);
                        $('#updateBlogModal').modal('show');
                    })
                });


                $('#blogDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivBlog').addClass('d-none');
                $('#wrongDivBlog').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivBlog').addClass('d-none');
            $('#wrongDivBlog').removeClass('d-none');
        });
}
$('#addNewBlogBtnId').click(function() {
    $('#addBlogModal').modal('show');
})
$('#blogAddConfirmBtn').click(function() {
    var blogName = $('#blogNameId').val();
    var blogDes = $('#blogDesId').val();
    var blogLink = $('#blogLinkId').val();
    var blogImage = $('#blogImgId').val();
    blogAdd(blogName, blogDes, blogLink, blogImage)
})

//Blog Add Method
function blogAdd(blogName, blogDes, blogLink, blogImage) {
    if (blogName.length == 0) {
        toastr.error('Blog Name is Empty !');
    } else if (blogDes.length == 0) {
        toastr.error('Blog Description is Empty !');
    } else if (blogLink.length == 0) {
        toastr.error('Blog Link is Empty !');
    } else if (blogImage.length == 0) {
        toastr.error('Blog Image is Empty !');
    } else {
        $('#blogAddConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/blogAdd', {
                blog_name: blogName,
                blog_desc: blogDes,
                blog_link: blogLink,
                blog_img: blogImage,
            })
            .then(function(response) {
                $('#blogAddConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addBlogModal').modal('hide');
                        toastr.success('Add Success');
                        getBlogData();
                    } else {
                        $('#addBlogModal').modal('hide');
                        toastr.error('Add Faild');
                        getBlogData();
                    }
                } else {
                    $('#addBlogModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#addBlogModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}

$('#blogDeleteConfirmBtn').click(function() {
    var id = $('#blogDeleteId').html();
    blogDelete(id);
});
// Blog Delete
function blogDelete(deleteId) {
    $('#blogDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/blogDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#blogDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteBlogModal').modal('hide');
                    toastr.success('Delete Success');
                    getBlogData();
                } else {
                    $('#deleteBlogModal').modal('hide');
                    toastr.error('Delete Faild');
                    getBlogData();
                }
            } else {
                $('#deleteBlogModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteBlogModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}
$('#blogUpdateConfirmBtn').click(function() {
    var blogId = $('#blogUpdateId').html();
    var blogName = $('#blogUpdateNameId').val();
    var blogDes = $('#blogUpdateDesId').val();
    var blogLink = $('#blogUpdateLinkId').val();
    var blogImg = $('#blogUpdateImgId').val();
    blogUpdate(blogId, blogName, blogDes, blogLink, blogImg);
})
// Blog Update
function blogUpdateDetails(detailsId) {
    axios.post('/blogDetails', {
            id: detailsId
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#blogEditForm').removeClass('d-none')
                $('#blogEditLoader').addClass('d-none')
                var dataJSON = response.data;
                $('#blogUpdateNameId').val(dataJSON[0].blog_name)
                $('#blogUpdateDesId').val(dataJSON[0].blog_desc)
                $('#blogUpdateLinkId').val(dataJSON[0].blog_link)
                $('#blogUpdateImgId').val(dataJSON[0].blog_img)
            } else {
                $('#blogEditLoader').addClass('d-none');
                $('#blogEditeWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#blogEditLoader').addClass('d-none');
            $('#blogEditeWrong').removeClass('d-none');
        })
}

function blogUpdate(blogId, blogName, blogDes, blogLink, blogImg) {
    if (blogName.length == 0) {
        toastr.error('blog Name is Empty !');
    } else if (blogDes.length == 0) {
        toastr.error('blog Description is Empty !');
    } else if (blogLink.length == 0) {
        toastr.error('blog Link is Empty !');
    } else if (blogImg.length == 0) {
        toastr.error('blog Image is Empty !');
    } else {
        $('#blogUpdateConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/blogUpdate', {
                id: blogId,
                blog_name: blogName,
                blog_desc: blogDes,
                blog_link: blogLink,
                blog_img: blogImg,
            })
            .then(function(response) {
                $('#blogUpdateConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateBlogModal').modal('hide');
                        toastr.success('Update Success');
                        getBlogData();
                    } else {
                        $('#updateBlogModal').modal('hide');
                        toastr.error('Update Faild');
                        getBlogData();
                    }
                } else {
                    $('#updateBlogModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error) {
                $('#updateBlogModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }
}
</script>
@endsection