<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" id="menu">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ nombre }}</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="change-password.php">Cambiar contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" v-on:click="cerrar_sesion">Cerrar sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    var app = new Vue({
        el: "#menu",
        data: function() {
            return {
                nombre: ""
            }
        },
        created: function() {
            this.sesion_validar_local();
        },
        methods: {
            sesion_validar: function() {
                let token = localStorage.getItem("token");
                let h = {};
                h.Authorization = 'Bearer ' + token;
                $.ajax({
                    type: 'POST',
                    url: 'back/sesion_validar.php',
                    dataType: 'json',
                    headers: h,
                    success: (response) => {
                        if (!response.estatus) {
                            this.cerrar_sesion();

                        } else {
                            this.nombre = response.data.nombre_completo
                        }
                    },
                    error: (e) => {
                        toastr.error(e.statusText, 'Prueba');
                    }
                });
            },
            sesion_validar_local: function() {
                let token = localStorage.getItem("token");
                if (!!token) {
                    this.sesion_validar();
                } else {
                    this.cerrar_sesion({});
                }
            },
            cerrar_sesion: function() {
                localStorage.clear();
                location.href = "signin.php";
            }
        }
    });
</script>