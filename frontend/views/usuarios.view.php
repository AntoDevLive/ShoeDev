<?php

require '../config/database.php';

$conexion = conectarDB();

$stmt_usuario = $conexion->prepare(
  "SELECT usuario.id, usuario.username, usuario.email, usuario.rol, perfil.nombre, perfil.apellidos, perfil.direccion, perfil.nacimiento FROM usuario LEFT JOIN perfil on usuario.id = perfil.usuario_id"
);
$stmt_usuario->execute();
$usuarios = $stmt_usuario->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/shoedev/frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Administrar productos</title>
</head>

<body class="min-h-screen flex flex-col text-gray-900">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>

  <!-- Título section -->
  <section class="bg-neutral-50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Administrar Usuarios</h1>
    </div>

  </section>


  <!-- Usuarios -->
  <section class="py-8 grow">

    <!-- Filters -->
    <div class="flex justify-center items-center flex-col gap-2 w-full">
      <div class="max-w-2xl mx-auto mb-6 relative barra-busqueda w-full">
        <input id="searchInput" type="text" placeholder="Buscar usuarios..." class="pl-10 h-12 w-full border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-600">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
            <path d="M21 21l-6 -6" />
          </svg>
        </span>
      </div>

      <!-- Buttons -->
      <div class="w-full flex justify-center items-center gap-10">
        <button data-action="recent" id="btnRecent" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Más recientes primero</button>
        <button data-action="oldest" id="btnOldest" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Más antiguos primero</button>
        <button data-action="admin" id="btnAdmin" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Administradores</button>
        <button data-action="standard" id="btnStandard" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Usuarios estándar</button>
      </div>
    </div>

    <div class="overflow-x-auto px-6 py-10">
      <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-orange-600 text-white">
          <tr>
            <th class="py-3 px-4 text-center text-md font-semibold">ID</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Usuario</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Email</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Nombre</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Apellidos</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Dirección</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Nacimiento</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Rol</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Acciones</th>
          </tr>
        </thead>

        <tbody id="usersTbody" class="divide-y divide-gray-200 bg-white text-center">

          <?php foreach ($usuarios as $user):
            // normalizamos rol para dataset
            $rol_data = isset($user['rol']) ? strtolower($user['rol']) : '';
          ?>
            <tr class="user-row hover:bg-orange-50 transition" data-id="<?php echo (int)$user['id']; ?>" data-rol="<?php echo htmlspecialchars($rol_data, ENT_QUOTES); ?>">
              <td class="py-3 px-4"> <?php echo $user['id']; ?> </td>
              <td class="py-3 px-4 username-cell"><?php echo $user['username']; ?></td>
              <td class="py-3 px-4 email-cell"><?php echo $user['email']; ?></td>
              <td class="py-3 px-4 capitalize nombre-cell"><?php echo $user['nombre']; ?></td>
              <td class="py-3 px-4 capitalize apellidos-cell"><?php echo $user['apellidos']; ?></td>
              <td class="py-3 px-4 capitalize direccion-cell"><?php echo $user['direccion']; ?></td>
              <td class="py-3 px-4 nacimiento-cell"><?php echo $user['nacimiento']; ?></td>
              <td class="py-3 px-4">
                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-semibold capitalize rol-cell"><?php echo $user['rol']; ?></span>
              </td>
              <td class="py-3 px-4">
                <div class="flex gap-3 justify-center">
                  <button class="px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md transition cursor-pointer">Editar</button>
                  <button class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-md transition cursor-pointer">Eliminar</button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<!-- scripts -->
<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/users-filter.js"></script>

</html>