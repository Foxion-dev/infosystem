const bxFetch = async (url, formData) => {
    const fetchResp = await fetch(url, {
        method: 'post',
        headers: {
            'bx-ajax': 'Y',
        },
        body: formData
    });
    if (!fetchResp.ok) {
        throw new Error(fetchResp.status);
    }
    return await fetchResp;
};
const forms = document.querySelectorAll('.js-form');
forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        showLoading();
        bxFetch(form.getAttribute('action'), formData)
            .then(function (response) {
                if (response.ok && response.status === 200) {
                    return response.json();
                }
            })
            .then((response) => {
                if (response.status === 'success') {
                    //form.reset();
                    //showSuccess (response.message);
                    window.location.href = '/thanks/';
                } else {
                    form.querySelector('.js-error').innerHTML = response.message;
                }
                hideLoading();
            })
            .catch((err) => setError(err));

    });
});
function initDomLoad() {
    const contentLoadedEvent = document.createEvent('Event');
    contentLoadedEvent.initEvent('DOMContentLoaded', true, true);
    window.document.dispatchEvent(contentLoadedEvent);
}

function showLoading() {
    document.querySelector('body').classList.add('is-loading');
}
function hideLoading() {
    document.querySelector('body').classList.remove('is-loading');
}
function setError(message) {
    console.log(message);
    hideLoading();
}
function showSuccess(message) {
    const modal = document.querySelector('.js-popup');
    const overlay = document.querySelector('.js-overlay');

    modal.classList.add('is-active');
    overlay.classList.add('is-active');

    modal.querySelector('.js-popup-title').innerHTML = message;

    setTimeout(function() {
        modal.classList.remove('is-active');
        overlay.classList.remove('is-active');
    }, 3000)
}
