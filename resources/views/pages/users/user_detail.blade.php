<x-admin-layout>
    @php $roleIds = [];
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
    @endphp
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
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $name }}" placeholder="Name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $email }}" placeholder="Email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $phone }}" placeholder="Phone">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                      </div>
                      <div class="form-group">
                        <label for="roles">User Roles</label>
                        <select class="form-control chosen-select" id="roles" name="roles[]" multiple>
                          @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', $roleIds)) ? 'selected' : '' }}>
                              {{ $role->role_name }}
                            </option>
                          @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                      </div>
                        <div class="form-group">
                            <label for="profile_pic">Profile Picture</label>
                            @if($profile_pic != '')
                                <div class="mb-2 col-6 col-md-4">
                                    <img src="{{ asset('storage/' . $profile_pic) }}" alt="Profile Picture" class="img-thumbnail" width="150">
                                </div>
                                <div class="mb-2 col-6 col-md-4">

                                 </div>
                            @endif
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" value="{{ old('profile_pic', $profile_pic) }}" placeholder="Profile Picture">
                            <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control  chosen-select" id="status" name="status">
                              <option value="1" {{ $status == 1 ? 'selected' : '' }}>Active</option>
                              <option value="0" {{ $status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
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
