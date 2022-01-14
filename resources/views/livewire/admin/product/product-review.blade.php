<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Review List</h3>
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
                            <div class="col-md-1 float-left">
                                <a href="{{ route('admin.list.product') }}" class="btn btn-outline-primary"><span
                                        data-feather="arrow-left"></span> Go Back</a>
                            </div>
                            <div class="col-md-11 float-right">
                                <input class="form-control" wire:model="search" type="search" placeholder="Search...">
                            </div>
                        </div>
                        <div wire:init="loadData">
                            <div class="table-responsive">
                                @if(count($reviews))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Description</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($reviews as $review)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($review->user->slug,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $review->product->name }}</td>
                                                <td>{{ $review->user->name }}</td>
                                                <td>{{ $review->description }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($review->updated_at)) }}</td>
                                                <td>
                                                    <button type="button"
                                                            wire:click="delete('{{ $review->id }}')"
                                                            class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Description</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No reviews were found...</p>
                                @endif

                                @if(count($reviews))
                                    <ul class="pagination justify-content-end">
                                        {{ $reviews->links() }}
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
