import Modal from '@/modal.js';

jQuery(document).ready(async function () {
    await (async function () {
        const request = axios.get('/api/user');
        const result = await request
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return {};
                }
                return data.result;
            })
            .catch((e) => {
                console.error(e);
                return {};
            });
        Events.setUser(result);
    })();

    Events.updateGeneral();
    Events.updateUsers();
});

const Events = (function () {
    const $generalEvents = $('#general-events');
    const $userEvents = $('#user-events');
    const $eventContainer = $('#event-container');
    const $joinButton = $eventContainer.find('#join-button');
    const $refuseButton = $eventContainer.find('#refuse-button');
    const $deleteButton = $eventContainer.find('#delete-button');
    let generalEvents;
    let userEvents;
    let user = {};

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
        async function body() {
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
            $userEvents.html(html);
            addEventClickHandlers($userEvents);
        }

        await body();
        checkLocalStorageEvents();
        updateUsers = body;
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
        const canJoin = !isUserEvent && participants.every((participant) => participant.id !== user.id);

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

        $joinButton.toggle(canJoin).off('click').on('click', function () {
            changeActivity(eventId, true);
        });
        $refuseButton.toggle(!canJoin).off('click').on('click', function () {
            changeActivity(eventId, false);
        });
        $deleteButton.toggle(isUserEvent).off('click').on('click', function () {
            deleteEvent(eventId);
        });
    }

    async function changeActivity(eventId, activity) {
        const request = axios.get('/api/events/' + eventId + '/' + (activity ? 'join' : 'refuse'));
        const result = await request
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return null;
                }
                return data.result;
            })
            .catch((e) => {
                Modal.show('Ошибка', 'Возникла ошибка во время удаления события. Пожалуйста, перезагрузите страницу.');
                console.error(e);
                return null;
            });
        if (result.success) {
            $eventContainer.hide();
            await fillEventInfo(eventId);
            $eventContainer.show();
        }
    }

    async function deleteEvent(eventId) {
        const request = axios.delete('/api/events/' + eventId);
        const result = await request
            .then(({status, data}) => {
                if (status !== 200 || data.error) {
                    return null;
                }
                return data.result;
            })
            .catch((e) => {
                Modal.show('Ошибка', 'Возникла ошибка во время удаления события. Пожалуйста, перезагрузите страницу.');
                console.error(e);
                return null;
            });
        if (result.success) {
            updateGeneral();
            updateUsers();
            $eventContainer.hide();
        }
    }

    async function checkLocalStorageEvents() {
        const eventId = localStorage.getItem('event_id');
        if (eventId) {
            localStorage.removeItem('event_id');
            await fillEventInfo(eventId);
            $eventContainer.show();
        }
    }

    return {
        updateGeneral,
        updateUsers,
        setUser(userData) {
            user = userData;
        }
    };
})();
