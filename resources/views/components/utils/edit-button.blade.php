@props(['href' => '#', 'permission' => false])

<x-utils.link :href="$href" class="btn btn-primary btn-lg" icon="fa fa-pencil" :text="__('Edit')" permission="{{ $permission }}" />
