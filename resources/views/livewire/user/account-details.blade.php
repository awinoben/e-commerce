<div>
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ route('dashboard') }}">Home</a></h1>
                            </li>
                            <li>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-area mt-50">
        <div class="container">
            <div class="row">
                @livewire('user.inc.dash-nav')

                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                @include('inc.alert')
                <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">
                        <div class="tab-pane fade active show">
                            <h3 class="last-title">Account details </h3>
                            <div class="checkout_info">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <form class="form-row" wire:submit.prevent="submit">
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">Country</label>
                                                <input class="input-form form-control" type="text" readonly
                                                       value="{{ $user->country->name }}">
                                            </div>
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">Account Type</label>
                                                <input class="input-form form-control" type="text" readonly
                                                       value="{{ $user->role->name }}">
                                            </div>
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">Full Name <span>*</span></label>
                                                <input class="input-form form-control" type="text" wire:model="name">
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">Email Address <span>*</span></label>
                                                <input class="input-form form-control" type="text" wire:model="email">
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form_group col-12">
                                                <label class="form-label">Phone Number <span>*</span></label>
                                                <input class="input-form form-control" type="text"
                                                       wire:model="phone_number">
                                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-outline-success float-right"
                                                        wire:loading.attr="disabled"
                                                        type="submit"><span
                                                        wire:loading.class="fa fa-spinner fa-spin"></span> UPDATE
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow-lg" style="margin-top: 10px!important">
                                    <div class="card-body">
                                        <form class="form-row" action="#">
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">New Password <span>*</span></label>
                                                <input class="input-form input-login form-control" type="password"
                                                       wire:model="password">
                                            </div>
                                            <div class="form_group col-12 col-lg-6">
                                                <label class="form-label">Confirm Password <span>*</span></label>
                                                <input class="input-form input-login form-control" type="password"
                                                       wire:model="confirm_password">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-outline-success float-right"
                                                        wire:loading.attr="disabled"
                                                        type="submit"><span
                                                        wire:loading.class="fa fa-spinner fa-spin"></span> CHANGE
                                                    PASSWORD
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
