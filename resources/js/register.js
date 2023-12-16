import Modal from "@/modal.js";

jQuery(document).ready(function () {
    initForm();
    $('#reservationdate').datetimepicker({
        format: 'DD.MM.YYYY',
        maxDate: new Date(),
    });
});

function initForm() {
    let requestInProcess = false;
    $('#auth-form').on('submit', async function (e) {
        if (requestInProcess) return;
        e.preventDefault();

        requestInProcess = true;
        const res = await register.make(collectFormData());

        requestInProcess = false;
        if (!res) return;

        const token = res.token || '';
        const url = res.url || '';
        localStorage.setItem('user-token', token);
        window.location.replace(url);
    });

    function collectFormData() {
        const result = {
            login: $('#login').val(),
            password: $('#password').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
        };
        const birthdate = $('#birthdate').val()
        if (birthdate) {
            result['birthdate'] = birthdate;
        }

        return result;
    }
}

const register = {
    async make(data) {
        return await axios.post('/api/users/register', data)
            .then(({data, status}) => {
                if (status !== 200 || !data.result) {
                    Modal.show('Ошибка', 'Произошла ошибка во время запроса. Пожалуйста перезагрузите страницу');
                    return null;
                }
                if (data.result.success) {
                    return data.result;
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
