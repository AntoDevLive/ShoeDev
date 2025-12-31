<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="frontend/src/output.css">
      <link rel="shortcut icon" href="/shoedev/frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | <?php echo $infoProducto['titulo']; ?></title>
</head>

<body>

  <div class="min-h-screen bg-background">

    <!-- Modal -->
    <?php include 'frontend/templates/Modal.php' ?>

    <!-- Header -->
    <?php include 'frontend/templates/Header.php' ?>

    <!-- Carrito -->
    <?php include 'frontend/templates/Carrito.php' ?>


    <main class="container mx-auto px-4 py-8">
      <div class="grid lg:grid-cols-2 gap-8 lg:gap-16">

        <!-- Image Section -->
        <div class="space-y-4">
          <div class="relative aspect-square rounded-3xl overflow-hidden bg-secondary/30">
            <img src="/shoedev/backend/uploads/products/<?php echo $infoProducto['imagen'] ?>" alt="NOMBRE_PRODUCTO" class="w-full h-full object-cover" />

            <button class="absolute top-4 right-4 bg-background/80 backdrop-blur-sm hover:bg-background text-muted-foreground">
              <svg class="w-5 h-5"></svg>
            </button>
          </div>
        </div>

        <!-- Details Section -->
        <div class="space-y-6">

          <!-- Brand & Name -->
          <div>
            <p class="text-primary font-semibold uppercase tracking-wider text-sm mb-2">
              <?php echo $infoProducto['marca']; ?>
            </p>
            <h1 class="text-3xl md:text-4xl font-bold text-foreground mb-4 capitalize">
              <?php echo $infoProducto['titulo']; ?>
            </h1>

            <!-- Rating -->
            <div class="flex items-center gap-2">
              <span class="text-foreground font-semibold">4.5</span>
              <span class="text-muted-foreground">(120 reseñas)</span>
            </div>
          </div>

          <!-- Price -->
          <div class="flex items-baseline gap-3">
            <span class="text-4xl font-bold text-foreground">
              <?php echo $infoProducto['precio']; ?>
            </span>
          </div>

          <!-- Description -->
          <p class="text-muted-foreground leading-relaxed">
            <?php echo $infoProducto['descripcion']; ?>
          </p>


          <!-- Buttons -->
<div class="flex flex-col sm:flex-row gap-4 pt-4">
  <button
    class="producto-btn bg-orange-500 text-white w-full text-2xl font-semibold py-3 rounded-lg cursor-pointer transition-all duration-300 hover:bg-orange-500/85 focus:outline-none focus:ring-2 focus:ring-orange-400"
    data-id="<?php echo $infoProducto['id']; ?>"
    data-titulo="<?php echo htmlspecialchars($infoProducto['titulo']); ?>"
    data-precio="<?php echo $infoProducto['precio']; ?>"
    data-imagen="/shoedev/backend/uploads/products/<?php echo $infoProducto['imagen']; ?>">
    Añadir al carrito
  </button>

  <a
    id="comprar-ahora-btn"
    class="producto-btn bg-white border-2 border-orange-500 text-orange-500 w-full text-2xl font-semibold py-3 rounded-lg cursor-pointer transition-all duration-300 hover:bg-orange-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-orange-400 text-center">
    Comprar Ahora
  </a>
</div>


          

          <!-- Features -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-border">
            <div class="flex items-center gap-3 text-muted-foreground">
              <svg class="w-5 h-5 text-primary"></svg>
              <span class="text-sm">Envío gratis +50€</span>
            </div>
            <div class="flex items-center gap-3 text-muted-foreground">
              <svg class="w-5 h-5 text-primary"></svg>
              <span class="text-sm">30 días devolución</span>
            </div>
            <div class="flex items-center gap-3 text-muted-foreground">
              <svg class="w-5 h-5 text-primary"></svg>
              <span class="text-sm">Garantía 2 años</span>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>


  <?php include 'frontend/templates/Footer.php' ?>
</body>

<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>

</html>