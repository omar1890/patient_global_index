<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
<section class="Form m-5">
    <div class="container mt-10">
        <div class="row no-gutters">
            <div class="col-lg-5">
                <img src="{{asset('assets/Hospital.png')}}" class="img-fluid" alt="Patient Image">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3" style="color: white;">Welcome to IPG!</h1>
                <h4 style="color: white;">Create new account</h4>
                <form method="POST" action="{{route('create.hospital')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Hospital name</h6>
                            <input name="name" type="text" class="form-control my-2 p-2" placeholder="Hospital name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Phone number</h6>
                            <input name="mobile" type="number" class="form-control my-2 p-2" placeholder="0591457489">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Email</h6>
                            <input name="email" type="email" class="form-control my-2 p-2"
                                   placeholder="hospitalname@gmail.com">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Address</h6>
                            <input name="address" type="text" class="form-control my-2 p-2" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Password</h6>
                            <input name="password_confirmed" type="password" class="form-control my-2 p-2"
                                   placeholder="*******">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Confirm password</h6>
                            <input type="password" class="form-control my-2 p-2" placeholder="*******">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-12 align-self-center">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary " href="#" role="button">Sign up</button>
                            </div>
                        </div>
                    </div>
                    <p>have an account? <a href="{{route('login')}}">Login</a></p>

                </form>
            </div>

        </div>
    </div>
</section>

<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
</body>
</html>
