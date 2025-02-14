@php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="main-sidebar">

    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
          <div class="ulogo">
            <a href="{{ route('Staff_Dashboard') }}">
              <!-- logo for regular state and mobile devices -->
              <div class="d-flex align-items-center justify-content-center">					 	
                  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                  <h3>{{ @Auth::user()->name }} | Staff</h3>
              </div>
            </a>
          </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree"> 
		    <li class=" {{ ($route == 'Staff_Dashboard')? 'active' : ''}} ">
          <a href="{{ route('Staff_Dashboard') }}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>        
        
        
      </ul>
    </section>

  </aside>
