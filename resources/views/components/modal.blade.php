<div class="modal fade" id="{{ $name }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{ $title }}
            </div>
            <div class="modal-body overflow-visible" id="body-{{ $name }}">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
                        <div class="dashboard_wrap">
                            <div class="form_blocs_wrap">
                                {{ $content }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
