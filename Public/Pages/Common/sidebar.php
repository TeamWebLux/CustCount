<aside class="sidebar sidebar-base sidebar-white sidebar-default navs-rounded-all " id="first-tour" data-toggle="main-sidebar" data-sidebar="responsive">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="../index.php/Portal" class="navbar-brand">

            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <img src="../assets/images/CustCountLogo.png" style="height: 40px;" alt="">
                </div>
                <div class="logo-mini">
                    <img src="../assets/images/CustCountLogo.png" alt="" srcset="">
                </div>
            </div>
            <!--logo End-->
            <h4 class="logo-title">CustCount</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">

                <svg class="icon-10" width="10" height="10" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.29853 8C7.11974 8 6.94002 7.93083 6.80335 7.79248L3.53927 4.50446C3.40728 4.37085 3.33333 4.18987 3.33333 4.00036C3.33333 3.81179 3.40728 3.63081 3.53927 3.4972L6.80335 0.207279C7.07762 -0.069408 7.52132 -0.069408 7.79558 0.209174C8.06892 0.487756 8.06798 0.937847 7.79371 1.21453L5.02949 4.00036L7.79371 6.78618C8.06798 7.06286 8.06892 7.51201 7.79558 7.79059C7.65892 7.93083 7.47826 8 7.29853 8Z" fill="white" />
                    <path d="M3.96552 8C3.78673 8 3.60701 7.93083 3.47034 7.79248L0.206261 4.50446C0.0742745 4.37085 0.000325203 4.18987 0.000325203 4.00036C0.000325203 3.81179 0.0742745 3.63081 0.206261 3.4972L3.47034 0.207279C3.74461 -0.069408 4.18831 -0.069408 4.46258 0.209174C4.73591 0.487756 4.73497 0.937847 4.4607 1.21453L1.69649 4.00036L4.4607 6.78618C4.73497 7.06286 4.73591 7.51201 4.46258 7.79059C4.32591 7.93083 4.14525 8 3.96552 8Z" fill="white" />
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <?php
            // Start the session
            // session_start();
            $role = $_SESSION['role']; // Assuming role is stored in session
            ?>

            <nav class="navbar">
                <ul>


                    <!-- Item 2: Accessible by Agent and above -->

                    <!-- Item 3: Accessible by Supervisor and above -->


                    <!-- Item 4: Accessible by Manager and above -->

                </ul>
            </nav>

            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
                        <span class="default-icon">Home</span>
                        <span class="mini-icon" data-bs-toggle="tooltip" title="Home" data-bs-placement="right">-</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal') echo 'active';  ?> " aria-current="page" href="../index.php/Portal">
                        <i class="icon" data-bs-toggle="tooltip" title="Dashboard" data-bs-placement="right">
                            <svg width="20" class="icon-20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>








                <?php if (in_array($role, ['Agent', 'Supervisor', 'Manager', 'Admin'])) : ?>

                  
                    <li class="nav-item" >
                            <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_User_Management') echo 'active';  ?>  " aria-current="page" href="../index.php/Portal_User_Management">
                                <i class="icon" data-bs-toggle="tooltip" title="Crypto" data-bs-placement="right">
                                    <svg class="icon-20" width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M10.1167 0.333496H3.88856C1.61893 0.333496 0.333008 1.61942 0.333008 3.88905V10.1113C0.333008 12.3809 1.61893 13.6668 3.88856 13.6668H10.1167C12.3863 13.6668 13.6663 12.3809 13.6663 10.1113V3.88905C13.6663 1.61942 12.3863 0.333496 10.1167 0.333496Z" fill="currentColor"/>
                                        <path d="M3.91244 5.24609C3.61022 5.24609 3.36133 5.49498 3.36133 5.80313V10.3839C3.36133 10.6861 3.61022 10.935 3.91244 10.935C4.22059 10.935 4.46948 10.6861 4.46948 10.3839V5.80313C4.46948 5.49498 4.22059 5.24609 3.91244 5.24609Z" fill="currentColor"/>
                                        <path d="M7.02279 3.05957C6.72057 3.05957 6.47168 3.30846 6.47168 3.61661V10.384C6.47168 10.6862 6.72057 10.9351 7.02279 10.9351C7.33094 10.9351 7.57983 10.6862 7.57983 10.384V3.61661C7.57983 3.30846 7.33094 3.05957 7.02279 3.05957Z" fill="currentColor"/>
                                        <path d="M10.0932 7.66406C9.78502 7.66406 9.53613 7.91295 9.53613 8.2211V10.3841C9.53613 10.6863 9.78502 10.9352 10.0872 10.9352C10.3954 10.9352 10.6443 10.6863 10.6443 10.3841V8.2211C10.6443 7.91295 10.3954 7.66406 10.0932 7.66406Z" fill="currentColor"/>
                                    </svg>
                                </i>
                                <span class="item-name">User Management</span>
                            </a>
                        </li> 
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Add Data</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="collapse" href="#sidebar-form" role="button" aria-expanded="false" aria-controls="sidebar-form">
                            <i class="icon" data-bs-toggle="tooltip" title="Form" data-bs-placement="right">
                                <svg width="20" class="icon-20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07996 6.6499V6.6599C7.64896 6.6599 7.29996 7.0099 7.29996 7.4399C7.29996 7.8699 7.64896 8.2199 8.07996 8.2199H11.069C11.5 8.2199 11.85 7.8699 11.85 7.4289C11.85 6.9999 11.5 6.6499 11.069 6.6499H8.07996ZM15.92 12.7399H8.07996C7.64896 12.7399 7.29996 12.3899 7.29996 11.9599C7.29996 11.5299 7.64896 11.1789 8.07996 11.1789H15.92C16.35 11.1789 16.7 11.5299 16.7 11.9599C16.7 12.3899 16.35 12.7399 15.92 12.7399ZM15.92 17.3099H8.07996C7.77996 17.3499 7.48996 17.1999 7.32996 16.9499C7.16996 16.6899 7.16996 16.3599 7.32996 16.1099C7.48996 15.8499 7.77996 15.7099 8.07996 15.7399H15.92C16.319 15.7799 16.62 16.1199 16.62 16.5299C16.62 16.9289 16.319 17.2699 15.92 17.3099Z" fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">Add data</span>
                            <i class="right-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </i>
                        </a>
                        <ul class="sub-nav collapse" id="sidebar-form" data-bs-parent="#sidebar-menu">
                            <li class="nav-item  ">
                                <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_Add_Deposit') echo 'active';  ?>" href="../index.php/Portal_Add_Deposit">
                                    <i class="icon">
                                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon " data-bs-toggle="tooltip" title="Elements" data-bs-placement="right"> E </i>
                                    <span class="item-name">Add Deposit</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_Add_Withdrawal') echo 'active';  ?>" href="../index.php/Portal_Add_Withdrawal">
                                    <i class="icon">
                                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Elements" data-bs-placement="right"> E </i>
                                    <span class="item-name">Add Withdrawal</span>
                                </a>
                            </li>
                            <li class="nav-item">
                        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_Add_Users') echo 'active';  ?>" href="../index.php/Portal_Add_Users">
                            <i class="icon">
                                <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                    </g>
                                </svg>
                            </i>
                            <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Elements" data-bs-placement="right"> E </i>
                            <span class="item-name">Add Users</span>
                        </a>
                    </li>



                    

                <?php endif; ?>
                <?php if (in_array($role, ['Supervisor', 'Manager', 'Admin'])) : ?>
                   
                    
                    </ul>
                    </li>

                    <li>
                        <hr class="hr-horizontal">
                    </li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Get Data</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-special" role="button" aria-expanded="false" aria-controls="sidebar-special">
                            <i class="icon" data-bs-toggle="tooltip" title="Spacial Pages" data-bs-placement="right">
                                <svg width="20" class="icon-20" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M6.85044 12.5583C5.32841 11.6182 3.91355 10.5097 2.63172 9.25306C1.7268 8.35584 1.0357 7.26031 0.611238 6.05018C-0.147183 3.69015 0.735667 0.992986 3.20054 0.192264C4.50154 -0.216313 5.9165 0.034503 7.00449 0.866556C8.09289 0.0354335 9.50738 -0.215301 10.8085 0.192264C13.2733 0.992986 14.1621 3.69015 13.4037 6.05018C12.9827 7.25917 12.2957 8.3546 11.395 9.25306C10.1121 10.5083 8.69734 11.6167 7.17632 12.5583L7.01042 12.6667L6.85044 12.5583Z" fill="currentColor" />
                                    <path d="M7.00694 12.6666L6.85033 12.5583C5.32643 11.6183 3.90959 10.5098 2.62569 9.25304C1.71648 8.35707 1.02126 7.26144 0.593354 6.05016C-0.159142 3.69013 0.723708 0.992966 3.18858 0.192245C4.48958 -0.216332 5.9232 0.0346753 7.00694 0.873695V12.6666Z" fill="currentColor" />
                                    <path d="M11.153 4.66615C11.0191 4.65753 10.8943 4.5906 10.8081 4.48104C10.7218 4.37149 10.6815 4.22893 10.6966 4.08677C10.7111 3.61854 10.4447 3.19234 10.0338 3.02651C9.7733 2.95539 9.61553 2.67324 9.6807 2.39499C9.74255 2.12121 9.99891 1.95098 10.2566 2.0126C10.2891 2.018 10.3204 2.02979 10.3489 2.04737C11.1727 2.36439 11.7061 3.2176 11.6637 4.1505C11.6623 4.2919 11.6072 4.42665 11.5109 4.52387C11.4146 4.62109 11.2854 4.67244 11.153 4.66615Z" fill="currentColor" />
                                </svg>
                            </i>
                            <span class="item-name">Get Data</span>
                            <i class="right-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </i>
                        </a>
                        <ul class="sub-nav collapse" id="sidebar-special" data-bs-parent="#sidebar-menu">
                            <li class="nav-item">
                                <a class="nav-link  <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_See_Users') echo 'active';  ?> " href="../index.php/Portal_See_Users">
                                    <i class="icon">
                                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Login" data-bs-placement="right">B</i>
                                    <span class="item-name">See Users </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  <?php if ($_SERVER['REQUEST_URI'] == '/CustCount/index.php/Portal_See_Deposits') echo 'active';  ?>" href="../index.php/Portal_See_Deposits">
                                    <i class="icon">
                                        <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Calender" data-bs-placement="right">C</i>
                                    <span class="item-name">See Deposits</span>
                                </a>
                            </li>



                        <?php endif; ?>


                        <?php if (in_array($role, ['Manager', 'Admin'])) : ?>





                        <?php endif; ?>

                        <!-- Item 5: Accessible by Admin only -->
                        <?php if ($role == 'Admin') : ?>




                        <?php endif; ?>




                        <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>