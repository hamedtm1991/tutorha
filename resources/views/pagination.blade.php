@if ($paginator->hasPages())
    <div class="row align-items-center justify-content-between">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <nav class="float-right">
                <ul class="pagination smalls m-0">
                    @if ($paginator->onLastPage())
                        <li class="page-item">
                            <a id="previous1" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link"><i class="fas fa-arrow-circle-right"></i></a>
                        </li>
                    @elseif($paginator->onFirstPage())
                        <li class="page-item">
                            <a id="next1" wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-link"><i class="fas fa-arrow-circle-left"></i></a>
                        </li>
                    @else
                        <li class="page-item">
                            <a id="previous2" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link"><i class="fas fa-arrow-circle-right"></i></a>
                        </li>

                        <li class="page-item">
                            <a id="next2" wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-link"><i class="fas fa-arrow-circle-left"></i></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
