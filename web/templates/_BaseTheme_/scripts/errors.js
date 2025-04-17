window.ErrorsObject = {};

window.ErrorsObject = {
    showErrorCode: function(self, id)
    {
        let allCodeButtons = document.querySelectorAll('.item.switchable, .file-line.switchable');
        if(allCodeButtons !== undefined){
            for(let i = 0; i < allCodeButtons.length; i++){
                allCodeButtons[i].classList.remove('active');
            }
        }
        self.classList.add('active');

        let allCodeBlocks = document.querySelectorAll('.trace-back .right-panel .item');
        if(allCodeBlocks !== undefined){
            for(let i = 0; i < allCodeBlocks.length; i++){
                allCodeBlocks[i].classList.add('hidden');

                let cid = allCodeBlocks[i].getAttribute('id');
                if(id === cid){
                    console.log(id, cid);
                    allCodeBlocks[i].classList.remove('hidden');
                }
            }
        }
    }
};