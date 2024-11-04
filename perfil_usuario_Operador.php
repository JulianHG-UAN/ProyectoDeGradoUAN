<?php require_once "vistas_user/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$usuarioId = $_SESSION['usuario_id'];

// Consulta SQL para obtener los datos del usuario
$query = $conexion->prepare("SELECT * FROM users WHERE users_id = :id");
$query->bindParam(':id', $usuarioId, PDO::PARAM_INT);
$query->execute();

// Obtener los datos del usuario
// $userData = $query->fetch(PDO::FETCH_ASSOC);
// if (!$userData) {
//    die('No se encontró el usuario.');
// }

// Obtener los roles disponibles
if (isset($_POST['update_profile'])) {
   $new_name = $_POST['name'];
   $new_lastname = $_POST['lastname'];
   $new_email = $_POST['email'];
   $new_role_id = $_POST['role'];

   // Actualizar el nombre, apellido, correo y rol
   $update = $conexion->prepare("UPDATE `users` SET users_name = ?, users_lastname = ?, users_email = ?, role_id = ? WHERE users_id = ?");
   $update->execute([$new_name, $new_lastname, $new_email, $new_role_id, $usuarioId]);

   $_SESSION['usuario'] = $new_email; // Actualizamos la sesión con el nuevo correo
   header('Location: perfil_usuario_Operador.php');
   exit();
}

// Manejar la actualización de contraseña
if (isset($_POST['update_password'])) {
   $current_password = $_POST['current_password'];
   $new_password = $_POST['new_password'];
   $confirm_password = $_POST['confirm_password'];

   // Verificar la contraseña actual
   $query = $conexion->prepare("SELECT password_hash FROM `users` WHERE users_id = ?");
   $query->execute([$usuarioId]);
   $user = $query->fetch(PDO::FETCH_ASSOC);

   if (password_verify($current_password, $user['password_hash'])) {
      if ($new_password === $confirm_password) {
         $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

         $update_password = $conexion->prepare("UPDATE `users` SET password_hash = ? WHERE users_id = ?");
         if ($update_password->execute([$new_password_hash, $usuarioId])) {
            $message[] = 'Contraseña actualizada con éxito';
         }
      } else {
         $message[] = 'Las contraseñas no coinciden';
      }
   } else {
      $message[] = 'Contraseña actual incorrecta';
   }
}

?>
<!DOCTYPE html>
<html lang="en">

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

         <h4><?php echo $userData['users_name'] . ' ' . $userData['users_lastname']; ?></h4>
         <p><?php echo $userData['users_email']; ?></p>

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
               <select name="role" class="form-control" required>
                  <?php while ($role = $roles_query->fetch_assoc()) { ?>
                     <option value="<?php echo $role['role_id']; ?>"
                        <?php if ($role['role_id'] == $userData['role_id']) echo 'selected'; ?>>
                        <?php echo $role['role_name']; ?>
                     </option>
                  <?php } ?>
               </select>
            </div>
            <input type="submit" name="update_profile" value="Actualizar Perfil" class="btn btn-primary btn-block">
         </form>

         <hr>

         <!-- Formulario para cambiar contraseña -->
         <h5>Cambiar Contraseña</h5>
         <form action="perfil.php" method="post">
            <div class="form-group">
               <label for="current_password">Contraseña Actual</label>
               <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
               <label for="new_password">Nueva Contraseña</label>
               <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
               <label for="confirm_password">Confirmar Nueva Contraseña</label>
               <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <input type="submit" name="update_password" value="Cambiar Contraseña" class="btn btn-warning btn-block">
         </form>
      </div>
   </div>

</body>

</html>

<!-- FIN contenido principal -->

<?php require_once "vistas_user/parte_inf.php"?>