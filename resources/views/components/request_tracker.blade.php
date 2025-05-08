@extends('layouts.master-without-nav')

@section('content')

<div class="container">
<div class="row justify-content-center mt-4">
   
<div class="card col-xl-8">
    <div class="card-body">
        <div class="card shadow-sm p-4 mb-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
              
                <div>
                    <h5 class="mb-1"><i class="bi bi-person text-primary"></i> Name:</h5>
                    <p class="text-muted">{{ $mainRequest->member->name }}</p>
                </div>
                <div>
                    <h5 class="mb-1"><i class="bi bi-envelope text-primary"></i> Email:</h5>
                    <p class="text-muted">{{ $mainRequest->member->email }}</p>
                </div>
                <div>
                    <h5 class="mb-1"><i class="bi bi-envelope text-primary"></i> Tracking No:</h5>
                    <p class="text-muted">{{ $mainRequest->tracking_number }}</p>
                </div>
            </div>
        </div>
        <div class="table-responsive table-card">
            <table class="table table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mainRequest->requestItems as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->service->name}}</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>Pending</td>
        
                            <td>
                                @if ($item->status === 'rejected')
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="collapse"
                                        data-bs-target="#edit-form-{{ $item->id }}">
                                        Edit
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-success text-white">Download</button>
                                @endif
                            </td>
                        
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
            
            @if ($item->status === 'rejected')
            <!-- Editable Form -->
            <tr id="edit-form-{{ $item->id }}" class="collapse">
                <td colspan="5">
                    <form method="POST" action="{{ route('requests.updateAttachment', $item->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Name on Document</label>
                                <input type="text" name="certificate_holder_name" class="form-control"
                                    value="{{ $item->certificate_holder_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Reference Number</label>
                                <input type="text" name="certificate_index_number" class="form-control"
                                    value="{{ $item->certificate_index_number }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Upload New PDF</label>
                                <input type="file" name="attachment" accept="application/pdf"
                                    class="form-control" required>
                            </div>
                            <div class="col-12 text-end mt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endif
        </div>
        
    </div>
    </div>
</div>
</div>

@endsection
