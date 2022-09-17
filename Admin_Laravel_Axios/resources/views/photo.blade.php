@extends('layout.app')
@section('title','Photo Gallery')
@section('content')

<div id="mainDiv" class="container">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewPhoto" class="btn btn-sm btn-danger">Add New</button>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row" id="ImageIdRow">

    </div>
    <button id="loadMore" class="btn btn-sm btn-danger" style="text-align: center">Load More</button>
</div>

{{-- add new modal --}}
<div class="modal fade" id="addPhotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Add New Photo your gallery</p>
            <hr>
                <label for="">Chose File</label>
                <input type="file" id="imgInput" class="form-control">
                <img class="imgPre mt-3" id="imagePreview" src="{{ asset('images/photGell.jpg') }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
          <button id="PhotYesbtn" type="button" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
<script type="text/javascript">
    GetImage();
    // Show Modal
    $('#addNewPhoto').click(function(){
        $('#addPhotModal').modal('show');
    });
    // Image Reader-----
    $('#imgInput').change(function(){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload= function(event) {
            var ImageSource = event.target.result;
            $('#imagePreview').attr('src',ImageSource);

        }
    });
    //Photo Save yess button
    $('#PhotYesbtn').click(function(){
$('#PhotYesbtn').html("<div class='spinner-border spinner-grow-sm text-warning' role='status'></div>");
        var photo = $('#imgInput').prop('files')[0];
        var formData = new FormData();
        formData.append('photo',photo);

        axios.post('/upPhoto',formData)
        .then(function(response){
            $('#ImageIdRow').empty();
            $('#PhotYesbtn').html('Yes');
            $('#addPhotModal').modal('hide');
            toastr.success('Images Successfully Uploded');
            GetImage();
        })
        .catch(function(error){
            toastr.error('Upload Error, try again');
        });
    });

    //Get Gallery Image
    function GetImage(){

        axios.get('/getImg')
        .then(function(response){
            if (response.status==200) {
                var getPhoto = response.data;
                $.each(getPhoto,function(i){
                    $('<div class="col-md-3 mt-1" id="ImageId">').html(
                        "<img data-id="+getPhoto[i].id+" class='pl-1' width='270px' height='150px' src="+ getPhoto[i].location +" alt='Gallery Images'>"
                    ).appendTo('#ImageIdRow');
                });
            }else{
                alert('wrong else');
            }
        })
        .then(function(error){

        });
    }
    $('#loadMore').click(function(){
       var FirstImgId =  $(this).closest('div').find('img').data('id');
       LoadById(FirstImgId);

    });
    //Load by id
    function LoadById(FirstImgId){
            var imgId = FirstImgId+3;
            var URL = "/loadMore/"+imgId;
            alert(URL);

        axios.get(URL)
        .then(function(response){
            if (response.status==200) {
                var morePhoto = response.data;
                alert(morePhoto)
                $.each(morePhoto,function(i){
                    $('<div class="col-md-3 mt-1" id="ImageId">').html(
                        "<img data-id="+morePhoto[i].id+" class='pl-1' width='270px' height='150px' src="+ morePhoto[i].location +" alt='Gallery Images'>"
                    ).appendTo('#ImageIdRow');
                });
            }else{
                alert('wrong else');
            }
        })
        .then(function(error){

        });

    }


</script>
@endsection
