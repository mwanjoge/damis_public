<div class="step step-document-upload">
    <div class="mb-4 text-center">
        <h4 class="text-primary">Upload Required Documents</h4>
        <p class="text-muted">Provide all necessary documents per selected service.</p>
    </div>

    <div id="document-repeater">
        <div class="document-group border rounded p-3 mb-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Document Title</label>
                    <input type="text" name="documents[0][title]" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Name on Document</label>
                    <input type="text" name="documents[0][name]" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Reference Number</label>
                    <input type="text" name="documents[0][ref]" class="form-control">
                </div>
                <div class="col-md-12 mt-2">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" name="documents[0][file]" accept="application/pdf" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

</div>
