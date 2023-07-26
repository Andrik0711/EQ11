// require('./bootstrap');
import Dropzone from "dropzone"

// Dropzone para subir imagenes
Dropzone.autoDiscover = false;
const subir_imagen = new Dropzone('#cargar_imagen', {
    dictDefaultMessage: 'Suba tú imagen aquí',
    acceptedFiles: ".png,.jpg,.jpeg",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    //trabajando con imagen en el contenedor de dropzone
    init: function () {
        if (document.querySelector('[name= "imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name= "imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada.name,
                '/uploads/${imagenPublicada.name}'
            );
            imagenPublicada.previewElement.classList.add(
                "dz-sucess",
                "dz-complete"
            )
        }
    }
});

//evento de envio de correo correcto
subir_imagen.on('success', function (file, response) {
    document.querySelector('[name= "imagen"]').value = response.imagen;
});
//envio cuando hay error
subir_imagen.on('error', function (file, message) {
    console.log(message);
});
//remover un archivo
subir_imagen.on('removedfile', function () {
    document.querySelector('[name= "imagen"]').value = "";
});


//inicializar datatable	de categorias
new DataTable('#categorias-table');

//inicializar datatable	de subcategorias
new DataTable('#subcategorias-table');

//inicializar datatable	de productos
new DataTable('#productos-table');

// inicializar datatable de marcas
new DataTable('#marcas-table');

//inicializar datatable de clientes
new DataTable('#clientes-table');

//inicializar datatable de proveedores
new DataTable('#proveedores-table');