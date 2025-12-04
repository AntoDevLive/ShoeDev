document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  if (!searchInput) return;

  const emptySearchSection = document.getElementById('empty-search');
  const header = document.querySelector('header');
  const carrito = document.querySelector('.carrito');
  const nuevoProductoBtn = document.getElementById("nuevo-producto-btn");

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase().trim();
    let hasVisibleProducts = false;

    // 🔥 Recoger SIEMPRE los productos más recientes del DOM (incluye dinámicos)
    const products = document.querySelectorAll('.product-card');

    // --- Mostrar/ocultar productos según búsqueda ---
    products.forEach(product => {
      const name = product.dataset.name?.toLowerCase() || "";
      const brand = product.dataset.brand?.toLowerCase() || "";
      const match = name.includes(query) || brand.includes(query);

      product.style.display = match ? 'block' : 'none';
      if (match) hasVisibleProducts = true;
    });

    // Detectar si estamos en la página de admin
    const isAdminPage = window.location.pathname.includes('productos.php');

    // --- LÓGICA PARA TIENDA ---
    if (!isAdminPage) {
      const sections = document.querySelectorAll('body > section');

      sections.forEach(section => {
        const isInsideHeader = header && header.contains(section);
        const isInsideCarrito = carrito && carrito.contains(section);
        const isCarrito = section.classList.contains('carrito');
        const isEmpty = section.id === 'empty-search';

        if (isInsideHeader || isInsideCarrito || isCarrito || isEmpty) return;

        const visibleProducts = section.querySelectorAll(
          '.product-card:not([style*="display: none"])'
        );

        section.style.display = visibleProducts.length > 0 ? 'block' : 'none';
      });
    }

    // --- LÓGICA PARA ADMIN ---
    if (isAdminPage) {
      const brandSections = document.querySelectorAll(
        "section[id='nike'], section[id='adidas'], section[id='puma']"
      );

      brandSections.forEach(section => {
        const visibleProducts = section.querySelectorAll(
          '.product-card:not([style*="display: none"])'
        );

        section.style.display = visibleProducts.length > 0 ? 'block' : 'none';
      });
    }

    // --- Mostrar mensaje "sin resultados" ---
    emptySearchSection.classList.toggle('hidden', hasVisibleProducts || query === '');

    // --- Mostrar/ocultar botón "Nuevo Producto" en admin ---
    if (nuevoProductoBtn) {
      if (!hasVisibleProducts && query !== "") {
        nuevoProductoBtn.classList.add("hidden");
      } else {
        nuevoProductoBtn.classList.remove("hidden");
      }
    }
  });
});
