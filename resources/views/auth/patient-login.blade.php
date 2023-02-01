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
                <img src="{{asset('assets/Patient.png')}}" class="img-fluid" alt="Patient Image">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3" style="color: white;">Stay Safe, Stay Healthy</h1>
                <h4 style="color: white;">Login to your account</h4>
                <form method="POST" action="{{route('patient.login')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input name="mobile" type="id" class="form-control my-2 p-2" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input name="password" type="password" class="form-control my-2 p-2" placeholder="*******">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-lg-12 align-self-center">
                            <div class="text-center"><button type="submit" class="btn btn-primary " href="#" role="button">Login</button></div>
                        </div>
                    </div>
                    <p>Don't have an account? <a href="{{route('view.patient.register')}}">Sign up</a></p>

                    @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile_number') }}
                        </div>
                    @endif
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

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
