<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Meta Information --}}
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="theme_ocean">

  <title>@yield('title', 'WTS || CRM')</title>

  {{-- Favicon --}}
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

  {{-- Vendors CSS --}}
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/vendors.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/daterangepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/jquery-jvectormap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/select2-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/vendors/css/jquery.time-to.min.css') }}">

  {{-- Custom Theme CSS --}}
  <link rel="stylesheet" href="{{ asset('crm-assets/assets/css/theme.min.css') }}">

  <!-- Phone Input Country Code  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />

  {{-- Extra CSS from child views --}}
  @stack('styles')

  <style>
    .crm-page-container {
      max-width: 100%;
      margin: 0 auto;
      min-height: 100vh;
      padding: 30px;
    }

    .crm-page-heading {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 25px;
      color: #333;
    }

    .action-links {
      display: flex;
      gap: 10px;
      align-items: center;
      justify-content: center;
    }

    .btn-edit {
      color: #3490dc;
      background: none;
      border: none;
      font-weight: 500;
      cursor: pointer;
    }

    .btn-delete {
      background: none;
      border: none;
      color: #e3342f;
      font-weight: 500;
      cursor: pointer;
    }

    .btn-history {
      background: none;
      border: none;
      color: orange;
      font-weight: 500;
      cursor: pointer;
    }

    .btn {
      border-radius: 8px;
      font-size: 13px;
      padding: 6px 12px;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: center;
    }

    th {
      font-size: small !important;
      text-transform: none !important;
    }

    @media (max-width: 768px) {
      .crm-page-container {
        padding: 20px 15px;
      }
    }
  </style>
</head>

<body>
  {{-- Sidebar --}}
  @include('layouts.aside')

  {{-- Header --}}
  @include('layouts.header')

  <main class="nxl-container">
    <div class="nxl-content">
      {{-- Main Content --}}
      @yield('content')
    </div>

    {{-- Footer --}}
    @include('layouts.footer')
  </main>

  {{-- Customizer --}}
  @include('layouts.customizer')

  {{-- Vendor Scripts --}}
  <script src="{{ asset('crm-assets/assets/vendors/js/vendors.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/daterangepicker.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/jquery.time-to.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/circle-progress.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/select2.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/vendors/js/select2-active.min.js') }}"></script>

  {{-- App Scripts --}}
  <script src="{{ asset('crm-assets/assets/js/common-init.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/js/leads-init.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/js/theme-customizer-init.min.js') }}"></script>
  <script src="{{ asset('crm-assets/assets/js/analytics-init.min.js') }}"></script>

  {{-- Extra Scripts from child views --}}
  @stack('scripts')

  <!-- intlTelInput scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/highcharts@11/highcharts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/highcharts@11/modules/funnel.js"></script>

  <style>
    /* FIX: Disable blur on Bootstrap modal-open */
    body.modal-open .nxl-header,
    body.modal-open .nxl-navigation,
    body.modal-open .page-header,
    body.modal-open .nxl-container {
      filter: none !important;
    }

    /* Restore Bootstrap backdrop behavior */
    .modal-backdrop {
      position: fixed !important;
    }

    .modal-backdrop.show {
      opacity: 0.5;
    }
  </style>
</body>

</html>