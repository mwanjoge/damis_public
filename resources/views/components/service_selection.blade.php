@section('css')
    <link href="{{ URL::asset('build/libs/multi.js/multi.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}" rel="stylesheet">
@endsection

<div class="step step-service-selection">
    <div class="col-lg-10">
        <div class="mt-4">
            <div class="mb-4 text-center">
                <h4 class="text-primary">Select Services</h4>
                <p class="text-muted">Choose your provider and the services you need.</p>
            </div>
            <select multiple="multiple" name="services[]" id="multiselect-optiongroup" class="form-select vh-100">
                @foreach ($providers as $provider)
                <optgroup label="{{ $provider->name }}">
                    @foreach ($provider->services as $service)
                        <option value="{{ $service->id }}" data-name="{{ $service->name }}" data-provider-id="{{ $provider->id }}">
                            {{ $service->name }}
                        </option>
                    @endforeach
                @endforeach
            
                <optgroup label="Other">
                    <option value="other" data-name="Other Documents">Other Documents</option>
                </optgroup>
            </select>
            <p><span class="fw-bold">NOTE:</span> Please select other documents if service  is not in list</p>
        </div>
    </div>
</div>


@section('script')
    <script src="{{ URL::asset('build/libs/multi.js/multi.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>
    <!-- input flag init -->
    <script src="{{ URL::asset('build/js/pages/flag-input.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        const selectedServices = new Set();
        const repeater = document.getElementById('document-repeater');
    
        document.getElementById('multiselect-optiongroup').addEventListener('change', function () {
            const selectedOptions = Array.from(this.selectedOptions).map(opt => ({
                id: opt.value,
                name: opt.getAttribute('data-name') || opt.text
            }));
    
            // Track currently selected IDs
            const currentIds = selectedOptions.map(o => o.id);
    
            // Remove document fields for unselected services
            [...selectedServices].forEach(id => {
                if (!currentIds.includes(id)) {
                    const group = document.getElementById(`document_group_${id}`);
                    if (group) group.remove();
                    selectedServices.delete(id);
                }
            });
    
            // Add document fields for newly selected services
            selectedOptions.forEach(opt => {
                if (!selectedServices.has(opt.id)) {
                    selectedServices.add(opt.id);
                    repeater.appendChild(createDocumentGroup(opt.id, opt.name));
                }
            });
        });
    
        function createDocumentGroup(serviceId, serviceName) {
    const providerId = document.querySelector(`#multiselect-optiongroup option[value="${serviceId}"]`)?.getAttribute('data-provider-id') || '';

    const wrapper = document.createElement('div');
    wrapper.className = 'document-group border rounded p-3 mb-3';
    wrapper.id = `document_group_${serviceId}`;

    wrapper.innerHTML = `
        <h6 class="text-primary mb-3">Documents for: ${serviceName}</h6>
        <input type="hidden" name="documents[${serviceId}][provider_id]" value="${providerId}">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Document Title</label>
                <input type="text" name="documents[${serviceId}][title]" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Name on Document</label>
                <input type="text" name="documents[${serviceId}][name]" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Reference Number</label>
                <input type="text" name="documents[${serviceId}][ref]" class="form-control">
            </div>
            <div class="col-md-12 mt-2">
                <label class="form-label">Upload PDF</label>
                <input type="file" name="documents[${serviceId}][file]" accept="application/pdf" class="form-control" required>
            </div>
        </div>
    `;
    return wrapper;
}

    </script>
    

    @endsection
