import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    // Nous définissons les cibles que nous allons manipuler.
    static targets = ['menu'];

   // Méthode qui sera exécutée lorsque l'utilisateur cliquera sur le menu burger
    toggle() {
        this.menuTarget.classList.toggle('hidden');
    }
    
    close() {
        this.menuTarget.classList.add('hidden');
    }
}