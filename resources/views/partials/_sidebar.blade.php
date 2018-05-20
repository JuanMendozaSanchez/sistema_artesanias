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
                    <a href="/pedidos">
                        <i class="ti-view-list-alt"></i>
                        <p>Pedidos en linea <span class="glyphicon glyphicon-bell" style="font-size: 2.3rem;background-color: #FF7234;padding: 2px; border-radius: 10px;color: white;" data-toggle="tooltip" data-placement="left" title="Actualiza la página para ver los nuevos pedidos" id="notificacion"></span></p>
                        <input type="hidden" name="pedidos" id="pedidos" value="0">

                    </a>
                </li>
                <li>
                    <a href="/codigosB">
                        <i class="glyphicon glyphicon-barcode"></i>
                        <p>Generar BC</p>

                    </a>
                </li>
                <li>
                    <a href="/maps">
                        <i class="ti-map"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="/reportes">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <p>Reportes</p>
                    </a>
                </li>
                <li>
                    <a href="/graficas">
                        <i class="glyphicon glyphicon-stats"></i>
                        <p>Gráficas</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>