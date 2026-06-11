<nav class="sidebar sidebar-offcanvas mt-2" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">{{ __('Agentic Users') }}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    @if (auth()->user()->can('manage-users'))
                      <li class="nav-item"> <a class="nav-link" href="{{ route('user.list') }}">{{ __('Web Users List') }}  </a></li>
                    @endif
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.api.list') }}">{{ __('API Users List') }}</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">{{ __('Settings') }}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#"> {{ __('General Settings') }} </a></li>
                    <li class="nav-item"> <a class="nav-link" href="#"> {{ __('Site Settings') }} </a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
