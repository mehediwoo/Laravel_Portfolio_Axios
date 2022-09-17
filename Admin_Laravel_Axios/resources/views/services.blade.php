@extends('layout.app')
@section('title','Services')
@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button class="btn btn-sm btn-danger" id="addNew">Add New</button>
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
                <tbody id="serviceData">

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


<!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Are you sure want to delete this?</p>
            <p class="text-center d-none" id="ServiceDelId"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="deleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!--Service Edit Modal -->
  <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Services Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center" id="editBody">
                <div class="serviceEditForm d-none">
                    <p id="EditID" class="d-none"></p>
                    <input type="text" id="title" class="form-control" placeholder="Service Title"> <br>
                    <input type="text" id="image" class="form-control" placeholder="Service Image link"><br>
                    <textarea id="desc" cols="5" rows="5" placeholder="Service Desc" class="form-control"></textarea>
                </div>

                <img class="text-center" id="editLoder" src="{{ asset('images/loader.svg') }}" width="70px" alt="">
                <h6 class="d-none text-center"  id="editWrong" style="color:red">Something went wrong</h6>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="ServiceUpdatebtn" type="button" class="btn btn-sm btn-dark">Update</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Add new Service --}}
  <!-- Modal -->
  <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Services</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center" id="editBody">
                <div class="serviceEditForm">
                    <input type="text" id="titleAdd" class="form-control" placeholder="Service Title"> <br>
                    <input type="text" id="imgAdd" class="form-control" placeholder="Service Image link"><br>
                    <textarea id="descAdd" cols="5" rows="5" placeholder="Service Desc" class="form-control"></textarea>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="ServiceAddbtn" type="button" class="btn btn-sm btn-dark">Create</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script type="text/javascript">
        getServicesData();

 // Get Service Data
function getServicesData() {
    axios.get('/getServiceData')
        .then(function(response) {
            if (response.status == 200) {
                $('#serviceDataTable').DataTable().destroy();
                $('#serviceData').empty();
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
                var getData = response.data;
                $.each(getData, function(i) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + getData[i].services_image + "></td>" +
                        "<td>" + getData[i].services_name + "</td>" +
                        "<td>" + getData[i].services_desc + "</td>" +
                        "<td><a class='editBtn' data-id=" + getData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='deleteId' data-id=" + getData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#serviceData')
                });

                $('.deleteId').click(function() {
                    var id = $(this).data('id');
                    $('#ServiceDelId').html(id);
                    $('#deleteModal').modal('show');
                })
                // Service Edit BTN
                $('.editBtn').click(function() {
                    var id = $(this).data('id');
                    $('#EditID').html(id);
                    serviceDetails(id);
                    $('#EditModal').modal('show');
                })
                $('#serviceDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');


            } else {
                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').addClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });

}
//Delete Yes Button
$('#deleteConfirmBtn').click(function() {
    var del = $('#ServiceDelId').html();
    deleteServiceData(del);
})


function deleteServiceData(del) {
    $('#deleteConfirmBtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
    axios.post('/ServiceDelete', {
            id: del
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteConfirmBtn').html("Yes");
                $('#deleteModal').modal('hide');
                toastr.success('Delete Success');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Faield');
                getServicesData();
            }
        })
        .catch(function(error) {
            console.log(error);
        });
}

//Service Update Details
function serviceDetails(id) {

    axios.post('/ServiceDetails',
        {
            id: id
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#editLoder').addClass('d-none');
                $('.serviceEditForm').removeClass('d-none');
                var details = response.data;
                $('#title').val(details[0].services_name);
                $('#image').val(details[0].services_image);
                $('#desc').val(details[0].services_desc);
            } else {
                $('#editWrong').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#editWrong').removeClass('d-none');
        });
}


//Service Update Confirm Button
$('#ServiceUpdatebtn').click(function() {
    var id = $('#EditID').html();
    var title = $('#title').val();
    var desc = $('#desc').val();
    var img = $('#image').val();
    serviceUpdated(id, title, desc, img);
});
//Service Update
function serviceUpdated(id, title, desc, img) {

    if (title.length == 0) {
        toastr.error('Service Title is empty');
    } else if (img.length == 0) {
        toastr.error('Service Image Link is empty');
    } else if (desc.length == 0) {
        toastr.error('Service Image Link is empty');
    } else {

        $('#ServiceUpdatebtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>")
        axios.post('/ServiceUpdate', {
                id: id,
                title: title,
                desc: desc,
                img: img
            })
            .then(function(response) {

                if (response.data == 1) {
                    $('#ServiceUpdatebtn').html('Update');
                    toastr.success('Data Successfully Updated');
                    $('#EditModal').modal('hide');
                    getServicesData();
                } else {

                    toastr.error('Updated Faield! Try again');
                    $('#EditModal').modal('hide');

                    getServicesData();
                }
            })
            .catch(function(error) {
                toastr.error('Error');
            });

    }
}
//Service Modal Btn
$('#addNew').click(function() {
    $('#AddModal').modal('show');
});
//Service Confirm Btn
$('#ServiceAddbtn').click(function() {
    var title = $('#titleAdd').val();
    var desc = $('#descAdd').val();
    var img = $('#imgAdd').val();
    AddService(title, desc, img);
});
//Add Services
function AddService(title, desc, img) {

    if (title.length == 0) {
        toastr.error('Service Title is empty');
    } else if (img.length == 0) {
        toastr.error('Service Image Link is empty');
    } else if (desc.length == 0) {
        toastr.error('Service Image Link is empty');
    } else {

        $('#ServiceAddbtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'><div>");
        axios.post('/ServiceAdd',
            {
                title: title,
                desc: desc,
                img: img
            })
            .then(function(response) {

                if (response.data == 1) {
                    $('#ServiceAddbtn').html('Create');
                    toastr.success('Data Successfully Added');
                    $('#AddModal').modal('hide');
                    getServicesData();
                } else {

                    toastr.error('Data Created Faield! Try again');
                    $('#AddModal').modal('hide');

                    getServicesData();
                }
            })
            .catch(function(error) {
                toastr.error('Error');
            });

    }
}

    </script>

@endsection
