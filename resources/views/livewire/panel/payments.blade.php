<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <x-title title="payments" />

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table dash_list">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('general.resnumber') }}</th>
                                    <th scope="col">{{ __('general.value') }}</th>
                                    <th scope="col">{{ __('general.status') }}</th>
                                    <th scope="col">{{ __('general.createdAt') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $model)
                                    @php
                                        if ($model->status == \App\Models\Payment::STATUSPAID) {
                                            $statusColor = 'success';
                                        } elseif ($model->status == \App\Models\Payment::STATUSREJECT) {
                                            $statusColor = 'danger';
                                        } elseif ($model->status == \App\Models\Payment::STATUSUNPAID) {
                                            $statusColor = 'warning';
                                        } elseif ($model->status == \App\Models\Payment::STATUSCANCELED) {
                                            $statusColor = 'danger';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $model->resnumber }}</td>
                                        <td>{{ number_format($model->price) . ' ' . __('general.toman') }}</td>
                                        <td class="bg-{{ $statusColor }}">{{ __('general.' . $model->status) }}</td>
                                        <td>{{ localDate($model->created_at, 'Y-m-d H:i:s', '%A، %d %B %Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $data->links('pagination') }}
            </div>
        </div>
    </div>
</div>
