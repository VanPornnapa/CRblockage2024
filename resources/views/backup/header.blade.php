 <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                เมนู
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ url('/report') }}"><i class="fa fa-fw fa-user-circle"></i>หน้าแรก <span class="badge badge-success">6</span></a>
                            </li>
                            
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>รายงานสรุป <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/') }}">แผนที่</a>
                                        </li>

                            @guest
                                
                                @if (Route::has('register'))
                                    
                                @endif
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/report') }}">รายงานสรุป </a>
                                </li>

                                    
                            @endguest
                                       
                                    </ul>
                                </div>
                            </li>
                           
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ url('/report') }}"><i class="fa fa-fw fa-user-circle"></i>รายงานสรุป <span class="badge badge-success">6</span></a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>ข้อมูลการกีดขวางลำน้ำ</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            
                                                 <a class="nav-link" href="{{ asset('login') }}">ข้อมูลสำรวจรายละเอียดการกีดขวางทางน้ำ</a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ asset('/expert') }}">ข้อเสนอแนะโดยผู้เชี่ยวชาญ</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                                <a class="nav-link" href="#">admin</a>
                                        </li> --}}
                                       
                                    </ul>
                                </div>
                            </li>
                        
                        
                          
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu Level</a>
                                <div id="submenu-10" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Level 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
                                            <div id="submenu-11" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Level 1</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Level 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Level 3</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->