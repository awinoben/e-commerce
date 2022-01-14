<div class="content-body">
    <!-- Content -->
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h3>Customer List</h3>
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
                                @if(count($users))
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Type</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Joined On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count = 1)
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <figure class="avatar avatar-sm">
                                                        <img
                                                            src="{{ \App\Http\Controllers\SystemController::generateAvatars($user->slug,400) }}"
                                                            class="rounded-circle" alt="image">
                                                    </figure>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->country->name }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>
                                                    @if($user->is_active)
                                                        <span class="badge badge-success">active</span>
                                                    @else
                                                        <span class="badge badge-danger">in-active</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y h:i a', strtotime($user->updated_at)) }}</td>
                                                <td>
                                                    <button wire:click="changeStatus('{{ $user->id }}')"
                                                            class="btn btn-primary"><span
                                                            data-feather="user-x"></span> Change Status
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Type</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Joined On</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center">No customers were found...</p>
                                @endif

                                @if(count($users))
                                    <ul class="pagination justify-content-end">
                                        {{ $users->links() }}
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
