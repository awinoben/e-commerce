<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Add SubCategory</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Overview</h6>
                        <div wire:init="loadData">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('inc.alert')
                                    <form wire:submit.prevent="submit">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id"
                                                    class="select2-example form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                                    wire:model="category_id">
                                                <option disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
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

    </div>
    <!-- ./ Content -->


    <!-- Footer -->
    @livewire('admin.inc.footer')
    <!-- ./ Footer -->
</div>
