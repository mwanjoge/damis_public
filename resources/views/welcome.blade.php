@extends('layouts.master-without-nav')

@section('content')
    <style>
        body {
            background: linear-gradient(to right, #eef2f7, #dfe7f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 3px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-5 text-center ">

                    <div class="tab-pane fade show active" id="step1">
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                              <p  class="text-center">Enter Tracking Number</p>
                              <input type="text" class="form-control" id="trackingNumber" placeholder="e.g., TRK123456">
                            </div>
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>

                          
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('request') }}" class="next">Start New Request</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection