import ClassicEditor from '@binay7587/ckeditor5-full-free';
window.ClassicEditor = ClassicEditor;

let numberOfCkeditors;
let ckEditors = [];
$( document ).ready(function() {
    let component = Livewire.first()
   numberOfCkeditors = Object.keys(Livewire.getByName('widgets.ckeditor')).length;

    for (let i = 1; i <= numberOfCkeditors; i++) {
        ClassicEditor
            .create( document.querySelector( '#ckeditor' + i ), {
                language: {
                    ui: 'en',
                    content: 'ar'
                }
            })
            .then(editor => {
                ckEditors[i] = editor
                    editor.model.document.on('change:data', (evt, data) => {
                    component.set('form.ckeditor' + i, editor.getData(), 'false')
                });
            })
            .catch( error => {
                console.error( error );
            } );
    }
});

document.addEventListener('livewire:initialized', () => {
    Livewire.on('setDataOnCkeditor', (data) => {
        for (let i = 1; i <= numberOfCkeditors; i++) {
            ckEditors[i].setData(data[i - 1])
        }
    })
});
