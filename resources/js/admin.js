jQuery(document).ready(function () {
    Events.updateGeneral();
    Events.updateUsers();
});

const Events = (function () {
    const $generalEvents = $('#general-events');
    const $userEvents = $('#user-events');
    const $eventContainer = $('#event-container');
    let generalEvents;
    let userEvents;

    /**
     * Загрузка событий
     * @param {boolean} user - Если передан параметр true загружаются события пользователя
     */
    function load(user = false) {
        return axios.get('/api/events/' + (user ? 'user/' : ''))
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return null;
                }
                return data.result;
            }).catch((e) => {
                console.error(e);
                return null;
            });
    }

    function loadEvent(id) {
        return axios.get('/api/events/' + id)
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return null;
                }
                return data.result;
            })
            .catch((e) => {
                console.error(e);
                return null;
            });
    }

    async function updateGeneral() {
        generalEvents = await load();
        if (!generalEvents) {
            return;
        }
        if (generalEvents.length <= 0) {
            $generalEvents.html('<li class="nav-header">Все события</li>'
                + '<li class="nav-item"><a href="javascript:void(0)" class="nav-link">Событий нет</a></li>');
            return;
        }
        let html = generalEvents.reduce(function (res, event) {
            return res + '<li class="nav-item">' +
                '<a href="javascript:void(0)" class="nav-link" data-id="' + event.id + '">' +
                '<p>' + event.header + '</p>' +
                '</a>' +
                '</li>';
        }, '<li class="nav-header">Все события</li>');
        $generalEvents.html(html);
        addEventClickHandlers($generalEvents);
    }

    async function updateUsers() {
        userEvents = await load(true);
        if (!userEvents) {
            return;
        }
        if (userEvents.length <= 0) {
            $userEvents.html('<li class="nav-header">Мои события</li>'
                + '<li class="nav-item"><a href="javascript:void(0)" class="nav-link">Событий нет</a></li>');
            return;
        }
        let html = userEvents.reduce(function (res, event) {
            return res + '<li class="nav-item">' +
                '<a href="javascript:void(0)" class="nav-link" data-id="' + event.id + '">' +
                '<p>' + event.header + '</p>' +
                '</a>' +
                '</li>';
        }, '<li class="nav-header">Мои события</li>');
        html += '<li class="nav-item">' +
            '<a href="javascript:void(0)" class="nav-link">' +
            '<i class="nav-icon fas fa-plus"></i>' +
            '<p>Добавить событие</p>' +
            '</a>' +
            '</li>';
        $userEvents.html(html);
        addEventClickHandlers($userEvents);
    }

    function addEventClickHandlers($container) {
        $container.find('.nav-link').off('click').on('click', async function () {
            const eventId = $(this).data('id');
            $eventContainer.toggle(false);
            await fillEventInfo(eventId);
            $eventContainer.show();
        });
    }

    async function fillEventInfo(id) {
        const event = await loadEvent(id);
        if (!event) {
            $eventContainer.find('#event-header, #event-text, #event-date, #participants, #join-button, #refuse-button').hide();
            $eventContainer.find('#alert-info').show();
            return;
        } else {
            $eventContainer.find('#event-header, #event-text, #event-date, #participants, #join-button, #refuse-button').show();
            $eventContainer.find('#alert-info').hide();
        }
        const eventId = event.id ?? '';
        const header = event.header ?? '';
        const text = event.text ?? '';
        const created_at = event.created_at ?? '';
        const participants = event.participants ?? [];

        const isUserEvent = Array.isArray(userEvents) && userEvents.some((event) => event.id === eventId);

        $eventContainer.find('#event-header').text(header);
        $eventContainer.find('#event-text').text(text);
        $eventContainer.find('#event-date').text(created_at);

        if (participants.length > 0) {
            $eventContainer.find('#participants').html(participants.reduce(function (res, participant) {
                return res + '<p>' + (participant.fio ?? '') + '</p>';
            }, ''));
        } else {
            $eventContainer.find('#participants').html('<p>Нет участников</p>');
        }

        $('#join-button').toggle(!isUserEvent);
        $('#refuse-button').toggle(isUserEvent);
    }

    return {
        updateGeneral,
        updateUsers,
    };
})();
