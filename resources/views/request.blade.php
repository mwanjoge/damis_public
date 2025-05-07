@extends('layouts.master-without-nav')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form id="wizard-form" autocomplete="off">

                            {{-- Step navigation --}}
                            <ul class="nav nav-pills nav-justified mb-4 d-none" id="wizardSteps">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#step1">1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#step2">2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#step3">3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#step4">4</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#step5">5</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#step6">6</a>
                                </li>
                            </ul>

                            {{-- Tab contents --}}
                            <div class="tab-content bg-transparent">

                                {{--  --}}
                                <div class="tab-pane fade show active" id="step1">
                                    <div class="text-center mb-4">
                                        <h4 class="fw-semibold">Choose Your Residency Status</h4>
                                        <p class="text-muted">Let us know if you're a resident of Tanzania or living abroad
                                            (diaspora).</p>
                                    </div>

                                    <div class="row justify-content-center g-4">
                                        {{-- Resident Card --}}
                                        <div class="col-md-5">
                                            <div
                                                class="card border-0 shadow-sm hover-shadow h-100 text-center residency-card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <i class="bi bi-house-door-fill text-primary fs-1"></i>
                                                    </div>
                                                    <h5 class="card-title">Resident</h5>
                                                    <p class="card-text text-muted">You currently live in Tanzania.</p>
                                                    <button type="button" class="btn btn-primary mt-2 next"
                                                        data-next="resident">Continue</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Diaspora Card --}}
                                        <div class="col-md-5">
                                            <div
                                                class="card border-0 shadow-sm hover-shadow h-100 text-center residency-card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <i class="bi bi-globe2 text-success fs-1"></i>
                                                    </div>
                                                    <h5 class="card-title">Diaspora</h5>
                                                    <p class="card-text text-muted">You are currently living outside of
                                                        Tanzania.</p>
                                                    <button type="button" class="btn btn-success mt-2 next"
                                                        data-next="diaspora">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="step2">
                                    @include('components.countries')

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Step 2 - Personal Info --}}
                                <div class="tab-pane fade" id="step3">
                                    @include('components.personal_info')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Step 3 - Service --}}
                                <div class="tab-pane fade" id="step4">
                                    @include('components.service_selection')
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Step 4 - Upload --}}
                                <div class="tab-pane fade" id="step5">
                                    @include('components.document_upload')

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="button" class="btn btn-primary next">Next</button>
                                    </div>
                                </div>

                                {{-- Step 5 - Payment --}}
                                <div class="tab-pane fade" id="step6">
                                    @include('components.payment_page')

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary prev">Previous</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
   document.addEventListener('DOMContentLoaded', function () {
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Handle diaspora and resident buttons separately
        document.querySelectorAll('.btn.next[data-next]').forEach(button => {
            button.addEventListener('click', function () {
                const type = button.getAttribute('data-next');
                let nextTabId = '';

                if (type === 'diaspora') {
                    nextTabId = 'step2'; // Go to country selection
                } else if (type === 'resident') {
                    nextTabId = 'step3'; // Skip country, go to personal info
                }

                if (nextTabId) {
                    const tabTrigger = document.querySelector(`#wizardSteps a[href="#${nextTabId}"]`);
                    if (tabTrigger) {
                        new bootstrap.Tab(tabTrigger).show();
                        scrollToTop();
                    }
                }
            });
        });

        // General next button (used after step2 and onward)
        document.querySelectorAll('.btn.next:not([data-next])').forEach(button => {
            button.addEventListener('click', function () {
                const currentTab = document.querySelector('.tab-pane.active');
                const allTabs = Array.from(document.querySelectorAll('.tab-pane'));
                const currentIndex = allTabs.indexOf(currentTab);

                if (currentIndex >= 0 && currentIndex < allTabs.length - 1) {
                    const nextTabId = allTabs[currentIndex + 1].getAttribute('id');
                    const trigger = document.querySelector(`#wizardSteps a[href="#${nextTabId}"]`);
                    if (trigger) {
                        new bootstrap.Tab(trigger).show();
                        scrollToTop();
                    }
                }
            });
        });

        // Previous button
        document.querySelectorAll('.btn.prev').forEach(button => {
            button.addEventListener('click', function () {
                const currentTab = document.querySelector('.tab-pane.active');
                const allTabs = Array.from(document.querySelectorAll('.tab-pane'));
                const currentIndex = allTabs.indexOf(currentTab);

                if (currentIndex > 0) {
                    const prevTabId = allTabs[currentIndex - 1].getAttribute('id');
                    const trigger = document.querySelector(`#wizardSteps a[href="#${prevTabId}"]`);
                    if (trigger) {
                        new bootstrap.Tab(trigger).show();
                        scrollToTop();
                    }
                }
            });
        });
    });
</script>
