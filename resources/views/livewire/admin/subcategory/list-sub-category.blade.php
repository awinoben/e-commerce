<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>SubCategory List</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div wire:poll.60000ms>
                        <div class="card-body">
                            <div wire:loading>
                                @include('inc.loader-effect')
                            </div>
                            <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($subcategories))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Sub Sub-Category</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($subcategories as $subcategory)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($subcategory->slug,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>{{ $subcategory->category->name }}</td>
                                                <td>{{ number_format(count($subcategory->sub_sub_category)) }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($subcategory->updated_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.edit.sub.category',['id'=> $subcategory->id]) }}"
                                                       class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    @if (!count($subcategory->sub_sub_category))
                                                        <button type="button"
                                                                wire:click="delete('{{ $subcategory->id }}')"
                                                                class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    @else
                                                        <button class="btn btn-danger disabled">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Sub Sub-Category</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No sub categories were found...</p>
                                @endif

                                @if(count($subcategories))
                                    <ul class="pagination justify-content-end">
                                        {{ $subcategories->links() }}
                                    </ul>
                                @endif
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
