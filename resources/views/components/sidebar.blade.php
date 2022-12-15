@php


$links = [
    [
        'href' => 'dashboard',
        'text' => 'Dashboard',
        'section_text' => 'Dashboard',
        'is_multi' => false,
        'has_permission' => true,
    ],
    [
        'href' => [
            [
                'section_text' => 'Department',
                'section_list' => [
                    ['href' => 'department.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'department.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],
            [
                'section_text' => 'Batch',
                'section_list' => [
                    ['href' => 'batch.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'batch.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],

            [
                'section_text' => 'Subject',
                'section_list' => [
                    ['href' => 'subject.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'subject.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],
        ],
        'text' => 'Department',
        'is_multi' => true,
        'has_permission' => true,
],
    [
        'href' => [
            [
                'section_text' => 'Exam',
                'section_list' => [
                    ['href' => 'exam.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'exam.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],
            [
                'section_text' => 'Routine',
                'section_list' => [
                    ['href' => 'routine.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'routine.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],
        ],
        'text' => 'Routine',
        'is_multi' => true,
        'has_permission' => true,
],
[
        'href' => [
            [
                'section_text' => 'Teacher',
                'section_list' => [
                    ['href' => 'teacher.create', 'text' => 'Add', 'has_permission' => true],
                    ['href' => 'teacher.index', 'text' => 'List', 'has_permission' => true],
                ],
            ],
        ],
        'text' => 'User',
        'is_multi' => true,
        'has_permission' => true,
]
];
$navigation_links = json_decode(json_encode($links), false);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
            <ul class="sidebar-menu">
                @if (!isset($link->has_permission) || $link->has_permission)
                    <li class="menu-header">{{ $link->text }}</li>
                    @if (!$link->is_multi)
                        <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route($link->href) }}"><i
                                    class="fas fa-fire"></i><span>{{ $link->section_text }}</span></a>
                        </li>
                    @else
                        @foreach ($link->href as $section)
                            @php
                                $routes = collect($section->section_list)
                                    ->map(function ($child) {
                                        return Request::routeIs($child->href);
                                    })
                                    ->toArray();

                                $is_active = in_array(true, $routes);
                            @endphp

                            <li class="dropdown {{ $is_active ? 'active' : '' }}">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="fas fa-chart-bar"></i> <span>{{ $section->section_text }}</span></a>
                                <ul class="dropdown-menu">
                                    @foreach ($section->section_list as $child)
                                        @if ($child->has_permission)
                                            <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}">
                                                <a class="nav-link"
                                                    href="{{ route($child->href) }}">{{ $child->text }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        @endforeach
    </aside>
</div>
