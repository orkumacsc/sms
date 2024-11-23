@php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="main-sidebar">

    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
          <div class="ulogo">
            <a href="{{ route('admissions_dashboard') }}">
              <!-- logo for regular state and mobile devices -->
              <div class="d-flex align-items-center justify-content-center">					 	
                  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                  <h3>{{ @Auth::user()->name }} | Admission Officer</h3>
              </div>
            </a>
          </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree"> 
		    <li class=" {{ ($route == 'admissions_dashboard')? 'active' : ''}} ">
          <a href="{{ route('admissions_dashboard') }}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>        
        
        <li class="treeview {{ ($prefix == '/students')? 'active' : ''}}">
          <a href="javascript:void(0)">
            <i data-feather="users"></i>
            <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admissions') }}"><i class="ti-more"></i>Enrol Student</a></li>            
            <li><a href="{{ route('admissions_view') }}"><i class="ti-more"></i>Enroled Students</a></li>
          </ul>
        </li> 

      </ul>
    </section>

  </aside>
