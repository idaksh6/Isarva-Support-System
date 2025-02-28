@props(['href' => '#', 'text' => __('Delete'), 'permission' => false])

<x-utils.form-button
    :action="$href"
    method="delete"
    name="delete-item"
    button-class="btn btn-danger btn-lg"
    permission="{{ $permission }}"
>
    <i class="fa fa-trash"></i> {{ $text }}
</x-utils.form-button>
