@extends('layout.app')
@section('title','Review')
@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <table id="reviewtDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Image</th>
                    <th class="th-sm">Title</th>
                    <th class="th-sm">Description</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="reviewBody">

                </tbody>
            </table>

        </div>
    </div>
</div>

<div id="loaderDiv" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img src="{{ asset('images/loader.svg') }}" width="70px" alt="">

        </div>
    </div>
</div>

<div id="wrongDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h6 style="color:red">Something went wrong</h6>

        </div>
    </div>
</div>

{{-- Delete Contact Modal --}}
<!-- Modal -->
<div class="modal fade" id="reviewDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Are you sure want to delete this?</p>
            <p class="text-center d-none" id="reviewDelId"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="conDelRevBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
    <script type="text/javascript">
        GetData();
        //Get Review Data
function GetData(){
    axios.get('/getData')
      .then(function (response) {
        if (response.status==200) {
            $('#reviewtDataTable').DataTable().destroy();
            $('#reviewBody').empty();
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
            var data = response.data;
            $.each(data,function(i){
            $('<tr>').html(
                "<td class='th-sm'><img width='100px' src="+data[i].img+"></td>" +
                "<td class='th-sm'>" + data[i].title + "</td>" +
                "<td class='th-sm'>" + data[i].description + "</td>" +
                "<td class='th-sm'><a class='delConbtn' data-id=" + data[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#reviewBody');
        });
            $('.delConbtn').click(function(){
                var id =$(this).data('id');
                $('#reviewDelId').html(id);
                $('#reviewDelModal').modal('show');
            });
            $('#reviewtDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
        }else{
            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
        }
      })
      .catch(function (error) {
        $('#wrongDiv').removeClass('d-none');
        $('#loaderDiv').addClass('d-none');
      })
}

//Delete Yes confirm button
$('#conDelRevBtn').click(function(){
    var id =$('#reviewDelId').html();
    DeleteData(id);
});
//Delete
function DeleteData(id){

    axios.post('/delData', {
        id: id
      })
      .then(function (response) {
        if (response.status==200) {
            $('#reviewDelModal').modal('hide');
            toastr.success('Data Successfully Delete');
            GetData();
        }else{
            $('#reviewDelModal').modal('hide');
            toastr.error('Delete Faield, try again');
            GetData();
        }
      })
      .catch(function (error) {
        toastr.error('Delete Action  Faield');
      });
}
    </script>
@endsection
