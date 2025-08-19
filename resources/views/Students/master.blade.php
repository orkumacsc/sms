<!DOCTYPE html>
<html lang="en-UK">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="Gospel International College, Zaki-Biam - Quality Christian Education in Benue State, Nigeria. Discover our academic programs, admissions, and school news.">
  <meta name="author" content="MiEduSoft Solutions | Educational Software Company in Benue State, Nigeria">
  <meta name="keywords"
    content="Gospel International College, Zaki-Biam, Christian School, Benue State, Nigeria, Secondary School, Admissions, Education">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

  @hasSection('title')
    <title>@yield('title') | GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</title>
  @else
    <title>GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM</title>
  @endif

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="@yield('title') | GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM">
  <meta property="og:description" content="Gospel International College, Zaki-Biam - Quality Christian Education in Benue State, Nigeria. Discover our academic programs, admissions, and school news.">
  <meta property="og:image" content="{{ asset('backend/images/favicon.ico') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="en_NG">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="@yield('title') | GOSPEL INTERNATIONAL COLLEGE, ZAKI-BIAM">
  <meta property="twitter:description" content="Gospel International College, Zaki-Biam - Quality Christian Education in Benue State, Nigeria. Discover our academic programs, admissions, and school news.">
  <meta property="twitter:image" content="{{ asset('backend/images/favicon.ico') }}">
  <meta property="twitter:url" content="{{ url()->current() }}">

  <!-- Vendors Style-->
  <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

  <!-- Style-->
  <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed" oncontextmenu="return false">

  <div class="wrapper">

    @include('Students.body.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('Students.body.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('mainContent')
    <!-- /.content-wrapper -->

    @include('Students.body.footer')

  </div>
  <!-- ./wrapper -->


  <!-- Vendor JS -->
  <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
  <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('backend/js/pages/validation.js') }}"></script>
  <script src="{{ asset('backend/js/pages/form-validation.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
  <script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

  <!-- MiEduSoft SMS -->
  <script src="{{ asset('backend/js/template.js') }}"></script>
  <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.x/css/materialdesignicons.min.css" rel="stylesheet">


  <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"

    switch (type) {
      case 'info':
      toastr.info(" {{Session::get('message') }} ");
      break;

      case 'success':
      toastr.success(" {{Session::get('message') }} ");
      break;

      case 'warning':
      toastr.warning(" {{Session::get('message') }} ");
      break;

      case 'error':
      toastr.error(" {{Session::get('message') }} ");
      break;

    }

  @endif

  </script>

  <script type="text/javascript">
    $(function () {
      $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this User?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete the user!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })

      })
    })
  </script>


</body>

</html>