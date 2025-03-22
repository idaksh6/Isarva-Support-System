{{-- <div class="row">
    @foreach($assets as $file)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                @if($file->is_image == 1)
                    <!-- Display Image -->
                    <img src="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="card-img-top" alt="{{ $file->filename }}" style="height: 150px; object-fit: cover;">
                @else
                    <!-- Display PDF Icon for Non-Image Files -->
                    <div class="text-center p-4">
                        <i class="icofont-file-pdf display-4 text-danger"></i>
                        <p class="small text-truncate mt-2">{{ $file->filename }}</p>
                    </div>
                @endif
                <div class="card-body text-center">
                    <p class="card-text small">{{ $file->filename }}</p>
                    <a href="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="btn btn-sm btn-outline-primary" download>
                        <i class="icofont-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}