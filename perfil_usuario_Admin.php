<?php require_once "vistas_admin/parte_sup.php"?>
<head>
   <!-- Custom styles -->
   <style>
      .profile-card {
         max-width: 500px;
         margin: 0 auto;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
      }

      .profile-img {
         width: 100px;
         height: 100px;
         object-fit: cover;
         border-radius: 50%;
         margin-bottom: 20px;
      }
   </style>
</head>

<body>

   <div class="container mt-5">
      <div class="profile-card text-center">
         <h3>Perfil de Usuario</h3>

         <!-- Formulario para actualizar perfil -->
         <form action="perfil.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Nombre</label>
               <input type="text" name="name" class="form-control" value="<?php echo $userData['users_name']; ?>" required>
            </div>
            <div class="form-group">
               <label for="lastname">Apellido</label>
               <input type="text" name="lastname" class="form-control" value="<?php echo $userData['users_lastname']; ?>" required>
            </div>
            <div class="form-group">
               <label for="email">Correo Electrónico</label>
               <input type="email" name="email" class="form-control" value="<?php echo $userData['users_email']; ?>" required>
            </div>
            <div class="form-group">
               <label for="role">Rol</label>
               <input type="text" name="role" class="form-control" value="<?php echo $userData['role']; ?>" required>
            </div>
         </form>
      </div>
   </div>
</body>
</html>
<?php require_once "vistas_admin/parte_inf.php"?>