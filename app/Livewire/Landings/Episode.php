<?php

namespace App\Livewire\Landings;

use App\Services\V1\Wallet\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Episode extends Component
{
    public $index;
    public $episode;
    public $product;
    public $url;
    public $first;

    public $listeners = [];

    public function mount($index, $episode, $product, $first, $url)
    {
        $this->index = $index;
        $this->episode = $episode;
        $this->product = $product;
        $this->url = $url;
        $this->first = $first;
        $this->listeners = ["pay-" . $episode->id =>"pay"];
    }

    /**
     * @param \App\Models\Episode $episode
     * @return void
     */
    public function pay(\App\Models\Episode $episode)
    {
        if (!Auth::user()->wallet || Auth::user()->wallet->value < $episode->price) {
            return $this->redirect(Route('payment', ['value' => $episode->price - Auth::user()->wallet->value ?? 0]));
        }

        if (!$episode->checkOrder()) {
            $response = Wallet::payWithoutCart($episode);

            if ($response['status']) {
                $this->dispatch('toast', type: 'success', message: __('general.successfulPurchase'));
            } else {
                $this->dispatch('toast', type: 'error', message: $response['error']);
            }
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.alreadyPaid'));
        }
    }

    /**
     * @return null
     */
    public function login()
    {
        return $this->redirect(Route('login'));
    }

    public function render()
    {
        $class = 'unview';
        $onclick = "";
        if (!empty($this->url)) {
            $class = 'complete videourl';
            $onclick = 'scrollup()';
        }

        if (!Auth::check() && empty($this->url)) {
            $onclick = "login()";
        }

        if (Auth::check() && empty($this->url)) {
            $onclick = "getConfirm('landings.episode', 'pay-" . $this->episode->id . "', '" . $this->episode->id . "', '" .  __('general.sure') . "', '" . __('general.reducingMoney', ['value' => number_format($this->episode->price) . ' ' . __('general.toman')]) . "', '" . __('buttons.yes') . "', '" . __('buttons.no') . "')";
        }

        return view('livewire.landings.episode', [
            'index' => $this->index,
            'episode' => $this->episode,
            'product' => $this->product,
            'url' => $this->url,
            'class' => $class,
            'onclick' => $onclick
        ]);
    }
}
