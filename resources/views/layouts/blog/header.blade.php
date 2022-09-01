<header id="header">
    <!-- NAV -->
    <div id="nav" role="nav and web site Header">
        <!-- Top Nav -->
        <div id="nav-top" role="Main Nav & header" aria-level="1">
            <div class="container">
                <ul class="nav-social">
                </ul>   
                
                <div class="nav-logo" role="Website Name:Test Blog">
                    <a href="{{ url('home')}}" class="logo">Test Blog</a>
                </div>

                <!-- search & aside toggle -->
                <div class="nav-btns" role="Nav">
                    <button class="aside-btn" aria-label="Dropdown" role="image" aria-pressed="false" tabindex="0"><i class="fa fa-bars"></i></button>
                    <button class="search-btn" aria-label="Search Window"  role="image" aria-pressed="false" tabindex="0"><i class="fa fa-search"></i></button>
                    <div id="nav-search" role="search form">
                        <form action="" role="search" method="" id="searchForm">
                            <input type="text" class="input" value="<?php !empty($keyword)? $keyword:''; ?>" name="search" placeholder="Search a source">
                        </form>
                        <button class="nav-close search-close">
                            <span></span>
                        </button>
                    </div>
                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Top Nav -->

        <!-- Main Nav -->
        <div id="nav-bottom" role="Website Nav">
            <div class="container">
                <!-- nav -->
                <ul class="nav-menu">
                    <li><a href="{{ url('home')}}">Home</a></li>
                    <li><a href="{{ url('sources')}}">Source List</a></li>
                    <li><a href="#">Language</a></li>
                    <li><a href="{{ url('register')}}">Register</a></li>
                </ul>
                <!-- /nav -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside" role="side nav">
            <ul class="nav-aside-menu">
                <li><a href="{{ url('home')}}">Home</a></li>
                <li><a href="{{ url('sources')}}">Source List</a></li>
                <li><a href="#">Language</a></li>
                <li><a href="#">Contacts</a></li>
                <li><a href="{{ url('register')}}">Register</a></li>
            </ul>
            <button class="nav-close nav-aside-close"><span></span></button>
        </div>
        <!-- /Aside Nav -->
    </div>
    <!-- /NAV -->
</header>
<!-- /HEADER -->