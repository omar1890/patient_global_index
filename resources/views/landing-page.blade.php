<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/landingPage.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body data-spy="scroll" data-target=".navbar-nav" data-offset="50">
<!-- header section -->
<header class="header fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand -->
            <a class="navbar-brand" href="#"><span class="logo-circle"></span>PGI</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view.patient.login')}}">Login/Sign-up</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- Home section -->
<section class="home-section " id="home">
    <div class="bg-shapes">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="home-content">
                    <h1>Patient Global Index</h1>
                    <p>Healthcare facilities face challenges due to a lack of complete medical histories for patients, which can delay medical diagnoses and treatments, particularly in emergency situations. To resolve this issue, the Patient Global Index (PGI) system has been created to store and centralize patient medical records for easy access by both patients and medical staff.</p>
                </div>
            </div>
            <div class="col-lg-6 order-first order-lg-last">
                <div class="home-img">
                    <img src="{{asset('assets/Tech.png')}}" alt="PGIpic">
                </div>
            </div>
        </div>
</section>

<!-- Problem -->
<section class="about-section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex">
                <div class="about-img">
                    <img id="p-img" class="img-fluid" src="{{asset('assets/heartpump.jpg')}}" alt="logo">

                </div>

            </div>
            <div class="col-lg-6 order-first order-lg-last">
                <div class="section-title">
                    <h1 class="title">Problem</h1>
                    <h2 class="subtitle">Problem details</h2>

                </div>
                <div class="about-content">

                    <ul class="list-unstyled">
                        <li id="problem"><i class="fa-solid fa-check"></i>Healthcare facilities often struggle with the lack of complete patient medical histories, which can hinder faster detection of health issues. ​</li>
                        <li id="problem"><i class="fa-solid fa-check"></i>In emergency situations, this lack of information can even lead to delayed medical procedures, such as transfusions, due to unknown blood type. ​</li>
                        <li id="problem"><i class="fa-solid fa-check"></i>Additionally, patients may experience frustration and repeated processes when transferring to different hospitals or when asked to recall past medical history. ​</li>
                        <li id="problem"><i class="fa-solid fa-check"></i>To address these challenges, the Patient Global Index (PGI) has been created to centralize and store a patient's medical history, accessible to both patients and medical staff.​</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Solution section -->

<section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex">
                <div class="section-title" style="text-align: left; margin-left: 90px;">
                    <h1 class="title">Our solution</h1>
                    <h2 class="subtitle">Solution details</h2>

                    <div class="about-content">

                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-check"></i>A display of the patient's complete medical history, including information such as blood type, vaccines, past diagnoses, surgeries, etc.​</li>
                            <li><i class="fa-solid fa-check"></i>Access for medical staff to view the patient's medical history to facilitate more accurate diagnoses and efficient procedures.​</li>
                            <li><i class="fa-solid fa-check"></i>Patients can retrieve their medical history from any location, allowing them to easily track their health and recall important information such as vaccines.</li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="col-lg-6">
                <div class="about-img">
                    <img class="img-fluid" src="{{asset('assets/Solution.jpg')}}" alt="logo">

                </div>
            </div>
        </div>
    </div>
</section>

<!-- features -->
<section class="feature-section bg-light" id="features">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title">
                    <h1 class="title">features</h1>
                    <h2 class="subtitle"> PGI features! </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- feature item -->
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="col-lg-12 feature-items">
                    <div class="icon">
                        <h3>Globalization</h3>
                        <p>system is accessible at any place in the world you can take your medical info anywhere in the world</p>
                    </div>
                </div>
            </div>
            <!-- feature item end -->
            <!-- feature item -->
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="col-lg-12 feature-items">
                    <div class="icon">
                        <!-- we can put icon here from font awesone -->
                        <h3>first</h3>
                        <p>desc</p>
                    </div>
                </div>
            </div>
            <!-- feature item end -->
            <!-- feature item -->
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="col-lg-12 feature-items">
                    <div class="icon">
                        <!-- we can put icon here from font awesone -->
                        <h3>first</h3>
                        <p>desc</p>
                    </div>
                </div>
            </div>
            <!-- feature item end -->
            <!-- feature item -->
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="col-lg-12 feature-items">
                    <div class="icon">
                        <!-- we can put icon here from font awesone -->
                        <h3>first</h3>
                        <p>desc</p>
                    </div>
                </div>
            </div>
            <!-- feature item end -->
            <!-- feature item -->
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="col-lg-12 feature-items">
                    <div class="icon">
                        <!-- we can put icon here from font awesone -->
                        <h3>first</h3>
                        <p>desc</p>
                    </div>
                </div>
            </div>
            <!-- feature item end -->
        </div>
    </div>
</section>


<!-- footer section  -->
<footer class="footer" id="contact">
    <div class="containe">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="footer-logo">
                    <a class="navbar-brand" href="#"><span class="logo-circle"></span>PGI</a>
                </div>

                <div class="footer-text">
                    <p>
                        Contact us we will be happy to hear your suggestions
                    </p>
                </div>
                <div class="footer-social-links">
                    <ul class="list-unstyled">
                        <li><a href="https://www.linkedin.com/in/rawan-alfarhan/"><i class="fa-brands fa-linkedin"></i></a>
                            Rawan Alfarhan
                        </li>
                        <li><a href="https://www.linkedin.com/in/omarwael/"><i class="fa-brands fa-linkedin"></i></a>
                            Omar Wael
                        </li>
                        <li><a><i class="fa-brands fa-linkedin"></i></a>Halema Alaqily</li>
                        <li><a><i class="fa-brands fa-linkedin"></i></a>Abdullah Gamal</li>
                        <li><a><i class="fa-brands fa-linkedin"></i></a>Rana Alotabi</li>
                    </ul>
                    <!-- <a href="#" ><i class="fa-brands fa-linkedin"></i> <br></a>
                    <a href="#" ><i class="fa-brands fa-linkedin"></i> <br></a>
                    <a href="#" ><i class="fa-brands fa-linkedin"></i><br></a>
                    <a href="#" ><i class="fa-brands fa-linkedin"></i><br></a> -->

                </div>

            </div>
        </div>
    </div>
    <div class="copyright">
        <p>
            Copyrigtht&copy; by Cloud Ninjas 2023
        </p>

    </div>
</footer>

<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
</body>
</html>
