import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';

// Recupero tutti i pulsanti di cancellazione della tabella
const deleteSubmitButtons = document.querySelectorAll('.delete-post-form button[type="submit"]');

// Ciclo tutti i pulsanti
deleteSubmitButtons.forEach((button) => {
    // Ad ogni pulsante indico di rimanere in attesa di un evento click
    button.addEventListener('click', (event) => {
        // Prevengo la sottomissione della form al click
        event.preventDefault();

        // Recupero l'HTML della modale di conferma
        const modal = document.getElementById('confirmPostDelete');

        // Creo un'istanza della classe Modal di Bootstrap a partire dall'HTML recuperato in precedenza  
        const bootstrapModal = new bootstrap.Modal(modal);

        // Mostro la modale
        bootstrapModal.show();

        // Recupero il pulsante di cancellazione all'interno della modale
        const buttonDelete = modal.querySelector('.confim-delete-button');

        // Devo far sì che questo pulsante rimanga in attesa di un nuovo evento click
        buttonDelete.addEventListener('click', () => {
            button.parentElement.submit();
        });
    });
});