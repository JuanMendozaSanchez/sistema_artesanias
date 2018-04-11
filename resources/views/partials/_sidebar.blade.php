<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
      var current_page_URL = location.href;
      $( "a" ).each(function() {
         if ($(this).attr("href") !== "#") {
           var target_URL = $(this).prop("href");
           if (target_URL == current_page_URL) {
              $('nav a').parents('li, ul').removeClass('active');
              $(this).parent('li').addClass('active');
              return false;
           }
         }
      });
    });
</script>

<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text"><span class="glyphicon glyphicon-home">
                    Inicio
                </a>
            </div>

            <ul class="nav_mio nav">
                <li >
                    <a href="/home">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/usuario">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="/tabla">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="/fuentes">
                        <i class="ti-text"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="/iconos">
                        <i class="ti-pencil-alt2"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="/maps">
                        <i class="ti-map"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="/notificaciones">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>