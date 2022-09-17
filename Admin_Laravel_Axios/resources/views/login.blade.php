
@extends('layout.app2')
@section('title', 'Login')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body ">
                        <p class="text-muted"> <small>Protfoli Admin Panel Login</small></p>
                        <h3>Login  </h3>
                        <hr>
                        <form action=" " class="loginForm">
                            <div class="form-group">
                                <label for="" class="text-danger">User Name</label>
                                <input  value="" type="text" class="form-control" name="uName" placeholder="User Name">
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-danger">Password</label>
                                <input  type="password" class="form-control" value="" name="uPass" placeholder="User Password">
                            </div>
                            <div class="form-group mt-3">
                                <button name="submit" class="btn btn-danger" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.loginForm').on('submit',function(event){
            event.preventDefault();
            let formData = $(this).serializeArray();
            let user = formData[0]['value'];
            let pass = formData[1]['value'];
            let url      = "/onlogin";

            axios.post(url, {
            user: user,
            pass: pass
            })
            .then(function (response) {
            if (response.status==200 && response.data==1) {
                toastr.success('Login Successfully');
                window.location.href='/';
            }else{
                toastr.error('Your Username Or Password id incorect');
            }
            })
            .catch(function (error) {
                toastr.error('Server Error, Request Not Completed');
            });
        });
    </script>
@endsection





