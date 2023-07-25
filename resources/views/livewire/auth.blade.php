<div>
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-8 col-md-12 col-sm-12">
                    <form wire:submit="verify">
                        @if($showCode)
                            <div class="crs_log_wrap">
                            <div class="crs_log__thumb" style="background-color: #02b97cbd">
                            </div>
                            <div class="crs_log__caption">
                                <div class="rcs_log_123">
                                    <div class="rcs_ico"><i class="fas fa-lock" style="color: @if($errors->has('code')) red @else #03b97c @endif"></i></div>
                                </div>

                                <div class="rcs_log_124">
                                    <div class="Lpo09"><h4>{{ __('auth.login') }}</h4></div>
                                    <div class="form-group">
                                        <label class="mb-1">{{ __('inputs.verificationCode') }}</label>
                                        <p id="demo" style="color: green"></p>
                                        <a id="resend-verification" class="mb-2" href="#" x-on:click="$wire.resendVerification()" style="display: none; color: #02b97c">{{ __('buttons.resendVerification') }}</a>
                                        <input type="text" class="form-control" placeholder="******" wire:model="code" />
                                        <div class="mt-2" style="color: red">@error('code') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="form-group mt-3 mb-2">
                                        <button type="submit" class="btn full-width btn-md theme-bg text-white">{{ __('buttons.login') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>

                    <form wire:submit="initialAuth">
                        @if(!$showCode)
                            <div class="crs_log_wrap">
                            <div class="crs_log__thumb" style="background-color: #02b97cbd">
                            </div>
                            <div class="crs_log__caption">
                                <div class="rcs_log_123">
                                    <div class="rcs_ico"><i class="fas fa-lock" style="color: @if($errors->has('mobile')) red @else #03b97c @endif"></i></div>
                                </div>

                                <div class="rcs_log_124">
                                    <div class="Lpo09"><h4>{{ __('auth.login') }}</h4></div>
                                    <div class="form-group">
                                        <label class="mb-1">{{ __('inputs.mobileNumber') }}</label>
                                        <input type="text" class="form-control" placeholder="0912xxxxxxx" wire:model="mobile" />
                                        <div class="mt-2" style="color: red">@error('mobile') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="form-group mt-3 mb-2">
                                        <button type="submit" class="btn full-width btn-md theme-bg text-white">{{ __('buttons.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
