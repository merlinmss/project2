<x-admin-layout>
    @foreach (['success', 'danger', 'warning', 'info'] as $msg)
        @if(session()->has($msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach
    @php
      //  echo '<pre>'; print_r($users); echo '</pre>';
    @endphp
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span class="page-title">{{ $title }}</span></li>
                    </ol>
                </nav>
            </div>
             <div class="col-md-4">
                <a href="{{ route('user.detail',0) }}" class="btn btn-sm btn-info add-btn">Create User</a>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td> 
                                    <img src="{{ Storage::disk(config('filesystems.default'))->temporaryUrl($user->profile_pic,now()->addMinutes(30)) }}" alt="" class="rounded-circle me-2" width="30" height="30">
                                    {{ $user->name }}
                                </td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->phone }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <div class="mb-1">{{ $role->role_name }}</div>
                                @endforeach
                            </td>

                              <td><label class="badge @if($user->status == 1) badge-success @else badge-danger @endif ">@if($user->status == 1) Active @else Inactive @endif</label></td>
                                <td>
                                    @if (auth()->user()->can('edit-users'))
                                    <a href="{{ route('user.detail',$user->id) }}" class="btn btn-sm btn-info edit-btn float-start me-2">Edit </a>
                                    @endif
                                    @if (auth()->user()->can('delete-users'))
                                        <form action="{{ route('user.delete',$user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this user?');" class="float-start">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger del-btn">Delete</button>
                                        </form>
                                     @endif
                                </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="4">No users found.</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
