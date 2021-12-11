<!-- NAVIGATION -->
<div id="menu">
    <nav class="navbar-wrapper navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand site-name" href="#top"><img src="{{asset('landing1/images/logo1.png')}}" alt="logo" style="width: 200px;"></a>
            </div>

            <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="#intro">About</a></li>
                    <li><a href="#feature">Features</a></li>
                    <li><a href="#download">Download</a></li>
                    <!-- <li><a href="#package">Pricing</a></li> -->
                    <li><a href="#testi">Reviews</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/login"><i class="fa fa-user-circle"></i> <?= Auth::check() ? Auth::user()->name : "Login" ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>