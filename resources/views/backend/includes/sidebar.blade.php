<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

<!-- Aqui va el menu gestor de logs de laravel boilerplate -->
            @endif

            <li class="divider"></li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    MÓDULO COMERCIAL
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        Clientes

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">



                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/clientes*'))
                            }}" href="{{ route('admin.clientes.index') }}">
                                Clientes

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/contactos*'))
                            }}" href="{{ route('admin.contacto_clientes.index') }}">
                                Contacto clientes
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/cotizaciones*'))
                    }}" href="#">
                        <i class="nav-icon far fa-edit"></i>
                        Cotizaciones

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">

                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/cotizaciones*'))
                            }}" href="{{ route('admin.cotizaciones.index') }}">
                                Cotizaciones

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="divider"></li>
            @endif


            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    MÓDULO PROCESOS
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/orden_trabajos*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/orden_trabajos*'))
                    }}" href="#">
                        <i class="nav-icon fas fa-briefcase"></i>
                        Trabajos

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/orden_trabajos*'))
                            }}" href="{{ route('admin.orden_trabajos.index') }}">
                                Ordenes de Trabajo

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/item_ots*'))
                            }}" href="{{ route('admin.item_ots.index') }}">
                                Trabajos (ítems)
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/procesos*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/procesos*'))
                    }}" href="#">
                        <i class="nav-icon fas fa-cogs"></i>
                        Configuración

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                       
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/procesos*'))
                            }}" href="{{ route('admin.procesos.index') }}">
                                Clasificación de procesos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/maquinas*'))
                            }}" href="{{ route('admin.maquinas.index') }}">
                                Registro de máquinas
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>
            @endif


            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    ADMINISTRACION EMPLEADOS
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/empleados*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/empleados*'))
                    }}" href="#">
                        <i class="nav-icon fas fa-users"></i>
                        RR.HHs

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/empleados*'))
                            }}" href="{{ route('admin.empleados.index') }}">
                                Operadores
                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="divider"></li>
            @endif


        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
