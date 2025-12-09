const modalSession = document.querySelector('#modal-session');
const dialogSession = document.querySelector('#dialog-session');
const cancelBtn = document.querySelector('#cancel-btn-session');

function closeModal() {
  modalSession.classList.add('hidden');
}

modalSession.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
dialogSession.addEventListener('click', e => e.stopPropagation());