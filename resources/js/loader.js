const Loader = (function () {
    const $loader = $('.preloader');
    let isVisible = true;

    function show() {
        if (isVisible) return;
        isVisible = !isVisible;

        $loader.css('height', '100%');
        setTimeout(function () {
            $loader.children().show();
        }, 200);
    }

    function hide() {
        if (!isVisible) return;
        isVisible = !isVisible;

        $loader.css('height', 0);
        setTimeout(function () {
            $loader.children().hide();
        }, 200);
    }

    return {
        show,
        hide,
    };
})();

export default Loader;
