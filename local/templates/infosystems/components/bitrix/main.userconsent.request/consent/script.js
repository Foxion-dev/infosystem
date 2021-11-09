document.addEventListener('DOMContentLoaded', function(){
    let controlNodes = [...document.querySelectorAll('[data-bx-user-consent]')];
    let formNodes = [...document.getElementsByTagName('form')];

    controlNodes.forEach((elem) => {
        elem.addEventListener('click', function (event) {
            event.preventDefault();

            let inputNode = elem.querySelector('input[type="checkbox"]');
            let consentId = this.getAttribute('data-bx-user-consent');

            let consentPopup = this.parentNode.querySelector('[data-main-user-consent-popup="'+ consentId +'"]');

            consentPopup.style.display = '';

            popupHandlers(consentPopup, inputNode);
        });
    });

    formNodes.forEach((form) => {
        form.addEventListener('submit', function (event) {
            let inputNodes = this.querySelectorAll('input[type="checkbox"]');

            inputNodes.forEach((inputNode) => {
                if (!inputNode.checked) {
                    event.preventDefault();

                    let consentId = inputNode.parentNode.getAttribute('data-bx-user-consent');

                    if (consentId) {
                        let consentPopup = form.querySelector('[data-main-user-consent-popup="'+ consentId +'"]');

                        consentPopup.style.display = '';

                        popupHandlers(consentPopup, inputNode);

                        return false;
                    }
                }
            });
        });
    });

    function popupHandlers(popupNode, inputNode) {
        let buttonAccept = popupNode.querySelector('[data-bx-btn-accept]');
        let buttonReject = popupNode.querySelector('[data-bx-btn-reject]');

        buttonAccept.addEventListener('click', function (event) {
            inputNode.checked = true;
            popupNode.style.display = 'none';
        });

        buttonReject.addEventListener('click', function (event) {

            inputNode.checked = false;
            popupNode.style.display = 'none';
        });
    }
});

