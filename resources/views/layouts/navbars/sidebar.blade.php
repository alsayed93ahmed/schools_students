<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'schools' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('schools.index') }}">
                    <i class="material-icons">school</i>
                    <p>{{ __('Schools') }}</p>
                </a>
            </li>

            <li class="nav-item{{ $activePage == 'students' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('students.index') }}">
                    <i class="material-icons">group</i>
                    <p>{{ __('Students') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
