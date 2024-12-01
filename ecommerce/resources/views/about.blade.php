@extends('layout')
@section('title') Ecommerce About Us @endsection
@section('keywords')   @endsection
@section('description') @endsection
@section('content')

<div align="center" style="background:#1CD5E8;padding:20px;">
<h3  class="black-text" style="font-weight:bold;margin-top:15px;">
THE DEVELOPER STORY</h3>
<p class="white-text" style="font-weight:bold;">    JOURNEY OF Me FROM STARTUP TO PRESENT</p>


</div>

<div class="container-fluid" style="background:white;font-family: 'Balsamiq Sans', cursive;">
    <div class="row px-5">
        <div   class="col-md-12 ">
            <div align="center">
               <p class="col-md-4">
                    <img src="{{asset('image/wollo.jpg')}}" class="img-fluid">
                </p>
            </div>
              <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am a dedicated Computer Science student at Wollo University, passionate about
                technology and its potential to solve real-world problems. With certifications in
                computer maintenance, networking, and Microsoft Azure, I have built a solid
                foundation in the IT field.
                   </p>
<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; My expertise extends to web
    development, where I have a deep understanding of designing websites using Laravel and React. I also
     have experience in mobile app development, allowing me to create user-friendly applications for
      various platforms. Additionally, I am fascinated by
    machine learning and continuously seek to expand my knowledge in this cutting-edge area of technology.</p>

<h1 class="black-text" style="font-weight:bold;"> THIS WEBSITE IS ECOMMERCE </h1>

    <div align="center">
               <p class="col-md-4">
                    <img src="{{asset('image/16.webp')}}" class="img-fluid">
                </p>
    </div>




        </div>
        <div align="center" class="col-md-12">
        <div class="col-md-8  ">

<h1 align="center" class="black-text" style="font-weight:bold;">GALLARY</h1>

                                    <!--Carousel Wrapper-->
                        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                          <!--Indicators-->
                          <ol class="carousel-indicators">
                            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-2" data-slide-to="2"></li>
                          </ol>
                          <!--/.Indicators-->
                          <!--Slides-->
                              <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                  <div class="view">
                                    <img class="d-block w-100" src="{{url('Img/Gallary/1.jpg')}}"
                                      alt="First slide">
                                    <div class="mask rgba-black-light"></div>
                                  </div>
                                  <div class="carousel-caption">
                                    <h3 class="h3-responsive"></h3>
                                    <p></p>
                                  </div>
                                </div>


                                  <div class="carousel-item">
                                  <!--Mask color-->
                                  <div class="view">
                                    <img class="d-block w-100" src="{{url('Img/Gallary/2.jpg')}}"
                                      alt="Third slide">
                                    <div class="mask rgba-black-slight"></div>
                                  </div>
                                  <div class="carousel-caption">
                                    <h3 class="h3-responsive"> </h3>
                                    <p> </p>
                                  </div>
                                </div>
                              </div>

                          <!--/.Slides -->
                          <!--Controls-->
                          <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                          <!--/.Controls-->
                        </div>
                        <!--/.Carousel Wrapper-->
        </div>
        </div>
        <div align="center" class="col-md-3"> </div>
         <div align="left"  class="col-md-6 mx-3">
              <br>    <br>
                <span class="black-text" style="font-weight:bold;font-size:25px;">MY Mission:</span> "To leverage my
                 skills in computer science, networking, and software development to create innovative solutions that
                 enhance user experiences and drive technological advancements. I aim to continuously learn and grow in
                  the fields of web and mobile app development
                 while contributing to meaningful projects that address real-world challenges." <br>

            <span class="black-text" style="font-weight:bold;font-size:25px;">MY Vision:</span>
            "To become a leading technology professional recognized for my expertise in web design,
             mobile app development, and machine learning, committed to making a positive impact in
             the tech industry. I envision a future where technology seamlessly integrates into daily
              life, empowering individuals and
             communities through accessible and intelligent solutions."

        </div>
    </div>
 <br><br>

</div>


@endsection
