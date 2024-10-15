<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            <!-- Header Profile Dropdown -->
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img  src="/images/logo-5.JPEG" width="20">
                    <div class="header-info ms-3">
                   
                     <span class="font-w600"><b>@if(Auth::user()->admin)
                        <h4 class="text-end font-w400">{{ Auth::user()->admin->firstname }}</h4>
                        <small class="text-end font-w400">Admin</small>
                    @else
                        <h4 class="card-title">{{ Auth::user()->firstname }}</h4>
                        <small class="text-end font-w400">Receptionist</small>
                    @endif</b></span>
                     <small class="text-end font-w400">{{Auth::user()->email}}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('dashboard.profile') }}" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                     @csrf
                        <button type="submit" class="dropdown-item ai-icon">
                          <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span class="ms-2">{{ __('Log Out') }}</span>
                         </button>
                        </form>


            <!-- Dashboard Link -->
            <li>
                <a href="{{ route('dashboard') }}" class="ai-icon">
                    <i class="fas fa-tachometer-alt"></i> 
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>


            <!-- Users Link -->
            @if(Auth::check() && Auth::user()->admin)
    <li>
        <a href="{{ route('user.index') }}" class="ai-icon">
            <i class="fas fa-users"></i>
            <span class="nav-text">Users</span>
        </a>
    </li>
@endif
            <!-- Guest Link -->
            <li>
    <a href="{{ route('guest.index') }}" class="ai-icon">
        <i class="fas fa-user"></i>
        <span class="nav-text">Guest</span>
    </a>
</li>


             <!-- Billing Link -->
             <li>
    <a href="{{ route('billing.index') }}" class="ai-icon" aria-expanded="false">
        <i class="flaticon-013-checkmark"></i>
        <span class="nav-text">Billing</span>
    </a>
</li>

   <!-- CashFlow Link -->
   <li>
    <a href="{{ route('cashflow.index') }}"  class="ai-icon"aria-expanded="false">
    <i class="flaticon-022-copy"></i>
        <span class="nav-text">CashFlow</span>
    </a>
</li>

                <!-- Assests Link -->
            <li><a class="has-arrow ai-icon" href="javascript:void()">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Assests</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('inventory.index') }}">Inventory</a></li>
                            <li><a href="{{ route('stock.index') }}">Stock</a></li>
                        </ul>
                    </li>

            <!-- Records Link -->
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-072-printer"></i>
							<span class="nav-text">Records</span>
						</a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{ route('guest.print_ticket')}}">Tickets</a>
                            </li>
                            <li>
                             <a href="{{ route('billing.printbill')}}">Bills</a>
                            </li>
                        </ul>
                    </li>

            <!-- Ticket Price Link -->
            <li>
                <a href="{{ route('ticket.index') }}" class="ai-icon">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Ticket Price</span>
                </a>
            </li>

            @if(Auth::check() && Auth::user()->admin)
             <!-- Staff Allocation Link -->
             <li><a href="{{ route('staff.index') }}" aria-expanded="false">
							<i class="flaticon-086-star"></i>
							<span class="nav-text">Staff Allocation</span>
				</a>
            </li>
            @endif
        </ul>
    </div>
</div>

