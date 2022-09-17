@extends('layout.app')
@section('title','Project')
@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewProject" class="btn btn-sm btn-danger">Add New</button>
            <table id="projectTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Project Image</th>
                    <th class="th-sm">Project Name</th>
                    <th class="th-sm">Project Description</th>
                    <th class="th-sm">Project Link</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="ProjectDataBody">

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

{{-- Project Delete Modal --}}
<div class="modal fade" id="projectDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Are you sure want to delete this?</p>
            <p class="text-center d-none" id="ProjectDelId"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="projectdeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>
  <!--Project Edit Modal -->
  <div class="modal fade" id="proEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Project Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center" id="editBody">
                <div class="projectEditForm d-none">
                    <p id="EditID" class="d-none"></p>
                    <input type="text" id="pName" class="form-control" placeholder="Project Name"> <br>
                    <input type="text" id="proImg" class="form-control" placeholder="Project Image link"><br>
                    <input type="text" id="proLink" class="form-control" placeholder="Project link"><br>
                    <textarea id="proDesc" cols="5" rows="5" placeholder="Project Description" class="form-control"></textarea>
                </div>

                <img class="text-center" id="editLoder" src="{{ asset('images/loader.svg') }}" width="70px" alt="">
                <h6 class="d-none text-center"  id="editWrong" style="color:red">Something went wrong</h6>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="ProjectUpdatebtn" type="button" class="btn btn-sm btn-danger">Update</button>
        </div>
      </div>
    </div>
  </div>
{{-- Add New Project Modal --}}
<div class="modal fade" id="AddNewPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center" id="editBody">
                    <input type="text" id="pNameid" class="form-control" placeholder="Project Name"> <br>
                    <input type="text" id="proImgid" class="form-control" placeholder="Project Image link"><br>
                    <input type="text" id="proLinkid" class="form-control" placeholder="Project link"><br>
                    <textarea id="proDescid" cols="5" rows="5" placeholder="Project Description" class="form-control"></textarea>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button id="ProjectSave" type="button" class="btn btn-sm btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script type="text/javascript">
    getProject();
    //Get Project Data

function getProject(){

    axios.get('/getProject')
    .then(function (response) {
        if (response.status==200) {
            $('#projectTable').DataTable().destroy();
            $('#ProjectDataBody').empty();
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
            $('#projectTable').DataTable().destroy();
            var ProjectData = response.data;
            $.each(ProjectData,function(i){
                $('<tr>').html(
                    "<td class='th-sm'><img class='table-img' src="+ ProjectData[i].ProjectImage +"></td>" +
                    "<td class='th-sm'>"+ ProjectData[i].ProjectName +"</td>" +
                    "<td class='th-sm'>"+ ProjectData[i].ProjectDesc +"</td>" +
                    "<td class='th-sm'>"+ ProjectData[i].ProjectLink +"</td>" +
                    "<td class='th-sm'><a class='projectEdit' data-id="+ProjectData[i].id+" ><i class='fas fa-edit'></i></a></td>" +
                    "<td class='th-sm'><a class='projectDel' data-id="+ProjectData[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#ProjectDataBody');

            });
            //Project Delete Btn
            $('.projectDel').click(function(){
                var Delid = $(this).data('id');
                $('#ProjectDelId').html(Delid);
                $('#projectDelModal').modal('show');
            });
            //Project Edit Btn
            $('.projectEdit').click(function(){
                var edtid = $(this).data('id');
                $('#EditID').html(edtid);
                ProjectDetails(edtid);
                $('#proEditModal').modal('show');
            });

            $('#projectTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
        }else{
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }
    })
    .catch(function (error) {
        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    });


}
//Project Delete confirm btn
$('#projectdeleteConfirmBtn').click(function(){
    var id = $('#ProjectDelId').html();
    ProjectDelete(id);
});
//Project Delete Function
function ProjectDelete(id){
$('#projectdeleteConfirmBtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
    axios.post('/DeleteProject', {
        id: id
      })
      .then(function (response) {

        $('#projectdeleteConfirmBtn').html('Yes');
        $('#projectDelModal').modal('hide');
        if (response.data==1) {

            toastr.success('Delete Success');
            getProject();
        }else{
            toastr.error('Something went wrong');
            getProject();
        }
      })
      .catch(function (error) {
        toastr.error('Error');
        $('#projectDelModal').modal('hide');
      });

}
//Project Details
function ProjectDetails(edtid){

    axios.post('/ProjectDetails', {
        id: edtid
      })
      .then(function (response) {
        if (response.status==200) {
            $('.projectEditForm').removeClass('d-none');
            $('#editLoder').addClass('d-none');
            var data = response.data;
            $('#pName').val(data[0].ProjectName);
            $('#proImg').val(data[0].ProjectImage);
            $('#proLink').val(data[0].ProjectLink);
            $('#proDesc').val(data[0].ProjectDesc);
        }else{
            $('#editLoder').addClass('d-none');
            $('#editWrong').removeClass('d-none');
        }
      })
      .catch(function (error) {
        $('#editLoder').addClass('d-none');
        $('#editWrong').removeClass('d-none');
      });
}
//Project Update Confirm btn
$('#ProjectUpdatebtn').click(function(){
    var id   = $('#EditID').html();
    var name = $('#pName').val();
    var img  = $('#proImg').val();
    var link = $('#proLink').val();
    var desc = $('#proDesc').val();
    UpdateProject(id,name,img,link,desc);
});
//Udpate Project
function UpdateProject(id,name,img,link,desc){
$('#ProjectUpdatebtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
    if(name.length==''){
        toastr.error('Project Name is empty');
    }else if(img.length==''){
        toastr.error('Project Image link is empty');
    }else if(link.length=='') {
        toastr.error('Project  link is empty');
    }else if(desc.length==''){
        toastr.error('Project  Description is empty');
    }else{

        axios.post('/ProjectUpdate', {
            id: id,
            name: name,
            img: img,
            link: link,
            desc: desc
          })
          .then(function (response) {
            $('#proEditModal').modal('hide');
            toastr.success('Data Updadet Successfully');
            getProject();
          })
          .catch(function (error) {
            $('#proEditModal').modal('hide');
            toastr.error('Data Update Faield');
            getProject();
          });
    }
}
//Add New Project Btn
$('#addNewProject').click(function(){
    $('#AddNewPro').modal('show')
});
//Project Save Btn
$('#ProjectSave').click(function(){
    var name = $('#pNameid').val();
    var img  = $('#proImgid').val();
    var link = $('#proLinkid').val();
    var desc = $('#proDescid').val();
    InsertProject(name,img,link,desc);
});
//Insert Project
function InsertProject(name,img,link,desc){

    if(name.length==''){
        toastr.error('Project Name is empty');
    }else if(img.length==''){
        toastr.error('Project Image link is empty');
    }else if(link.length=='') {
        toastr.error('Project  link is empty');
    }else if(desc.length==''){
        toastr.error('Project  Description is empty');
    }else{
        $('#ProjectSave').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
        axios.post('/InsertProject', {
            name: name,
            img: img,
            link: link,
            desc: desc
        })
        .then(function (response) {
            if (response.data==1) {
                $('#ProjectSave').html('Yes');
                $('#AddNewPro').modal('hide');
                toastr.success('Data Created Successfully');
                getProject();
            }else{
                $('#AddNewPro').modal('hide');
                toastr.error('Created Faield, try again');
                getProject();
            }
        })
        .catch(function (error) {
            $('#AddNewPro').modal('hide');
            toastr.error('Data  Error, Try again later!');
            getProject();
        });
    }
}

</script>
@endsection
