<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-menu-fixed" data-base-url="{{url('/')}}" data-framework="laravel">
  <head>
    @include('partials.head')
  </head>

  <body>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Layout Content -->
        <x-layouts.menu.vertical :title="$title ?? null"></x-layouts.menu.vertical>
        <!--/ Layout Content -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <x-layouts.navbar.default :title="$title ?? null"></x-layouts.navbar.default>
          <!--/ Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              {{ $slot }}
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <x-layouts.footer.default :title="$title ?? null"></x-layouts.footer.default>
            <!--/ Footer -->
            <div class="content-backdrop fade"></div>
            <!-- / Content wrapper -->
          </div>
        </div>
        <!-- / Layout page -->
      </div>
    </div>

    <!-- Modal Editar Perfil (global) -->
    @auth
        <livewire:editar-perfil />
    @endauth

    <!-- Include Scripts -->
    @include('partials.scripts')
    <!-- / Include Scripts -->

    <script>
      (function () {
        var btn = document.getElementById('menu-toggle-btn');
        var menu = document.getElementById('layout-menu');
        var wrapper = document.querySelector('.layout-wrapper');

        if (btn && menu) {
          btn.addEventListener('click', function () {
            var isOpen = menu.classList.contains('menu-open');
            if (isOpen) {
              menu.classList.remove('menu-open');
              menu.style.transform = '';
              menu.style.display = '';
              if (wrapper) wrapper.classList.remove('layout-menu-expanded');
            } else {
              menu.classList.add('menu-open');
              menu.style.display = 'block';
              if (wrapper) wrapper.classList.add('layout-menu-expanded');
            }
          });
        }
      })();
    </script>
  </body>
</html>
