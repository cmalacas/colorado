<aside class="left-sidebar">
    <div class="d-flex no-block nav-text-box align-items-center">
        <span><img src="{{ asset('assets/images/logo-light.png') }}" alt="elegant admin template" class="light-logo"></span>
        <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="ti-menu"></i></a>
        <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="/" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                <li> <a class="waves-effect waves-dark" href="/production-orders" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Production Orders</span></a></li>
                <li> <a class="waves-effect waves-dark" href="/purchase-orders" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu"></span>Purchase Orders</a></li>
                <li> <a class="waves-effect waves-dark" href="/not-invoiced" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Not Invoiced</a></li>
                <!-- <li> <a class="waves-effect waves-dark" href="/invoiced" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Invoiced</a></li> -->
                <li><a class="waves-effect waves-dark" href="/folding-schedule/unscheduled">Folding Unscheduled</a></li>
                <li><a class="waves-effect waves-dark" href="/jet-schedule/unscheduled">Jet Unscheduled</a></li>
                <li><a class="waves-effect waves-dark" href="/latex-ps/unscheduled">Latex / PS: Unscheduled</a></li>
                <li><a class="waves-effect waves-dark" href="/straightknife/unscheduled">Straightknife: Unscheduled</a></li>
                <!-- <li> <a class="waves-effect waves-dark" href="/general-order-info" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>General Order Info</a></li> -->
                <li>
                    <a href="/folding-schedule" class="waves-effect waves-dark" >Folding Schedule</a>
                    <ul>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/mo">Folding Schedule MO</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/mow">Folding Schedule MOW</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/ra-1">Folding Schedule RA-1</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/ra-2">Folding Schedule RA-2</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/ra-3">Folding Schedule RA-3</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/so">Folding Schedule SO</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/wr-1">Folding Schedule WR-1</a></li>
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/wr-2">Folding Schedule WR-2</a></li>                    
                        <li><a class="waves-effect waves-dark" href="/folding-schedule/wr-3">Folding Schedule WR-3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/jet-schedule" class="waves-effect waves-dark" >Jet Schedule</a>
                    <ul>    
                        <li><a class="waves-effect waves-dark" href="/jet-schedule/3inch1">Jet Schedule 3 inch - 1</a></li>
                        <li><a class="waves-effect waves-dark" href="/jet-schedule/3inch2">Jet Schedule 3 inch - 2</a></li>
                        <li><a class="waves-effect waves-dark" href="/jet-schedule/3inch3">Jet Schedule 3 inch - 3</a></li>
                        <li><a class="waves-effect waves-dark" href="/jet-schedule/3inch4">Jet Schedule 3 inch - 4</a></li>
                        <li><a class="waves-effect waves-dark" href="/jet-schedule/super-jet">Jet Schedule Super Jet</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/latex-ps" class="waves-effect waves-dark" >Latex / PS: Scheduled</a>                     
                </li>
                <li>
                    <a href="/straightknife" class="waves-effect waves-dark" >Straight Knife: Scheduled</a>                    
                </li>
                <li> <a class="waves-effect waves-dark" href="/view-schedules" aria-expanded="false"><i class="fa fa-globe"></i><span class="hide-menu"></span>View Schedules</a>
                    <ul>       
                        <li><a class="waves-effect waves-dark" href="/view-schedules/jet" aria-expanded="false">Jet</a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/jet/3in1" aria-expanded="false">3 inch - 1</a></li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/jet/3in2" aria-expanded="false">3 inch - 2</a></li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/jet/3in3" aria-expanded="false">3 inch - 3</a></li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/jet/3in4" aria-expanded="false">3 inch - 4</a></li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/jet/super" aria-expanded="false">Super Jet</a></li>
                            </ul>
                        </li>
                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding" aria-expanded="false">Folding</a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/folding/ra" aria-expanded="false">Folding RA</a>
                                    <ul>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/ra/1" aria-expanded="false">RA - 1</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/ra/2" aria-expanded="false">RA - 2</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/ra/3" aria-expanded="false">RA - 3</a></li>                                        
                                    </ul>
                                </li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/folding/wr" aria-expanded="false">Folding WR</a>
                                <ul>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/wr/1" aria-expanded="false">WR - 1</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/wr/2" aria-expanded="false">WR - 2</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/wr/3" aria-expanded="false">WR - 3</a></li>                                        
                                    </ul>
                                </li>
                                <li><a class="waves-effect waves-dark" href="/view-schedules/folding/more" aria-expanded="false">Folding: MOW, MO, SO, Latex/PS</a>
                                    <ul>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/more/mow" aria-expanded="false">MOW</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/more/mo" aria-expanded="false">MO</a></li>
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/more/so" aria-expanded="false">SO</a></li>                                        
                                        <li><a class="waves-effect waves-dark" href="/view-schedules/folding/more/latex-ps" aria-expanded="false">Latex/PS</a></li>                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a class="waves-effect waves-dark" href="/view-schedules/straight-knife" aria-expanded="false">Straight Knife</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/double-die" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Window Double Die</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables/out-diagonals" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Out Diagonals</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables/out-mo-booklet" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Out MO Booklet</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables/out-mo-catalog" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Out MO Catalog</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables/out-side-seam" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Out Side Seam</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables/machines" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Machines</a>                    
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="/tables" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu"></span>Site Tables</a>
                    
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>