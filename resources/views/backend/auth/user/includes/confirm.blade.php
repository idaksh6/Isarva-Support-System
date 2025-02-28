@if ($user->isConfirmed())
    @if ($user->id !== 1 && $user->id !== auth()->id())
        <a href="{{ route( 'admin.auth.user.unconfirm', $user) }}" data-toggle="tooltip" data-placement="top" name="confirm_item">
            <span class="badge bg-success" style="cursor:pointer">Yes</span>
        </a>
    @else
        <span class="badge bg-success">Yes</span>
    @endif
@else
    <a href="#" data-toggle="tooltip" data-placement="top" name="confirm_item">
        <span class="badge bg-danger" style="cursor:pointer">No</span>
    </a>
@endif