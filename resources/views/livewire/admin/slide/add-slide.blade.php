<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Add Slide</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Overview</h6>
                        <div class="row">
                            <div class="col-md-12">
                                @include('inc.alert')
                                <form wire:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="name">Sub Title</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               id="name" placeholder="Enter name"
                                               wire:model="name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Slide Url <i class="text-info">optional</i></label>
                                        <input type="url"
                                               class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                                               id="url" placeholder="Enter url"
                                               wire:model="url">
                                        @error('url')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slide_image">Slide Banner</label>
                                        <input type="file"
                                               class="form-control {{ $errors->has('slide_image') ? 'is-invalid' : '' }}"
                                               id="slide_image" placeholder="Enter Banner Image"
                                               wire:model="slide_image">
                                        @error('slide_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled"><span
                                            wire:loading.class="spinner-border spinner-border-sm"></span> Save
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
