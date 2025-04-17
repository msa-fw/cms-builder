/**
 * Close all modal windows by Escape key press
 */
document.addEventListener('keydown', function(event){
    if(event.key === 'Escape'){
        mainObj.modal.close('.modal-window');
    }
});
