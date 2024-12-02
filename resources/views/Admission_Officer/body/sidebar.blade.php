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
    </section>

  </aside>
