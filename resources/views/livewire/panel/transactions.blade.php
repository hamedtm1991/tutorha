<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <x-title title="transactions" />

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table dash_list">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('general.type') }}</th>
                                    <th scope="col">{{ __('general.resnumber') }}</th>
                                    <th scope="col">{{ __('general.value') }}</th>
                                    <th scope="col">{{ __('general.status') }}</th>
                                    <th scope="col">{{ __('general.createdAt') }}</th>
                                    <th scope="col">{{ __('general.detail') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $model)
                                    @php
                                        if ($model->type === \App\Models\Payment::TYPE_ONLINE) {
                                            if ($model->status == \App\Models\Payment::STATUSPAID) {
                                                $statusColor = 'success';
                                            } elseif ($model->status == \App\Models\Payment::STATUSREJECT) {
                                                $statusColor = 'danger';
                                            } elseif ($model->status == \App\Models\Payment::STATUSUNPAID) {
                                                $statusColor = 'warning';
                                            } elseif ($model->status == \App\Models\Payment::STATUSCANCELED) {
                                                $statusColor = 'danger';
                                            }
                                        } else {
                                            if ($model->status == \App\Models\WalletTransaction::STATUS_CONFIRMED) {
                                                $statusColor = 'success';
                                            } elseif ($model->status == \App\Models\WalletTransaction::STATUS_REJECTED) {
                                                $statusColor = 'danger';
                                            } elseif ($model->status == \App\Models\WalletTransaction::STATUS_PENDING) {
                                                $statusColor = 'warning';
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        @if($model->type === \App\Models\Payment::TYPE_ONLINE)
                                            <td>{{ __('general.portal') }}</td>
                                        @else
                                            <td class="badge bg-{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? 'success' : 'danger'  }}">{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? __('general.increase') : __('general.decrease') }}</td>
                                        @endif
                                        <td>{{ $model->resnumber }}</td>
                                        <td>{{ number_format($model->value ?? $model->price) . ' ' . __('general.toman') }}</td>
                                        <td class="badge bg-{{ $statusColor ?? 'white' }}">{{ __('general.' . $model->status) }}</td>
                                        <td>{{ localDate($model->created_at, 'Y-m-d H:i:s', '%A، %d %B %Y H:i:s') }}</td>
                                        @if($model->type === \App\Models\Payment::TYPE_ONLINE)
                                            <td>{{ __('general.portal') . ' ' . empty($model->bank_name) ? '' : __('general.' . $model->bank_name) }}</td>
                                        @else
                                            <td>
                                                @php($orderId = $model->order_id ? ' / ' . __('general.orderId') . ': ' : '')
                                                {{ __('general.' . $model->detail) . $orderId . $model->order_id  }}
                                            </td>
                                        @endif
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
