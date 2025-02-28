<div class="container-xxl">
    <div class="col-12">
        <div class="card">
            @if (isset($body))
                <div class="card-body p-5">
                    {{ $body }}
                </div>
            @endif

            @if (isset($footer))
                <div class="card-footer">
                    {{ $footer }}
                </div><!--card-footer-->
            @endif
        </div><!--card-->
    </div>
</div>
