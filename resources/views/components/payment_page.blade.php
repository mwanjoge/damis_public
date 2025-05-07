<div class="step step-payment-confirm">
    <div class="mb-4 text-center">
        <h4 class="text-primary">Payment Information</h4>
        <p class="text-muted">Review your total and confirm your payment.</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Control Number</label>
        <input type="text" class="form-control" name="control_number" value="{{ $controlNumber }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Total Amount (TZS)</label>
        <input type="text" class="form-control" name="total_amount" value="{{ $totalAmount }}" readonly>
    </div>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="confirmPayment" required>
        <label class="form-check-label" for="confirmPayment">I confirm I have paid using the control number</label>
    </div>

    <button type="submit" class="btn btn-success w-100">Complete Request</button>
</div>
