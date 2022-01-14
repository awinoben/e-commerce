<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Add Filter(s)</h3>
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
                                        <label for="type">Select Filter Type</label>
                                        <select name="type" id="type" wire:model="type"
                                                class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                            @foreach($filters as $filter)
                                                <option value="{{ $filter }}">{{ $filter }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Filter Name</label>
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
