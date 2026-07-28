// assets/controllers/mobile_menu_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    // Definimos los targets que vamos a manipular.
    // En este caso solo uno: 'menu'
    static targets = ['menu'];

    // Método que se ejecutará al hacer clic en el botón hamburguesa
    toggle() {
        this.menuTarget.classList.toggle('hidden');
    }
    
    close() {
        this.menuTarget.classList.add('hidden');
    }
}