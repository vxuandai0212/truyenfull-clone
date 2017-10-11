<!DOCTYPE html>
<html lang="vi">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# book: http://ogp.me/ns/book# profile: http://ogp.me/ns/profile#">
    <meta charset="UTF-8">
    @yield('title')
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"> 
    @include('guestLayouts.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript">
$(document).ready(function(){
    $("#search-input").autocomplete({
        source: "{{ url('/search/ajax') }}",
            focus: function( event, ui ) {
            //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
            return false;
        },
        select: function( event, ui ) {
            window.location.href = ui.item.url;
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="label"><h4><b>' + item.title + '</b></h4></div></div></a>';
        return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append(inner_html)
                .appendTo( ul );
    };
});
</script> 
<script>
    $('#hot-select').on('change', function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.get('ajax-subcat?cat_id=' +cat_id, function(data){
            $('#subcategory').empty();
            $.each(data, function(index, subcatObj){
                $(#subcategory).append('<option value"'+subcatObj.id+'">'+subcatObj.name+'</option>');
            });
        });
    });
</script> 
</body>

</html>
