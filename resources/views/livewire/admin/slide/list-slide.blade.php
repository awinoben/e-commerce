<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Slide List</h3>
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
                                @if(count($slides))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Banner</th>
                                            <th>Name</th>
                                            <th>URL</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($slides as $slide)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <img
                                                        src="{{ asset('storage/photos/'.$slide->slide_image) }}"
                                                        class="img-thumbnail" alt="image" width="100">
                                                </td>
                                                <td>{{ $slide->name }}</td>
                                                <td>{{ $slide->url }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($slide->updated_at)) }}</td>
                                                <td>
                                                    <button type="button"
                                                            wire:click="delete('{{ $slide->id }}')"
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
                                            <th>Banner</th>
                                            <th>Name</th>
                                            <th>URL</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No slides were found...</p>
                                @endif

                                @if(count($slides))
                                    <ul class="pagination justify-content-end">
                                        {{ $slides->links() }}
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
