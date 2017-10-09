<!DOCTYPE html>
<html lang="vi">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# book: http://ogp.me/ns/book# profile: http://ogp.me/ns/profile#">
    <meta charset="UTF-8">
    @yield('title')
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"> 
    @include('guestLayouts.css')
    <link rel="search" type="application/opensearchdescription+xml" href="http://static.truyenfull.vn/xml/opensearch.xml" title="Search">
</head>

<body id="body_home">
    <div id="wrap">
        <div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Hiện menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <h1><a class="header-logo" href="http://truyenfull.vn/" title="doc truyen">doc truyen</a></h1></div>
                <div class="navbar-collapse collapse" itemscope itemtype="http://schema.org/WebSite">
                    <meta itemprop="url" content="http://truyenfull.vn" />
                    @include('guestLayouts.navBar')
                    @include('guestLayouts.searchBar')
                    <div id="login-status" class="hide"></div>
                </div>
            </div>
            @yield('breadcrumb')
        </div>
      @yield('content')
    </div>
    @include('guestLayouts.footer')
    @include('guestLayouts.script')
    @yield('script')
</body>

</html>