window.formObj = {};

window.formObj = {
    ajaxSended: false,
    updateCaptcha: function(url, selector){
        let selectorObject = document.querySelector(selector);
        if(mainObj.defined(selectorObject) && !this.ajaxSended){
            let captchaBlock = document.querySelector('.captcha-block');
            if(mainObj.defined(captchaBlock)){
                captchaBlock.style.opacity = 0.5;
            }

            this.ajaxSended = true;

            selectorObject.setAttribute('src', mainObj.root + 'images/spinning_arrows.gif');

            let ajax = new XMLHttpRequest();

            ajax.open('POST', url, true);
            ajax.timeout = 30000;
            ajax.responseType = "blob";

            ajax.onreadystatechange = () => {
                if(ajax.readyState === 4){
                    let reader;
                    reader = new FileReader();
                    reader.onload = function(){
                        selectorObject.setAttribute('src', reader.result);
                    };
                    reader.readAsDataURL(ajax.response);

                    this.ajaxSended = false;
                    if(mainObj.defined(captchaBlock)){
                        captchaBlock.style.opacity = 1;
                    }
                }
            };
            ajax.onerror = () => {
                this.ajaxSended = false;
                if(mainObj.defined(captchaBlock)){
                    captchaBlock.style.opacity = 1;
                }
            };

            ajax.send();
        }else{
            console.log('Selector ' + selector + ' not found on DOM!');
        }
    },
};

