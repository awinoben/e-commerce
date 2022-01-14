<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Edit {{ $size->value }} Size</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><a href="{{ route('admin.list.size') }}" class="btn btn-default"><span
                                    data-feather="arrow-left"></span><b>Back</b></a> Overview</h6>
                        <div class="row">
                            <div class="col-md-12">
                                @include('inc.alert')
                                <form wire:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="value">Edit Size</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                               id="value" placeholder="Update {{ $size->value }}"
                                               wire:model="value">
                                        @error('value')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled"><span
                                            wire:loading.class="spinner-border spinner-border-sm"></span> Update
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
