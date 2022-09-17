@extends('layout.app')
@section('title','Course')
@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button class="btn btn-sm btn-danger" id="addNewCourse">Add New</button>
            <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Course Banner</th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Fee</th>
                    <th class="th-sm">Class</th>
                    <th class="th-sm">Enroll</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="courseBody">
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

{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="CourseDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Are you sure want to delete this?</p>
            <p class="text-center d-none" id="CourseDelId"> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="courseDelConBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

{{--  Course Edit Modal--}}
<div class="modal fade" id="EditCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Course Edit</h5>
        <p id="EditID" class="d-none"></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row d-none" id="editBody">
       		<div class="col-md-6" >
             	<input id="CourseName" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDes" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFee" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnroll" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6" >
     			<input id="CourseClass" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLink" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImg" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>

       	</div>
           <img class="text-center" id="editLoder" src="{{ asset('images/loader.svg') }}" width="70px" alt="">
           <h6 class="d-none text-center"  id="editWrong" style="color:red">Something went wrong</h6>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

{{-- Add New Course --}}
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
     			<input id="CourseLinkId" type="text"  id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text"   id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    getCourse();

    // Get Course
function getCourse() {

axios.get('/getCourse')
    .then(function(response) {
        if (response.status == 200) {
            $('#courseDataTable').DataTable().destroy();
            $('#courseBody').empty();
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
            var courseData = response.data;
            $.each(courseData, function(i) {
                $('<tr>').html(
                    "<td class='th-sm'><img width='70px' src=" + courseData[i].courseImage + "></td>" +
                    "<td class='th-sm'>" + courseData[i].courseName + "</td>" +
                    "<td class='th-sm'>" + courseData[i].courseFee + "</td>" +
                    "<td class='th-sm'>" + courseData[i].courseTotalClass + "</td>" +
                    "<td class='th-sm'>" + courseData[i].courseTotalEnroll + "</td>" +
                    "<td class='th-sm'><a class='Courseedit' data-id=" + courseData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td class='th-sm'><a class='deleteCoursebtn' data-id=" + courseData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#courseBody');
            });
            //Course Delete btn Modal
            $('.deleteCoursebtn').click(function() {
                var delId = $(this).data('id');
                $('#CourseDelId').html(delId);
                $('#CourseDelModal').modal('show');
            });
            //Course Edit Show Modal
            $('.Courseedit').click(function() {
                var EditId = $(this).data('id');
                $('#EditID').html(EditId);
                EditCourse(EditId);
                $('#EditCourseModal').modal('show');
            });
            $('#courseDataTable').DataTable({
                "order": false
            });
            $('.dataTables_length').addClass('bs-select');
        } else {
            $('#wrongDiv').removeClass('d-none');
        }
    })
    .catch(function(error) {
        $('#wrongDiv').removeClass('d-none');
    });



}
//Course Delete Confirm Button
$('#courseDelConBtn').click(function() {
var dId = $('#CourseDelId').html();
DeleteCourse(dId);
});

//Course Delete
function DeleteCourse(dId) {
$('#courseDelConBtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
axios.post('/delCourse', {
        id: dId
    })
    .then(function(response) {
        if (response.data == 1) {
            $('#courseDelConBtn').html('Yes');
            $('#CourseDelModal').modal('hide');
            toastr.success('Data Successfully Delete');
            getCourse();

        } else {
            toastr.error('Something went wrong! Try again');
            $('#CourseDelModal').modal('hide');
            getCourse();
        }
    })
    .catch(function(error) {
        toastr.error('Something went wrong! Try again');
    });
}

//Course Get All Data for Edit
$('#addNewCourse').click(function() {
$('#addCourseModal').modal('show');

});
//Course Insert Confirm BTN
$('#CourseAddConfirmBtn').click(function() {
var name = $('#CourseNameId').val();
var desc = $('#CourseDesId').val();
var fee = $('#CourseFeeId').val();
var enrol = $('#CourseEnrollId').val();
var clas = $('#CourseClassId').val();
var crslink = $('#CourseLinkId').val();
var image = $('#CourseImgId').val();
insertCourse(name, desc, fee, enrol, clas, crslink, image);
});

//Course Insert
function insertCourse(name, desc, fee, enrol, clas, crslink, image) {

if (name.length == '') {
    toastr.error('Course Title is empty');
} else if (desc.length == '') {
    toastr.error('Course Description is empty');
} else if (fee.length == '') {
    toastr.error('Course Fee is empty');
} else if (enrol.length == '') {
    toastr.error('Course Enroll is empty');
} else if (clas.length == '') {
    toastr.error('Course Class is empty');
} else if (crslink.length == '') {
    toastr.error('Course Class Link is empty');
} else if (image.length == '') {
    toastr.error('Course Image Link is empty');
} else {
    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");

    axios.post('/CourseInsert', {
            name: name,
            desc: desc,
            fee: fee,
            enrol: enrol,
            clas: clas,
            crslink: crslink,
            image: image,
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#addCourseModal').modal('hide');
                toastr.success('Data Successfully Inserted');
                getCourse();
            } else {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went wrong! Try again');
                getCourse();
            }

        })
        .catch(function(error) {
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went wrong! Try again');
        });
}


}
//Course Edit
function EditCourse(EditId) {
axios.post('/CourseEdit', {
        id: EditId
    })
    .then(function(response) {
        if (response.status == 200) {
            $('#editBody').removeClass('d-none');
            $('#editLoder').addClass('d-none');
            var Data = response.data;
            $('#CourseName').val(Data[0].courseName);
            $('#CourseDes').val(Data[0].courseDesc);
            $('#CourseFee').val(Data[0].courseFee);
            $('#CourseEnroll').val(Data[0].courseTotalEnroll);
            $('#CourseClass').val(Data[0].courseTotalClass);
            $('#CourseLink').val(Data[0].courseLink);
            $('#CourseImg').val(Data[0].courseImage);
        } else {
            $('#editLoder').addClass('d-none');
            $('#editWrong').removeClass('d-none');
            $('#editBody').addClass('d-none');
        }
    })
    .catch(function(error) {
        $('#editLoder').addClass('d-none');
        $('#editWrong').removeClass('d-none');

        $('#editBody').addClass('d-none');
    });
}


//Update Course Yes Button
$('#CourseEditConfirmBtn').click(function() {
var id = $('#EditID').html();
var name = $('#CourseName').val();
var desc = $('#CourseDes').val();
var fee = $('#CourseFee').val();
var enrol = $('#CourseEnroll').val();
var clas = $('#CourseClass').val();
var crslink = $('#CourseLink').val();
var image = $('#CourseImg').val();
UpdateCourse(id, name, desc, fee, enrol, clas, crslink, image);
})
//Update Course
function UpdateCourse(id, name, desc, fee, enrol, clas, crslink, image) {
$('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
if (name.length == '') {
    toastr.error('Course Title is empty');
} else if (desc.length == '') {
    toastr.error('Course Description is empty');
} else if (fee.length == '') {
    toastr.error('Course Fee is empty');
} else if (enrol.length == '') {
    toastr.error('Course Enroll is empty');
} else if (clas.length == '') {
    toastr.error('Course Class is empty');
} else if (crslink.length == '') {
    toastr.error('Course Class Link is empty');
} else if (image.length == '') {
    toastr.error('Course Image Link is empty');
} else {


    axios.post('/CourseUpdate', {
            id: id,
            name: name,
            desc: desc,
            fee: fee,
            enrol: enrol,
            clas: clas,
            crslink: crslink,
            image: image,
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#EditCourseModal').modal('hide');
                toastr.success('Data Successfully Updated');
                getCourse();
            } else {
                $('#EditCourseModal').modal('hide');
                toastr.error('Something Went wrong! Try again');
                getCourse();
            }

        })
        .catch(function(error) {
            $('#EditCourseModal').modal('hide');
            toastr.error('Something Went wrong! Try again');
        });
}

}
</script>
@endsection
