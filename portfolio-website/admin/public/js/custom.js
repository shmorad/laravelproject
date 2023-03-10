// blog table
function getReviewData() {
    axios.get('/getReviewData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');
                $('#reviewDataTable').DataTable().destroy();
                $('#review_table').empty();
                var dataJSON = response.data;
                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'><img class='w-25 h-100 m-0 p-0 table-img' src=" + dataJSON[i].img + "></td>" +
                        "<td class='th-sm'>" + dataJSON[i].name + "</td>" +
                        "<td class='th-sm'>" + dataJSON[i].des + "</td>" +
                        "<td class='th-sm'><a class='reviewEditBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='reviewDeleteBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#review_table');
                    // blog table  delete icon click
                    $('.reviewDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#reviewDeleteId').html(id);
                        $('#deleteReviewModal').modal('show');
                    })
                    // Blog table  edit icon click
                    $('.reviewEditBtn').click(function() {
                        var id = $(this).data('id');
                        reviewUpdateDetails(id);
                        $('#reviewUpdateId').html(id);
                        $('#updateReviewModal').modal('show');
                    })
                });


                $('#reviewDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');



            } else {

                $('#loaderDivReview').addClass('d-none');
                $('#wrongDivReview').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivReview').addClass('d-none');
            $('#wrongDivReview').removeClass('d-none');
        });
}
$('#addNewReviewBtnId').click(function() {
    $('#addReviewModal').modal('show');
})
$('#reviewAddConfirmBtn').click(function() {
    var reviewName = $('#reviewNameId').val();
    var reviewDes = $('#reviewDesId').val();
    var reviewImage = $('#reviewImgId').val();
    reviewAdd(reviewName, reviewDes, reviewImage)
})

//review Add Method
function reviewAdd(reviewName, reviewDes, reviewImage) {
    if (reviewName.length == 0) {
        toastr.error('Review Name is Empty !');
    } else if (reviewDes.length == 0) {
        toastr.error('Review Description is Empty !');
    } else if (reviewImage.length == 0) {
        toastr.error('Review Image is Empty !');
    } else {
        $('#reviewAddConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/reviewAdd', {
                name: reviewName,
                des: reviewDes,
                img: reviewImage,
            })
            .then(function(response) {
                $('#reviewAddConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addReviewModal').modal('hide');
                        toastr.success('Add Success');
                        getReviewData();
                    } else {
                        $('#addReviewModal').modal('hide');
                        toastr.error('Add Faild');
                        getReviewData();
                    }
                } else {
                    $('#addReviewModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }


            })
            .catch(function(error) {
                $('#addReviewModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }

}

$('#reviewDeleteConfirmBtn').click(function() {
    var id = $('#reviewDeleteId').html();
    reviewDelete(id);
});
// Review Delete
function reviewDelete(deleteId) {
    $('#reviewDeleteConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
    axios.post('/reviewDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#reviewDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.success('Delete Success');
                    getReviewData();
                } else {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Delete Faild');
                    getReviewData();
                }
            } else {
                $('#deleteReviewModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#deleteReviewModal').modal('hide');
            toastr.error('Something Went Wrong !');
        })
}
$('#reviewUpdateConfirmBtn').click(function() {
    var reviewId = $('#reviewUpdateId').html();
    var reviewName = $('#reviewUpdateNameId').val();
    var reviewDes = $('#reviewUpdateDesId').val();
    var reviewImg = $('#reviewUpdateImgId').val();
    blogUpdate(reviewId, reviewName, reviewDes, reviewImg);
})
// review Update
function reviewUpdateDetails(detailsId) {
    axios.post('/reviewDetails', {
            id: detailsId
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#reviewEditForm').removeClass('d-none')
                $('#reviewEditLoader').addClass('d-none')
                var dataJSON = response.data;
                $('#reviewUpdateNameId').val(dataJSON[0].name)
                $('#reviewUpdateDesId').val(dataJSON[0].des)
                $('#reviewUpdateImgId').val(dataJSON[0].img)
            } else {
                $('#reviewEditLoader').addClass('d-none');
                $('#reviewEditeWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditeWrong').removeClass('d-none');
        })
}

function blogUpdate(reviewId, reviewName, reviewDes, reviewImg) {
    if (reviewName.length == 0) {
        toastr.error('Review Name is Empty !');
    } else if (reviewDes.length == 0) {
        toastr.error('Review Description is Empty !');
    } else if (reviewImg.length == 0) {
        toastr.error('Review Image is Empty !');
    } else {
        $('#reviewUpdateConfirmBtn').html("<div><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Loading...</div>") //animation
        axios.post('/reviewUpdate', {
                id: reviewId,
                name: reviewName,
                des: reviewDes,
                img: reviewImg,
            })
            .then(function(response) {
                $('#reviewUpdateConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateReviewModal').modal('hide');
                        toastr.success('Update Success');
                        getReviewData();
                    } else {
                        $('#updateReviewModal').modal('hide');
                        toastr.error('Update Faild');
                        getReviewData();
                    }
                } else {
                    $('#updateReviewModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error) {
                $('#updateReviewModal').modal('hide');
                toastr.error('Something Went Wrong !');
            })
    }
}