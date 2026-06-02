<x-admin-layout>
    @php $roleIds = $userRoles = [];
    $name       =   isset($user) ? $user->name : '';
    $email      =   isset($user) ? $user->email : '';
    $phone      =   isset($user) ? $user->phone : '';
    $status     =   isset($user) ? $user->status : 1;
    $profile_pic=   isset($user) ? $user->profile_pic : '';

    if(isset($user->userRoleIds)){
        foreach($user->userRoleIds as $roleId){
            $roleIds[]  =   $roleId->role_id;
        }
    } else {
        $roleIds = [];
    }
    if($roles){ foreach($roles as $role){ $userRoles[$role->id] = $role->role_name; }}
    @endphp
    @foreach (['success', 'danger', 'warning', 'info'] as $msg)
        @if(session()->has($msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span class="page-title">{{ $title }}</span></li>
                    </ol>
                </nav>
            </div>
             <div class="col-md-4">
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-md-8 offset-md-2 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" name="userForm" method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($user) ? $user->id : 0 }}">
                      <div class="form-group">
                        <x-input label="Name" name="name" :value="$name" required />
                      </div>
                      <div class="form-group">
                        <x-input label="Email" name="email" :value="$email" required />
                      </div>
                      <div class="form-group">
                        <x-input label="Phone" name="phone" :value="$phone" required />
                      </div>
                        <div class="form-group">
                            <x-multiselect label="User Roles" name="roles" class="chosen-select" :options="$userRoles" :selected="old('roles', $roleIds)" />
                      </div>
                        <div class="form-group">
                            <label for="profile_pic">Profile Picture</label>
                            @if($profile_pic != '')
                                <div class="mb-2 col-6 col-md-4">
                                    <img src="{{ Storage::disk(config('filesystems.default'))->temporaryUrl($user->profile_pic,now()->addMinutes(30)) }}" alt="Profile Picture" class="img-thumbnail" width="150">
                                </div>
                                <div class="mb-2 col-6 col-md-4">

                                 </div>
                            @endif
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" value="{{ old('profile_pic', $profile_pic) }}" placeholder="Profile Picture">
                            <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <x-select label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('status', $status)" required />
                        </div>

                      <button type="submit" class="btn btn-info float-end">Submit</button>
                      <a href="{{ route('user.list') }}" class="btn btn-light float-end me-2">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Chosen plugin
            $('.chosen-select').chosen({
                width: '100%',
                no_results_text: 'No results matched'
            });
        });
    </script>
</x-admin-layout>
