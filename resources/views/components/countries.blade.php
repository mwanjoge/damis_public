@php use Illuminate\Support\Str; @endphp

<h4 class="mb-4 text-center">Select Your Country of Residence</h4>

<div class="mb-4 text-center">
    <input type="text" id="countrySearch" class="form-control w-50 mx-auto" placeholder="Search for a country...">
</div>

<div class="row" id="country-selection">
    @foreach ($countries as $country)
        <div class="col-md-3 col-sm-6 mb-4 country-item">
            <div class="country-card p-3 text-center h-100" data-country-name="{{ Str::title($country->name) }}">
                <div class="fw-semibold">{{ Str::title($country->name) }}</div>
            </div>
        </div>
    @endforeach
</div>

<!-- Add filtering script -->


<style>
    .country-card {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .country-card:hover {
        background-color: #e9f5ff;
    }

    .country-card.selected {
        background-color: #cfe2ff;
        border-color: #0d6efd;
        color: #0d6efd;
        font-weight: 600;
    }
</style>
<script>
    document.getElementById('countrySearch').addEventListener('input', function() {
        let search = this.value.toLowerCase();
        document.querySelectorAll('.country-item').forEach(function(el) {
            let countryName = el.querySelector('.country-card').getAttribute('data-country-name')
                .toLowerCase();
            el.style.display = countryName.includes(search) ? 'block' : 'none';
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const countryCards = document.querySelectorAll('.country-card');
        const hiddenInput = document.getElementById('selected-country-id');
        const nextButton = document.getElementById('next-to-personal');

        countryCards.forEach(card => {
            card.addEventListener('click', function() {
                // Clear previous selection
                countryCards.forEach(c => c.classList.remove('selected'));

                // Set current as selected
                this.classList.add('selected');

                // Store country ID
                const countryId = this.getAttribute('data-country');
                hiddenInput.value = countryId;
            });
        });

        nextButton.addEventListener('click', function() {
            if (!hiddenInput.value) {
                alert('Please select your country before continuing.');
                return;
            }

            // Navigate to personal info step (step3)
            const nextTab = document.querySelector('#wizardSteps a[href="#step3"]');
            if (nextTab) {
                new bootstrap.Tab(nextTab).show();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
