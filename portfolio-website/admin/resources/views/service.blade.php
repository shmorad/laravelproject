@extends('layouts.app')

@section('content')
<div id="mainDiv" class="container">
  <div class="row">
    <h2 id='txt'>Hello</h2>
  <div class="col-md-12 p-5 d-none">
  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
  <div class="col-md-12 p-5 text-center">
      <img style="margin-top:250px" src="{{asset('images/Spinner-3.gif')}}" alt="">
  </div>
  </div>
  </div>
  <div id="wrongDiv" class="container">
  <div class="row">
  <div class="col-md-12 p-5 text-center d-none">
      <h3>Some thing went wrong!</h3>
  </div>
  </div>
  </div>
@endsection

@push('js')
<script>
  $(document).ready(function() {

    axios.get('http://localhost/laravelproject/portfolio-website/admin/public/getservice')
    .then(function(res){

        if(res.status==200){
            // $('#mainDiv').removeClass('d-none');
            // $('#loaderDiv').addClass('d-none');
            var jsonData=res.data.data;
          $.each(jsonData, function (indexInArray, valueOfElement) { 
            $('tr').html(
                    "<td><img class='table-img' src="+jsonData[i].service_img +"></td>"+
                    "<td>"+jsonData[i].service_name+"</td>"+
                    "<td>"+jsonData[i].service_desc+"</td>"+
                    "<td><a href='' ><i class='fas fa-edit'></i></a></td>"+
                    "<td><a href='' ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#service_table');
          });






            // $.each(jsonData,function(i,item){
            //   var img = jsonData[i].service_img;
            //   // document.getElementById('txt').innerText=img;

              
            //     $('tr').html(
            //         "<td><img class='table-img' src="+jsonData[i].service_img +"></td>"+
            //         "<td>"+jsonData[i].service_name+"</td>"+
            //         "<td>"+jsonData[i].service_desc+"</td>"+
            //         "<td><a href='' ><i class='fas fa-edit'></i></a></td>"+
            //         "<td><a href='' ><i class='fas fa-trash-alt'></i></a></td>"
            //     ).appendTo('#service_table');
            // });
        }else{
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }
    }).catch(function(error){
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
    });
});
</script>
@endpush
