document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const products = document.querySelectorAll('.product-card');

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();

    // Oculta/muestra productos
    products.forEach(product => {
      const name = product.dataset.name.toLowerCase();
      const brand = product.dataset.brand.toLowerCase();
      if (name.includes(query) || brand.includes(query)) {
        product.style.display = 'block';
      } else {
        product.style.display = 'none';
      }
    });

    // Oculta/muestra secciones completas según productos visibles
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
      const visibleProducts = section.querySelectorAll('.product-card:not([style*="display: none"])');
      if (visibleProducts.length > 0) {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });
  });
});
