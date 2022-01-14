<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Subscriber List</h3>
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
                                @if(count($subscribers))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Email Address</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars(\Illuminate\Support\Str::slug($subscriber->email),400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>{{ date('F d, Y h:i a', strtotime($subscriber->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Email Address</th>
                                            <th>Created On</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No subscribers were found...</p>
                                @endif

                                @if(count($subscribers))
                                    <ul class="pagination justify-content-end">
                                        {{ $subscribers->links() }}
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
