import Modal from '@/modal.js';
import Loader from '@/loader.js';

jQuery(document).ready(function () {
    initForm();
    Loader.hide();
});

function initForm() {
    const $form = $('#create-form');

    $form.on('submit', function (e) {
        e.preventDefault();
        createEvent($form.serialize());
    });

    async function createEvent(data) {
        Loader.show();
        const request = axios.post('/api/events', data);
        const result = await request
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return null;
                }
                return data.result
            })
            .catch((e) => {
                console.error(e);
                return null;
            });
        if (!result || !result.id) {
            Modal.show('Ошибка',
                'Во время выполнения запроса произошла ошибка. Пожалуйста, перезагрузит страницу и попробуйте снова.');
            return;
        }
        localStorage.setItem('event_id', result.id);
        document.location.replace(document.location.pathname.replace('create', ''));
    }
}
