<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php' ?>
    <title>Bienvenido</title>
</head>

<body>

    <div class="container" style="margin-top: 60px;" id="app">
        <h4>
            Para poder acceder a tu panel de control, ingresa la siguiente informacion
        </h4>
        <div style="margin-top: 5px; width: 400px">
            <form class="row g-3" @submit.prevent="iniciar_sesion">
                <div class="mb-3">
                    <label for="correo" class="form-label">Usuario (correo)</label>
                    <input type="email" class="form-control" v-model="data.correo" id="correo" placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" v-model="data.contrasena" id="contrasena" required>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Iniciar sesion</button>
                </div>
            </form>
        </div>
        <div style="margin-top: 5px;">
            <h6>
                Si no tienes una cuenta, puedes <a href="register.php"> REGISTRARTE AHORA</a>
            </h6>
        </div>

    </div>


</body>
<script>
   

    var app = new Vue({
        el: "#app",
        data: function() {
            return {
                data: {}
            }
        },
        created: function() {
            this.sesion_validar_local();
        },
        methods: {
            sesion_validar_local: function() {
                let token = localStorage.getItem("token");
                if (!!token) {
                    this.iniciar();
                }
            },
            iniciar: function() {
                location.href = "index.php";
            },
            iniciar_sesion: function(){
                $.ajax({
                    type: 'POST',
                    url: 'back/iniciar_sesion.php',
                    data: this.data,
                    dataType: 'json',
                    success: (response) => {
                        if(!response.estatus){
                            toastr.error(response.data, 'Prueba'); 
                        }else{
                            token = response.token;
                            localStorage.setItem('token', token);
                            this.iniciar();
                        }
                    },
                    error: (e) => {
                        toastr.error(e.statusText, 'Prueba');
                    }
                });
            }

        }
    });
</script>

</html>