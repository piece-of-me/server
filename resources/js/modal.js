const Modal = (function () {
    const $modal = $('#modal-danger');
    const $header = $modal.find('.modal-title');
    const $body = $modal.find('.modal-body');
    $modal.find('.close').on('click', function () {
        hide();
    });

    function hide() {
        $modal.removeClass('show').fadeOut(250);
    }

    function show(title, content) {
        if (typeof title === 'string') {
            $header.html(title);
        } else {
            $header.html('');
        }
        if (typeof content === 'string') {
            $body.html(content);
        }
        $modal.addClass('show').fadeIn(250);
    }

    return {
        hide,
        show,
    };
})();

export default Modal;
