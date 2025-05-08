@extends('layouts.master-without-nav')

@section('content')
    <div class="container py-5">
        {{-- Awareness / Info Cards --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <div class="row mb-5">
        <div class="col-md-4">
            <div class="card awareness-card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-info-circle-fill text-primary fs-2 mb-3"></i>
                    <h5 class="card-title">What is this Service?</h5>
                    <p class="card-text text-muted">
                        This platform helps Tanzanians and those in the diaspora apply for key government services with ease.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card awareness-card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-shield-check text-success fs-2 mb-3"></i>
                    <h5 class="card-title">Secure & Reliable</h5>
                    <p class="card-text text-muted">
                        Your personal information and uploaded documents are handled with the highest levels of data protection.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card awareness-card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-journal-check text-warning fs-2 mb-3"></i>
                    <h5 class="card-title">Step-by-Step Guidance</h5>
                    <p class="card-text text-muted">
                        Follow the simple steps to complete your application. Each stage provides clear instructions.
                    </p>
                </div>
            </div>
        </div>
    </div> --}}

        {{-- Main Wizard Form --}}
        <div class="row justify-content-center">
            <div class="col-xl-2 col">
                <ul class="nav nav-pills flex-column mb-4" id="wizardSteps">
                    @php
                        $steps = [
                            1 => 'Residency Status',
                            2 => 'Location',
                            3 => 'Contact Details',
                            4 => 'Services',
                            5 => 'Attachments',
                            6 => 'Payment Details',
                            7 => 'Status'
                        ];
                    @endphp
                    @foreach ($steps as $index => $step)
                        <li class="nav-item">
                            <a class="nav-link {{ $index === 1 ? 'active' : '' }}" data-bs-toggle="pill"
                                href="#step{{ $index }}">{{ $step }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-xl-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('request.store') }}" method="post" id="wizard-form">
                            @csrf

                         

                            {{-- Wizard Steps --}}
                            <div class="tab-content bg-transparent">
                                <div class="tab-pane fade show active" id="step1">
                                    <div class="text-center mb-4">
                                        <h4 class="fw-semibold">Choose Your Residency Status</h4>
                                        <p class="text-muted">Let us know if you're a resident of Tanzania or living abroad
                                            (diaspora).</p>
                                    </div>
                                    <input type="hidden" name="type" id="selected-type">
                                    <div class="row justify-content-center g-4">
                                        <div class="col-md-5">
                                            <div
                                                class="card border-0 shadow-sm h-100 text-center residency-card hover-shadow">
                                                <div class="card-body">
                                                    <i class="bi bi-house-door-fill text-primary fs-1 mb-2"></i>
                                                    <h5>Resident</h5>
                                                    <p class="text-muted">You currently live in Tanzania.</p>
                                                    <button type="button" name="type" class="btn btn-primary mt-2 next"
                                                        data-next="resident">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div
                                                class="card border-0 shadow-sm h-100 text-center residency-card hover-shadow">
                                                <div class="card-body">
                                                    <i class="bi bi-globe2 text-success fs-1 mb-2"></i>
                                                    <h5>Diaspora</h5>
                                                    <p class="text-muted">You are currently living outside Tanzania.</p>
                                                    <button type="button" name="type" class="btn btn-success mt-2 next"
                                                        data-next="diaspora">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Countries --}}
                                <div class="tab-pane fade" id="step2">
                                    @include('components.countries')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Personal Info --}}
                                <div class="tab-pane fade" id="step3">
                                    @include('components.personal_info')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Service Selection --}}
                                <div class="tab-pane fade" id="step4">
                                    @include('components.service_selection')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Document Upload --}}
                                <div class="tab-pane fade" id="step5">
                                    @include('components.document_upload')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="submit" class="btn btn-primary next">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                                {{-- Payment Page --}}
                                <div class="tab-pane fade" id="step6">
                                    @include('components.payment_page')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-success">Status</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step7">
                                    @include('components.request_status')
                                    <div class="d-flex justify-content-between mt-4">
                                        {{-- <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-success">Complete</button> --}}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Handle diaspora and resident buttons separately
        document.querySelectorAll('.btn.next[data-next]').forEach(button => {
            button.addEventListener('click', function() {
                const type = button.getAttribute('data-next');
                let nextTabId = '';

                if (type === 'diaspora') {
                    document.getElementById('selected-type').value = 'Diaspora';
                    nextTabId = 'step2';
                } else if (type === 'resident') {
                    document.getElementById('selected-type').value = 'Domestic';
                    nextTabId = 'step3';
                }

                if (nextTabId) {
                    const tabTrigger = document.querySelector(
                        `#wizardSteps a[href="#${nextTabId}"]`);
                    if (tabTrigger) {
                        new bootstrap.Tab(tabTrigger).show();
                        scrollToTop();
                    }
                }
            });
        });

        // General next button (used after step2 and onward)
        document.querySelectorAll('.btn.next:not([data-next])').forEach(button => {
            button.addEventListener('click', function() {
                const currentTab = document.querySelector('.tab-pane.active');
                const allTabs = Array.from(document.querySelectorAll('.tab-pane'));
                const currentIndex = allTabs.indexOf(currentTab);

                if (currentIndex >= 0 && currentIndex < allTabs.length - 1) {
                    const nextTabId = allTabs[currentIndex + 1].getAttribute('id');
                    const trigger = document.querySelector(
                        `#wizardSteps a[href="#${nextTabId}"]`);
                    if (trigger) {
                        new bootstrap.Tab(trigger).show();
                        scrollToTop();
                    }
                }
            });
        });

        // Previous button
        document.querySelectorAll('.btn.prev').forEach(button => {
            button.addEventListener('click', function() {
                const currentTab = document.querySelector('.tab-pane.active');
                const allTabs = Array.from(document.querySelectorAll('.tab-pane'));
                const currentIndex = allTabs.indexOf(currentTab);

                if (currentIndex > 0) {
                    const prevTabId = allTabs[currentIndex - 1].getAttribute('id');
                    const trigger = document.querySelector(
                        `#wizardSteps a[href="#${prevTabId}"]`);
                    if (trigger) {
                        new bootstrap.Tab(trigger).show();
                        scrollToTop();
                    }
                }
            });
        });
    });
</script>
