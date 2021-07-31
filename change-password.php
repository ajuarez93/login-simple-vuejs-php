<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php' ?>
    <title>Bienvenido</title>
</head>

<body>
    <?php include_once 'menu.php' ?>

    <div class="container" style="margin-top: 100px;" id="app">
        <h4>
            Para poder cambiar la contraseña de tu panel de control, ingresa la siguiente informacion
        </h4>
        <div style="margin-top: 5px; width: 400px">
            <form class="row g-3" @submit.prevent="cambiar_contrasena">
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña anterior</label>
                    <input type="password" class="form-control" v-model="data.contrasena_anterior" id="contrasena" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña nueva</label>
                    <input type="password" class="form-control" v-model="data.contrasena_nueva" id="contrasena" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña nueva (confirmar)</label>
                    <input type="password" class="form-control" v-model="data.contrasena_nueva_confirmar" id="contrasena" required>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Cambiar contraseña</button>
                </div>
            </form>
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
        methods: {
            cambiar_contrasena: function(){
                if(!this.validar()){
                    return ;
                }
                let token = localStorage.getItem("token");
                let h = {};
                h.Authorization = 'Bearer ' + token;

                $.ajax({
                    type: 'POST',
                    url: 'back/cambiar_contrasena.php',
                    data: this.data,
                    dataType: 'json',
                    headers: h,
                    success: (response) => {
                        if(!response.estatus){
                            toastr.error(response.data, 'Prueba'); 
                        }else{
                            toastr.success(response.data, 'Prueba');
                            this.data = {};
                        }
                    },
                    error: (e) => {
                        toastr.error(e.statusText, 'Prueba');
                    }
                });
            },
            validar: function(){
                if(!this.data.contrasena_anterior){
                    toastr.error('Ingrese la contraseña anterior', 'Prueba');
                    return false;
                }
                if(!this.data.contrasena_nueva){
                    toastr.error('Ingrese la contraseña nueva', 'Prueba');
                    return false;
                }
                if(!this.data.contrasena_nueva_confirmar){
                    toastr.error('confirme la contraseña', 'Prueba');
                    return false;
                }
                if(this.data.contrasena_nueva_confirmar != this.data.contrasena_nueva){
                    toastr.error('Las contraseñas no coinciden', 'Prueba');
                    return false;
                }
                if(this.data.contrasena_anterior == this.data.contrasena_nueva){
                    toastr.error('Las contraseña nueva no puede ser igual a la anterior', 'Prueba');
                    return false;
                }
                return true;
            }

        }
    });
</script>
</html>