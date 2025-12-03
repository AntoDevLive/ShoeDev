document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const products = document.querySelectorAll('.product-card');
  const emptySearchSection = document.getElementById('empty-search');
  const header = document.querySelector('header');
  const carrito = document.querySelector('.carrito');

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    let hasVisibleProducts = false;

    // Oculta/muestra productos
    products.forEach(product => {
      const name = product.dataset.name.toLowerCase();
      const brand = product.dataset.brand.toLowerCase();
      if (name.includes(query) || brand.includes(query)) {
        product.style.display = 'block';
        hasVisibleProducts = true;
      } else {
        product.style.display = 'none';
      }
    });

    // Secciones excluidas
    const sections = document.querySelectorAll('body > section');
    sections.forEach(section => {
      const isInsideHeader = header && header.contains(section);
      const isInsideCarrito = carrito && carrito.contains(section);
      const isCarrito = section.classList.contains('carrito');
      const isEmptySearch = section.id === 'empty-search';

      if (isInsideHeader || isInsideCarrito || isCarrito || isEmptySearch) {
        return;
      }

      const visibleProducts = section.querySelectorAll('.product-card:not([style*="display: none"])');
      if (visibleProducts.length > 0) {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });

    // Mostrar mensaje de búsqueda vacía si no hay resultados y hay búsqueda activa
    if (!hasVisibleProducts && query.trim() !== '') {
      emptySearchSection.classList.remove('hidden');
    } else {
      emptySearchSection.classList.add('hidden');
    }
  });
});