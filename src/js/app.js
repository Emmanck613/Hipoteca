document.addEventListener('DOMContentLoaded', function(){
    eventListeners();

    darkMode();
})

function darkMode(){

    const preferencia = window.matchMedia('(prefers-color-scheme: dark)');

    if(preferencia.matches){
        document.body.classList.add('dark-mode');
    } else{
        document.body.classList.remove('dark-mode');
    }

    preferencia.addEventListener('change', function(){
        if(preferencia.matches){
            document.body.classList.add('dark-mode');
        } else{
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //muestra campos condicionales
     const metodoContacto = document.querySelectorAll('input[name="contacto[CONTACTO]"]'); 
     //va selecionar todos los inps con name contacto
     //nos permite selecionar los elementos que compartan un atributo
     metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))
     //vamos a iter metodo contacto al ser un arreglo con los metodos de contacto
}
function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    //toggle hace que si tiene la clase la agrega, sino la quita al hacer click
    navegacion.classList.toggle('mostrar'); 

};

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'TELEFONO'){
        contactoDiv.innerHTML = `
        <label for="TELEFONO">Numero Telefono</label>
        <input type="tel" placeholder="Telefono" id="TELEFONO" name="contacto[TELEFONO]"> 
        
        <p>Elija la fecha y la hora</p>
            
        <label for="FECHA">Fecha:</label>
        <input type="date" id="FECHA" name="contacto[FECHA]">
   
        <label for="HORA">Hora:</label>
        <input type="time" id="HORA" min="09:00" max="18:00" name="contacto[HORA]">
   
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="EMAIL">E-mail</label>
        <input type="email" placeholder="E-mail" id="EMAIL" name="contacto[EMAIL]" required>
        `;

    }
}