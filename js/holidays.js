(function () {
    /* =========================
       HOLIDAY TOP BAR
    ========================== */
    const bar = document.getElementById('holidayBar');
    if (bar) {


        if (localStorage.getItem('holidayBarClosed') === '1') {
            bar.remove();
        } else {

            const barHeight = bar.offsetHeight;
            document.body.style.paddingTop = barHeight + 'px';

            window.closeHolidayBar = function () {
                localStorage.setItem('holidayBarClosed', '1');
                bar.style.display = 'none';
                document.body.style.paddingTop = '';
            };
        }
    }


    /* =========================
       HOLIDAY POPUP
    ========================== */
    const popup = document.getElementById('holidayPopup');
    if (!popup) return;

    if (localStorage.getItem('holidayPopupSeen') === '1') return;

    window.addEventListener('load', () => {
        setTimeout(() => {
            popup.classList.remove('hidden');
        }, 1200);
    });

    window.closeHolidayPopup = function () {
        localStorage.setItem('holidayPopupSeen', '1');
        popup.classList.add('hidden');
    };

})();
