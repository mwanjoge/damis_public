<div class="step step-service-selection">
    <div class="mb-4 text-center">
        <h4 class="text-primary">Select Services</h4>
        <p class="text-muted">Choose your provider and the services you need.</p>
    </div>

    <div class="mb-3">
        <label for="provider" class="form-label">Service Provider</label>
        <select class="form-select" id="provider" name="provider_id" required>
            <option selected disabled>Select Provider</option>
            @foreach ($providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="services-list" class="mt-3">
        <!-- Services will load here dynamically -->
    </div>
</div>

<script>
    document.getElementById('provider').addEventListener('change', function () {
        const providerId = this.value;
        if (!providerId) return;

        fetch(`/get-services/${providerId}`)
            .then(response => response.json())
            .then(data => {
                const servicesList = document.getElementById('services-list');
                const documentRepeater = document.getElementById('document-repeater');
                servicesList.innerHTML = '';
                documentRepeater.innerHTML = '';

                data.services.forEach(service => {
                    const serviceItem = document.createElement('div');
                    serviceItem.classList.add('form-check');

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('form-check-input');
                    checkbox.id = `service_${service.id}`;
                    checkbox.name = 'services[]';
                    checkbox.value = service.id;

                    const label = document.createElement('label');
                    label.classList.add('form-check-label');
                    label.setAttribute('for', `service_${service.id}`);
                    label.innerText = service.name;

                    // Handle document fields show/hide
                    checkbox.addEventListener('change', function () {
                        if (this.checked) {
                            const docGroup = createDocumentGroup(service.id, service.name);
                            documentRepeater.appendChild(docGroup);
                        } else {
                            const existing = document.getElementById(`document_group_${service.id}`);
                            if (existing) existing.remove();
                        }
                    });

                    serviceItem.appendChild(checkbox);
                    serviceItem.appendChild(label);
                    servicesList.appendChild(serviceItem);
                });
            })
            .catch(error => console.error('Error fetching services:', error));
    });

    function createDocumentGroup(serviceId, serviceName) {
        const wrapper = document.createElement('div');
        wrapper.className = 'document-group border rounded p-3 mb-3';
        wrapper.id = `document_group_${serviceId}`;

        wrapper.innerHTML = `
            <h6 class="text-primary mb-3">Documents for: ${serviceName}</h6>
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
