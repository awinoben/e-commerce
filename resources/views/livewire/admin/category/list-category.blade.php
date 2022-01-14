<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Category List</h3>
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
                                @if(count($categories))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Sub Category</th>
                                            <th>Sub Sub-Category</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($category->slug,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ number_format(count($category->sub_category)) }}</td>
                                                <td>{{ number_format(count($category->sub_sub_category)) }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($category->updated_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.edit.category',['id'=> $category->id]) }}"
                                                       class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    @if (!count($category->sub_category))
                                                        <button type="button"
                                                                wire:click="delete('{{ $category->id }}')"
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
                                            <th>Sub Category</th>
                                            <th>Sub Sub-Category</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No categories were found...</p>
                                @endif

                                @if(count($categories))
                                    <ul class="pagination justify-content-end">
                                        {{ $categories->links() }}
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
