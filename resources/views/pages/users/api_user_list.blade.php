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
     //   echo '<pre>'; print_r($users); echo '</pre>'; 
        $prevdisabled  =   ($users->current_page == 1) ? 'disabled' : false;
        $nextdisabled  =   ($users->current_page == $users->last_page) ? 'disabled' : false;

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
                            <th>Cteated On</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($users->data as $user)
                            <tr>
                                <td> 
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->created_at }}</td>

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
                        <nav class="d-flex justify-items-center justify-content-between">
                            <div class="d-flex justify-content-between flex-fill d-sm-none">
                                <ul class="pagination">
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">« Previous</span>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="http://localhost/laravel/project2/public/user/list?page=2" rel="next">Next »</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                                <div class="small text-muted">
                                    Showing
                                    <span class="fw-semibold">{{$users->from}}</span>
                                    to
                                    <span class="fw-semibold">{{$users->to}}</span>
                                    of
                                    <span class="fw-semibold">{{$users->total}}</span>
                                    results
                                </div>

                                <div>
                                    <ul class="pagination">
                                        @if($prevdisabled)
                                        <li class="page-item {{ $prevdisabled }}" aria-disabled="true" aria-label="« Previous">
                                            <span class="page-link" aria-hidden="true">‹</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ route('user.list') }}?page={{ ($users->current_page-1) }}" rel="next" aria-label="« Previous">‹</a>
                                        </li>
                                        @endif
                                        @foreach ($users->links as $k=>$link)
                                            @php 
                                                if($k == 0) continue; 
                                                if($k > $users->last_page) continue; 
                                            @endphp
                                            <li class="page-item @if($link->active) active @endif "><a class="page-link"  @if($link->active == false) href="{{ route('user.list') }}?page={{ $link->page }}" @endif>{{ $link->label }}</a></li>
                                                                                                        
                                        @endforeach
                                        @if($nextdisabled)
                                        <li class="page-item {{ $nextdisabled }}" aria-disabled="true" aria-label="Next »">
                                            <span class="page-link" aria-hidden="true">›</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ route('user.list') }}?page={{ ($users->current_page-1) }}" rel="next" aria-label="Next »">›</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </nav>

                    </div>




                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
