<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
<section class="Form m-5">
    <div class="container mt-10">
        <dive class="row no-gutters">
            <div class="col-lg-5">
                <img src="{{ asset('assets/Patient.png')}}" class="img-fluid" alt="Patient Image">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3" style="color: white;">Stay Safe, Stay Healthy<br>Welcome to PGI!
                </h1>
                <h4 style="color: white;">Create new account</h4>
                <form method="POST" action="{{route('create.patient')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Full Name</h6>
                            <input name="name" type="id" class="form-control my-2 p-2" placeholder="Full Name">
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
                            <h6 style="color: white;">Identity number</h6>
                            <input name="identity_number" type="id" class="form-control my-2 p-2"
                                   placeholder="Identity Number or Residency number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Password</h6>
                            <input name="password" type="password" class="form-control my-2 p-2" placeholder="*******">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <h6 style="color: white;">Confirm password</h6>
                            <input name="password_confirmation" type="password" class="form-control my-2 p-2"
                                   placeholder="*******">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 align-self-center">
                            <div class="text-center"><button type="submit" class="btn btn-primary " href="#" role="button">Sign up</button>
                            </div>
                        </div>
                    </div>
                    <p>have an account? <a href="{{route('patient.login')}}">Login</a></p>

                </form>
            </div>

        </dive>
    </div>
</section>

<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
</body>
</html>
