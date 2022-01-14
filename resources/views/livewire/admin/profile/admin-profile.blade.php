<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Profile</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="nav nav-pills nav-fill mb-4" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="pill"
                       href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                       aria-selected="true">Account</a>
                    <a class="nav-item nav-link" id="v-pills-messages-tab" data-toggle="pill"
                       href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                       aria-selected="false">Security</a>
                </div>

                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                         aria-labelledby="v-pills-home-tab">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Account</h6>
                                <form wire:submit.prevent="submit">
                                    <div class="d-flex mb-3">
                                        <figure class="mr-3">
                                            <img width="100" class="rounded"
                                                 src="{{ \App\Http\Controllers\SystemController::generateAvatars($admin->slug,400) }}"
                                                 alt="...">
                                            <hr>
                                            <p class="text-center">{{ $admin->name }}</p>
                                            <hr>
                                        </figure>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" wire:model="name"
                                                       required>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" wire:model="email"
                                                       required>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number">Email</label>
                                                <input type="text" class="form-control" id="phone_number" required
                                                       wire:model="phone_number">
                                                @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled">
                                        <span wire:loading.class="spinner-border spinner-border-sm"></span> Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                         aria-labelledby="v-pills-messages-tab">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Security</h6>
                                <form wire:submit.prevent="resetPassword">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="old_password">Old Password</label>
                                                <input type="password" class="form-control" wire:model="old_password"
                                                       required
                                                       id="old_password">
                                                @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control" id="new_password" required
                                                       wire:model="new_password">
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm_password"
                                                       required
                                                       wire:model="confirm_password">
                                                @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled">
                                        <span wire:loading.class="spinner-border spinner-border-sm"></span> Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- ./ Content -->


    <!-- Footer -->
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->
</div>
