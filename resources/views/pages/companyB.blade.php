@extends('layout.adminLayout')
@section('content')
    <!doctype html>
<html lang="en">
<head>
    <title>Contact Form 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='{{asset('https://fonts.googleapis.com/css?family=Roboto:400,100,300,700')}}' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Attendance Management of {{ Auth::user()->name }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters mb-5">
                        <div class="col-md-12">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Details</h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                    Your info was saved, thank you!
                                </div>
                                <form action="{{route('admin.companyB.store')}}" method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    @csrf
                                    {{--                                    @method('PUT')--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="name">Date</label>
                                                <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Post Site</label>
                                                <input type="text" class="form-control" name="postSite" id="postSite" placeholder="Post Site">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="subject">Guard Name</label>
                                                <input type="text" class="form-control" name="guardName" id="guardName" placeholder="Guard Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Shift Start</label>
                                                <input type="time" class="form-control" name="shiftStart" id="shiftStart" placeholder="Shift Start">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="subject">Shift End</label>
                                                <input type="time" class="form-control" name="shiftEnd" id="shiftEnd" placeholder="Shift End">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="#">Remarks</label>
                                                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="4" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" name="submit" class= "btn-outline-primary primary btn-block btn-rounded mt3">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>


@endsection



















