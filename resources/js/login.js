import Modal from '@/modal.js';
import Loader from '@/loader.js';

jQuery(document).ready(function () {
    initForm();
    Loader.hide();
});

function initForm() {
    let requestInProcess = false;
    $('#auth-form').on('submit', async function (e) {
        if (requestInProcess) return;
        e.preventDefault();

        requestInProcess = true;
        Loader.show();
        const res = await login.make(collectFormData());

        requestInProcess = false;
        if (!res) {
            Loader.hide();
            return;
        }

        const token = res.token || '';
        const url = res.url || '';
        localStorage.setItem('user-token', token);
        window.location.replace(url);
    });

    function collectFormData() {
        return {
            login: $('#login').val(),
            password: $('#password').val(),
        };
    }
}

const login = {
    async make(data) {
        return await axios.post('/api/users/login', data)
            .then(({data, status}) => {
                if (status !== 200 || !data.result) {
                    Modal.show('Ошибка', 'Произошла ошибка во время запроса. Пожалуйста перезагрузите страницу');
                    return null;
                }
                if (data.result.success) {
                    return data.result;
                } else if (data.result.message) {
                    Modal.show('Ошибка авторизации', data.result.message);
                    return null;
                }

                const message = this.parseErrorMessage(data?.result?.errors ?? null);
                Modal.show('Ошибка валидации', message);
                return null;
            })
            .catch((err) => {
                Modal.show('Ошибка', 'Произошла ошибка во время запроса. Пожалуйста перезагрузите страницу');
                console.error(err);
                return null;
            });
    },

    parseErrorMessage(errors) {
        try {
            if (!errors) return 'Произошла непредвиденная ошибка';
            return Object.values(errors).map((error) => '<p>' + error[0] + '</p>').join('');
        } catch (e) {
            return 'Произошла непредвиденная ошибка';
        }
    }
};
