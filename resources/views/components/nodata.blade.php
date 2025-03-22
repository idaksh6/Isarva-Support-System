<div class="col-12 text-center py-5">
    <div class="no-info-card">
      <i class="fa fa-info-circle fa-3x text-info mb-3"></i>
      <h4 class="mb-2">No information found</h4>
      <p class="text-muted">{{ $message ?? "Sorry, we couldn't find any data." }}</p>
      <a href="{{ $backRoute ?? '#' }}" class="btn btn-primary mt-3">Go Back</a>
    </div>
  </div>
  