@extends('layout.app')
@section('title','Contact')
@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <table id="ContactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Phone</th>
                    <th class="th-sm">E-mail</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">Time</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="contactBody">

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
<div class="modal fade" id="contactDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Are you sure want to delete this?</p>
            <p class="text-center d-none" id="contcDelId"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="conDelConBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
    <script type="text/javascript">
        ContactDetails();
        //Get Contact Details

function ContactDetails(){

axios.post('/getContact')
.then(function(response){
    if (response.status==200) {
        $('#ContactDataTable').DataTable().destroy();
        $('#contactBody').empty();
        $('#mainDiv').removeClass('d-none');
        $('#loaderDiv').addClass('d-none');
        var data = response.data;
        $.each(data,function(i){
            $('<tr>').html(
                "<td class='th-sm'>" + data[i].ContactName + "</td>" +
                "<td class='th-sm'>" + data[i].ContactPhone + "</td>" +
                "<td class='th-sm'>" + data[i].ContactMail + "</td>" +
                "<td class='th-sm'>" + data[i].ContactMessage + "</td>" +
                "<td class='th-sm'>" + data[i].created_at + "</td>" +
                "<td class='th-sm'><a class='delConbtn' data-id=" + data[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#contactBody');
        });
        $('.delConbtn').click(function(){
            var id = $(this).data('id');
            $('#contcDelId').html(id);
            $('#contactDelModal').modal('show');
        });
        $('#ContactDataTable').DataTable({order:false});
        $('.dataTables_length').addClass('bs-select');
    }else{
        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    }
})
.catch(function(error){
    $('#loaderDiv').addClass('d-none');
    $('#wrongDiv').removeClass('d-none');
});
}
//Contact Delete Confirm Button
$('#conDelConBtn').click(function(){
var id = $('#contcDelId').html();
DeleteContactIteam(id);

});
//Contact Delete Function
function DeleteContactIteam(id){

axios.post('/contactDelete',
{
    id:id
})
.then(function(response){
    if (response.status == 200) {
        $('#contactDelModal').modal('hide');
        toastr.success('Data Successfully Delete');
        ContactDetails();
    }else{
        $('#contactDelModal').modal('hide');
        toastr.error('Data not Deleted, try again latter');
        ContactDetails();
    }
})
.catch(function(error){
    toastr.error('Wrong, try again latter');
})

}

    </script>
@endsection
